<?php
    $server = isset($_ENV["DB_HOST"]) ? $_ENV["DB_HOST"] : 'localhost';
    $username = isset($_ENV["DB_USERNAME"]) ? $_ENV["DB_USERNAME"] : 'root';
    $password = isset($_ENV["DB_PASSWORD"]) ? $_ENV["DB_PASSWORD"] : '';
    $db = isset($_ENV["DB_NAME"]) ? $_ENV["DB_NAME"] : 'DocWeboxDB';

    // Create connection
    $conn = mysqli_connect($server, $username, $password, $db);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
    // echo "Connected successfully";
?>