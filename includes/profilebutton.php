<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<!-- <div class="profile-container"> -->
<img src="assets/images/Profile.png" alt="Profile Image" class="profile-image" onclick="togglePopup()">
<div class="profile-popup" id="profilePopup">
  <span class="close-btn" onclick="togglePopup()">&times;</span>
  <?php
  // Check if the user is logged in
  if (isset($_SESSION['id'])) {
      // Get the username from the session
      $username = $_SESSION['name'];
      echo "<h3>Welcome, $username!</h3>";
      echo "<a class='logout' href='logout.php'>Logout</a>";
  } else {
      // If the user is not logged in, show a message
      echo "<h3>User not logged in</h3>";
  }
  ?>
</div>

<script src="assets/js/script.js"></script>
