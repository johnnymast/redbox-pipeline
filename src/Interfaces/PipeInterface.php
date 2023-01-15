<?php
/*
 * This file is part of Redbox-Pipeline
 *
 * (c) Johnny Mast <mastjohnny@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Redbox\Pipeline\Interfaces;

/**
 * interface PipelineInterface
 *
 * The PipelineInterface helps to force pipeplines to follow
 * a set to guided set of rules.
 *
 * PHP version 8.0 and higher.
 *
 * @category Interfaces
 * @package  Redbox_Pipeline
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/axiom-labs/rivescript-php
 * @since    0.1.0
 */
interface PipeInterface
{

    /**
     * Add an input for this pipeline.
     *
     * @param mixed $input
     *
     * @return $this
     */
    public function addInput(mixed $input): PipeInterface;

    /**
     * Return the input.
     *
     * @return mixed
     */
    public function getInput(): mixed;

    public function run(): bool;
}