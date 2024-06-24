<?php
include_once 'includes/navbar.php';
include_once 'includes/head.php';
?>
<?php

include_once 'functions/functions.php';
$conn = dbConnect();

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gallery App</title>
    <link rel="stylesheet" href="./assets/css/profile.css">
</head>
<body>

    <div class="container">
        <div class="controls">
            <input type="text" id="title" placeholder="add Title">
            <textarea id="description" placeholder="add description"></textarea>
            <button id="upload">upload</button>
            <button id="remove">remove</button>
        </div>
        <div class="gallery" id="gallery">
            <p>your gallery</p>
        </div>
    </div>
    <script src="../assets/js/profile.js"></script>
</body>
</html>
