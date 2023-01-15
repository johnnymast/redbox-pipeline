<?php
/*
 * This file is part of Redbox-Pipeline
 *
 * (c) Johnny Mast <mastjohnny@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Redbox\Pipeline;

use Redbox\Pipeline\Interfaces\PipeInterface;

/**
 * class Pipe.
 *
 * This is the base class for all pipe types
 * and contains the input related functions.
 *
 * PHP version 8.0 and higher.
 *
 * @category Core
 * @package  Redbox_Pipeline
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/axiom-labs/rivescript-php
 * @since    0.1.0
 */
class Pipe
{

    /**
     * The input for this pipeline.
     *
     * @var mixed|null
     */
    protected mixed $input = null;

    /**
     * Add an input for this pipeline.
     *
     * @param mixed $input The input for this pipe.
     *
     * @return \Redbox\Pipeline\Pipe
     */
    public function addInput(mixed $input): Pipe
    {
        $this->input = $input;
        return $this;
    }

    /**
     * Return the input.
     *
     * @return mixed
     */
    public function getInput(): mixed
    {
        return $this->input;
    }
}