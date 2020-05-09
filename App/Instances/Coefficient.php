<?php

namespace App\Instances;

class Coefficient
{
    static array $items;

    static function init()
    {
        self::$items = [
            'F1' => [
                'possibilities' => [
                    'win' => 1 / 3,
                    'zero' => 1 / 3
                ],
                'extra' => 0,
                'coef' => 2.15,
                'rule' =>
                    function ($result_match, $first_team, $second_team, $coef_arr) {
                        if ($result_match == 'W')
                            return ($first_team + $coef_arr['F1']['extra']) > $second_team;
                        else if ($result_match == 'Z')
                            return ($first_team + $coef_arr['F1']['extra']) == $second_team;
                        else
                            return ($first_team + $coef_arr['F1']['extra']) < $second_team;
                    }
            ],
            'F2' => [
                'possibilities' => [
                    'win' => 1 / 3,
                    'zero' => 1 / 3
                ],
                'extra' => 0,
                'coef' => 1.7,
                'rule' =>
                    function ($result_match, $first_team, $second_team, $coef_arr) {
                        if ($result_match == 'W')
                            return ($second_team + $coef_arr['F2']['extra']) > $first_team;
                        else if ($result_match == 'Z')
                            return ($second_team + $coef_arr['F2']['extra']) == $first_team;
                        else
                            return ($second_team + $coef_arr['F2']['extra']) < $first_team;
                    }
            ],
            'TB' => [
                'possibilities' => [
                    'win' => 1 / 3,
                    'zero' => 1 / 3
                ],
                'extra' => 2,
                'coef' => 1.68,
                'rule' =>
                    function ($result_match, $first_team, $second_team, $coef_arr) {
                        if ($result_match == 'W')
                            return ($second_team + $first_team) > $coef_arr['TB']['extra'];
                        else if ($result_match == 'Z')
                            return ($second_team + $first_team) == $coef_arr['TB']['extra'];
                        else
                            return ($second_team + $first_team) < $coef_arr['TB']['extra'];
                    }
            ],
            'TM' => [
                'possibilities' => [
                    'win' => 1 / 3,
                    'zero' => 1 / 3
                ],
                'extra' => 2,
                'coef' => 2.18,
                'rule' =>
                    function ($result_match, $first_team, $second_team, $coef_arr) {
                        if ($result_match == 'W')
                            return ($second_team + $first_team) < $coef_arr['TM']['extra'];
                        else if ($result_match == 'Z')
                            return ($second_team + $first_team) == $coef_arr['TM']['extra'];
                        else
                            return ($second_team + $first_team) > $coef_arr['TM']['extra'];
                    }
            ],
            'T_2-3' => [
                'possibilities' => [
                    'win' => 1 / 3
                ],
                'coef' => 2.08,
                'rule' =>
                    function ($result_match, $first_team, $second_team, $coef_arr) {
                        if ($result_match == 'W')
                            return ($second_team + $first_team) == 2 || ($second_team + $first_team) == 3;
                        else if ($result_match == 'Z')
                            return false;
                        else
                            return !(($second_team + $first_team) == 2 || ($second_team + $first_team) == 3);
                    }
            ],
            'Team1_1-2_Y' => [
                'possibilities' => [
                    'win' => 1 / 3
                ],
                'coef' => 1.66,
                'rule' =>
                    function ($result_match, $first_team, $second_team, $coef_arr) {
                        if ($result_match == 'W')
                            return $first_team == 1 || $first_team == 2;
                        else if ($result_match == 'Z')
                            return false;
                        else
                            return !($first_team == 1 || $first_team == 2);
                    }
            ],
            'Team1_1-2_N' => [
                'possibilities' => [
                    'win' => 1 / 3
                ],
                'coef' => 2.15,
                'rule' =>
                    function ($result_match, $first_team, $second_team, $coef_arr) {
                        if ($result_match == 'W')
                            return $first_team != 1 && $first_team != 2;
                        else if ($result_match == 'Z')
                            return false;
                        else
                            return !($first_team != 1 && $first_team != 2);
                    }
            ],
            'Team2_1-2_Y' => [
                'possibilities' => [
                    'win' => 1 / 3
                ],
                'coef' => 1.61,
                'rule' =>
                    function ($result_match, $first_team, $second_team, $coef_arr) {
                        if ($result_match == 'W')
                            return $second_team == 1 || $second_team == 2;
                        else if ($result_match == 'Z')
                            return false;
                        else
                            return !($second_team == 1 || $second_team == 2);
                    }
            ],
            'Team2_1-2_N' => [
                'possibilities' => [
                    'win' => 1 / 3
                ],
                'coef' => 2.23,
                'rule' =>
                    function ($result_match, $first_team, $second_team, $coef_arr) {
                        if ($result_match == 'W')
                            return $second_team != 1 && $second_team != 2;
                        else if ($result_match == 'Z')
                            return false;
                        else
                            return !($second_team != 1 && $second_team != 2);
                    }
            ],
            'Both_Goal_Y' => [
                'possibilities' => [
                    'win' => 1 / 3
                ],
                'coef' => 1.92,
                'rule' =>
                    function ($result_match, $first_team, $second_team, $coef_arr) {
                        if ($result_match == 'W')
                            return $first_team > 0 && $second_team > 0;
                        else if ($result_match == 'Z')
                            return false;
                        else
                            return !($first_team > 0 && $second_team > 0);
                    }
            ],
            'Both_Goal_N' => [
                'possibilities' => [
                    'win' => 1 / 3
                ],
                'coef' => 1.82,
                'rule' =>
                    function ($result_match, $first_team, $second_team, $coef_arr) {
                        if ($result_match == 'W')
                            return $first_team == 0 && $second_team == 0;
                        else if ($result_match == 'Z')
                            return false;
                        else
                            return !($first_team == 0 && $second_team == 0);
                    }
            ],
            'P1' => [
                'possibilities' => [
                    'win' => 1 / 3,
                    'zero' => 0
                ],
                'coef' => 3.1,
                'rule' =>
                    function ($result_match, $first_team, $second_team, $coef_arr) {
                        if ($result_match == 'W')
                            return $first_team > $second_team;
                        else if ($result_match == 'Z')
                            return false;
                        else
                            return $first_team <= $second_team;
                    }
            ],
            'X' => [
                'possibilities' => [
                    'win' => 1 / 3,
                    'zero' => 0
                ],
                'coef' => 3.15,
                'rule' =>
                    function ($result_match, $first_team, $second_team, $coef_arr) {
                        if ($result_match == 'W')
                            return $first_team == $second_team;
                        else if ($result_match == 'Z')
                            return false;
                        else
                            return $first_team != $second_team;
                    }
            ],
            'P2' => [
                'possibilities' => [
                    'win' => 1 / 3,
                    'zero' => 0
                ],
                'coef' => 2.44,
                'rule' =>
                    function ($result_match, $first_team, $second_team, $coef_arr) {
                        if ($result_match == 'W')
                            return $first_team < $second_team;
                        else if ($result_match == 'Z')
                            return false;
                        else
                            return $first_team >= $second_team;
                    }
            ],
            '1X' => [
                'possibilities' => [
                    'win' => 2 / 3,
                    'zero' => 0
                ],
                'coef' => 1.55,
                'rule' =>
                    function ($result_match, $first_team, $second_team, $coef_arr) {
                        if ($result_match == 'W')
                            return ($first_team > $second_team) || ($first_team == $second_team);
                        else if ($result_match == 'Z')
                            return false;
                        else
                            return $first_team < $second_team;
                    }
            ],
            '12' => [
                'possibilities' => [
                    'win' => 2 / 3,
                    'zero' => 0
                ],
                'coef' => 1.36,
                'rule' =>
                    function ($result_match, $first_team, $second_team, $coef_arr) {
                        if ($result_match == 'W')
                            return ($first_team > $second_team) || ($first_team < $second_team);
                        else if ($result_match == 'Z')
                            return false;
                        else
                            return $first_team == $second_team;
                    }
            ],
            'X2' => [
                'possibilities' => [
                    'win' => 2 / 3,
                    'zero' => 0
                ],
                'coef' => 1.37,
                'rule' =>
                    function ($result_match, $first_team, $second_team, $coef_arr) {
                        if ($result_match == 'W')
                            return ($first_team < $second_team) || ($first_team == $second_team);
                        else if ($result_match == 'Z')
                            return false;
                        else
                            return $first_team > $second_team;
                    }
            ],
            'iT_B1' => [
                'possibilities' => [
                    'win' => 1 / 3,
                    'zero' => 1 / 3
                ],
                'extra' => 1,
                'coef' => 1.99,
                'rule' =>
                    function ($result_match, $first_team, $second_team, $coef_arr) {
                        if ($result_match == 'W')
                            return $first_team > $coef_arr['iT_B1']['extra'];
                        else if ($result_match == 'Z')
                            return $first_team == $coef_arr['iT_B1']['extra'];
                        else
                            return $first_team < $coef_arr['iT_B1']['extra'];
                    }
            ],
            'iT_M1' => [
                'possibilities' => [
                    'win' => 1 / 3,
                    'zero' => 1 / 3
                ],
                'extra' => 1,
                'coef' => 1.77,
                'rule' =>
                    function ($result_match, $first_team, $second_team, $coef_arr) {
                        if ($result_match == 'W')
                            return $first_team < $coef_arr['iT_M1']['extra'];
                        else if ($result_match == 'Z')
                            return $first_team == $coef_arr['iT_M1']['extra'];
                        else
                            return $first_team > $coef_arr['iT_M1']['extra'];
                    }
            ],
            'iT_B2' => [
                'possibilities' => [
                    'win' => 1 / 3,
                    'zero' => 1 / 3
                ],
                'extra' => 1,
                'coef' => 1.68,
                'rule' =>
                    function ($result_match, $first_team, $second_team, $coef_arr) {
                        if ($result_match == 'W')
                            return $second_team > $coef_arr['iT_B2']['extra'];
                        else if ($result_match == 'Z')
                            return $second_team == $coef_arr['iT_B2']['extra'];
                        else
                            return $second_team < $coef_arr['iT_B2']['extra'];
                    }
            ],
            'iT_M2' => [
                'possibilities' => [
                    'win' => 1 / 3,
                    'zero' => 1 / 3
                ],
                'extra' => 1,
                'coef' => 2.11,
                'rule' =>
                    function ($result_match, $first_team, $second_team, $coef_arr) {
                        if ($result_match == 'W')
                            return $second_team < $coef_arr['iT_M2']['extra'];
                        else if ($result_match == 'Z')
                            return $second_team == $coef_arr['iT_M2']['extra'];
                        else
                            return $second_team > $coef_arr['iT_M2']['extra'];
                    }
            ],
        ];
    }

    static function computeItems()
    {
        foreach (self::$items as $coef_key => &$coef_val)
        {
            if (
                strpos($coef_key, 'F') !== false ||
                strpos($coef_key, 'T') !== false ||
                strpos($coef_key, 'iT') !== false
               )
            {
                if (!is_int($coef_val['extra']))
                {
                    $coef_val['possibilities']['zero'] = 0;
                }
            }
        }
    }

    static public function setRequiredCoefficients($required_coefs)
    {
        self::$items = array_intersect_key(self::$items, array_flip($required_coefs));
    }
}