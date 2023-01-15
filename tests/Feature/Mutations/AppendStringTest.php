<?php

use Redbox\Pipeline\MutablePipe;
use Redbox\Pipeline\Mutations\AppendString;

test("run() will return false no value have been provided.", function () {
    $input = "Hello";
    $append = " World";

    $pipeline = new MutablePipe();
    $pipeline->addInput($input);

    $condition = new AppendString();
    $condition->setPipe($pipeline);

    $result = $condition->run();
    expect($result)->toBeFalse();
});

test("run() will return false if the value is empty.", function () {
    $input = "Hello";
    $append = "";

    $pipeline = new MutablePipe();
    $pipeline->addInput($input);

    $condition = new AppendString($append);
    $condition->setPipe($pipeline);

    $result = $condition->run();
    expect($result)->toBeFalse();
});


test("run() will append a string to the input.", function () {
    $input = "Hello";
    $append = " World";

    $pipeline = new MutablePipe();
    $pipeline->addInput($input);

    $condition = new AppendString($append);
    $condition->setPipe($pipeline);

    $result = $condition->run();
    expect($result)->toBeTrue();

    $actual = $pipeline->getInput();
    $expected = $input.$append;

    expect($actual)->toEqual($expected);
});