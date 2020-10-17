<?php

  /*
   * Copyright (C) 2018 Proximit
   *
   * @author Guillaume de Lestanville <guillaume.delestanville@proximit.fr>.
   * @since 08/10/2018.
   *
   *
   */

  namespace guedel\Stream;

  /**
   * Description of CodeWriter
   *
   * @author Guillaume de Lestanville <guillaume.delestanville@proximit.fr>
   */
  class CodeWriter extends TextStreamWriter
  {
    /**
     *
     * @var int Level of indentation
     */
    private $indent = 0;

    /**
     *
     * @var string
     */
    private $spacer = '\t';
    /**
     *
     * @var string Buffer
     */
    private $current = '';

    /**
     *
     * @var array Stored lines of text
     */
    private $lines = array();

    public function __construct(string $spacer = "\t", int $initialIndent  = 0)
    {
      $this->indent = $initialIndent;
      $this->spacer = $spacer;
      $this->current = '';
      $this->lines = array();
    }

    public function indent() : self
    {
      $this->indent++;
      return $this;
    }

    public function unindent() : self
    {
      if ($this->indent > 0) {
        $this->indent--;
      }
      return $this;
    }

    public function render() : string
    {
      if (0 < strlen($this->current)) {
        $this->nl();
      }
      $ret = '';
      foreach($this->lines as $line) {
        $ret .= $line . PHP_EOL;
      }
      return $ret;
    }

    public function merge(CodeWriter $writer) : self
    {
      if (0 < strlen($this->current)) {
        $this->nl();
      }
      foreach($writer->lines as $line) {
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
     * @param array|string msg
     */
    public function out($msg): TextStreamWriter
    {
      if (is_array($msg)) {
        foreach($msg as $m) {
          $this->current .= $m;
        }
      } else {
        $this->current .= $msg;
      }
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
