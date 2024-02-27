<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use src\app\consts\HttpCode;
use src\app\models\SearchStorage;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->setBasePath('/public');

$errorMiddleware = $app->addErrorMiddleware(true, true, true);

$app->get('/search/{keyword}/last', function (Request $request, Response $response, $args) {
    $keyword = $args['keyword'];

    if (!$keyword) {
        return $response->withStatus(HttpCode::BAD_REQUEST);
    }

    $result = (new SearchStorage())->getLastKeywordSearchResult($keyword);
    $response->getBody()->write($result);

    return $response;
});

$app->run();
