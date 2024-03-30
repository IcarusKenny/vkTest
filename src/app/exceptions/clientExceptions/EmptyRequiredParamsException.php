<?php

namespace src\app\exceptions;

use Exception;
use Fig\Http\Message\StatusCodeInterface;

class EmptyRequiredParamsException extends Exception
{
    public function __construct()
    {
        parent::__construct('Empty required params', StatusCodeInterface::STATUS_BAD_REQUEST);
    }
}
