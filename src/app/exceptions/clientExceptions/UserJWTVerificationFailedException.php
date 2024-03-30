<?php

namespace src\app\exceptions\clientExceptions;

use Fig\Http\Message\StatusCodeInterface;

class UserJWTVerificationFailedException extends ClientException
{
    protected $code = StatusCodeInterface::STATUS_UNAUTHORIZED;
}
