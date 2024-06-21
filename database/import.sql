CREATE DATABASE photogroup

CREATE TABLE IF NOT EXISTS users (
    uid INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    admin BOOLEAN NOT NULL,
    PRIMARY KEY (uid)
);

-- admin account

REPLACE INTO users (uid, username, password, admin)
VALUES (1, 'admin', '$2y$10$qonovuxVdgXBVnjnqXV7j.WeN1g9iEJs8wOoxPh7AOkdkE4WnO5fW', true);