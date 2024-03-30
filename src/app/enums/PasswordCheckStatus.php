<?php

namespace src\app\enums;

enum PasswordCheckStatus: string
{
    case WEAK = 'weak';
    case GOOD = 'good';
    case STRONG = 'strong';
}
