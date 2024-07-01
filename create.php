<?php

include_once 'functions/functions.php';
$conn = dbConnect();

?>

<!DOCTYPE html>
<html lang="en">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<link rel="stylesheet" href="./style/style.css">
<?php include_once 'includes/head.php'; ?>

<body>
    <?php include_once 'includes/navbar.php'; ?>

    <div class="message">
        <p>Here you can upload a photo for your photobook.</p>
    </div>

    <form action="" method="POST" enctype="multipart/form-data">
        <label for="name">Name:</label>
        <input type="text" name="naam" id="naam" required>
        <label for="nameRestaurant">Name Photo:</label>
        <input type="text" name="nameRestaurant" id="nameRestaurant" required>
        <label for="place">Place:</label>
        <input type="text" name="place" id="place" required>
        <label class="reviewLabel" for="rating">Score 1 to 5:</label>
        <select class="reviewClass" id="rating" name="rating">
            <option value="1" id="1">1</option>
            <option value="2" id="2">2</option>
            <option value="3" id="3">3</option>
            <option value="4" id="4">4</option>
            <option value="5" id="5" selected>5</option>
        </select>
        <label for="image">upload youre picture here:</label>
        <input type="file" name="image" id="image" class="afbeeldingUpload">
        <label for="review"class="reviewLabel">Leave a description here of the photo:</label>
        <textarea rows="8" cols="35" id="review" class="reviewClass" name="review"></textarea>
        <input type="submit" name="submit" value="Opslaan">
    </form>
    <?php include_once 'includes/footer.php'; ?>

    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        upload($conn);
    }
    ?>
</body>

</html>