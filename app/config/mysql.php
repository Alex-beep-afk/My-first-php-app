<?php
try {
    $dsn = "mysql:host=dataBase;dbname=my_first_app;charset=utf8mb4";

    $db = new PDO(
    $dsn,
    'root',
    null,
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC] 
                );

} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : $error->getMessage()");
}


?>