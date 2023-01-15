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
 * class EqualsOrLessThan.
 *
 * The EqualsOrLessThan condition allows the CondtionPipe to
 * check if the pipeline input equals or is less than the given value.
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
class EqualsOrLessThan implements ConditionInterface
{
    /**
     * @var \Redbox\Pipeline\CondtionPipe|null
     */
    protected ?CondtionPipe $pipeline = null;

    public function __construct(protected mixed $value)
    {
    }

    /**
     * Set the pipeline for this condition.
     *
     * @param \Redbox\Pipeline\CondtionPipe $pipeline The pipeline.
     *
     * @return void
     */
    public function setPipeline(CondtionPipe $pipeline): void
    {
        $this->pipeline = $pipeline;
    }

    /**
     * Check to see if a condition evaluates.
     *
     * @return bool
     */
    public function evaluate(): bool
    {
        return ($this->pipeline?->getInput() <= $this->value);
    }
}