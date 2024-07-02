<?php
include_once 'includes/navbar.php';
include_once 'includes/head.php';
include_once 'functions/functions.php';

$conn = dbConnect();

$query = "SELECT title, category, price, img_path FROM images";
$stmt = $conn->query($query);

$images = $stmt->fetchAll();

$conn = null;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Webshop</title>
    <link rel="stylesheet" href="assets/css/webshop.css">
</head>
<body>

<div class="container">
    <button id="filter-toggle">Show Filters</button>

    <div class="filter">
        <div class="filter-section" id="filter-section" style="display:none;">
            <h1>Filter Options</h1>
            
            <!-- Category Filter -->
            <div class="main">
                <div class="filters">
                    <input type="text" id="search" placeholder="Search pictures...">
                    <select id="category">
                        <option value="all">All Categories</option>
                        <option value="nature">Nature</option>
                        <option value="city">City</option>
                        <option value="animals">Animals</option>
                    </select>
                </div>
                <!-- Price Filter -->
                <div>
                    <label class="filter-title">Price Range:</label>
                    <input type="number" id="min-price" name="min-price" placeholder="Min Price">
                    <input type="number" id="max-price" name="max-price" placeholder="Max Price">
                </div>

                <!-- Submit Button -->
                <div>
                    <button type="button" id="apply-filters">Apply Filters</button>
                </div>
            </div>
        </div>
    </div>

    <div class="grid" id="picture-grid">
        <?php if ($images): ?>
            <?php foreach ($images as $image): ?>
                <div class="grid-item" data-category="<?php echo htmlspecialchars($image['category']); ?>" data-price="<?php echo htmlspecialchars($image['price']); ?>">
                    <img src="<?php echo htmlspecialchars($image['img_path']); ?>" alt="<?php echo htmlspecialchars($image['title']); ?>">
                    <h3><?php echo htmlspecialchars($image['title']); ?></h3>
                    <p>$<?php echo htmlspecialchars($image['price']); ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No images found.</p>
        <?php endif; ?>
    </div>
</div>

<script src="./assets/js/webshop.js"></script>
</body>
</html>

<?php
include_once 'includes/footer.php';
?>
