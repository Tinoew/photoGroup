<?php

function dbConnect() {
    try {
        $servername = "localhost";
        $database = "photogroup";
        $dsn = "mysql:host=$servername;dbname=$database";
        $username = "root";
        $password = "";

        $conn = new PDO($dsn, $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION); // Ensure errors are displayed
        return $conn;
    } catch (PDOException $e) {
        echo "Connection error: " . $e->getMessage();
        exit; // Stop further execution if there is an error
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

    // Check if the name already exists
    $checkSql = 'SELECT * FROM users WHERE name = :name';
    $checkStmt = $conn->prepare($checkSql);
    $checkStmt->execute(['name' => $name]);
    if ($checkStmt->rowCount() > 0) {
        echo "<script type=\"text/javascript\">toastr.error('User already exists')</script>";
        return;
    }

    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    try {
        $sql = 'INSERT INTO users (name, password) VALUES (:name, :password)';
        $stmt = $conn->prepare($sql);
        $stmt->execute(['name' => $name, 'password' => $hashed_password]);

        echo "<script type=\"text/javascript\">toastr.success('Registered successfully')</script>";
    } catch (PDOException $e) {
        echo "<script type=\"text/javascript\">toastr.error('Registration failed: ')</script>" . $e->getMessage();
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
                echo "<script type=\"text/javascript\">toastr.error('Username and password do not match')</script>";
            }
        } else {
            echo "<script type=\"text/javascript\">toastr.error('User not found')</script>";
        }
    }
}

function upload($conn) {
    session_start();
    if (!isset($_SESSION['id'])) {
        echo "You need to be logged in to upload files.";
        return;
    }
    
    try {
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $targetDir = "img/";
            if (!is_dir($targetDir)) {
                mkdir($targetDir, 0755, true);
            }

            $targetFile = $targetDir . basename($_FILES["image"]["name"]);
            $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

            $check = getimagesize($_FILES["image"]["tmp_name"]);
            if ($check === false) {
                throw new Exception("File is not an image.");
            }

            if ($_FILES["image"]["size"] > 5000000) {
                throw new Exception("Sorry, your file is too large.");
            }

            $allowedTypes = array("jpg", "jpeg", "png", "gif");
            if (!in_array($imageFileType, $allowedTypes)) {
                throw new Exception("Sorry, only JPG, JPEG, PNG & GIF files are allowed.");
            }

            if (move_uploaded_file($_FILES["image"]["tmp_name"], $targetFile)) {
                $title = htmlspecialchars($_POST['title']);
                $category = htmlspecialchars($_POST['category']);
                $price = htmlspecialchars($_POST['price']);
                $author = htmlspecialchars($_POST['author']);
                $userId = $_SESSION['id'];

                $sql = "INSERT INTO images (title, category, price, img_path, author, user_id) VALUES (:title, :category, :price, :img_path, :author, :user_id)";
                $stmt = $conn->prepare($sql);
                $stmt->bindParam(':title', $title);
                $stmt->bindParam(':category', $category);
                $stmt->bindParam(':price', $price);
                $stmt->bindParam(':img_path', $targetFile);
                $stmt->bindParam(':author', $author);
                $stmt->bindParam(':user_id', $userId);
                
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
