<?php
//Attraverso il namespace impostato come da composer.json riesco a fare l'autoload delle classi senza
//dover fare require dei singoli file.php
namespace Alberto\SakilaPhpTest;

use Alberto\SakilaPhpTest\DatabaseContract;

//PDO è UNA classe nativa di php e richiede lo slash prima 
class MyPDO extends \PDO implements DatabaseContract {

    public function __construct(DBConfig $dBConfig)
    {
        $dsn = $this->getDsn($dBConfig->host,$dBConfig->port,$dBConfig->dbName);
        $username = $dBConfig->user;
        $password = $dBConfig->password;
        $options = [];
        // questo costruttore è ereditata dalla classe PDO di php che
        // vuole i seguenti parametri
        parent::__construct($dsn, $username, $password, $options);
    }

    public function getData(string $query, array $params =[]):QueryResultContract

    {
        // $query = "SELECT * FROM " . $tableName;
        $statement =  $this->prepare($query);
        $statement->execute($params);
        //Fetch all restituisce tutti i dati 
        return new PDOQueryResult($statement);
        
    }

    /**
     
     * Summary of getDsn
     * @param string $host
     * @param string $port
     * @param string $dbName
     * @return string
     */


//Questa funzione restituisce le infomrazioni per la connessione a db.
    private function getDsn( string $host,string  $port, string $dbName){

        return 
        "mysql:
        host={$host};
        port={$port};
        dbname={$dbName}";
    }

   
}