<?php
include_once 'includes/head.php';
include_once 'includes/footer.php';
include_once 'functions/functions.php';

session_start();
if (!isset($_SESSION['id'])) {
    header("Location: login.php");
    exit();
}

$conn = dbConnect();
$userId = $_SESSION['id'];

$sql = "SELECT * FROM images WHERE user_id = :user_id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(':user_id', $userId);
$stmt->execute();
$images = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="./style/style.css">
</head>

<body>
    <nav>
        <a href="index.php">Home</a>
    </nav>
    <h1>My Uploaded Photos</h1>
    <div class="gallery">
        <?php foreach ($images as $image) : ?>
            <div class="photo">
                <img src="<?php echo $image['img_path']; ?>" alt="<?php echo $image['title']; ?>" width="200">
                <p>Title: <?php echo $image['title']; ?></p>
                <p>Category: <?php echo $image['category']; ?></p>
                <p>Price: $<?php echo $image['price']; ?></p>
                <form method="post" action="delete_photo.php">
                    <input type="hidden" name="image_id" value="<?php echo $image['id']; ?>">
                    <button type="submit">Delete</button>
                </form>
                <form method="post" action="edit_photo.php">
                    <input type="hidden" name="image_id" value="<?php echo $image['id']; ?>">
                    <button type="submit">Edit</button>
                </form>
            </div>
        <?php endforeach; ?>
    </div>
</body>

</html>