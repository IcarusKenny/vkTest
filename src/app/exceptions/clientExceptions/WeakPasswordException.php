<?php

namespace src\app\exceptions\clientExceptions;

class WeakPasswordException extends ClientException
{
    protected $message = 'Weak password';
}
