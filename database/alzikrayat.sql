CREATE DATABASE IF NOT EXISTS alzikrayat
CHARACTER SET utf8mb4
COLLATE utf8mb4_unicode_ci;

USE alzikrayat;

-- Users table
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,

    first_name VARCHAR(50) NOT NULL,
    last_name VARCHAR(50) NOT NULL,

    email VARCHAR(100) NOT NULL UNIQUE,

    password VARCHAR(255) NOT NULL,

    location VARCHAR(100) NULL,

    description TEXT NULL,

    occupation VARCHAR(100) NULL
) ENGINE=InnoDB;


-- Photos table
CREATE TABLE IF NOT EXISTS photos (
    id INT AUTO_INCREMENT PRIMARY KEY,

    user_id INT NOT NULL,

    file_name VARCHAR(255) NOT NULL,

    title VARCHAR(200) NOT NULL,

    description TEXT NULL,

    CONSTRAINT fk_photos_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    INDEX idx_photos_user_id (user_id)
) ENGINE=InnoDB;


-- Comments table
CREATE TABLE IF NOT EXISTS comments (
    id INT AUTO_INCREMENT PRIMARY KEY,

    photo_id INT NOT NULL,

    user_id INT NOT NULL,

    comment TEXT NOT NULL,

    date_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,

    CONSTRAINT fk_comments_photo
        FOREIGN KEY (photo_id)
        REFERENCES photos(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    CONSTRAINT fk_comments_user
        FOREIGN KEY (user_id)
        REFERENCES users(id)
        ON DELETE CASCADE
        ON UPDATE CASCADE,

    INDEX idx_comments_photo_id (photo_id),
    INDEX idx_comments_user_id (user_id)
) ENGINE=InnoDB;
