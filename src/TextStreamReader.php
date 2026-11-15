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
 * base class for read text
 *
 * @author Guillaume de Lestanville <guillaume.delestanville@proximit.fr>
 */
abstract class TextStreamReader
{
    /**
     * Read until new line
     */
    abstract public function readline(): string;

    /**
     * read $length chars
     */
    abstract public function read(int $length): string;

    /**
     * Goto begin of stream
     */
    abstract public function rewind(): void;

    /**
     * End of stream ?
     */
    abstract public function eos(): bool;
}
