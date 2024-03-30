<?php

namespace src\app\exceptions\clientExceptions;

use Fig\Http\Message\StatusCodeInterface;

class EmailAlreadyExistsException extends ClientException
{
    protected $message = 'Email already exists';
    protected $code = StatusCodeInterface::STATUS_CONFLICT;
}
