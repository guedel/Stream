<?php

  /*
   * Copyright (C) 2018 Proximit
   *
   * @author Guedel <guedel87@live.fr>.
   * @since 08/10/2018.
   *
   *
   */

namespace Guedel\Stream;

/**
 * Description of MemoryTextReader
 *
 * @author Guedel <guedel87@live.fr>
 */
class MemoryTextReader extends TextStreamReader
{
    private int $position = 0;
    private readonly int $length;

    private const string CR = "\r";
    private const string LF = "\n";
    private const string CRLF = "\r\n";

    public function __construct(private readonly string $text)
    {
        $this->position = 0;
        $this->length = strlen($this->text);
    }


    public function eos(): bool
    {
        return $this->position > $this->length;
    }

    public function read(int $length): string
    {
        if ($this->eos()) {
            return '';
        }
        $str = substr($this->text, $this->position, $length);
        $this->position += $length;
        return $str;
    }

    public function readline(): string
    {
        if ($this->eos()) {
            return '';
        }
        $posCr = strpos($this->text, self::CR, $this->position);
        $posLf = strpos($this->text, self::LF, $this->position);
        $posCrLf = strpos($this->text, self::CRLF, $this->position);
        $part = '';

        // exclude bad responses
        $positions = array_filter([$posCr, $posCrLf, $posLf], fn ($v) => $v !== false);
        if (! empty($positions)) {
            $pos = min($positions);
            if ($pos === $posCrLf) {
                $part = substr($this->text, $this->position, $pos - $this->position);
                $this->position = $pos + 2;
                return $part;
            }
            $part = substr($this->text, $this->position, $pos - $this->position);
            $this->position = $pos + 1;
            return $part;
        }
        $part = substr($this->text, $this->position);
        $this->position = $this->length + 1;
        return $part;
    }

    /**
     * Restart to the begin of text
     */
    public function rewind(): void
    {
        $this->position = 0;
    }
}
