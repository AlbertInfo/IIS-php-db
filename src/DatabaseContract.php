<?php

namespace Alberto\SakilaPhpTest;

interface DatabaseContract
{

    const TYPE_PDO = 'pdo';
    const TYPE_MySQLi = 'mysqli';

    public function getData(string $tableName, array $params = []) :array;
}
