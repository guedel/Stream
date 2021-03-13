<?php

  /*
   * Copyright (C) 2018 Proximit
   *
   * @author Guillaume de Lestanville <guillaume.delestanville@proximit.fr>.
   * @since 08/10/2018.
   *
   *
   */

  namespace Guedel\Stream;

  /**
   * Description of MemoryTextReader
   *
   * @author Guillaume de Lestanville <guillaume.delestanville@proximit.fr>
   */
  class MemoryTextReader extends TextStreamReader
  {
    private $text = '';
    private $position = 0;
    private $length;

    public function __construct(string $text)
    {
      $this->text = $text;
      $this->position = 0;
      $this->length = strlen($text);
    }

    public function eos(): bool
    {
      return $this->position >= $this->length;
    }

    public function read(int $length): string
    {
      $str = substr($this->text, $this->position, $length);
      $this->position += strlen($str);
      return $str;
    }

    public function readline(): string
    {
      for($pos = $this->position; $pos < $this->length; ++$pos) {
        $ch = $this->text[$pos];
        if ($ch === "\r" || $ch === "\n") {
          break;
        }
      }
      $ret = substr($this->text, $this->position, $pos - $this->position);
      while (($ch === "\r" || $ch === "\n") && $pos < $this->length) {
        $ch = $this->text[$pos];
        $pos++;
      }
      $this->position = $pos;
      return $ret;
    }

    public function rewind(): void
    {
      $this->position = 0;
    }
  }
