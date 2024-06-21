<?php
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

function register($conn)
{
    if (isset($_POST['register'])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $repeatPassword = $_POST['repeatPassword'];
        $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
        $admin = 0;

        $stmtCheck = $conn->prepare("SELECT * FROM users WHERE name = :name");
        if ($stmtCheck->execute(['name' => $name])) {
            $result = $stmtCheck->fetch();
            if ($result) {
                echo "<script type=\"text/javascript\">toastr.error('Gebruiker bestaat al')</script>";
                return;
            }
        }

        $stmtCheck = $conn->prepare("SELECT * FROM users WHERE email = :email");
        if ($stmtCheck->execute(['email' => $email])) {
            $result = $stmtCheck->fetch();
            if ($result) {
                echo "<script type=\"text/javascript\">toastr.error('Email bestaat al')</script>";
                return;
            }
        }

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo "<script type=\"text/javascript\">toastr.error('Ongeldig email adres')</script>";
            return;
        }

        if ($password == $repeatPassword) {
            try {
                $stmtUpdate = $conn->prepare("INSERT INTO users (name, email, password, admin) VALUES (:name, :email, :password, :admin)");
                $stmtUpdate->bindParam(':name', $name);
                $stmtUpdate->bindParam(':email', $email);
                $stmtUpdate->bindParam(':password', $passwordHashed);
                $stmtUpdate->bindParam(':admin', $admin);
                $stmtUpdate->execute();

                if ($stmtUpdate) {
                    header("Location: ./login.php");
                }
            } catch (PDOException $e) {
                echo $e->getMessage();
            }

        } else {
            echo "<script type=\"text/javascript\">toastr.error('Wachtwoorden komen niet overeen')</script>";
        }
    }
}


function login($conn)
{
    if (isset($_POST['email']) && isset($_POST['password'])) {
        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                // Gebruiker is succesvol ingelogd, sla gebruikersgegevens op in sessievariabelen
                session_start(); // Start de sessie
                $_SESSION['uid'] = $user['uid'];
                $_SESSION['admin'] = $user['admin'];
                $_SESSION['name'] = $user['name'];

                header("Location: ./index.php");
                exit();
            } else {
                echo "<script type=\"text/javascript\">toastr.error('Wachtwoord en Email adres komen niet overeen')</script>";
            }
        } else {
            echo "<script type=\"text/javascript\">toastr.error('Gebruiker niet gevonden')</script>";
        }
    }
}

?>