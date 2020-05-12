<?php

namespace App\Instances\WebScraping;

use App\Instances\Coefficient;
use DOMNodeList;
use GuzzleHttp\Client;
use Symfony\Component\DomCrawler\Crawler;

class TableScraping
{
    static DOMNodeList $table1;

    static Crawler $table2;

    static function start($url, $number)
    {
        $client = new Client(['headers' => [
            'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/81.0.4044.129 Safari/537.36 OPR/68.0.3618.63'
        ]]);

        $content = $client->get($url)->getBody()->getContents();

        $pos1 = strpos($content, 'var hd_parametr') + 19;
        $pos2 = strpos($content, '"', $pos1);
        $bet_id = substr($content, $pos1, $pos2 - $pos1);

        $content = $client->get("https://www.parimatch.com/sbet.content.html?hd=$bet_id")->getBody()->getContents();

        $dom = (new Crawler($content))->filter("#g$bet_id");

        foreach ($dom->filter('.no') as $span) {
            if ($span->textContent == $number) {
                self::$table1 = $span->parentNode->parentNode->childNodes;

                $x_path = $span->parentNode->parentNode->parentNode->getNodePath();
                $x_path_index = intval(substr(substr($x_path, strrpos($x_path, '[') + 1), 0, -1));
                $x_path = str_replace("[$x_path_index]", '[' . ++$x_path_index . ']', "//*[@id=\"g$bet_id\"]/tbody[$x_path_index]");

                self::$table2 = (new Crawler($content))->filterXPath($x_path)->children();
                break;
            }
        }

        ParsingRules::init();
        ParsingRules::executeRules(array_keys(Coefficient::$items));
    }
}