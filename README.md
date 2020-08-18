# Parsing unicode emoji text file using PHP

[![Latest Stable Version](https://poser.pugx.org/sunaoka/emoji-parser/v/stable)](https://packagist.org/packages/sunaoka/emoji-parser)
[![License](https://poser.pugx.org/sunaoka/emoji-parser/license)](https://packagist.org/packages/sunaoka/emoji-parser)
[![Build Status](https://travis-ci.org/sunaoka/emoji-parser.svg?branch=develop)](https://travis-ci.org/sunaoka/emoji-parser)
[![codecov](https://codecov.io/gh/sunaoka/emoji-parser/branch/develop/graph/badge.svg)](https://codecov.io/gh/sunaoka/emoji-parser)

---

Library to parse `emoji-test.txt`
(`emoji-test.txt` file provides data for testing which emoji forms should be in keyboards and which should also be displayed/processed).

## Installation

```bash
composer require --dev sunaoka/php-parser
```

## Usage

```php
<?php

use Sunaoka\EmojiParser\EmojiParser;

$emojiParser = new EmojiParser('emoji-test.txt');
$data = $emojiParser->parse();

print_r($data);
```

output is ...

```text
(
    [date] => 2020-01-21, 13:40:25 GMT
    [version] => 13.0
    [url] => https://unicode.org/Public/emoji/13.0/emoji-test.txt
    [emoji] => Array
        (
            [0] => Array
                (
                    [group] => Smileys & Emotion
                    [subgroup] => face-smiling
                    [code_point] => 1F600
                    [status] => fully-qualified
                    [emoji] => 😀
                    [name] => grinning face
                    [version] => 1
                )
  :
  :
```

## Options

### sort

see: [Arrays > Predefined Constants > Sorting order flags](https://php.net/array.constants).

```php
<?php

use Sunaoka\EmojiParser\EmojiParser;

$options = [
    'sort' => SORT_ASC,
];

$emojiParser = new EmojiParser('emoji-test.txt', $options);
$data = $emojiParser->parse();
```

## emoji-test.txt

| Version | URL                                                  |
| ------: | ---------------------------------------------------- |
|    13.0 | https://unicode.org/Public/emoji/13.0/emoji-test.txt |
|    12.1 | https://unicode.org/Public/emoji/12.1/emoji-test.txt |
|    12.0 | https://unicode.org/Public/emoji/12.0/emoji-test.txt |
|    11.0 | https://unicode.org/Public/emoji/11.0/emoji-test.txt |
|     5.0 | https://unicode.org/Public/emoji/5.0/emoji-test.txt  |
|     4.0 | https://unicode.org/Public/emoji/4.0/emoji-test.txt  |
