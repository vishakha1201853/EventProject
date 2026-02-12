<?php
// db_connect.php
// Configuration for database access.
$host = 'localhost'; // Replace with your host
$user = 'root';      // Replace with your database username
$pass = '';          // Replace with your database password
$db_name = 'eventhub_db'; // Replace with your actual database name

// Establish the connection
$conn = new mysqli($host, $user, $pass, $db_name);

// Check connection
if ($conn->connect_error) {
    // Stops execution if connection fails
    die("Connection failed: " . $conn->connect_error);
}

// Set character set
$conn->set_charset("utf8");

// Recommended tables for your project:
//
// 1. users (for sign up)
//    CREATE TABLE users (
//        id INT AUTO_INCREMENT PRIMARY KEY,
//        fullname VARCHAR(100) NOT NULL,
//        email VARCHAR(100) UNIQUE NOT NULL,
//        password_hash VARCHAR(255) NOT NULL,
//        reg_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
//    );
//
// 2. bookings (for book event.html)
//    CREATE TABLE bookings (
//        id INT AUTO_INCREMENT PRIMARY KEY,
//        event_type VARCHAR(50),
//        service_choice VARCHAR(50),
//        client_name VARCHAR(100) NOT NULL,
//        client_email VARCHAR(100),
//        client_phone VARCHAR(20),
//        event_date DATE,
//        booking_date TIMESTAMP DEFAULT CURRENT_TIMESTAMP
//    );
//
// 3. feedback (for feedback.html)
//    CREATE TABLE feedback (
//        id INT AUTO_INCREMENT PRIMARY KEY,
//        name VARCHAR(100) NOT NULL,
//        email VARCHAR(100),
//        phone VARCHAR(20),
//        city VARCHAR(50),
//        fb_date DATE,
//        fb_type VARCHAR(20),
//        comments TEXT,
//        submission_time TIMESTAMP DEFAULT CURRENT_TIMESTAMP
//    );
?>