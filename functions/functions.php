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
        echo "<script type=\"text/javascript\">toastr.error('Please fill in all fields.')</script>";
        return;
    }

    $name = $_POST['name'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($password !== $confirm_password) {
        echo "<script type=\"text/javascript\">toastr.error('Passwords do not match')</script>";
        return;
    }

    // Controleren of de naam al bestaat
    $checkSql = 'SELECT * FROM users WHERE name = :name';
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->execute(['name' => $name]);
    if ($checkStmt->rowCount() > 0) {
        echo "<script type=\"text/javascript\">toastr.error('Gebruiker bestaat al')</script>";
        return;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $sql = 'INSERT INTO users (name, password) VALUES (:name, :password)';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['name' => $name, 'password' => $hashed_password]);

        echo "<script type=\"text/javascript\">toastr.success('registered succesful')</script>";
    } catch (PDOException $e) {
        echo "<script type=\"text/javascript\">toastr.error('register failed: ')</script>" . $e->getMessage();
    }
}

function login($conn)
{
    if (isset($_POST['name']) && isset($_POST['password'])) {
        $name = $_POST['name'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT * FROM users WHERE name = :name");
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            if (password_verify($password, $user['password'])) {
                // User successfully logged in, save user data in session variables
                session_start(); // Start the session
                $_SESSION['id'] = $user['id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['loggedin'] = true; // Add a session variable to indicate successful login

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

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    echo "<script type=\"text/javascript\">toastr.success('Je bent succesvol ingelogd')</script>";
    unset($_SESSION['loggedin']); 
}


function upload($conn) {
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $namephoto = $_POST['namephoto'];
        $place = $_POST['place'];
        $title = $_POST['title'];
        $rating = $_POST['rating'];
        $review = $_POST['review'];
        
        $path = "./assets/images/reviewImages/";
        
        if (isset($_FILES["image"]) && $_FILES["image"]["error"] == 0) {
            $image = basename($_FILES["image"]["name"]);
            $targetFilePath = $path . $image;
            $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);
            $allowedTypes = array('jpg', 'jpeg', 'png', 'gif');

            if (in_array($fileType, $allowedTypes)) {
                if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFilePath)) {
                } else {
                    echo "There was an error moving the uploaded file.";
                    return;
                }
            } else {
                echo "Sorry, only JPG, JPEG, PNG, & GIF files are allowed.";
                return;
            }
        }

        try {
            $stmt = $conn->prepare("INSERT INTO reviews (name, namephoto, place, title, review, rating, image) VALUES (:name, :namephoto, :place, :title, :review, :rating, :image)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':namephoto', $namephoto);
            $stmt->bindParam(':place', $place);
            $stmt->bindParam(':title', $title);
            $stmt->bindParam(':review', $review);
            $stmt->bindParam(':rating', $rating);
            $stmt->bindParam(':image', $image);
            $stmt->execute();

            echo "<script type=\"text/javascript\">toastr.success('Review succesvol aangemaakt')</script>";
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
?>
