<?php

include_once 'functions/functions.php';
$conn = dbConnect();

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

if (!isset($_SESSION['id'])) {
    header("Location: login.php"); // Redirect to login page if not logged in
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    upload($conn);
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style/style.css">
    <title>Upload Photo</title>
</head>

<body>
    <?php include_once 'includes/navbar.php'; ?>

    <div class="message">
        <p>Here you can upload a photo for your photobook.</p>
    </div>
    <div class="form-container">
        <form method="post" action="" enctype="multipart/form-data">
            <label for="title">Title:</label>
            <input type="text" id="title" name="title" required>

            <label for="category">Category:</label>
            <select id="category" name="category" required>
                <option value="nature">Nature</option>
                <option value="city">City</option>
                <option value="animals">Animals</option>
                <option value="people">People</option>
                <option value="landscapes">Landscapes</option>
                <option value="portraits">Portraits</option>
                <option value="architecture">Architecture</option>
                <option value="travel">Travel</option>
                <option value="events">Events</option>
                <option value="food">Food</option>
                <option value="sports">Sports</option>
                <option value="black_and_white">Black and White</option>
                <option value="abstract">Abstract</option>
                <option value="street_photography">Street Photography</option>
                <option value="night_photography">Night Photography</option>
                <option value="cars">Cars</option>
            </select>

            <label for="price">Price:</label>
            <input type="number" id="price" name="price" step="0.01" required>

            <label for="author">Author:</label>
            <input type="text" id="author" name="author" required>

            <label for="image">Choose an image:</label>
            <input type="file" id="image" name="image" accept="image/*" required>

            <input type="submit" value="Upload">
        </form>
    </div>
    <?php include_once 'includes/footer.php'; ?>
</body>

</html>