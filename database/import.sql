<<<<<<< Updated upstream
CREATE DATABASE photogroup
=======
CREATE DATABASE 
>>>>>>> Stashed changes

CREATE TABLE IF NOT EXISTS users (
    id INT NOT NULL AUTO_INCREMENT,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
);

-- admin account

insert INTO users (username, password,)
VALUES ('admin', '$2y$10$qonovuxVdgXBVnjnqXV7j.WeN1g9iEJs8wOoxPh7AOkdkE4WnO5fW');