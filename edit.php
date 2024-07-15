<?php
include_once 'includes/head.php';
include_once 'includes/footer.php';
include_once 'includes/navbar.php';
include_once 'functions/functions.php';

$conn = dbConnect();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    echo "You need to be logged in to view this page.";
    exit();
}

$userId = $_SESSION['id'];

// Handle edit form submission
if (isset($_POST['edit'])) {
    $id = $_POST['id'];
    $title = $_POST['title'];
    $category = $_POST['category'];
    $price = $_POST['price'];

    // Check if the current user is the author of the image
    $sql = "SELECT * FROM images WHERE id = :id AND user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $sql = "UPDATE images SET title = :title, category = :category, price = :price WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':category', $category);
        $stmt->bindParam(':price', $price);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            echo "Record updated successfully.";
        } else {
            echo "Error updating record.";
        }
    } else {
        echo "You do not have permission to edit this record.";
    }
}

// Handle delete form submission
if (isset($_POST['delete'])) {
    $id = $_POST['id'];

    // Check if the current user is the author of the image
    $sql = "SELECT * FROM images WHERE id = :id AND user_id = :user_id";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->bindParam(':user_id', $userId);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        $sql = "DELETE FROM images WHERE id = :id";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':id', $id);

        if ($stmt->execute()) {
            echo "Record deleted successfully.";
        } else {
            echo "Error deleting record.";
        }
    } else {
        echo "You do not have permission to delete this record.";
    }
}

// Fetch records uploaded by the logged-in user
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
    <title>Edit/Delete Images</title>
    <link rel="stylesheet" href="./assets/css/buy.css">
</head>
<body>

<h1>Edit/Delete Images</h1>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Title</th>
        <th>Category</th>
        <th>Price</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($images as $image): ?>
    <tr>
        <td><?php echo htmlspecialchars($image['id']); ?></td>
        <td><?php echo htmlspecialchars($image['title']); ?></td>
        <td><?php echo htmlspecialchars($image['category']); ?></td>
        <td><?php echo htmlspecialchars($image['price']); ?></td>
        <td>
            <!-- Edit form -->
            <form method="post" style="display:inline-block;">
                <input type="hidden" name="id" value="<?php echo $image['id']; ?>">
                <input type="text" name="title" value="<?php echo htmlspecialchars($image['title']); ?>">
                <input type="text" name="category" value="<?php echo htmlspecialchars($image['category']); ?>">
                <input type="text" name="price" value="<?php echo htmlspecialchars($image['price']); ?>">
                <button type="submit" name="edit">Edit</button>
            </form>

            <!-- Delete form -->
            <form method="post" style="display:inline-block;">
                <input type="hidden" name="id" value="<?php echo $image['id']; ?>">
                <button type="submit" name="delete">Delete</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>

</body>
</html>
