<?php
//DOCKER OR XAMPP
define('DB_HOST', isset($_ENV["DB_HOST"]) ? $_ENV["DB_HOST"] : 'localhost');
define('DB_NAME', isset($_ENV["DB_NAME"]) ? $_ENV["DB_NAME"] : 'DocWeboxDB');
define('DB_USERNAME', isset($_ENV["DB_USERNAME"]) ? $_ENV["DB_USERNAME"] : 'root');
define('DB_PASSWORD', isset($_ENV["DB_PASSWORD"]) ? $_ENV["DB_PASSWORD"] : '');
 
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
        password VARCHAR(255) NOT NULL,
        email VARCHAR(255)
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

      CREATE VIEW IF NOT EXISTS users AS
        SELECT id, username, email, password, 'patient' AS type FROM patients
        UNION ALL
        SELECT id, username, email, password, 'doctor' AS type FROM doctors
        UNION ALL
        SELECT id, username, email, password, 'admin' AS type FROM admins;

      CREATE VIEW IF NOT EXISTS rankedDoctors AS
        SELECT d.*, AVG(r.rating) as rating FROM reviews as r RIGHT JOIN doctors as d ON r.doctorID=d.id GROUP BY d.id ORDER BY rating DESC
      ";
    $pdo->query($sql);
}

function hashPasswords($pdo) {
    $sql = "
        select id, password, 'patients' as type from patients
        UNION ALL
        select id, password, 'doctors' as type from doctors
        UNION ALL
        select id, password, 'admins' as type from admins;
        ";

    $data = $pdo->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    if ($data) {
        foreach ($data as $entry) {
            $hashedPassword = password_hash($entry['password'], PASSWORD_DEFAULT);
            $pdo->query("UPDATE {$entry['type']} SET password = '{$hashedPassword}' WHERE id = {$entry['id']}");
        }
    }

}

?>