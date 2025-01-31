<?php

namespace Alberto\SakilaPhpTest;

use Exception;
use PDO;
use PDOException;

//Questo è un factory pattern, abbiamo portato dentro questa classe
//una istanza di creazione della connessione a db.
class DatabaseFactory
{



    // il metodo create restuisce un database contract o una pdo? 
    public static function Create(DbConfig $dbConfig, string $type = DatabaseContract::TYPE_PDO): DatabaseContract | null
    {

        if ($type == DatabaseContract::TYPE_PDO) {
            return self::CreateWithPdo($dbConfig);
        }
        if ($type == DatabaseContract::TYPE_MySQLi) {
            return self::CreateWithMySQLi($dbConfig);
        }

        throw new Exception("Not Implemented!");
    }

    private static function CreateWithPdo(DbConfig $dbConfig)
    {
        try {

            $pdo = new MyPDO($dbConfig); // creo una istanza della classe MyPDO che sta in src/MyPDO.php

            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $pdo;
        } catch (PDOException $e) {

            throw  new Exception("Database connection failed :{$e->getMessage()}");
        }
    }

    private static function CreateWithMySQLi(DbConfig $dbConfig) : MySQLi
    {

        try {

            $mysqli = new MySQLi($dbConfig); // creo una istanza della classe MyPDO che sta in src/MyPDO.php

            
            return $mysqli;
        } catch (Exception $e) {

            throw  new Exception("Database connection failed :{$e->getMessage()}");
        }
    }
}
