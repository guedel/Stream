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
 * Base class to write text
 *
 * @author Guedel <guedel87@live.fr>
 */
abstract class TextStreamWriter
{
    abstract public function nl(): TextStreamWriter;

    abstract public function out($msg): TextStreamWriter;

    abstract public function outln($msg): TextStreamWriter;
}
