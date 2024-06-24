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
        <h1>registreer</h1>

        <ul class="registerForm">
            <form action="" method="post">
                <li><input type="text" id="name" name="name" placeholder="gebruikersnaam" required></li>
                <li><input type="email" id="email" name="email" placeholder="email" required></li>
                <li><input type="password" id="password" name="password" placeholder="wachtwoord" required></li>
                <li><input type="password" id="repeatPassword" name="repeatPassword" placeholder="herhaal wachtwoord" required></li>
                <li class="registerButton"><input class="LoginButton" type="submit" value="Registreer" name="register" id="registerButton"></li>
                <li>
                    <div>Heeft u al een account?</div><a href="login.php">Login</a>
                </li>
            </form>
        </ul>
    </div>
    <?php include 'includes/footer.php' ?>
</body>

</html>