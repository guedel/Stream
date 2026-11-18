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

use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;
use Guedel\Stream\MemoryTextReader;

#[CoversClass(MemoryTextReader::class)]
class MemoryTextReaderTest extends TestCase
{
    public function testEmptyString(): void
    {
        $reader = new MemoryTextReader("");
        $this->assertFalse($reader->eos());
        $reader->read(1);
        $this->assertTrue($reader->eos());
        $reader->read(1);
        $this->assertTrue($reader->eos());
    }

    public function testOverflow(): void
    {
        $reader = new MemoryTextReader("the fox");
        $part = $reader->read(10);
        $this->assertTrue($reader->eos());
        $this->assertEquals("the fox", $part);
    }

    public function testWithoutNewline(): void
    {
        $reader = new MemoryTextReader("the dog with a fox in the forest");
        $this->assertFalse($reader->eos());
        $part = $reader->read(7);
        $this->assertFalse($reader->eos());
        $this->assertEquals("the dog", $part);
        $part2 = $reader->readline();
        $this->assertTrue($reader->eos());
        $this->assertEquals(" with a fox in the forest", $part2);
        $reader->rewind();
        $this->assertFalse($reader->eos());
        $this->assertEquals($part, $reader->read(7));
    }

    public function testWithNewline(): void
    {
        $reader = new MemoryTextReader("the dog\nwith a fox\nin the forest\n");
        $part1 = $reader->readline();
        $this->assertFalse($reader->eos());
        $this->assertEquals("the dog", $part1);
        $part2 = $reader->readline();
        $this->assertFalse($reader->eos());
        $this->assertEquals("with a fox", $part2);
        $part3 = $reader->readline();
        $this->assertFalse($reader->eos());
        $this->assertEquals("in the forest", $part3);
        $part4 = $reader->readline();
        $this->assertTrue($reader->eos());
        $this->assertEquals('', $part4);
        $reader->readline();
        $this->assertTrue($reader->eos());
    }

    public function testMixEol(): void
    {
        $reader = new MemoryTextReader("the dog\rwith a fox\r\nin the forest\n");
        $part1 = $reader->readline();
        $this->assertFalse($reader->eos());
        $this->assertEquals("the dog", $part1);
        $part2 = $reader->readline();
        $this->assertFalse($reader->eos());
        $this->assertEquals("with a fox", $part2);
        $part3 = $reader->readline();
        $this->assertFalse($reader->eos());
        $this->assertEquals("in the forest", $part3);
        $part4 = $reader->readline();
        $this->assertTrue($reader->eos());
        $this->assertEquals('', $part4);
    }
}
