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
        echo "<h3>Welkom $username!</h3>";
        
        echo "<a class='logout' href='logout.php'>Loguit</a>";
    } else {
        // Als de gebruiker niet is ingelogd, toon dan bijvoorbeeld een algemene melding
        echo "<h3>Gebruiker niet ingelogd</h3>";
    }
    ?>
  </div>
</div>

<script src="assets/js/script.js"></script>
