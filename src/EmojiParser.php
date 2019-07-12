<?php

namespace Sunaoka\EmojiParser;

use LogicException;

class EmojiParser
{
    const URL = 'https://unicode.org/Public/emoji/%s/emoji-test.txt';

    /**
     * @var string
     */
    private $path;

    /**
     * EmojiParser constructor.
     *
     * @param string $path path of emoji-test.txt
     */
    public function __construct(string $path)
    {
        $this->path = $path;
    }

    /**
     * Parse emoji-test.txt
     *
     * @return array
     */
    public function parse()
    {
        $contents = $this->load();

        $blocks = explode("\n\n", trim($contents));

        $result = $this->parseHeader(array_shift($blocks));
        $result['emoji'] = $this->parseBody($blocks);

        return $result;
    }

    private function parseHeader(string $block)
    {
        $result = [];
        $rows = explode("\n", $block);
        foreach ($rows as $row) {
            if (($value = $this->getValue($row, '# Date:')) !== false) {
                $result['date'] = $value;
            }
            if (($value = $this->getValue($row, '# Version:')) !== false) {
                $result['version'] = $value;
                $result['url'] = sprintf(self::URL, $value);
            }
        }
        return $result;
    }

    private function parseBody(array $blocks)
    {
        $result = [];
        $group = null;
        foreach ($blocks as $block) {
            $rows = explode("\n", trim($block));

            if (($value = $this->getValue($rows[0], '# group:')) !== false) {
                $group = $value;
                continue;
            }

            if (($subgroup = $this->getValue($rows[0], '# subgroup:')) !== false) {
                array_shift($rows);
                foreach ($rows as $row) {
                    // Format: code points; status # emoji name
                    list($codePoint, $status, $emoji, $name) = sscanf($row, '%[^;]; %[^#] # %[^ ] %[^$]');

                    $result[] = [
                        'group'      => $group,
                        'subgroup'   => $subgroup,
                        'code_point' => trim($codePoint),
                        'status'     => trim($status),
                        'emoji'      => trim($emoji),
                        'name'       => trim($name),
                    ];
                }
            }
        }

        return $result;
    }

    private function getValue($row, $key)
    {
        if (strpos($row, $key) !== 0) {
            return false;
        }

        return substr($row, strlen($key) + 1);
    }

    private function load()
    {
        if (! is_readable($this->path)) {
            throw new LogicException("{$this->path}: No such file");
        }

        return file_get_contents($this->path);
    }
}
