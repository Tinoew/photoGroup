

document.getElementById('upload').addEventListener('click', function() {
    const title = document.getElementById('title').value;
    const description = document.getElementById('description').value;

    if (title && description) {
        const gallery = document.getElementById('gallery');
        const newItem = document.createElement('div');
        newItem.classList.add('gallery-item');

        const itemTitle = document.createElement('h3');
        itemTitle.textContent = title;

        const itemDescription = document.createElement('p');
        itemDescription.textContent = description;

        newItem.appendChild(itemTitle);
        newItem.appendChild(itemDescription);
        gallery.appendChild(newItem);

        // Clear input fields
        document.getElementById('title').value = '';
        document.getElementById('description').value = '';
    } else {
        alert('Please fill in both fields.');
    }
});

document.getElementById('remove').addEventListener('click', function() {
    const gallery = document.getElementById('gallery');
    if (gallery.lastChild.classList.contains('gallery-item')) {
        gallery.removeChild(gallery.lastChild);
    } else {
        alert('No items to remove.');
    }
});

document.getElementById('remove').addEventListener('click', function() {
    const gallery = document.getElementById('gallery');
    if (gallery.lastChild.classList.contains('gallery-item')) {
        gallery.removeChild(gallery.lastChild);
        // Optionally, add code here to remove the item from the database
    } else {
        alert('No items to remove.');
    }
});
