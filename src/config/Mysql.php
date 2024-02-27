<?php

namespace src\config;

use PDO;

class Mysql
{
    /**
     * @var string
     */
    private $host = '172.17.0.1';

    /**
     * @var string
     */
    private $user = 'root';

    /**
     * @var string
     */
    private $password = 'mypassword';

    /**
     * @var string
     */
    private $dbname = 'testdb';

    /**
     * @return PDO
     */
    public function connect()
    {
        $connString = "mysql:host=$this->host;dbname=$this->dbname";
        $conn = new PDO($connString, $this->user, $this->password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $conn;
    }
}
