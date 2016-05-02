<?php

$DB_DSN      = 'camagru';
$DB_USER     = 'root';
$DB_PASSWORD = 'root';
global $DBH;
try {
    $DBH = new PDO('mysql:host=localhost;dbname='.$DB_DSN, $DB_USER, $DB_PASSWORD);
} catch (PDOException $e) {
    setMessage('error', 'Connexion échouée : ' . $e->getMessage());
    die();
}

