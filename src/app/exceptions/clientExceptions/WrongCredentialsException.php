<?php

namespace src\app\exceptions\clientExceptions;

use Fig\Http\Message\StatusCodeInterface;

class WrongCredentialsException extends ClientException
{
    protected $message = 'Wrong credentials';
    protected $code = StatusCodeInterface::STATUS_UNAUTHORIZED;
}
