<?php
include_once 'includes/head.php';
include_once 'includes/footer.php';
include_once 'includes/navbar.php';
include_once 'functions/functions.php';

$conn = dbConnect();

// Check if the user is logged in
if (!isset($_SESSION['id'])) {
    // Redirect to login page
    header("Location: login.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Buy Product</title>
    <link rel="stylesheet" href="./style/style.css">
</head>
<body>

<div class="form-container">
    <h1>Buy Product</h1>
    <form action="process_buy.php" method="post">
        <div class="form-group">
            <label for="name">Your Name:</label>
            <input type="text" id="name" name="name" required>
        </div>
        <div class="form-group">
            <label for="email">Your Email:</label>
            <input type="email" id="email" name="email" required>
        </div>
        <div class="form-group">
            <label for="address">Shipping Address:</label>
            <textarea id="address" name="address" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="quantity">Quantity:</label>
            <input type="number" id="quantity" name="quantity" min="1" required>
        </div>
        <div class="form-group">
            <label for="payment_method">Payment Method:</label>
            <select id="payment_method" name="payment_method" required>
                <option value="credit_card">Credit Card</option>
                <option value="paypal">PayPal</option>
                <option value="bank_transfer">Bank Transfer</option>
            </select>
        </div>
        <div class="form-group">
            <button type="submit">Submit Order</button>
        </div>
    </form>
</div>

</body>
</html>
