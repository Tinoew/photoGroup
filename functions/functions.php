<?php

// *********************************************************************** //

// Index functions.php
// () -> dbConnect
// () -> register
// () -> login
// ()
// ()

// *********************************************************************** //

function dbConnect()
{
    try {
        $servername = "localhost";
        $database = "photogroup";
        $dsn = "mysql:host=$servername;dbname=$database";
        $username = "root";
        $password = "";

        $conn = new PDO($dsn, $username, $password);
        return $conn;

    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
