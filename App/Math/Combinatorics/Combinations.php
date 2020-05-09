<?php

namespace App\Math\Combinatorics;

use App\Math\Math;

class Combinations
{
    static function P_formula($win_g, $zero_g, $lose_g, $wins, $zeros, $loses)
    {
        $N = $wins + $zeros + $loses;

        return
            self::C_formula($wins, $win_g) * self::C_formula($loses, $lose_g) * self::C_formula($zeros, $zero_g)
            / self::C_formula($N, 100) * 100;
    }

    static function C_formula($k, $n)
    {
        return Math::factorial($n) / (Math::factorial($n - $k) * Math::factorial($k));
    }
}