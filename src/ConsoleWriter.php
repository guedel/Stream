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
 * Console output
 *
 * @author Guillaume de Lestanville <guillaume.delestanville@proximit.fr>
 */
class ConsoleWriter extends TextStreamWriter
{
    public function nl(): TextStreamWriter
    {
        echo PHP_EOL;
        return $this;
    }

    public function out($msg): TextStreamWriter
    {
        if (is_array($msg)) {
            foreach ($msg as $m) {
                echo $m;
            }
            return $this;
        }
        echo $m;
        return $this;
    }

    public function outln($msg): TextStreamWriter
    {
        return $this
            ->out($msg)
            ->nl();
    }
}
