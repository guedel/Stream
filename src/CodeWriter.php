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
 * Description of CodeWriter
 *
 * @author Guedel <guedel87@live.fr>
 */
class CodeWriter extends TextStreamWriter
{
    /**
     *
     * @var string Buffer
     */
    private string $current = '';

    /**
     *
     * @var array Stored lines of text
     */
    private array $lines = [];

    /**
     *
     * @param int $indent Level of indentation
     */
    public function __construct(
        private readonly string $spacer = "\t",
        private int $indent = 0
    ) {
        $this->current = '';
        $this->lines = [];
    }

    public function indent(): self
    {
        $this->indent++;
        return $this;
    }

    public function unindent(): self
    {
        if ($this->indent > 0) {
            $this->indent--;
        }
        return $this;
    }

    public function render(): string
    {
        if (0 < strlen($this->current)) {
            $this->nl();
        }
        $ret = '';
        foreach ($this->lines as $line) {
            $ret .= $line . PHP_EOL;
        }
        return $ret;
    }

    public function merge(CodeWriter $writer): self
    {
        if (0 < strlen($this->current)) {
            $this->nl();
        }
        foreach ($writer->lines as $line) {
            $this->lines[] = $line;
        }
        return $this;
    }

    /**
     * Do a newline. Flush the buffer
     */
    public function nl(): TextStreamWriter
    {
        $line = str_repeat($this->spacer, $this->indent) . $this->current;
        $this->lines[] = $line;
        $this->current = '';
        return $this;
    }

    /**
     *  simple output witout new line
     *
     * @param array|string $msg
     */
    public function out($msg): TextStreamWriter
    {
        if (is_array($msg)) {
            foreach ($msg as $m) {
                $this->current .= $m;
            }
            return $this;
        }
        $this->current .= $msg;
        return $this;
    }

    /**
     * output with new line
     *
     * @param array|string $msg
     */
    public function outln($msg): TextStreamWriter
    {
        $this->out($msg);
        $this->nl();
        return $this;
    }
}
