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
// $results = $db->getData("actor", []);
// var_dump($results);
// foreach ($results as $singleResult) {

//     echo $singleResult["first_name"] . PHP_EOL;
// }
// 

// var_dump($_POST);
if ($_SERVER['REQUEST_METHOD'] == "GET") {
    $id = $_GET['actor_id'];
    //Vado a prendere dal db l'attore che ha l'id che arriva da GET
    $result =  $db->getData("SELECT * FROM actor WHERE actor_id = ?", [$id]);

    $selectedActor = $result->fetch();

    if (!$selectedActor) {
        die('Actor not found!');
    }
}

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $firstName = $_POST['first_name'];
    $lastName = $_POST['last_name'];
    $id = $_POST['actor_id'];

    //Query POST PER AGGIORNARE IL NOME DELL'ATTORE.
    $db->setData("UPDATE actor SET first_name = ?, last_name = ? WHERE actor_id = ?", [
        [$firstName, $lastName, $id]

    ]);
    
    //Reload della pagina
    header("Location : index.php"); //Reload della pagina
    // $result =  $db->getData("SELECT * FROM actor WHERE actor_id = ?", [$id]);

    // $selectedActor = $result->fetch();
    //Inserimento di due elementi alla volta in transazione.
    // $db->doWithTransaction([
    //     "INSERT INTO actor (first_name, last_name) VALUES('$firstName', '$lastName')",
    //     "INSERT INTO actor (first_name, last_name) VALUES('$firstName', '$lastName')"
    // ]);


}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update actor</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="card">
            <div class="card-body">
                <div class="card-title">
                    Aggiorna il nome attore
                </div>
                <form action="" method="POST">
                    <input type="hidden" name="actor_id" value="<?=$id ?>">
                    <input type="text" name="first_name" value="<?= !is_null($selectedActor) ? $selectedActor["first_name"] : '' ?>">
                    <input type="text" name="last_name" value="<?=!is_null($selectedActor) ? $selectedActor["last_name"] : ''?>">
                    <input type="submit" value="Invia">


                </form>
            </div>

        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>