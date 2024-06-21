<nav>
    <a href="index.php">Home</a>
    <?php

    if (isset($_SESSION["uid"])) {
        
    } else {
        echo '<a href="login.php">Login</a>';
        echo '<a href="register.php">Registreer</a>';
    }

    include "includes/profielKnop.php";

    ?>
</nav>