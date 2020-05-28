<?php

namespace App\Math\Combinatorics;

class ArrayComb
{
    static $percents = [];

    static function getAllPossibleCombinations($items, $size, $combinations = [])
    {
        if (empty($combinations)) {
            $combinations = $items;
        }

        if ($size == 1) {
            return $combinations;
        }

        $new_combinations = [];

        foreach ($combinations as $combination) {
            foreach ($items as $mask) {
                $new_combinations[] = array_merge(
                    is_array($combination) ? $combination : [$combination], [$mask]
                );
            }
        }

        return self::getAllPossibleCombinations($items, $size - 1, $new_combinations);
    }

    static function manyToOneCombinations($items, $relations_amount, $self = false)
    {
        $combs = [];
        $size = sizeof($items);
        for ($i = 0; $i < $size; $i++)
        {
            $offset = $i + $relations_amount;
            $end = $size;
            $coef_keys_1 = array_slice($items, $i, $relations_amount);

            if ($offset >= $size)
            {
                $offset -= $size;
                $coef_keys_1 = array_merge($coef_keys_1, array_slice($items,0, $offset));
                $end = $i;
            }
            if ($self && !empty($coef_keys_1)) $combs[] = $coef_keys_1;

            for ($j = $offset; $j < $end; $j++)
            {
                $coef_keys_result = array_unique(
                    array_merge($coef_keys_1, [$items[$j]])
                );

                if (!self::item_contains($coef_keys_result, $combs))
                    $combs[] = $coef_keys_result;
            }

        }
        return $combs;
    }

    static private function item_contains($combs, $past_combs)
    {
        foreach ($past_combs as $comb)
        {
            if (sizeof($combs) == sizeof($comb))
            {
                $f = true;
                foreach ($comb as $c)
                {
                    if (!in_array($c, $combs))
                    {
                        $f = false;
                        break;
                    }
                }
                if ($f)
                    return true;
            }
        }
        return false;
    }


}