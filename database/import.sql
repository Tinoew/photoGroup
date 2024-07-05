CREATE DATABASE photogroup

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);


-- admin account

insert INTO users (name, password)
VALUES ('admin', '$2y$10$qonovuxVdgXBVnjnqXV7j.WeN1g9iEJs8wOoxPh7AOkdkE4WnO5fW');

CREATE TABLE uploads (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    description TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE images (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    category VARCHAR(255) NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    img_path VARCHAR(255) NOT NULL,
    author VARCHAR(255) NOT NULL
);

-- Sample data
INSERT INTO images (title, category, price, img_path, author)
VALUES 
    ('Nature Picture 1', 'city', 10.00, '/img/almere_campus.jpg', 'dominique'),
    ('City Picture 1', 'city', 20.00, '/img/city.jpg', 'anonomous'),
    ('Animals Picture 1', 'animals', 15.00, '/img/hond_sneeuw.jpg', 'mark'),
    ('Nature Picture 2', 'nature', 45.00, '/img/nature2.jpg', 'user292');