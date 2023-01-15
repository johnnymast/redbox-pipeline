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

use Redbox\Pipeline\CondtionPipe;
use Redbox\Pipeline\MutablePipe;
use Redbox\Pipeline\Pipe;

/**
 * interface MutationInterface
 *
 * The MutationInterface helps conditions to follow a set
 * of rules for the MutablePipe.
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
interface MutationInterface
{
    /**
     * Set the pipeline for this condition.
     *
     * @param \Redbox\Pipeline\MutablePipe $pipe The pipeline.
     *
     * @return void
     */
    public function setPipe(MutablePipe $pipe): void;

    /**
     * Check to see if a condition evaluates.
     *
     * @return bool
     */
    public function run(): bool;
}