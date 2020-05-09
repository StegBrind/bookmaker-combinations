<?php

namespace App\Output;

use App\Math\Combinatorics\ArrayComb;

class Coefficient
{
    static function output($coef_keys)
    {
        echo '[ | ';
        for ($i = 0; $i < sizeof($coef_keys); $i++)
        {
            echo $coef_keys[$i] . ' | ';
        }
        echo ']';
    }

    static function outputCombinations($coef_items, $coef_keys, $budget, $relations_amount = 1)
    {
        $coef_combs = ArrayComb::manyToOneCombinations($coef_keys, $relations_amount);
        foreach ($coef_combs as $comb)
        {
            Coefficient::output($comb);
            echo ' <---> ';
            Calculation::calculatePercents($comb, $coef_items, $budget);
            echo PHP_EOL;
        }
        echo 'Кол-во комбинаций: ' . sizeof($coef_combs);
    }
}