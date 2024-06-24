<?php


$host = 'localhost';
$dbname = 'photogroup';
$user = 'root';
$pass = '';
$charset = 'utf8mb4';

try {
    // databaseverbinding aanmaken
    $dsn = "mysql:host=$host;dbname=$dbname;charset=$charset";
    $pdo = new PDO($dsn, $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

        $password = $_POST['password'];
        $username = $_POST['username'];

        if (empty($password) || empty($username)) {
            die("Alle velden moeten worden ingevuld.");
        }

        // Controleer of de gebruikersnaam al bestaan
        $stmt_check_username = $pdo->prepare("SELECT * FROM users WHERE username = :username");
        $stmt_check_username->bindParam(':username', $username, PDO::PARAM_STR);
        // $stmt->bindParam(':password', $password);
        $stmt_check_username->execute();

        if ($stmt_check_username->rowCount() > 0) {
            die("Gebruikersnaam is al in gebruik. Kies een andere gebruikersnaam.");
        }

        // Wachtwoord opslaan
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // Voorbereiden van de SQL-query
        $sql = "INSERT INTO users (username, password) VALUES (:username, :password)";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);
        $stmt->bindParam(':username', $username, PDO::PARAM_STR);

        // Uitvoeren van de query
        if ($stmt->execute()) {
            echo "Registratie succesvol! Je kunt nu <a href='index.php'>inloggen</a>.";
        } else {
            echo "Fout bij het opslaan van gegevens.";
        }
    }
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
} finally {
    // Databaseverbinding evetjes sluiten
    $pdo = null;
}

?>