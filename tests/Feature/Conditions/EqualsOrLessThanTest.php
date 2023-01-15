<?php

/*
 * This file is part of Redbox-Pipeline
 *
 * (c) Johnny Mast <mastjohnny@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Redbox\Pipeline\Conditions\EqualsOrLessThan;
use Redbox\Pipeline\CondtionPipe;

test("run() will return true if input is equal to the given value", function () {
    $input = 5;
    $compareTo = 5;

    $pipeline = new CondtionPipe();
    $pipeline->addInput($input);

    $condition = new EqualsOrLessThan($compareTo);
    $condition->setPipe($pipeline);

    $result = $condition->run();
    expect($result)->toBeTrue();
});

test("run() will return true if input is less than to the given value", function () {
    $input = 30;
    $compareTo = 50;

    $pipeline = new CondtionPipe();
    $pipeline->addInput($input);

    $condition = new EqualsOrLessThan($compareTo);
    $condition->setPipe($pipeline);

    $result = $condition->run();
    expect($result)->toBeTrue();
});

test("run() will return false if input does not match the condition.", function () {
    $input = 50;
    $compareTo = 30;

    $pipeline = new CondtionPipe();
    $pipeline->addInput($input);

    $condition = new EqualsOrLessThan($compareTo);
    $condition->setPipe($pipeline);

    $result = $condition->run();
    expect($result)->toBeFalse();
});