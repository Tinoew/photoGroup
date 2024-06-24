document.addEventListener("DOMContentLoaded", () => {
    const filterToggle = document.getElementById("filter-toggle");
    const filterSection = document.getElementById("filter-section");
    const searchInput = document.getElementById("search");
    const categorySelect = document.getElementById("category");
    const minPriceInput = document.getElementById("min-price");
    const maxPriceInput = document.getElementById("max-price");
    const applyFiltersButton = document.getElementById("apply-filters");
    const pictures = document.querySelectorAll(".grid-item");

    filterToggle.addEventListener("click", () => {
        filterSection.style.display = filterSection.style.display === "none" ? "block" : "none";
    });

    function filterPictures() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedCategory = categorySelect.value;
        const minPrice = parseFloat(minPriceInput.value) || 0;
        const maxPrice = parseFloat(maxPriceInput.value) || Infinity;

        pictures.forEach(picture => {
            const title = picture.querySelector("h3").textContent.toLowerCase();
            const price = parseFloat(picture.dataset.price);
            const matchesSearch = title.includes(searchTerm);
            const matchesCategory = selectedCategory === "all" || picture.dataset.category === selectedCategory;
            const matchesPrice = price >= minPrice && price <= maxPrice;

            if (matchesSearch && matchesCategory && matchesPrice) {
                picture.style.display = "block";
            } else {
                picture.style.display = "none";
            }
        });
    }

    applyFiltersButton.addEventListener("click", filterPictures);
});