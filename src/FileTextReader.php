<?php

  /*
   * The MIT License
   *
   * Copyright 2018 Guillaume de Lestanville <guillaume.delestanville@proximit.fr>.
   *
   * Permission is hereby granted, free of charge, to any person obtaining a copy
   * of this software and associated documentation files (the "Software"), to deal
   * in the Software without restriction, including without limitation the rights
   * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
   * copies of the Software, and to permit persons to whom the Software is
   * furnished to do so, subject to the following conditions:
   *
   * The above copyright notice and this permission notice shall be included in
   * all copies or substantial portions of the Software.
   *
   * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
   * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
   * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
   * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
   * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
   * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN
   * THE SOFTWARE.
   */

  namespace guedel\Stream;

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
      } else {
        $this->open($filename);
      }
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
