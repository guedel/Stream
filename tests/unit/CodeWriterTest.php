<?php

/*
 * This file is part of Stream library.
 *
 * (c) Guedel <guedel87@live.fr>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Guedel\Stream\Tests\Unit;

use Guedel\Stream\CodeWriter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(CodeWriter::class)]
class CodeWriterTest extends TestCase
{
    public function testSingleLine(): void
    {
        $text = 'the fox';
        $writer = new CodeWriter(' ');
        $writer->out($text);
        $result = $writer->render();
        $this->assertEquals($text . PHP_EOL, $result);
    }

    public function testConcat(): void
    {
        $text = ['the fox', ' and the dog'];
        $writer = new CodeWriter(' ');
        $writer->out($text);
        $result = $writer->render();
        $this->assertEquals(implode('', $text) . PHP_EOL, $result);
    }

    public function testMultiline(): void
    {
        $text1 = 'the fox';
        $text2 = 'and the dog';
        $writer = new CodeWriter(' ');
        $writer
            ->outln($text1)
            ->outln($text2);
        $result = $writer->render();
        $expected = $text1 . PHP_EOL . $text2 . PHP_EOL;
        $this->assertEquals($expected, $result);
    }

    public function testIndentation(): void
    {
        $text1 = 'the fox';
        $text2 = 'and';
        $text3 = 'the dog';
        $writer = new CodeWriter(' ');
        $writer
            ->outln($text1)
            ->indent()
            ->outln($text2)
            ->unindent()
            ->outln($text3)
        ;
        $result = $writer->render();
        $expected = $text1 . PHP_EOL . ' ' . $text2 . PHP_EOL . $text3 . PHP_EOL;
        $this->assertEquals($expected, $result);
    }

    public function testMerge(): void
    {
        $text1 = 'the fox';
        $text2 = 'and';
        $text3 = 'the dog';
        $writer1 = new CodeWriter(' ');
        $writer1->outln($text1)->out($text2);
        $writer2 = new CodeWriter(' ');
        $writer2->outln($text3);
        $writer1->merge($writer2);
        $result = $writer1->render();
        $expected = $text1 . PHP_EOL . $text2 . PHP_EOL . $text3 . PHP_EOL;
        $this->assertEquals($expected, $result);
    }
}
