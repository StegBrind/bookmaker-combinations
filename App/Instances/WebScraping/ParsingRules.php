<?php

namespace App\Instances\WebScraping;

use App\Instances\Coefficient;
use Symfony\Component\DomCrawler\Crawler;

class ParsingRules
{
    static private array $rules;

    const GOAL_SECTION_POS = 31;

    static function init()
    {
        self::$rules = [
            'F1' => function () {
                $extra = TableScraping::$table1[3]->firstChild->textContent;
                $extra = !is_numeric($extra[0]) && $extra[0] != '+' ? -floatval(substr($extra, 1)) : floatval($extra);

                Coefficient::$items['F1']['extra'] = $extra;
                Coefficient::$items['F1']['coef'] = floatval(TableScraping::$table1[4]->firstChild->textContent);
            },
            'F2' => function () {
                $extra = TableScraping::$table1[3]->lastChild->textContent;
                $extra = !is_numeric($extra[0]) && $extra[0] != '+' ? -floatval(substr($extra, 2)) : floatval($extra);

                Coefficient::$items['F2']['extra'] = $extra;
                Coefficient::$items['F2']['coef'] = floatval(TableScraping::$table1[4]->childNodes[1]->textContent);
            },
            'TB' => function () {
                $extra = TableScraping::$table1[5]->textContent;
                $extra = $extra[0] == '–' ? -floatval(substr($extra, 1)) : floatval($extra);

                Coefficient::$items['TB']['extra'] = $extra;
                Coefficient::$items['TB']['coef'] = floatval(TableScraping::$table1[6]->textContent);
            },
            'TM' => function () {
                $extra = TableScraping::$table1[5]->textContent;
                $extra = !is_numeric($extra[0]) && $extra[0] != '+' ? -floatval(substr($extra, 2)) : floatval($extra);

                Coefficient::$items['TM']['extra'] = $extra;
                Coefficient::$items['TM']['coef'] = floatval(TableScraping::$table1[7]->textContent);
            },
            'P1' => function () {
                Coefficient::$items['P1']['coef'] = floatval(TableScraping::$table1[8]->textContent);
            },
            'X' => function () {
                Coefficient::$items['X']['coef'] = floatval(TableScraping::$table1[9]->textContent);
            },
            'P2' => function () {
                Coefficient::$items['P2']['coef'] = floatval(TableScraping::$table1[10]->textContent);
            },
            '1X' => function () {
                Coefficient::$items['1X']['coef'] = floatval(TableScraping::$table1[11]->textContent);
            },
            '12' => function () {
                Coefficient::$items['12']['coef'] = floatval(TableScraping::$table1[12]->textContent);
            },
            'X2' => function () {
                Coefficient::$items['X2']['coef'] = floatval(TableScraping::$table1[13]->textContent);
            },
            'iT_B1' => function () {
                $extra = TableScraping::$table1[14]->firstChild->textContent;
                $extra = !is_numeric($extra[0]) && $extra[0] != '+' ? -floatval(substr($extra, 2)) : floatval($extra);

                Coefficient::$items['iT_B1']['extra'] = $extra;
                Coefficient::$items['iT_B1']['coef'] = floatval(TableScraping::$table1[15]->firstChild->textContent);
            },
            'iT_M1' => function () {
                $extra = TableScraping::$table1[14]->firstChild->textContent;
                $extra = !is_numeric($extra[0]) && $extra[0] != '+' ? -floatval(substr($extra, 2)) : floatval($extra);

                Coefficient::$items['iT_M1']['extra'] = $extra;
                Coefficient::$items['iT_M1']['coef'] = floatval(TableScraping::$table1[16]->firstChild->textContent);
            },
            'iT_B2' => function () {
                $extra = TableScraping::$table1[14]->lastChild->textContent;
                $extra = !is_numeric($extra[0]) && $extra[0] != '+' ? -floatval(substr($extra, 2)) : floatval($extra);

                Coefficient::$items['iT_B2']['extra'] = $extra;
                Coefficient::$items['iT_B2']['coef'] = floatval(TableScraping::$table1[15]->childNodes[1]->textContent);
            },
            'iT_M2' => function () {
                $extra = TableScraping::$table1[14]->lastChild->textContent;
                $extra = !is_numeric($extra[0]) && $extra[0] != '+' ? -floatval(substr($extra, 2)) : floatval($extra);

                Coefficient::$items['iT_M2']['extra'] = $extra;
                Coefficient::$items['iT_M2']['coef'] = floatval(TableScraping::$table1[16]->childNodes[1]->textContent);
            },
            'Both_Goal_Y' => function () {
                $root = (new Crawler(TableScraping::$table2->getNode(self::GOAL_SECTION_POS)))->filter('td.p2r')->getNode(0);
                if ($root->childNodes[13]->textContent != 'Îáå çàáüþò:') throw new \BadMethodCallException('Both_Goal_Y coefficient not found');

                Coefficient::$items['Both_Goal_Y']['coef'] = floatval($root->childNodes[15]->textContent);
            },
            'Both_Goal_N' => function () {
                $root = (new Crawler(TableScraping::$table2->getNode(self::GOAL_SECTION_POS)))->filter('td.p2r')->getNode(0);
                if ($root->childNodes[13]->textContent != 'Îáå çàáüþò:') throw new \BadMethodCallException('Both_Goal_N coefficient not found');

                Coefficient::$items['Both_Goal_N']['coef'] = floatval($root->childNodes[17]->textContent);
            },
            'T_0-1' => function () {
                $root = (new Crawler(TableScraping::$table2->getNode(self::GOAL_SECTION_POS)))->filter('td.p2r')->getNode(0);
                if ($root->childNodes[40]->textContent != ' 0-1 ãîëà ') throw new \BadMethodCallException('T_0-1 coefficient not found');

                Coefficient::$items['T_0-1']['coef'] = floatval($root->childNodes[41]->textContent);
            },
            'T_2-3' => function () {
                $root = (new Crawler(TableScraping::$table2->getNode(self::GOAL_SECTION_POS)))->filter('td.p2r')->getNode(0);
                if ($root->childNodes[42]->textContent != '; 2-3 ãîëà ') throw new \BadMethodCallException('T_2-3 coefficient not found');

                Coefficient::$items['T_2-3']['coef'] = floatval($root->childNodes[43]->textContent);
            },
            'T_4-more' => function () {
                $root = (new Crawler(TableScraping::$table2->getNode(self::GOAL_SECTION_POS)))->filter('td.p2r')->getNode(0);
                if ($root->childNodes[44]->textContent != '; 4 è áîëüøå ãîëîâ ') throw new \BadMethodCallException('T_4-more coefficient not found');

                Coefficient::$items['T_4-more']['coef'] = floatval($root->childNodes[45]->textContent);
            },
            'T_even' => function () {
                Coefficient::$items['T_even']['coef'] = floatval(TableScraping::$table2->getNode(22)->childNodes[1]->childNodes[3]->textContent);
            },
            'T_odd' => function () {
                Coefficient::$items['T_odd']['coef'] = floatval(TableScraping::$table2->getNode(22)->childNodes[1]->childNodes[5]->textContent);
            },
            'Team1_win_in_1-2_goals' => function () {
//                var_dump(TableScraping::$table2->getNode(54)->textContent);
//                Coefficient::$items['Team1_win_in_1-2_goals']['coef'] =
//                    floatval(TableScraping::$table2->getNode(54)->childNodes[1]->childNodes[2]->childNodes[1]->textContent);
            },
            'Team2_win_in_1-2_goals' => function () {
//                Coefficient::$items['Team2_win_in_1-2_goals']['coef'] =
//                    floatval(TableScraping::$table2->getNode(54)->childNodes[1]->childNodes[5]->childNodes[1]->textContent);
            },
            'Team1_win_in_1_goal_or_draw' => function () {

            },
            'Team2_win_in_1_goal_or_draw' => function () {

            },
        ];
    }

    static function executeRules(array $coefficients)
    {
        foreach ($coefficients as $coefficient)
            (self::$rules[$coefficient])();
    }
}