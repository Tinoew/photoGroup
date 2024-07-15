<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="nav">
    <div class="logo">
        <img src="./assets/images/logods.gif" alt="Logo">
    </div>

    <a href="index.php">Home</a>
    <a href="buy.php">Buy</a>
    <?php
    if (isset($_SESSION["id"])) {
        echo '<a href="sell.php">Sell</a>';
        echo '<a href="create.php">Upload</a>'; // Show the "Upload" tab if the user is logged in
    } else {
        echo '<a href="login.php">Login</a>';
        echo '<a href="register.php">Register</a>';
    }
    include "includes/profilebutton.php";
    ?>
</nav>
