<?php

function dbConnect() {
    try {
        $servername = "localhost";
        $database = "photogroup";
        $dsn = "mysql:host=$servername;dbname=$database";
        $username = "root";
        $password = "";

        $conn = new PDO($dsn, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Zorgt ervoor dat fouten worden weergegeven
        return $conn;
    } catch (PDOException $e) {
        echo "Verbindingsfout: " . $e->getMessage();
        exit; // Stop verdere uitvoering als er een fout is
    }
}

function register($conn) {
    if (!isset($_POST['name'], $_POST['password'], $_POST['confirm_password'])) {
        echo 'Vul alle velden in.';
        return;
    }

    $name = $_POST['name'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo 'Wachtwoorden komen niet overeen!';
        return;
    }

    // Controleren of de naam al bestaat
    $checkSql = 'SELECT * FROM users WHERE name = :name';
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->execute(['name' => $name]);
    if ($checkStmt->rowCount() > 0) {
        echo 'Gebruikersnaam is al in gebruik!';
        return;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $sql = 'INSERT INTO users (name, password) VALUES (:name, :password)';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['name' => $name, 'password' => $hashed_password]);

        echo 'Registratie succesvol!';
    } catch (PDOException $e) {
        echo 'Registratie mislukt: ' . $e->getMessage();
    }
}

function login($conn) {
    if (isset($_POST['name'], $_POST['password'])) {
        $name = $_POST['name'];
        $password = $_POST['password'];

        $sql = 'SELECT * FROM users WHERE name = :name';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['name' => $name]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            echo 'Inloggen succesvol!';
            // Hier kun je een sessie starten of doorverwijzen naar een andere pagina
        } else {
            echo 'Ongeldige gebruikersnaam of wachtwoord!';
        }
    }
}
?>
