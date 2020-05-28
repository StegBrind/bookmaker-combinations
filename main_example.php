<?php

require 'vendor/autoload.php';
require 'autoload.php';

use App\Instances\Coefficient;
use App\Instances\WebScraping\TableScraping;

$options = getopt('', ['budget:', 'combs:', 'match_num:', 'match_num:', 'match_link:']);

$budget = intval($options['budget']);

$relations = intval($options['combs']);

Coefficient::init();

Coefficient::setRequiredCoefficients(['F1', 'F2', 'TB', 'TM', 'P1', 'X','P2', '1X','12','X2',
    'iT_B1','iT_M1','iT_B2','iT_M2', 'T_even', 'T_odd']);

TableScraping::start($options['match_link'], intval($options['match_num']));

Coefficient::computeItems();

var_dump(Coefficient::$items);

\App\Output\Coefficient::outputCombinations(
    Coefficient::$items,
    array_keys(Coefficient::$items),
    $budget,
    $relations - 1
);
