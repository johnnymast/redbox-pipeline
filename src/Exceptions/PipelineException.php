<?php
/*
 * This file is part of Redbox-Pipeline
 *
 * (c) Johnny Mast <mastjohnny@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Redbox\Pipeline\Exceptions;

/**
 * class PipelineException
 *
 * The pipelink acception will be throwsn if a pipe
 * in the pipeline does not implement the PipeInterface.
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
class PipelineException extends \Exception
{
    // Silence is golden.
}