<?php

namespace src\app\exceptions\serverExceptions;

use Exception;
use Fig\Http\Message\StatusCodeInterface;

class ServerException extends Exception
{
    protected $message = '';
    protected $code = StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR;

    public function __construct()
    {
        parent::__construct($this->message, $this->code);
    }
}
