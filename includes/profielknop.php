<?php
session_start();
?>

<!-- <div class="profile-container"> -->
  <img src="assets/images/Profile.png" alt="Profile Image" class="profile-image" onclick="togglePopup()">
  <div class="profile-popup" id="profilePopup">
    <span class="close-btn" onclick="togglePopup()">&times;</span>
    <?php
    // Controleer of de gebruiker is ingelogd
    if (isset($_SESSION['uid'])) {
        // Haal de gebruikersnaam uit de sessie
        $username = $_SESSION['name'];
        echo "<h3>Welcome $username!</h3>";
        
        echo "<a class='logout' href='logout.php'>logout</a>";
    } else {
        echo "<h3>User not logged in, click <a href='register.php'>here</a> to make a account, or <a href='login.php'>here</a> to login. </h3>";
    }
    ?>
  </div>
</div>

<script src="assets/js/script.js"></script>
