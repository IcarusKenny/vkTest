<?php

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;
use src\app\controllers\UsersController;
use src\app\middleware\ErrorHandlerMiddleware;

require __DIR__ . '/../vendor/autoload.php';

$app = AppFactory::create();
$app->setBasePath('/public');

$app->group('', function () use ($app) {
    $app->post(
        '/register',
        fn(Request $request, Response $response) => UsersController::register($request, $response)
    );

    $app->post(
        '/authorize',
        fn(Request $request, Response $response) => UsersController::authorize($request, $response)
    );

    $app->get(
        '/feed',
        fn(Request $request, Response $response) => UsersController::feed($request, $response)
    );
})->add(new ErrorHandlerMiddleware());

$app->run();
