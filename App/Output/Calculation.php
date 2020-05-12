<?php

namespace App\Output;

use App\Math\Combinatorics\ArrayComb;
use App\Math\Combinatorics\Combinations;

class Calculation
{
    static function calculatePercents($coef_keys_combination, $coef_arr, $budget)
    {
        $win_general = 0;
        $zero_general = 0;
        $comb_size = sizeof($coef_keys_combination);

        foreach ($coef_keys_combination as $coef_key)
        {
            $win_general += $coef_arr[$coef_key]['possibilities']['win'];
            $zero_general += $coef_arr[$coef_key]['possibilities']['zero'];
        }

        $win_general = $win_general / $comb_size * 100;
        $zero_general = $zero_general / $comb_size * 100;
        $lose_general = 100 - ($win_general + $zero_general);
        echo PHP_EOL . '--------------------' . PHP_EOL;

        $logic_combs_count = 0;
        $pluses_possibs = [];
        $plus_results = 0;
        $zeros_possibs = [];
        $zero_results = 0;
        $minus_possibs = [];
        $minus_results = 0;

        $incomes = [];
        $combs = [];
        $possibs = [];
        $match_results = [];

        $masks = ArrayComb::getAllPossibleCombinations(['_W', '_Z', '_L'], $comb_size);

        foreach ($masks as $mask)
        {
            foreach ($mask as $ind => &$m) {
                $m = $coef_keys_combination[$ind] . $m;
            }

            $match_result = null;
            if (($match_result = self::possibleResults($mask, $coef_arr)) === false)
                continue;


            $match_results[] = $match_result;

            $results = self::resultsAmount($mask);
            $possibility = Combinations::P_formula(
                $win_general, $zero_general, $lose_general,
                $results['wins'], $results['zeros'], $results['loses']
            );

            $income = self::calculateIncome($mask, $coef_arr, $budget);

            if ($income > 0) {
                $plus_results += sizeof($match_result);
                $pluses_possibs[] = $possibility;
            }
            else if ($income == 0) {
                $zero_results += sizeof($match_result);
                $zeros_possibs[] = $possibility;
            }
            else {
                $minus_results += sizeof($match_result);
                $minus_possibs[] = $possibility;
            }

            $incomes[] = $income;
            $combs[] = $mask;
            $possibs[] = $possibility;

            ++$logic_combs_count;

        }

        arsort($incomes, SORT_NUMERIC);
        foreach ($incomes as $i => $inc) {

            Coefficient::output($combs[$i]);

            echo ' | Доход: ' . $inc . ' грн. <-> '
                . $possibs[$i] . ' % <-> Исходы матча: ';
            foreach ($match_results[$i] as $match_result) echo $match_result[0] . ':' . $match_result[1] . ', ';
            echo PHP_EOL;
        }

        // calculating percent of incomes

        $plus_gen = sizeof($pluses_possibs) == 0 ? 0
            : array_sum($pluses_possibs) / sizeof($pluses_possibs);

        $zero_gen = sizeof($zeros_possibs) == 0 ? 0
            : array_sum($zeros_possibs) / sizeof($zeros_possibs);

        $minus_gen = sizeof($minus_possibs) == 0 ? 0
            : array_sum($minus_possibs) / sizeof($minus_possibs);

        $g1 = $plus_gen + $zero_gen + $minus_gen;

        $plus_gen = $plus_gen == 0 ? 0 : 100 / ($g1 / $plus_gen);
        $zero_gen = $zero_gen == 0 ? 0 : 100 / ($g1 / $zero_gen);
        $minus_gen = 100 - ($plus_gen + $zero_gen);

        // calculating percentage coverage of favorable and adverse results

        $g2 = $plus_results + $zero_results + $minus_results;

        $plus_results = $plus_results == 0 ? 0 : 100 / ($g2 / $plus_results);
        $zero_results = $zero_results == 0 ? 0 : 100 / ($g2 / $zero_results);
        $minus_results = 100 - ($plus_results + $zero_results);

        echo
            'Процент охвата исходов в плюс: ' . $plus_results . ' %' . PHP_EOL .
            'Процент охвата исходов в ноль: ' . $zero_results . ' %' . PHP_EOL .
            'Процент охвата исходов в минус: ' . $minus_results . ' %' . PHP_EOL .
            'Процент уйти в плюс: ' . $plus_gen . ' %' . PHP_EOL .
            'Процент уйти в ноль: ' . $zero_gen . ' %' . PHP_EOL .
            'Процент уйти в минус: ' . $minus_gen . ' %' . PHP_EOL .
            'Общее кол-во логичных комбинаций: ' . $logic_combs_count . PHP_EOL .
            '--------------------';

    }

    static private function possibleResults($coef_comb, $coef_arr)
    {
        $res_mathes = [];
        $coefs = [];
        foreach ($coef_comb as $coef) {
            $res_mathes[] = $coef[strlen($coef) - 1];
            $coefs[] = substr($coef, 0, strrpos($coef, '_'));
        }
        $possib_results = [];
        for ($i = 0; $i < 8; $i++)
        {
            for ($j = 0; $j < 8; $j++)
            {
                foreach ($coefs as $ind => $coef) {
                    if (
                    ! $coef_arr[$coef]['rule']($res_mathes[$ind], $i, $j, $coef_arr)
                    ) continue 2;
                }
                $possib_results[] = [$i, $j];
            }
        }
        if (empty($possib_results)) return false;
        return $possib_results;
    }

    static private function resultsAmount($comb)
    {
        $wins = 0;
        $zeros = 0;
        $loses = 0;

        foreach ($comb as $coef) {
            $result = $coef[strlen($coef) - 1];
            if ($result == 'W') ++$wins;
            else if ($result == 'Z') ++$zeros;
            else ++$loses;
        }
        return compact('wins', 'zeros', 'loses');
    }

    static private function calculateIncome($coef_comb, $coef_arr, $budget)
    {
        $income = 0;
        $budget_part = $budget / sizeof($coef_comb);
        foreach ($coef_comb as $coef)
        {
            $match_result_pos = null;
            if (($match_result_pos = strpos($coef, '_W')) !== false)
            {
                $coef_val = $coef_arr[substr($coef, 0, $match_result_pos)]['coef'];
                $income += $budget_part * $coef_val;
            }
            else if (strpos($coef, '_Z') !== false)
            {
                $income += $budget_part;
            }
        }

        return $income - $budget;
    }
}