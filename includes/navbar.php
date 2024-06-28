<nav class="nav">
        <div class="logo">
            <img src="./assets/images/logods.gif" alt="Logo">
        </div>
    <a href="index.php">Home</a>
    <a href="webshop.php">Gallary</a>
    <a href="create.php">Upload</a>
    <?php

    if (isset($_SESSION["uid"])) {
        
    } else {
        echo '<a href="login.php">Login</a>';
        echo '<a href="register.php">Registreer</a>';
    }

    include "includes/profielKnop.php";
    ?>
</nav>