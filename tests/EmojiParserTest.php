<?php

namespace Sunaoka\EmojiParser\Tests;

use PHPUnit\Framework\TestCase;
use Sunaoka\EmojiParser\EmojiParser;

class EmojiParserTest extends TestCase
{
    public function testLoadFail()
    {
        $this->expectExceptionMessage('fake.txt: No such file');
        $emojiParser = new EmojiParser('fake.txt');
        $emojiParser->parse();
    }

    public function testParse4_0()
    {
        $emojiParser = new EmojiParser(__DIR__ . '/emoji-test/4.0.txt');
        $data = $emojiParser->parse();
        $this->assertSame(2822, count($data['emoji']));
    }

    public function testParse5_0()
    {
        $emojiParser = new EmojiParser(__DIR__ . '/emoji-test/5.0.txt');
        $data = $emojiParser->parse();
        $this->assertSame(3377, count($data['emoji']));
    }

    public function testParse11_0()
    {
        $emojiParser = new EmojiParser(__DIR__ . '/emoji-test/11.0.txt');
        $data = $emojiParser->parse();
        $this->assertSame(3570, count($data['emoji']));
    }

    public function testParse12_0()
    {
        $emojiParser = new EmojiParser(__DIR__ . '/emoji-test/12.0.txt');
        $data = $emojiParser->parse();
        $this->assertSame(3836, count($data['emoji']));
    }
}
