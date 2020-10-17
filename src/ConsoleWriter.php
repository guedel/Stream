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
   * Console output
   *
   * @author Guillaume de Lestanville <guillaume.delestanville@proximit.fr>
   */
  class ConsoleWriter extends TextStreamWriter
  {
    public function nl(): void
    {
     echo PHP_EOL;
    }

    public function out($msg): void
    {
      if (is_array($msg)) {
        foreach ($msg as $m) {
          echo $m;
        }
      } else {
        echo $m;
      }
    }

    public function outln($msg): void
    {
      if (is_array($msg)) {
        foreach ($msg as $m) {
          echo $m;
        }
      } else {
        echo $m;
      }
      $this->nl();
    }

  }
