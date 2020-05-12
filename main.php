<?php

require 'vendor/autoload.php';
require 'autoload.php';

use App\Instances\Coefficient;
use App\Instances\WebScraping\TableScraping;

$budget = 1000;

Coefficient::init();

Coefficient::setRequiredCoefficients(['P1', 'X', 'P2', 'F1', 'F2', 'TB', 'TM', 'Both_Goal_Y', 'Both_Goal_N']);

TableScraping::start('https://www.parimatch.com/sport/futbol/germanija-bundesliga', 1330);

Coefficient::computeItems();

var_dump(Coefficient::$items);

\App\Output\Coefficient::outputCombinations(
    Coefficient::$items,
    array_keys(Coefficient::$items),
    $budget,
    4
);
