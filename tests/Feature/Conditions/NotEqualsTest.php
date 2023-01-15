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
use Redbox\Pipeline\CondtionPipe;

test("run() will return true if input does match the given value", function () {
    $input = 100;
    $compareTo = 50;

    $pipeline = new CondtionPipe();
    $pipeline->addInput($input);

    $condition = new NotEquals($compareTo);
    $condition->setPipe($pipeline);

    $result = $condition->run();
    expect($result)->toBeTrue();
});

test("run() will return false if input does not match the given value.", function () {
    $input = 30;
    $compareTo = 30;

    $pipeline = new CondtionPipe();
    $pipeline->addInput($input);

    $condition = new NotEquals($compareTo);
    $condition->setPipe($pipeline);

    $result = $condition->run();
    expect($result)->toBeFalse();
});