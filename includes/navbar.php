<nav class="nav">
        <div class="logo">
            <img src="./assets/images/logods.gif" alt="Logo">
        </div>
    
    <a href="index.php">Home</a>
    <a href="webshop.php">Gallery</a>
    <a href="create.php">Upload</a>
    <?php
    include "includes/profilebutton.php";

    if (isset($_SESSION["id"])) {
        
    } else {
        echo '<a href="login.php">Login</a>';
        echo '<a href="register.php">Register</a>';
    }
    ?>
</nav>