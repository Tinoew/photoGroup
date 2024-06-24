<?php 
include_once 'includes/navbar.php';
include_once 'includes/head.php';

include_once 'functions/functions.php';
$conn = dbConnect();

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="./style/style.css">
</head>
<body>
<div class="register">
        <h1>Login</h1>

        <ul class="registerForm">
            <form action="" method="post">
                <li><input type="text" id="email" name="email" placeholder="email"></li>
                <li><input type="password" id="password" name="password" placeholder="wachtwoord"></li>
                <div class="button-container">
                <li><input class="LoginButton" type="submit" value="Login"></li>
                </div>
                <li>
                    <div>Heeft u geen account?</div><a href="register.php">Registreer</a>
                </li>
            </form>
        </ul>

        <?php include_once 'includes/footer.php'; ?>

        <?php
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            login($conn);
        }
        ?>

    </div>
    <?php include 'includes/footer.php' ?>
</body>

</html>