<?php
include_once 'includes/navbar.php';
include_once 'includes/head.php';
include_once 'functions/functions.php';

$conn = dbConnect();
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
        <div class="grid-item" data-category="nature" data-price="10">
            <img src="./assets/images/nature.jpg" alt="Nature Picture 1">
            <h3>Nature Picture 1</h3>
            <p>$10</p>
        </div>

        <div class="grid-item" data-category="city" data-price="20">
            <img src="./assets/images/city.jpg" alt="City Picture 1">
            <h3>City Picture 1</h3>
            <p>$20</p>
        </div>

        <div class="grid-item" data-category="animals" data-price="15">
            <img src="./assets/images/animals.jpg" alt="Animals Picture 1">
            <h3>Animals Picture 1</h3>
            <p>$15</p>
        </div>

        <div class="grid-item" data-category="nature" data-price="45">
            <img src="./assets/images/nature2.jpg" alt="Nature Picture 2">
            <h3>Nature Picture 2</h3>
            <p>$45</p>
        </div>

        <div class="grid-item" data-category="nature" data-price="24">
            <img src="./assets/images/nature2.jpg" alt="Nature Picture 2">
            <h3>Nature Picture 3</h3>
            <p>$24</p>
        </div>

        <div class="grid-item" data-category="city" data-price="30">
            <img src="./assets/images/city.jpg" alt="Nature Picture 2">
            <h3>city picture 2</h3>
            <p>$30</p>
        </div>

        
        <div class="grid-item" data-category="nature" data-price="12">
            <img src="./assets/images/animal.jpg" alt="animal Picture 2">
            <h3>animal picture</h3>
            <p>$12</p>
        </div>

        <div class="grid-item" data-category="animal" data-price="5">
            <img src="./assets/images/animal.jpg" alt="animal Picture 2">
            <h3>animalPicture 2</h3>
            <p>$5</p>
        </div>

        <div class="grid-item" data-category="city" data-price="9">
            <img src="./assets/images/city.jpg" alt="city Picture 2">
            <h3>city picture 3</h3>
            <p>$9</p>
        </div>

        
        <div class="grid-item" data-category="animal" data-price="10">
            <img src="./assets/images/animal.jpg" alt="Nature Picture 1">
            <h3>animal Picture 1</h3>
            <p>$10</p>
        </div>

        <div class="grid-item" data-category="city" data-price="20">
            <img src="./assets/images/city.jpg" alt="City Picture 1">
            <h3>City Picture 1</h3>
            <p>$20</p>
        </div>

        <div class="grid-item" data-category="animals" data-price="15">
            <img src="./assets/images/animals.jpg" alt="Animals Picture 1">
            <h3>Animals Picture 1</h3>
            <p>$15</p>
        </div>

        <div class="grid-item" data-category="nature" data-price="3">
            <img src="./assets/images/city.jpg" alt="Nature Picture 2">
            <h3>city picture</h3>
            <p>$3</p>
        </div>

        <div class="grid-item" data-category="nature" data-price="24">
            <img src="./assets/images/nature2.jpg" alt="Nature Picture 2">
            <h3>Nature Picture 3</h3>
            <p>$24</p>
        </div>

        <div class="grid-item" data-category="city" data-price="30">
            <img src="./assets/images/city.jpg" alt="Nature Picture 2">
            <h3>city picture 2</h3>
            <p>$30</p>
        </div>

        
        <div class="grid-item" data-category="nature" data-price="45">
            <img src="./assets/images/nature2.jpg" alt="Nature Picture 2">
            <h3>Nature Picture 4</h3>
            <p>$45</p>
        </div>

        <div class="grid-item" data-category="animal" data-price="35">
            <img src="./assets/images/animal.jpg" alt="animal Picture 2">
            <h3>animalPicture 2</h3>
            <p>$35</p>
        </div>

        <div class="grid-item" data-category="city" data-price="30">
            <img src="./assets/images/city.jpg" alt="city Picture 2">
            <h3>city picture 3</h3>
            <p>$30</p>
        </div>
        <!-- Add more grid items as needed -->
    </div>
</div>

<script src="./assets/js/webshop.js"></script>
</body>
</html>
<?php
include_once 'includes/footer.php';
?>
