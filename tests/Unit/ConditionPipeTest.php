<?php
/*
 * This file is part of Redbox-Pipeline
 *
 * (c) Johnny Mast <mastjohnny@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Redbox\Pipeline\Conditions\NotEquals;
use Redbox\Pipeline\Interfaces\ConditionInterface;
use Redbox\Pipeline\Conditions\Equals;
use Redbox\Pipeline\CondtionPipe;

test("The input passed can be read back.", function () {
    $input = "Hello world";
    $expected = $input;

    $pipeline = new CondtionPipe();
    $pipeline->addInput($input);
    $actual = $pipeline->getInput();

    expect($actual)->toEqual($expected);
});

test("The sucess callback should be called on success.", function () {
    $called = false;
    $input = "My house on the hill.";

    $result = (new CondtionPipe())
        ->addInput($input)
        ->addCondition(new Equals($input))
        ->succes(function (mixed $input) use (&$called) {
            $called = true;
        })
        ->run();

    expect($called)->toBeTrue();
    expect($result)->toBeTrue();
});

test("The failed callback should be called on failure.", function () {
    $called = false;
    $input = "My house on the hill.";
    $compareTo = "My house in New Orleans";

    $result = (new CondtionPipe())
        ->addInput($input)
        ->addCondition(new Equals($compareTo))
        ->failed(function (ConditionInterface $condtion, mixed $input) use (&$called) {
            $called = true;
        })
        ->run();

    expect($called)->toBeTrue();
    expect($result)->toBeFalse();
});


test("A single condition can used.", function() {
    $called = false;
    $input = "My house on the hill.";
    $compareTo =  $input;

    $result = (new CondtionPipe())
        ->addInput($input)
        ->addCondition(new Equals($compareTo))
        ->succes(function (mixed $input) use (&$called) {
            $called = true;
        })
        ->run();

    expect($called)->toBeTrue();
    expect($result)->toBeTrue();
});

test("Multiple conditions can used.", function() {
    $called = false;
    $input = "My house on the hill.";
    $compareTo =  $input;

    $result = (new CondtionPipe())
        ->addInput($input)
        ->addConditions([
            new Equals($compareTo),
            new NotEquals("Not equal to this random string.")
        ])
        ->succes(function (mixed $input) use (&$called) {
            $called = true;
        })
        ->run();

    expect($called)->toBeTrue();
    expect($result)->toBeTrue();
});

// failed right condition
