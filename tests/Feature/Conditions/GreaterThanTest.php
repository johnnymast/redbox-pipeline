<?php
/*
 * This file is part of Redbox-Pipeline
 *
 * (c) Johnny Mast <mastjohnny@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

use Redbox\Pipeline\Conditions\GreaterThan;
use Redbox\Pipeline\CondtionPipe;

test("evaluates() will return true if input does match the given value", function () {
    $input = 80;
    $compareTo = 20;

    $pipeline = new CondtionPipe();
    $pipeline->addInput($input);

    $condition = new GreaterThan($compareTo);
    $condition->setPipeline($pipeline);

    $result = $condition->evaluate();
    expect($result)->toBeTrue();
});

test("evaluates() will return false if input does not match the given value.", function () {
    $input = 20;
    $compareTo = 40;

    $pipeline = new CondtionPipe();
    $pipeline->addInput($input);

    $condition = new GreaterThan($compareTo);
    $condition->setPipeline($pipeline);

    $result = $condition->evaluate();
    expect($result)->toBeFalse();
});