<?php
/*
 * This file is part of Redbox-Pipeline
 *
 * (c) Johnny Mast <mastjohnny@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Redbox\Pipeline\MutablePipe;
use Redbox\Pipeline\Mutations\AppendString;

test("The input passed can be read back.", function () {
    $input = "Hello world";
    $expected = $input;

    $pipeline = new MutablePipe();
    $pipeline->addInput($input);
    $actual = $pipeline->getInput();

    expect($actual)->toEqual($expected);
});

test("run() will return false if an mutation fails", function () {
    $input = "Hello world";

    $pipeline = new MutablePipe();
    $result = $pipeline
        ->addInput($input)
        ->addMutation(new AppendString())
        ->run();

    expect($result)->toBeFalse();
});

test("run() will return true if an mutation fails", function () {
    $input = "Hello";
    $append = " World";

    $pipeline = new MutablePipe();
    $result = $pipeline
        ->addInput($input)
        ->addMutation(new AppendString($append))
        ->run();

    expect($result)->toBeTrue();
});


test("getInput() should return the mutated object", function () {
    $input = "Hello";
    $append = " World";

    $pipeline = new MutablePipe();
    $result = $pipeline
        ->addInput($input)
        ->addMutation(new AppendString($append))
        ->run();

    $expected = $input.$append;
    $actual = $pipeline->getInput();

    expect($result)->toBeTrue();
    expect($expected)->toEqual($actual);
});