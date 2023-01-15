<?php
/*
 * This file is part of Redbox-Pipeline
 *
 * (c) Johnny Mast <mastjohnny@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Redbox\Pipeline\Mutations;

use Redbox\Pipeline\Interfaces\MutationInterface;
use Redbox\Pipeline\MutablePipe;

/**
 * class Equals.
 *
 * The Equals condition allows the CondtionPipe to
 * check if the pipeline input equals the given value.
 *
 * PHP version 8.0 and higher.
 *
 * @category Mutations
 * @package  Redbox_Pipeline
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/axiom-labs/rivescript-php
 * @since    0.1.0
 */
class AppendString implements MutationInterface
{
    /**
     * @var \Redbox\Pipeline\MutablePipe|null
     */
    protected ?MutablePipe $pipe = null;

    /**
     * @param mixed $value The string to add.
     */
    public function __construct(protected string $value = '')
    {
    }

    /**
     * Set the pipe to work on.
     *
     * @param \Redbox\Pipeline\MutablePipe $pipe
     *
     * @return void
     */
    public function setPipe(MutablePipe $pipe): void
    {
        $this->pipe = $pipe;
    }

    /**
     * Run the mutation.
     *
     * @return bool
     */
    public function run(): bool
    {
        if (!strlen($this->value)) {
            return false;
        }

        $newInput = $this->pipe->getInput() . $this->value;
        $this->pipe->addInput($newInput);
        return true;
    }
}