<?php

use Redbox\Pipeline\Conditions\NotEquals;
use Redbox\Pipeline\CondtionPipe;
use Redbox\Pipeline\Exceptions\PipelineException;
use Redbox\Pipeline\Pipeline;
use Redbox\Pipeline\Conditions\Equals;

test("run should return false if no pipes are attached to the pipeline.", function () {
    $pipeline = new Pipeline();
    $result = $pipeline->run();

    expect($result)->toBeFalse();
});

test("run show throw an PiplelineException if a given pipe does not implement the PipeInterface.", function () {
    $input = 20;

    $pipe1 = new class() {};

    $pipe2 = new CondtionPipe();
    $pipe2->addInput($input);
    $pipeline = new Redbox\Pipeline\Pipeline([$pipe1, $pipe2]);

    $pipeline->run();

})->throws(PipelineException::class);

test("run() should return true if all pipes are sucessfull.", function () {
    $input = 20;
    $compareEqualTo = 20;
    $compareNotEqualTo = 10;

    $pipe1 = new CondtionPipe();
    $pipe1->addInput($input)
        ->addCondition(new Equals($compareEqualTo));

    $pipe2 = new CondtionPipe();
    $pipe2->addInput(new NotEquals($compareNotEqualTo));

    $pipeline = new Redbox\Pipeline\Pipeline([$pipe1, $pipe2]);

    $result = $pipeline->run();

    expect($result)->toBeTrue();
});

test("run() should return false if not all pipes are sucessfull.", function () {
    $input = 20;
    $compareEqualTo = 20;
    $compareNotEqualTo = $compareEqualTo; // This makes the test fail.

    $pipe1 = new CondtionPipe();
    $pipe1->addInput($input);
    $pipe1->addCondition(new Equals($compareEqualTo));

    $pipe2 = new CondtionPipe();
    $pipe2->addInput($input);
    $pipe2->addCondition(new NotEquals($compareNotEqualTo));

    $pipeline = new Redbox\Pipeline\Pipeline([$pipe1, $pipe2]);

    $result = $pipeline->run();

    expect($result)->toBeFalse();
});