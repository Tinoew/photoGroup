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
    <link rel="stylesheet" href="./assets/css/webshop.css">
</head>
<body>

<div class="container">
    <button id="filter-toggle">Show Filters</button>
    
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

    <div class="grid" id="picture-grid">
        <div class="grid-item" data-category="nature" data-price="10">
            <img src="path/to/nature1.jpg" alt="Nature Picture 1">
            <h3>Nature Picture 1</h3>
            <p>$10</p>
        </div>
        <div class="grid-item" data-category="city" data-price="20">
            <img src="path/to/city1.jpg" alt="City Picture 1">
            <h3>City Picture 1</h3>
            <p>$20</p>
        </div>
        <div class="grid-item" data-category="animals" data-price="15">
            <img src="path/to/animals1.jpg" alt="Animals Picture 1">
            <h3>Animals Picture 1</h3>
            <p>$15</p>
        </div>
        <div class="grid-item" data-category="animals" data-price="45">
            <img src="path/to/animals1.jpg" alt="Animals Picture 1">
            <h3>Animals Picture </h3>
            <p>$45</p>
        </div>
        <!-- Add more grid items as needed -->
    </div>
</div>

<script src="../assets/js/webshop.js"></script>
</body>
</html>
