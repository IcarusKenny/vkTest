<?php

namespace src\app\models;

use Exception;
use src\app\exceptions\clientExceptions\EmptyRequiredParamsException;
use src\app\exceptions\clientExceptions\UserJWTVerificationFailedException;
use src\app\exceptions\clientExceptions\WrongCredentialsException;
use stdClass;

class UserJWT
{
    private string $secretKey = 'usersSecretKey';

    /**
     * @param string $email
     * @param string $password
     * @return string
     * @throws EmptyRequiredParamsException
     * @throws WrongCredentialsException
     */
    public function generate(string $email, string $password): string
    {
        $hash = User::hashPassword($password);
        $user = UserStorage::getUserByEmail($email);
        $userId = $user->id;

        if (!$userId || $hash !== $user->hash) {
            throw new WrongCredentialsException();
        }

        return (new JWT($this->secretKey))->generate(['userId' => $userId]);
    }

    /**
     * @param string $accessToken
     * @return stdClass
     * @throws UserJWTVerificationFailedException
     */
    public function validate(string $accessToken): stdClass
    {
        try {
            return (new JWT($this->secretKey))->validate($accessToken);
        } catch (Exception) {
            throw new UserJWTVerificationFailedException();
        }
    }
}
