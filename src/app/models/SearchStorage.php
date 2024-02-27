<?php

namespace src\app\models;

use src\app\exceptions\EmptyRequiredParamsException;
use src\app\exceptions\InsertException;
use src\config\Mysql;

class SearchStorage
{
    /**
     * @param string $keyword
     * @param string $result
     * @return void
     * @throws EmptyRequiredParamsException|InsertException
     */
    public function save($keyword, $result)
    {
        if (!$keyword || !$result) {
            throw new EmptyRequiredParamsException();
        }

        $sql = 'insert into search (keyword, result) values (:keyword, :result)';
        $db = new Mysql();
        $conn = $db->connect();
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':keyword', $keyword);
        $stmt->bindParam(':result', $result);

        $res = $stmt->execute();
        $db = null;

        if (!$res) {
            throw new InsertException();
        }
    }

    /**
     * @param string $keyword
     * @return string
     * @throws EmptyRequiredParamsException
     */
    public function getLastKeywordSearchResult($keyword)
    {
        if (!$keyword) {
            throw new EmptyRequiredParamsException();
        }

        $sql = "select result from search where keyword = '$keyword' order by date desc";
        $db = new Mysql();
        $conn = $db->connect();
        $stmt = $conn->query($sql);

        $res = $stmt->fetchColumn();
        $db = null;

        return (string) $res;
    }
}
