<nav class="nav">
        <div class="logo">
            <img src="./assets/images/logods.gif" alt="Logo">
        </div>
        <a href="index.php">Home</a>
    <?php

    if (isset($_SESSION["uid"])) {
        
    } else {
        echo '<a href="login.php">Login</a>';
        echo '<a href="register.php">Registreer</a>';
        echo '<a href="webshop.php">gallery</a>';
    }

    include "includes/profielKnop.php";

    ?>
</nav>