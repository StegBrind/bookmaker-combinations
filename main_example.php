<?php

require 'vendor/autoload.php';
require 'autoload.php';

use App\Instances\Coefficient;
use App\Instances\WebScraping\TableScraping;

$budget = 1000;

$relations = 4;

Coefficient::init();

Coefficient::setRequiredCoefficients(['F1', 'F2', 'TB', 'TM', 'P1', 'X','P2', '1X','12','X2',
    'iT_B1','iT_M1','iT_B2','iT_M2', 'T_even', 'T_odd', 'Both_Goal_Y', 'Both_Goal_N', 'Team1_win_in_1_goal_or_draw', 'Team2_win_in_1_goal_or_draw']);

TableScraping::start('https://www.pm-511.info/sport/futbol/germanija-bundesliga', 2175);

Coefficient::computeItems();

var_dump(Coefficient::$items);

\App\Output\Coefficient::outputCombinations(
    Coefficient::$items,
    array_keys(Coefficient::$items),
    $budget,
    $relations - 1
);
