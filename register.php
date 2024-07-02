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
    <!-- Registratie Formulier -->
    <div id="register" class="form-container">
        <h1 class="register">Register</h1>
        <form class="registerForm" method="POST" action="register.php">
            <input type="text" name="name" placeholder="Name" required>
            <input type="password" name="password" placeholder="Password" required>
            <input type="password" name="confirm_password" placeholder="Confirm Password" required>
            <div class="button-container">
                <button type="submit" class="button-78" role="button">Register</button>
            </div>
        </form>
    </div>

    <?php include_once 'includes/footer.php'; ?>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        register($conn);
    }
    ?>
</body>
</html>
