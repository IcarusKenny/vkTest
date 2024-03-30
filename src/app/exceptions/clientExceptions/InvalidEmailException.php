<?php

namespace src\app\exceptions\clientExceptions;

class InvalidEmailException extends ClientException
{
    protected $message = 'Invalid email';
}
