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
   * Base class to write text
   *
   * @author Guillaume de Lestanville <guillaume.delestanville@proximit.fr>
   */
  abstract class TextStreamWriter
  {
    public abstract function nl() : TextStreamWriter;

    public abstract function out($msg): TextStreamWriter;

    public abstract function outln($msg) : TextStreamWriter;
  }
