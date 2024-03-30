<?php

namespace src\app\exceptions\clientExceptions;

class EmptyRequiredParamsException extends ClientException
{
    protected $message = 'Empty required params';
}
