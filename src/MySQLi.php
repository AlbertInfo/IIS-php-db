<?php

namespace Alberto\SakilaPhpTest;

use Exception;

class MySQLi extends \mysqli implements DatabaseContract
{

    public function __construct(DBConfig $dBConfig)
    {
        parent::__construct($dBConfig->host, $dBConfig->user, $dBConfig->password, $dBConfig->dbName, $dBConfig->port);
    }

    public function getData(string $query, array $params = []): DatabaseQueryResultContract
    {

        //Implementaziobe di mysqli.
        $statement =  $this->prepare($query);
        $statement->execute($params);

        $result = $statement->get_result();

        return new MySQLiQueryResult($result);
    }

    public function setData(string $command, array $items): void
    {

        $statement =  $this->prepare($command);

       foreach($items as $item){
        $statement->execute($item);
       }
    }

    public function doWithTransaction(array $operations): void
    {
        throw new Exception('Not implemented');
    }

    //Quando il garbage collector vede che il db non è più utilizzato
    //chiama la funzione __destruct e chiude la connessione a db.
    public function __destruct()
    {
        //Siccome per questa implementazione la dbconnection è direttamente
        //la classe da cui ereditiamo posso fare this->close()
        $this->close();
    }
}
