<?php
define('DB_HOST', 'localhost');
define('DB_NAME', 'DocWeboxDB');
define('DB_USERNAME', 'root');
define('DB_PASSWORD', '');
 
/* Attempt to connect to MySQL database */
try{
    $pdo = new PDO("mysql:host=".DB_HOST, DB_USERNAME, DB_PASSWORD);
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    // Create Database
    $sql = "CREATE DATABASE IF NOT EXISTS ".DB_NAME;
    $pdo->query($sql);

    // Use Database
    $pdo->query("use ".DB_NAME);

    createSchema($pdo);

} catch(PDOException $e){
    die("ERROR: " . $e->getMessage());
}

function createSchema($pdo) {

    $sql = "
      CREATE TABLE IF NOT EXISTS patients (
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        name VARCHAR(255),
        email VARCHAR(255),
        phone VARCHAR(50)
      );

      CREATE TABLE IF NOT EXISTS doctors (
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL,
        name VARCHAR(255),
        email VARCHAR(255),
        avatarUrl VARCHAR(255),
        phone VARCHAR(50),
        location VARCHAR(255),
        insurance VARCHAR(255),
        specialisation VARCHAR(255),
        price DOUBLE,
        description TEXT
      );

      CREATE TABLE IF NOT EXISTS admins (
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        username VARCHAR(50) NOT NULL UNIQUE,
        password VARCHAR(255) NOT NULL
      );

      CREATE TABLE IF NOT EXISTS appointments (
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        date DATETIME NOT NULL,
        confirmed BOOLEAN DEFAULT FALSE,
        patientID INT NOT NULL,
        doctorID INT NOT NULL,
        FOREIGN KEY (patientID) REFERENCES patients(id),
        FOREIGN KEY (doctorID) REFERENCES doctors(id)
      );

      CREATE TABLE IF NOT EXISTS reviews (
        id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
        date DATETIME NOT NULL,
        content TEXT,
        rating INT,
        patientID INT NOT NULL,
        doctorID INT NOT NULL,
        FOREIGN KEY (patientID) REFERENCES patients(id),
        FOREIGN KEY (doctorID) REFERENCES doctors(id)
      );
      ";
    $pdo->query($sql);
}

?>