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
    <main class="main-log-in">

        <div class="primary-bg">
        </div>
        <p class="action">Log in</p>
        <p class="what-you-have-to-do">log in je account</p>
        <form method="post" class="input-fields">
            <input type="text" name="username" placeholder="username" required><br>
            <input type="password" name="password" placeholder="password" required><br>
            <button type="submit" name="submit">log in</button>
        </form>
        <a href="sign_up.php">maak een account</a>
        </div>
    </main>
    <?php include 'includes/footer.php' ?>
</body>

</html>