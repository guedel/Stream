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
   * base class for read text
   *
   * @author Guillaume de Lestanville <guillaume.delestanville@proximit.fr>
   */
  abstract class TextStreamReader
  {
    /**
     * Read until new line
     */
    public abstract function readline() : string;

    /**
     * read $length chars
     */
    public abstract function read(int $length): string;

    /**
     * Goto begin of stream
     */
    public abstract function rewind() : void;

    /**
     * End of stream ?
     */
    public abstract function eos() : bool;
  }
