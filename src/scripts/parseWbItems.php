<?php

use src\app\models\SearchStorage;
use src\app\models\WbPositionParser;

require_once __DIR__ . '/../config.php';

$keywords = array_slice($_SERVER['argv'], 1);
//$keywords = ['джинсы', 'платье', 'футболка'];

foreach ($keywords as $keyword) {
    try {
        $parsedData = (new WbPositionParser($keyword))->init();
        $jsonResult = json_encode($parsedData, JSON_UNESCAPED_UNICODE);
        (new SearchStorage())->save($keyword, $jsonResult);
    } catch (Exception $_ex) {
        // TODO: Можно прикрутить логи при желании
    }
}
