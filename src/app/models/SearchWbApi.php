<?php

namespace src\app\models;

use GuzzleHttp\Client;

class SearchWbApi
{
    /**
     * @var Client
     */
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'https://search.wb.ru/',
            'timeout'  => 3.0
        ]);
    }

    /**
     * Стучится в апи-метод
     * https://search.wb.ru/exactmatch/ru/common/v4/search?appType=1&dest=-1185381&query=%D0%B4%D0%B6%D0%B8%D0%BD%D1%81%D1%8B&resultset=catalog&sort=popular&spp=30
     * @param string $query
     * @return array
     */
    public function searchExactMatch($query)
    {
        $request = $this->client->get(
            'exactmatch/ru/common/v4/search',
            [
                'query' => [
                    'appType' => 1,
                    'dest' => -1185381,
                    'query' => $query,
                    'resultset' => 'catalog',
                    'sort' => 'popular',
                    'spp' => '30'
                ]
            ]
        );
        $response = json_decode($request->getBody()->getContents(), true);

        return (array) $response;
    }
}
