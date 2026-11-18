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

use Guedel\Stream\FileException;
use Guedel\Stream\FileTextReader;
use PHPUnit\Framework\Attributes\CoversClass;
use PHPUnit\Framework\TestCase;

#[CoversClass(FileTextReader::class)]
class FileTextReaderTest extends TestCase
{
    private const string FILENAME = __DIR__ . '/../mock/fileread.txt';

    public function testEosEmpty(): void
    {
        $stream = new FileTextReader();
        $this->expectException(FileException::class);
        $stream->eos();
    }

    public function testReadEmpty(): void
    {
        $stream = new FileTextReader();
        $this->expectException(FileException::class);
        $stream->read(1);
    }

    public function testReadlineEmpty(): void
    {
        $stream = new FileTextReader();
        $this->expectException(FileException::class);
        $stream->readline();
    }

    public function testRewindEmpty(): void
    {
        $stream = new FileTextReader();
        $this->expectException(FileException::class);
        $stream->rewind();
    }

    public function testOpenBadFile(): void
    {
        $stream = new FileTextReader();
        $this->expectException(FileException::class);
        $stream->open('dummy.nul');
    }

    public function testRead(): void
    {
        $stream = new FileTextReader(self::FILENAME);
        $part = $stream->read(3);
        $this->assertEquals('the', $part);
    }

    public function testReadline(): void
    {
        $stream = new FileTextReader(self::FILENAME);
        $part = $stream->readline();
        $this->assertEquals('the dog', $part);
    }

    public function testRewind(): void
    {
        $stream = new FileTextReader(self::FILENAME);
        $part = $stream->readline();
        $this->assertEquals('the dog', $part);
        $stream->rewind();
        $part = $stream->readline();
        $this->assertEquals('the dog', $part);
        $this->assertFalse($stream->eos());
        $stream->close();
    }
}
