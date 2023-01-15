<?php

namespace Redbox\Pipeline;

use ArrayObject;
use Redbox\Pipeline\Exceptions\PipelineException;
use Redbox\Pipeline\Interfaces\PipeInterface;

class Pipeline extends ArrayObject
{
    public function __construct(object|array $array = [])
    {
        parent::__construct($array);
    }

    /**
     * @throws \Redbox\Pipeline\Exceptions\PipelineException
     */
    public function run(): bool
    {
        if (!$this->count()) {
            return false;
        }

        $result = true;

        foreach($this->getIterator() as $pipe) {
            if (!$pipe instanceof PipeInterface) {
                throw new PipelineException();
            }

            if (!$pipe->run()) {
                $result = false;
                break;
            }
        }

        return $result;
    }
}