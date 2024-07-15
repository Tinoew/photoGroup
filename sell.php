<?php
include_once 'includes/head.php';
include_once 'includes/footer.php';
include_once 'includes/navbar.php';
include_once 'functions/functions.php';

$conn = dbConnect();

if ($conn) {
    $userId = $_SESSION['id'];
    $sql = "SELECT * FROM images WHERE user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $userId, PDO::PARAM_INT);
    $stmt->execute();
    $images = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    $images = [];
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile</title>
    <link rel="stylesheet" href="./assets/css/buy.css">
</head>

<body>
    <h1>My Uploaded Photos</h1>
    <div class="gallery">
        <?php if (!empty($images)) : ?>
            <?php foreach ($images as $image) : ?>
                <div class="photo">
                    <img src="<?php echo htmlspecialchars($image['img_path']); ?>" alt="<?php echo htmlspecialchars($image['title']); ?>" width="200">
                    <p>Title: <?php echo htmlspecialchars($image['title']); ?></p>
                    <p>Category: <?php echo htmlspecialchars($image['category']); ?></p>
                    <p>Price: $<?php echo htmlspecialchars($image['price']); ?></p>
                    <form method="post" action="edit.php">
                        <input type="hidden" name="image_id" value="<?php echo $image['id']; ?>">
                        <button type="submit">Edit</button>
                    </form>
                </div>
            <?php endforeach; ?>
        <?php else : ?>
            <p>No images found.</p>
        <?php endif; ?>
    </div>
</body>

</html>
