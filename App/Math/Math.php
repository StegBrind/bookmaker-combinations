<?php

namespace App\Math;

class Math
{
    static function factorial($a){
        $n = 1;
        $b = abs($a);
        if (is_float($b)) {
            $n = self::gamma($b + 1);
        }
        else {
            for ($i = 0; $i < $a; $i++)
                $n *= ($b - $i);
        }
        return $a < 0 ? -$n : $n;
    }

    static function gamma($x)
    {
        $p = [0.99999999999980993, 676.5203681218851, -1259.1392167224028,
            771.32342877765313, -176.61502916214059, 12.507343278686905,
            -0.13857109526572012, 9.9843695780195716e-6, 1.5056327351493116e-7];

        $g = 7;
        if ($x < 0.5) {
            return M_PI / (sin(M_PI * $x) * self::gamma(1 - $x));
        }

        $x -= 1;
        $a = $p[0];
        $t = $x + $g + 0.5;
        for ($i = 1; $i < sizeof($p); $i++) {
            $a += $p[$i] / ($x + $i);
        }

        return sqrt(2 * M_PI) * pow($t, $x + 0.5) * exp(-$t) * $a;
    }
}