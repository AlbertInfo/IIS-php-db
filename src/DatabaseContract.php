<?php

namespace Alberto\SakilaPhpTest;

use PDOStatement;

interface DatabaseContract
{

    const TYPE_PDO = 'pdo';
    const TYPE_MySQLi = 'mysqli';

    public function getData(string $query, array $params = []): QueryResultContract;
}


interface QueryResultContract
{
    public function fetch();
    public function fetchAll();
}

class PDOQueryResult implements QueryResultContract
{

    private PDOStatement $statement;

    public function __construct(PDOStatement $statement)
    {
        $this->statement = $statement;
    }


    public function fetch() : mixed
    {

        return $this->statement->fetch();
    }


    public function fetchAll() :array
    {

        return $this->statement->fetchAll();
    }
}
