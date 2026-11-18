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

use Guedel\Stream\ConsoleWriter;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(ConsoleWriter::class)]
class ConsoleWriterTest extends TestCase
{
    public function testOutSimpleString(): void
    {
        $message = "the fox";
        $writer = new ConsoleWriter();
        $this->expectOutputString($message);
        $writer->out($message);
    }

    public function testOutArrayOfString(): void
    {
        $message = ["the fox", " and ", "the dog"];
        $writer = new ConsoleWriter();
        $this->expectOutputString(implode('', $message));
        $writer->out($message);
    }

    public function testOutlnSimpleString(): void
    {
        $message = "the dog";
        $writer = new ConsoleWriter();
        $this->expectOutputString($message . PHP_EOL);
        $writer->outln($message);
    }

    public function testOutlnArrayOfString(): void
    {
        $message = ["the fox", " and ", "the dog"];
        $writer = new ConsoleWriter();
        $this->expectOutputString(implode('', $message) . PHP_EOL);
        $writer->outln($message);
    }
}
