<?php
try {
    $database = new PDO(
        "mysql:host=localhost;dbname=twitter",
        "root",
        "",
        array(PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8")
    );
    $database->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $error) {
    die('Site indisponible : ' . $error->getMessage());
}

$stmt = $database->query('SELECT * FROM user');
$results = $stmt->fetchAll(PDO::FETCH_ASSOC);
var_dump($results);
?>