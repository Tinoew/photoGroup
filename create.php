<?php

include_once 'functions/functions.php';
$conn = dbConnect();

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
    <form method="post" action="" enctype="multipart/form-data">
        <label for="title">Title:</label>
        <input type="text" id="title" name="title" required>

        <label for="category">Category:</label>
        <select id="category" name="category" required>
            <option value="nature">Nature</option>
            <option value="city">City</option>
            <option value="animals">Animals</option>
            <option value="people">People</option>
        </select>

        <label for="price">Price:</label>
        <input type="number" id="price" name="price" step="0.01" required>

        <label for="author">author:</label>
        <input type="text" id="author" name="author" required>


        <label for="image">Choose an image:</label>
        <input type="file" id="image" name="image" accept="image/*" required>

        <input type="submit" value="Upload">
    </form>
    <?php include_once 'includes/footer.php'; ?>
</body>
</html>
