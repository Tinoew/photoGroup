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

function upload($conn) {
    try {
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            // Define the target directory
            $targetDir = "img/";
            // Check if the directory exists, if not, create it
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }

            $targetFile = $targetDir . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            // Check if the file is an actual image
            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check === false) {
                throw new Exception("File is not an image.");
            }

            // Check file size (example: limit to 5MB)
            if ($_FILES["image"]["size"] > 5000000) {
                throw new Exception("Sorry, your file is too large.");
            }

            // Allow certain file formats
            $allowedTypes = array("jpg", "jpeg", "png", "gif");
            if (!in_array($imageFileType, $allowedTypes)) {
                throw new Exception("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            }

            // Try to move the uploaded file to the target directory
            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                $title = htmlspecialchars($_POST['title']);
                $category = htmlspecialchars($_POST['category']);
                $price = htmlspecialchars($_POST['price']);

                // Insert file information into the database (without description)
                $sql = "INSERT INTO images (title, category, price, img_path) VALUES (:title, :category, :price, :img_path)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':category', $category);
                $stmt->bindParam(':price', $price);
                $stmt->bindParam(':img_path', $targetFile);
                
                if ($stmt->execute()) {
                    echo "The file " . htmlspecialchars(basename($_FILES["image"]["name"])) . " has been uploaded.";
                } else {
                    throw new Exception("Sorry, there was an error uploading your file.");
                }
            } else {
                throw new Exception("Sorry, there was an error uploading your file.");
            }
        } else {
            throw new Exception("No file was uploaded or there was an error.");
        }
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

?>
