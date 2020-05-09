<?php

require 'vendor/autoload.php';
require 'autoload.php';

use App\Instances\Coefficient;

$budget = 1000;

Coefficient::init();
Coefficient::computeItems();

Coefficient::setRequiredCoefficients(['F1', 'F2', 'TM', 'TB']);

$coef_keys = array_keys(Coefficient::$items);

\App\Output\Coefficient::outputCombinations(
    Coefficient::$items, $coef_keys, $budget, 1
);
