<?php

namespace src\app\exceptions\clientExceptions;

use Exception;
use Fig\Http\Message\StatusCodeInterface;

class ClientException extends Exception
{
    protected $message = '';
    protected $code = StatusCodeInterface::STATUS_BAD_REQUEST;

    public function __construct()
    {
        parent::__construct($this->message, $this->code);
    }
}
