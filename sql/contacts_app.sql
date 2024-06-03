DROP DATABASE IF EXISTS contacts_app;

CREATE DATABASE contacts_app;
USE contacts_app;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE countries (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL
);
CREATE TABLE contacts (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    user_id INT NOT NULL,
    phone_number VARCHAR(255) NOT NULL,
    country_id INT,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (country_id) REFERENCES countries(id)
);





/* DESCRIBE contacts;

SELECT * FROM addresses;



--Select the addressesid for a user's contacts
SELECT addresses.id
FROM addresses
JOIN contacts ON addresses.contact_id = contacts.id
JOIN users ON contacts.user_id = users.id
WHERE users.id = 2 AND addresses.id = 1;

SELECT * FROM contacts ; */


SELECT * FROM contacts WHERE user_id = 1;

