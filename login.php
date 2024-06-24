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
    <!-- Login Formulier -->
    <div id="login" class="form-container">
        <h1 class="register">Login</h1>
        <form class="registerForm">
            <input type="email" name="email" placeholder="Email" required>
            <input type="password" name="password" placeholder="Wachtwoord" required>
            <div class="button-container">
                <button type="submit" class="button-78" role="button">Login</button>
            </div>
        </form>
    </div>

    <?php include_once 'includes/footer.php'; ?>


</body>

</html>

