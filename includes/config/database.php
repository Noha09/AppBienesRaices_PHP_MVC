<?php

function conectarDB(): mysqli
{
    $db = new mysqli($_ENV['DB_HOST'], $_ENV['DB_USER'], $_ENV['DB_PASS'], $_ENV['DB_NAME']);

    if (!$db) {
        echo "Error no se pudo conectar";
        exit;
    }

    return $db;
}

/* mostrar errores php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL); */