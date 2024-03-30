<?php

namespace src\app\models;

use src\app\enums\PasswordCheckStatus;
use src\app\exceptions\clientExceptions\EmailAlreadyExistsException;
use src\app\exceptions\clientExceptions\EmptyRequiredParamsException;
use src\app\exceptions\clientExceptions\InvalidEmailException;
use src\app\exceptions\clientExceptions\WeakPasswordException;
use src\app\exceptions\serverExceptions\InsertException;
use src\app\helpers\PasswordChecker;

class User
{
    /**
     * @param string $email
     * @param string $password
     * @return array
     * @throws EmailAlreadyExistsException
     * @throws EmptyRequiredParamsException
     * @throws InvalidEmailException
     * @throws WeakPasswordException
     * @throws InsertException
     */
    public static function create(string $email, string $password): array
    {
        if (empty($email) || empty($password)) {
            throw new EmptyRequiredParamsException();
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidEmailException();
        }

        $emailExists = !!UserStorage::getUserByEmail($email)->id;

        if ($emailExists) {
            throw new EmailAlreadyExistsException();
        }

        $passwordCheckStatus = PasswordChecker::check($password);

        if ($passwordCheckStatus->value === PasswordCheckStatus::WEAK->value) {
            throw new WeakPasswordException();
        }

        $hash = self::hashPassword($password);
        $userId = UserStorage::save($email, $hash);

        return [
            'user_id' => $userId,
            'password_check_status' => $passwordCheckStatus->value
        ];
    }

    /**
     * @param string $password
     * @return string
     */
    public static function hashPassword(string $password): string
    {
        return hash('sha256', $password);
    }
}
