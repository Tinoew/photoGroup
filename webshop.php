<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>webshop</title>
    <link rel="stylesheet" href="../assets/css/webshop.css">
</head>
<body>

    <div class="container">
        <div class="filter">
            <input type="text" id="filter-input" placeholder="test">
        </div>
        <div class="filter-section" id="filter-section">
            <h1>Filter Options</h1>
            
            <!-- Category Filter -->
            <div>
                <label class="filter-title" for="category">Category:</label>
                <select id="category" name="category">
                    <option value="">Select Category</option>
                    <option value="electronics">Electronics</option>
                    <option value="clothing">Clothing</option>
                    <option value="home_appliances">Home Appliances</option>
                    <option value="books">Books</option>
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
                <button type="submit">Apply Filters</button>
            </div>
        </div>

        
        <div class="grid">
            <div class="grid-item"></div>
            <div class="grid-item"></div>
            <div class="grid-item"></div>
            <div class="grid-item"></div>
            <div class="grid-item"></div>
            <div class="grid-item"></div>
        </div>
    </div>

</body>
</html>
