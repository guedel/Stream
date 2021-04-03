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
   * Base class to write text
   *
   * @author Guedel <guedel87@live.fr>
   */
  abstract class TextStreamWriter
  {
    public abstract function nl() : TextStreamWriter;

    public abstract function out($msg): TextStreamWriter;

    public abstract function outln($msg) : TextStreamWriter;
  }
