<?php
/*
 * This file is part of Redbox-Pipeline
 *
 * (c) Johnny Mast <mastjohnny@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Redbox\Pipeline\Conditions;

use Redbox\Pipeline\CondtionPipe;
use Redbox\Pipeline\Interfaces\ConditionInterface;

/**
 * class NotEquals.
 *
 * The NotEquals condition allows the CondtionPipe to
 * check if the pipeline input not equals the given value.
 *
 * PHP version 8.0 and higher.
 *
 * @category Conditions
 * @package  Redbox_Pipeline
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/axiom-labs/rivescript-php
 * @since    0.1.0
 */
class NotEquals implements ConditionInterface
{
    /**
     * @var \Redbox\Pipeline\CondtionPipe|null
     */
    protected ?CondtionPipe $pipe = null;

    public function __construct(protected mixed $value)
    {
    }

    /**
     * Set the pipeline for this condition.
     *
     * @param \Redbox\Pipeline\CondtionPipe $pipe The pipeline.
     *
     * @return void
     */
    public function setPipe(CondtionPipe $pipe): void
    {
        $this->pipe = $pipe;
    }

    /**
     * Check to see if a condition evaluates.
     *
     * @return bool
     */
    public function run(): bool
    {
        return ($this->pipe?->getInput() !== $this->value);
    }
}