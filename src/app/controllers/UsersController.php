<?php

namespace src\app\controllers;

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use src\app\exceptions\clientExceptions\EmailAlreadyExistsException;
use src\app\exceptions\clientExceptions\EmptyRequiredParamsException;
use src\app\exceptions\clientExceptions\InvalidEmailException;
use src\app\exceptions\clientExceptions\UserJWTVerificationFailedException;
use src\app\exceptions\clientExceptions\WeakPasswordException;
use src\app\exceptions\serverExceptions\InsertException;
use src\app\models\User;
use src\app\models\UserJWT;

class UsersController
{
    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws EmailAlreadyExistsException
     * @throws EmptyRequiredParamsException
     * @throws InvalidEmailException
     * @throws WeakPasswordException
     * @throws InsertException
     */
    public static function register(Request $request, Response $response): Response
    {
        $body = $request->getParsedBody();
        $email = (string) $body['email'];
        $password = (string) $body['password'];

        $result = User::create($email, $password);
        $response->getBody()->write(json_encode($result));

        return $response->withHeader('Content-Type', 'application/json');
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws EmptyRequiredParamsException
     */
    public static function authorize(Request $request, Response $response): Response
    {
        $body = $request->getParsedBody();
        $email = (string) $body['email'];
        $password = (string) $body['password'];

        $response->getBody()->write(json_encode([
            'access_token' => (new UserJWT())->generate($email, $password)
        ]));

        return $response->withHeader('Content-Type', 'application/json');
    }

    /**
     * @param Request $request
     * @param Response $response
     * @return Response
     * @throws UserJWTVerificationFailedException
     */
    public static function feed(Request $request, Response $response): Response
    {
        $accessToken = (string) $request->getQueryParams()['access_token'];
        (new UserJWT())->validate($accessToken);

        return $response->withStatus(StatusCodeInterface::STATUS_OK);
    }
}
