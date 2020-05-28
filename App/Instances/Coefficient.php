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
                'coef' => 1.94,
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
                'coef' => 1.59,
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
                'coef' => 1.65,
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
                'coef' => 2.3,
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
                    'win' => 1 / 3,
                    'zero' => 0
                ],
                'coef' => 2.04,
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
            'T_0-1' => [
                'possibilities' => [
                    'win' => 1 / 3,
                    'zero' => 0
                ],
                'coef' => 3.6,
                'rule' =>
                    function ($result_match, $first_team, $second_team, $coef_arr) {
                        if ($result_match == 'W')
                            return ($second_team + $first_team) == 0 || ($second_team + $first_team) == 1;
                        else if ($result_match == 'Z')
                            return false;
                        else
                            return !(($second_team + $first_team) == 0 || ($second_team + $first_team) == 1);
                    }
            ],
            'T_4-more' => [
                'possibilities' => [
                    'win' => 1 / 2,
                    'zero' => 0
                ],
                'coef' => 3.2,
                'rule' =>
                    function ($result_match, $first_team, $second_team, $coef_arr) {
                        if ($result_match == 'W')
                            return ($second_team + $first_team) >= 4;
                        else if ($result_match == 'Z')
                            return false;
                        else
                            return !(($second_team + $first_team) >= 4);
                    }
            ],
            'T_odd' => [
                'possibilities' => [
                    'win' => 1 / 2,
                    'zero' => 0
                ],
                'coef' => 1.94,
                'rule' =>
                    function ($result_match, $first_team, $second_team, $coef_arr) {
                        if ($result_match == 'W')
                            return ($second_team + $first_team) % 2 != 0;
                        else if ($result_match == 'Z')
                            return false;
                        else
                            return ($second_team + $first_team) % 2 == 0;
                    }
            ],
            'T_even' => [
                'possibilities' => [
                    'win' => 1 / 2,
                    'zero' => 0
                ],
                'coef' => 1.92,
                'rule' =>
                    function ($result_match, $first_team, $second_team, $coef_arr) {
                        if ($result_match == 'W')
                            return ($second_team + $first_team) % 2 == 0;
                        else if ($result_match == 'Z')
                            return false;
                        else
                            return ($second_team + $first_team) % 2 != 0;
                    }
            ],
            'Team1_win_in_1-2_goals' => [
                'possibilities' => [
                    'win' => 13 / 64,
                    'zero' => 0
                ],
                'coef' => 2.25,
                'rule' =>
                    function ($result_match, $first_team, $second_team, $coef_arr) {
                        if ($result_match == 'W')
                            return ($first_team - $second_team) == 1 || ($first_team - $second_team) == 2;
                        else if ($result_match == 'Z')
                            return false;
                        else
                            return !(($first_team - $second_team) == 1 || ($first_team - $second_team) == 2);
                    }
            ],
            'Team2_win_in_1-2_goals' => [
                'possibilities' => [
                    'win' => 13 / 64,
                    'zero' => 0
                ],
                'coef' => 3.9,
                'rule' =>
                    function ($result_match, $first_team, $second_team, $coef_arr) {
                        if ($result_match == 'W')
                            return ($second_team - $first_team) == 1 || ($second_team - $first_team) == 2;
                        else if ($result_match == 'Z')
                            return false;
                        else
                            return !(($second_team - $first_team) == 1 || ($second_team - $first_team) == 2);
                    }
            ],
            'Team1_win_in_1_goal_or_draw' => [
                'possibilities' => [
                    'win' => 15 / 64,
                    'zero' => 0
                ],
                'coef' => 2.55,
                'rule' =>
                    function ($result_match, $first_team, $second_team, $coef_arr) {
                        if ($result_match == 'W')
                            return ($first_team - $second_team) == 1 || $first_team == $second_team;
                        else if ($result_match == 'Z')
                            return false;
                        else
                            return !(($first_team - $second_team) == 1 || $first_team == $second_team);
                    }
            ],
            'Team2_win_in_1_goal_or_draw' => [
                'possibilities' => [
                    'win' => 15 / 64,
                    'zero' => 0
                ],
                'coef' => 2.23,
                'rule' =>
                    function ($result_match, $first_team, $second_team, $coef_arr) {
                        if ($result_match == 'W')
                            return ($second_team - $first_team) == 1 || $first_team == $second_team;
                        else if ($result_match == 'Z')
                            return false;
                        else
                            return !(($second_team - $first_team) == 1 || $first_team == $second_team);
                    }
            ],
//            'Team1_1-2_Y' => [
//                'possibilities' => [
//                    'win' => 1 / 3,
//                    'zero' => 0
//                ],
//                'coef' => 1.66,
//                'rule' =>
//                    function ($result_match, $first_team, $second_team, $coef_arr) {
//                        if ($result_match == 'W')
//                            return $first_team == 1 || $first_team == 2;
//                        else if ($result_match == 'Z')
//                            return false;
//                        else
//                            return !($first_team == 1 || $first_team == 2);
//                    }
//            ],
//            'Team1_1-2_N' => [
//                'possibilities' => [
//                    'win' => 1 / 3,
//                    'zero' => 0
//                ],
//                'coef' => 2.15,
//                'rule' =>
//                    function ($result_match, $first_team, $second_team, $coef_arr) {
//                        if ($result_match == 'W')
//                            return $first_team != 1 && $first_team != 2;
//                        else if ($result_match == 'Z')
//                            return false;
//                        else
//                            return !($first_team != 1 && $first_team != 2);
//                    }
//            ],
//            'Team2_1-2_Y' => [
//                'possibilities' => [
//                    'win' => 1 / 3,
//                    'zero' => 0
//                ],
//                'coef' => 1.61,
//                'rule' =>
//                    function ($result_match, $first_team, $second_team, $coef_arr) {
//                        if ($result_match == 'W')
//                            return $second_team == 1 || $second_team == 2;
//                        else if ($result_match == 'Z')
//                            return false;
//                        else
//                            return !($second_team == 1 || $second_team == 2);
//                    }
//            ],
//            'Team2_1-2_N' => [
//                'possibilities' => [
//                    'win' => 1 / 3,
//                    'zero' => 0
//                ],
//                'coef' => 2.23,
//                'rule' =>
//                    function ($result_match, $first_team, $second_team, $coef_arr) {
//                        if ($result_match == 'W')
//                            return $second_team != 1 && $second_team != 2;
//                        else if ($result_match == 'Z')
//                            return false;
//                        else
//                            return !($second_team != 1 && $second_team != 2);
//                    }
//            ],
            'Both_Goal_Y' => [
                'possibilities' => [
                    'win' => 49 / 64,
                    'zero' => 0
                ],
                'coef' => 1.86,
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
                    'win' => 15 / 64,
                    'zero' => 0
                ],
                'coef' => 1.88,
                'rule' =>
                    function ($result_match, $first_team, $second_team, $coef_arr) {
                        if ($result_match == 'W')
                            return !($first_team > 0 && $second_team > 0);
                        else if ($result_match == 'Z')
                            return false;
                        else
                            return $first_team > 0 && $second_team > 0;
                    }
            ],
            'P1' => [
                'possibilities' => [
                    'win' => 1 / 3,
                    'zero' => 0
                ],
                'coef' => 3.4,
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
                'coef' => 3.45,
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
                'coef' => 2.21,
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
                'coef' => 1.48,
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
                'coef' => 1.35,
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
                'coef' => 1.33,
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
            ]
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
                if (($coef_val['extra'] - floor($coef_val['extra'])) != 0)
                {
                    $coef_val['possibilities']['zero'] = 0;
                    $coef_val['possibilities']['win'] = 1 / 2;
                }
            }
        }
    }

    static public function setRequiredCoefficients($required_coefs)
    {
        self::$items = array_intersect_key(self::$items, array_flip($required_coefs));
    }
}