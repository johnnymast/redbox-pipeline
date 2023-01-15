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

use Redbox\Pipeline\Interfaces\MutationInterface;
use Redbox\Pipeline\Interfaces\PipeInterface;

/**
 * class MutablePipe.
 *
 * This type of pipe allows for mutation of the input.
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
class MutablePipe extends Pipe implements PipeInterface
{

    /**
     * The mutations for this pipeline.
     *
     * @var array<\Redbox\Pipeline\Interfaces\MutationInterface>
     */
    protected array $mutations = [];

    /**
     * Add a single condtion.
     *
     * @param \Redbox\Pipeline\Interfaces\MutationInterface $mutation The Mutation to add.
     *
     * @return \Redbox\Pipeline\MutablePipe
     */
    public function addMutation(MutationInterface $mutation): MutablePipe
    {
        $this->mutations[] = $mutation;

        return $this;
    }

    public function run(): bool
    {
        $failed = false;

        foreach ($this->mutations as $mutation) {
            $mutation->setPipe($this);

            if (!$mutation->run()) {
                $failed = true;
                break;
            }
        }

        return ($failed === false);
    }
}