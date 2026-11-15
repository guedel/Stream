<?php

/*
 * This file is part of AbstractLanguage library.
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
