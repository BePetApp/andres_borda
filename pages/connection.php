<?php 
    $conn = new mysqli("127.0.0.1", "root", null, "blog", 3308, "127.0.0.1:3308");

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>