<?php

namespace src\app\helpers;

use src\app\enums\PasswordCheckStatus as Status;

class PasswordChecker
{
    /**
     * @param string $password
     * @return Status
     */
    public static function check(string $password): Status
    {
        $goodPasswordPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,}$/';
        $strongPasswordPattern = '/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{16,}$/';

        if (preg_match($strongPasswordPattern, $password)) {
            return Status::STRONG;
        }

        return preg_match($goodPasswordPattern, $password) ? Status::GOOD : Status::WEAK;
    }
}
