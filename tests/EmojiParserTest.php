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
        $this->assertCount(2822, $data['emoji']);
    }

    public function testParse5_0()
    {
        $emojiParser = new EmojiParser(__DIR__ . '/emoji-test/5.0.txt');
        $data = $emojiParser->parse();
        $this->assertCount(3377, $data['emoji']);
    }

    public function testParse11_0()
    {
        $emojiParser = new EmojiParser(__DIR__ . '/emoji-test/11.0.txt');
        $data = $emojiParser->parse();
        $this->assertCount(3570, $data['emoji']);
    }

    public function testParse12_0()
    {
        $emojiParser = new EmojiParser(__DIR__ . '/emoji-test/12.0.txt');
        $data = $emojiParser->parse();
        $this->assertCount(3836, $data['emoji']);
    }

    public function testParse12_1()
    {
        $emojiParser = new EmojiParser(__DIR__ . '/emoji-test/12.1.txt');
        $data = $emojiParser->parse();
        $this->assertCount(4022, $data['emoji']);
    }

    public function testParse13_0()
    {
        $emojiParser = new EmojiParser(__DIR__ . '/emoji-test/13.0.txt');
        $data = $emojiParser->parse();
        $this->assertCount(4168, $data['emoji']);
    }

    public function testParse13_1()
    {
        $emojiParser = new EmojiParser(__DIR__ . '/emoji-test/13.1.txt');
        $data = $emojiParser->parse();
        $this->assertCount(4590, $data['emoji']);
    }

    public function testParse14_0()
    {
        $emojiParser = new EmojiParser(__DIR__ . '/emoji-test/14.0.txt');
        $data = $emojiParser->parse();
        $this->assertCount(4702, $data['emoji']);
    }

    public function testParse15_0()
    {
        $emojiParser = new EmojiParser(__DIR__ . '/emoji-test/15.0.txt');
        $data = $emojiParser->parse();
        $this->assertCount(4733, $data['emoji']);
    }

    public function testParse15_1()
    {
        $emojiParser = new EmojiParser(__DIR__ . '/emoji-test/15.1.txt');
        $data = $emojiParser->parse();
        $this->assertCount(5034, $data['emoji']);
    }

    public function testSortNone()
    {
        $emojiParser = new EmojiParser(__DIR__ . '/emoji-test/12.0.txt');
        $data = $emojiParser->parse();

        $codePoints = array_map(function($emoji) {
            return $emoji['code_point'];
        }, array_values(array_filter($data['emoji'], function ($emoji) {
            return $emoji['group'] === 'Smileys & Emotion' && $emoji['subgroup'] === 'face-affection';
        })));

        $this->assertSame([
            '1F970',
            '1F60D',
            '1F929',
            '1F618',
            '1F617',
            '263A FE0F',
            '263A',
            '1F61A',
            '1F619',
        ], $codePoints);
    }

    public function testSortAsc()
    {
        $emojiParser = new EmojiParser(__DIR__ . '/emoji-test/12.0.txt', ['sort' => SORT_ASC]);
        $data = $emojiParser->parse();

        $codePoints = array_map(function($emoji) {
            return $emoji['code_point'];
        }, array_values(array_filter($data['emoji'], function ($emoji) {
            return $emoji['group'] === 'Smileys & Emotion' && $emoji['subgroup'] === 'face-affection';
        })));

        $this->assertSame([
            '263A',
            '263A FE0F',
            '1F60D',
            '1F617',
            '1F618',
            '1F619',
            '1F61A',
            '1F929',
            '1F970',
        ], $codePoints);
    }

    public function testSortDesc()
    {
        $emojiParser = new EmojiParser(__DIR__ . '/emoji-test/12.0.txt', ['sort' => SORT_DESC]);
        $data = $emojiParser->parse();

        $codePoints = array_map(function($emoji) {
            return $emoji['code_point'];
        }, array_values(array_filter($data['emoji'], function ($emoji) {
            return $emoji['group'] === 'Smileys & Emotion' && $emoji['subgroup'] === 'face-affection';
        })));

        $this->assertSame([
            '1F970',
            '1F929',
            '1F61A',
            '1F619',
            '1F618',
            '1F617',
            '1F60D',
            '263A FE0F',
            '263A',
        ], $codePoints);
    }
}
