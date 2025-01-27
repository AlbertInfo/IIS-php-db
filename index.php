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

// $results = $db->getData("actor", []);
// var_dump($results);
// foreach ($results as $singleResult) {

//     echo $singleResult["first_name"] . PHP_EOL;
// }
// 
?>


<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sakila test</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<!-- Restituzione da db con ciclo foreach -->

<body>
    <div class="container">

        <h1>Sakila Actors</h1>
        <ul class="list-group">
            <?php $result =  $db->getData("SELECT * FROM actor WHERE first_name LIKE :param1", ["param1" => "%pen%"]); ?>
            <?php while ($actor = $result->fetch()) : ?>
                <li class="list-group-item"><?= $actor["first_name"] ?>, <?= $actor["last_name"] ?></li>
            <?php endwhile; ?>
            <?php foreach ($result->fetchAll() as $actor) : ?>
                <li class="list-group-item"><?= $actor["first_name"] ?>, <?= $actor["last_name"] ?></li>
            <?php endforeach; ?>
        </ul>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>