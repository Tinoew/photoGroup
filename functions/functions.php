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

// *********************************************************************** //

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

// *********************************************************************** //

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


function readAllReviews($conn)
{
    $stmt = $conn->prepare("SELECT * FROM reviews ORDER BY id DESC");
    $stmt->execute();
    
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $reviews = $stmt->fetchAll();

    echo '<div class="row-preview-container">';
    $count = 0;
    foreach ($reviews as $record) {
        echo '
        <div class="column-preview">
            <div class="content-preview">
                <img src="assets/images/reviewImages/' . htmlspecialchars($record['image']) . '" alt="Deze afbeelding is niet beschikbaar" id="appeltaart">
                <h3><a href="reviews.php">' . htmlspecialchars($record['title']) . '</a></h3>
                <p><strong>Review gegeven door: ' . htmlspecialchars($record['name']) . '</strong></p>
                <p>' . htmlspecialchars($record['review']) . '</p>
                <p>Restaurant: ' . htmlspecialchars($record['nameRestaurant']) . '</p>
                <p>Plek: ' . htmlspecialchars($record['place']) . '</p>
                <div class="rating">';
        
        for ($i = 0; $i < $record['rating']; $i++) {
            echo '<i class="fa-regular fa-star"></i>';
        }

        for ($i = $record['rating']; $i < 5; $i++) {
            echo '<i class="fa fa-star" style="color: grey;"></i>';
        }

        echo '
                </div>
            </div>
        </div>';
        
        $count++;
        if ($count % 3 == 0) {
            echo '<div class="clear"></div>';
        }
    }
    echo '</div>';
}



function read3Reviews($conn)
{
    // Prepare the SQL statement to select 3 random reviews
    $stmt = $conn->prepare("SELECT * FROM reviews ORDER BY RAND() LIMIT 3");
    $stmt->execute();
    
    $stmt->setFetchMode(PDO::FETCH_ASSOC);
    $reviews = $stmt->fetchAll();

    echo '<div class="row-preview-container">';
    $count = 0;
    foreach ($reviews as $record) {
        echo '
        <div class="column-preview">
            <div class="content-preview">
                <img src="assets/images/reviewImages/' . htmlspecialchars($record['image']) . '" alt="appeltaart" id="appeltaart">
                <h3><a href="reviews.php">' . htmlspecialchars($record['title']) . '</a></h3>
                <p><strong>Review gegeven door: ' . htmlspecialchars($record['name']) . '</strong></p>
                <p>' . htmlspecialchars($record['review']) . '</p>
                <p>Restaurant: ' . htmlspecialchars($record['nameRestaurant']) . '</p>
                <p>Plek: ' . htmlspecialchars($record['place']) . '</p>
                <div class="rating">';
        
        for ($i = 0; $i < $record['rating']; $i++) {
            echo '<i class="fa-regular fa-star"></i>';
        }

        for ($i = $record['rating']; $i < 5; $i++) {
            echo '<i class="fa fa-star" style="color: grey;"></i>';
        }

        echo '
                </div>
            </div>
        </div>';
        
        $count++;
        if ($count % 5 == 0) {
            echo '<div class="clear"></div>';
        }
    }
    echo '</div>';
}

function createReview($conn) {
    if (isset($_POST['submit'])) {
        $name = $_POST['name'];
        $nameRestaurant = $_POST['nameRestaurant'];
        $place = $_POST['place'];
        $title = $_POST['title'];
        $rating = $_POST['rating'];
        $review = $_POST['review'];
        
        $defaultImage = 'appeltaart.jpg';
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
        } else {
            $image = $defaultImage;
        }

        try {
            $stmt = $conn->prepare("INSERT INTO reviews (name, nameRestaurant, place, title, review, rating, image) VALUES (:name, :nameRestaurant, :place, :title, :review, :rating, :image)");
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':nameRestaurant', $nameRestaurant);
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

function searchReview($conn) {
    if (isset($_POST['query'])) {
        $search = '%' . $_POST['query'] . '%';

        $stmt = $conn->prepare("SELECT * FROM reviews WHERE place LIKE :search");
        $stmt->bindParam(':search', $search);

        $stmt->execute();

        $stmt->setFetchMode(PDO::FETCH_ASSOC);
        $reviews = $stmt->fetchAll();

        if (empty($reviews)) {
            echo '<h1 class="no-results">Geen resultaten gevonden</h1>';
            return;
        }

        echo '<div class="row-preview-container">';
        $count = 0;
        foreach ($reviews as $record) {
            echo '
            <div class="column-preview">
                <div class="content-preview">
                    <img src="assets/images/reviewImages/' . htmlspecialchars($record['image']) . '" alt="appeltaart" id="appeltaart">
                    <h3><a href="reviews.php">' . htmlspecialchars($record['title']) . '</a></h3>
                    <p><strong>Review gegeven door: ' . htmlspecialchars($record['name']) . '</strong></p>
                    <p>' . htmlspecialchars($record['review']) . '</p>
                    <p>Restaurant: ' . htmlspecialchars($record['nameRestaurant']) . '</p>
                    <p>Plek: ' . htmlspecialchars($record['place']) . '</p>
                    <div class="rating">';
            
            for ($i = 0; $i < $record['rating']; $i++) {
                echo '<i class="fa-regular fa-star"></i>';
            }

            for ($i = $record['rating']; $i < 5; $i++) {
                echo '<i class="fa fa-star" style="color: grey;"></i>';
            }

            echo '
                    </div>
                </div>
            </div>';
            $count++;
            if ($count % 3 == 0) {
                echo '<div class="clear"></div>';
            }
        }
        echo '</div>';
    }
}



?>