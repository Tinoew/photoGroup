<?php
include_once 'includes/head.php';
include_once 'includes/footer.php';
include_once 'functions/functions.php';

$conn = dbConnect();
?>

<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>

<nav class="nav">
    <div class="logo">
        <img src="./assets/images/logods.gif" alt="Logo">
    </div>

    <a href="index.php">back</a>
</nav>

<?php

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    echo "You need to be logged in to buy products.";
    exit();
}

// Check if form data is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_SESSION['id'];
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $address = htmlspecialchars($_POST['address']);
    $quantity = intval($_POST['quantity']);
    $paymentMethod = htmlspecialchars($_POST['payment_method']);

    // Validate the form data
    if (empty($name) || empty($email) || empty($address) || $quantity <= 0) {
        echo "All fields are required and quantity must be at least 1.";
        exit();
    }

    // Insert the order into the database
    try {
        $sql = "INSERT INTO orders (user_id, quantity, payment_method, name, email, address) 
                VALUES (:user_id, :quantity, :payment_method, :name, :email, :address)";
        $stmt = $conn->prepare($sql);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':payment_method', $paymentMethod);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':address', $address);

        if ($stmt->execute()) {
            echo "Order placed successfully, a email will be send with the payment details, thanks for your purchase!";
        } else {
            echo "Error placing order.";
        }
    } catch (PDOException $e) {
        echo "Database error: " . $e->getMessage();
    }
} else {
    echo "Invalid request.";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="./style/style.css">
</head>
<body>
    
</body>
</html>
