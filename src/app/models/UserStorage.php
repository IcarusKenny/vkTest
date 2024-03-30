<?php

namespace src\app\models;

use src\app\exceptions\clientExceptions\EmptyRequiredParamsException;
use src\app\exceptions\serverExceptions\InsertException;
use src\config\Mysql;
use stdClass;

class UserStorage
{
    /**
     * @param string $email
     * @param string $hash
     * @return int
     * @throws EmptyRequiredParamsException|InsertException
     */
    public static function save($email, $hash)
    {
        if (!$email || !$hash) {
            throw new EmptyRequiredParamsException();
        }

        $sql = 'insert into users (email, hash) values (:email, :hash)';
        $db = new Mysql();
        $conn = $db->connect();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':hash', $hash);

        $res = $stmt->execute();
        $db = null;

        if (!$res) {
            throw new InsertException();
        }

        return (int) $conn->lastInsertId();
    }

    /**
     * @param string $email
     * @return stdClass
     * @throws EmptyRequiredParamsException
     */
    public static function getUserByEmail($email)
    {
        if (!$email) {
            throw new EmptyRequiredParamsException();
        }

        $db = new Mysql();
        $conn = $db->connect();
        $sth = $conn->prepare('select * from users where email = :email limit 1');
        $sth->bindParam(':email', $email);
        $sth->execute();
        $db = null;

        return $sth->fetchObject() ?: new stdClass();
    }
}