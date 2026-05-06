CREATE DATABASE IF NOT EXISTS autorent;
CREATE USER IF NOT EXISTS 'autorent'@'localhost' IDENTIFIED BY 'Parool123!';
GRANT ALL PRIVILEGES ON autorent.* TO 'autorent'@'localhost';
FLUSH PRIVILEGES;
