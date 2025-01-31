<?php

require_once __DIR__ . '/vendor/autoload.php'; //caricare l'autoloader;

//Se voglio modificare il composer.json devo fare il comando composer update
//Come aggiunta di dipendenze o cambio autoload

use Alberto\SakilaPhpTest\DatabaseContract;
use Alberto\SakilaPhpTest\DatabaseFactory;
use Alberto\SakilaPhpTest\DBConfig;
use Alberto\SakilaPhpTest\MyPDO; //necessario per utilizzare la classe 

//Creo una istanza di DBConfig e passo i parametri di connessione del db
//cosa da non fare quando si va in produzione.

// $statement->debubDumpParamas() : mi permette di vedere lo stato
//e le informazione dello statement
$dbConfig = new DBConfig(
    'localhost',
    '3306',
    'root',
    'Alberto97',
    'sakila'
);
//Creo la connessione a db passando la dbConfig che mi ritorna la stringa 
//proprio come vuole il PDO.

// Qui posso passare due tipi di connessione al db o TYPE_PDO O TYPE_MYSQLi che attualmente non è
//implementato e tira un'eccezione.
$db = DatabaseFactory::Create($dbConfig, DatabaseContract::TYPE_PDO);
$selectedActor = null;

if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $id = $_GET['actor_id'];
    //Vado a prendere dal db l'attore che ha l'id che arriva da GET
    $db->getData("DELETE FROM actor WHERE actor_id = ?", [$id]);;

    header("Location : index.php"); //Reload della pagina
}

