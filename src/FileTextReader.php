<?php

/*
 * This file is part of Stream library.
 *
 * (c) Guedel <guedel87@live.fr>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace Guedel\Stream;

/**
 * Description of FileTextReader
 *
 * @author Guillaume de Lestanville <guillaume.delestanville@proximit.fr>
 */
class FileTextReader extends TextStreamReader
{
    private $filename;
    private $file;
    private $filesize;

    public function __construct(string $filename = null)
    {
        if ($filename === null) {
            $this->filesize = 0;
            $this->filename = null;
            $this->file =  null;
            return;
        }
        $this->open($filename);
    }

    public function close()
    {
        if ($this->file !== null) {
            fclose($this->file);
            $this->file = null;
            $this->filename = null;
            $this->filesize = 0;
        }
    }

    public function open(string $filename): bool
    {
        if (! file_exists($filename)) {
            throw new FileException('file not found');
        }
        $this->filesize = filesize($filename);
        $this->file = fopen($this->filename = $filename, "r");
    }

    public function eos(): bool
    {
        if ($this->file === null) {
            throw new FileException("end of stream on not opened file!");
        }
        return feof($this->file);
    }

    public function read(int $length): string
    {
        if ($this->file === null) {
            throw new FileException("attempt to read on not opened file!");
        }
        return fread($this->file, $length);
    }

    public function readline(): string
    {
        if ($this->file === null) {
            throw new FileException("attempt to read a line on not opened file!");
        }
        $res = fgets($this->file);
        return rtrim($res, "\r\n");
    }

    public function rewind(): void
    {
        if ($this->file === null) {
            throw new FileException("attempt to rewind on not opened file!");
        }
        fseek($this->file, 0);
    }
}
