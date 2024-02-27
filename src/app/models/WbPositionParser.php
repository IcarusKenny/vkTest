<?php

namespace src\app\models;

class WbPositionParser
{
    /**
     * @var string
     */
    private $keyword;

    public function __construct($keyword)
    {
        $this->keyword = $keyword;
    }

    /**
     * @return array
     */
    public function init()
    {
        $products = (new SearchWbApi())->searchExactMatch($this->keyword)['data']['products'];

        return $this->parseByPosition($products);
    }

    /**
     * @param array $products
     * @return array
     */
    private function parseByPosition($products)
    {
        $formattedProducts = [];
        $position = 1;

        foreach ($products as $product) {
            $formattedProducts[] = [
                'position' => $position,
                'name' => $product['name']
            ];
            $position++;
        }

        return $formattedProducts;
    }
}
