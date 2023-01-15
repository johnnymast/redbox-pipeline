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

use Redbox\Pipeline\Interfaces\ConditionInterface;
use Redbox\Pipeline\Interfaces\PipeInterface;

/**
 * class CondtionPipeline.
 *
 * The Condition piple line allow to run your input
 * through a set of conditions.
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
class CondtionPipe implements PipeInterface
{
    /**
     * Registered handlers.
     *
     * @var array<string, string|callable $handler >
     */
    protected array $handlers = [
        'success' => null,
        'failed' => null,
    ];

    /**
     * The conditions for this pipeline.
     *
     * @var array<\Redbox\Pipeline\Interfaces\ConditionInterface>
     */
    protected array $conditions = [];

    /**
     * The input for this pipeline.
     *
     * @var mixed|null
     */
    protected mixed $input = null;

    /**
     * This is the callback for success.
     *
     * @param string|callable $handler
     *
     * @return $this
     */
    public function succes(string|callable $handler): CondtionPipe
    {
        $this->handlers['success'] = $handler;

        return $this;
    }

    /**
     * This is the callback for failure.
     *
     * @param string|callable $handler
     *
     * @return $this
     */
    public function failed(string|callable $handler): CondtionPipe
    {
        $this->handlers['failed'] = $handler;

        return $this;
    }

    /**
     * Add an input for this pipeline.
     *
     * @param mixed $input
     *
     * @return $this
     */
    public function addInput(mixed $input): PipeInterface
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

    /**
     * Add a single condtion.
     *
     * @param \Redbox\Pipeline\Interfaces\ConditionInterface $condition
     *
     * @return \Redbox\Pipeline\CondtionPipe
     */
    public function addCondition(ConditionInterface $condition): CondtionPipe
    {
        $this->conditions[] = $condition;

        return $this;
    }

    /**
     * Add a list of conditions.
     *
     * @param array<\Redbox\Pipeline\Interfaces\ConditionInterface> $conditions
     *
     * @return \Redbox\Pipeline\CondtionPipe
     */
    public function addConditions(array $conditions): CondtionPipe
    {
        if (count($conditions) > 0) {
            foreach ($conditions as $condition) {
                $this->addCondition($condition);
            }
        }

        return $this;
    }

    /**
     * Run the Pipeline.
     *
     * @return bool
     */
    public function run(): bool
    {
        $failed = false;

        foreach ($this->conditions as $condition) {
            $condition->setPipeline($this);

            if (!$condition->evaluate()) {
                $failed = true;
                break;
            }
        }

        if ($failed) {
            if ($this->handlers['failed']) {
                call_user_func($this->handlers['failed'], $condition, $this->input);
            }
            return false;
        } else {
            if ($this->handlers['success']) {
                call_user_func($this->handlers['success'], $this->input);
            }
        }

        return true;
    }
}