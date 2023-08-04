<?php
$servername = "localhost";
$username = "root";
$password = "";

// Create connection
$conn = new mysqli($servername, $username, $password);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create database if it doesn't exist
$dbName = "JinshanLottery";
$sql = "CREATE DATABASE IF NOT EXISTS $dbName";
if ($conn->query($sql) === TRUE) {
    echo "Database $dbName created successfully<br>";
} else {
    echo "Error creating database: " . $conn->error . "<br>";
    $conn->close();
    exit;
}

// Select the newly created database
$conn->select_db($dbName);


// Create User table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS User (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    ID_number VARCHAR(20) NOT NULL,
    phone_number VARCHAR(50) NOT NULL,
    email VARCHAR(100),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if ($conn->query($sql) === TRUE) {
    echo "Table User created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Create Store table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS Store (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    store_id VARCHAR(100) NOT NULL,
    store_name VARCHAR(100) NOT NULL,
    pin VARCHAR(6) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    INDEX (store_id)
)";
if ($conn->query($sql) === TRUE) {
    echo "Table Store created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}



// Create Consumption table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS Consumption (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) UNSIGNED NOT NULL,
    amount INT(11) NOT NULL,
    store_id VARCHAR(100) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES User(id) ON DELETE CASCADE,
    FOREIGN KEY (store_id) REFERENCES Store(store_id) ON DELETE CASCADE
)";
if ($conn->query($sql) === TRUE) {
    echo "Table Consumption created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}



// Create Prizes table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS Prizes (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    remaining_quantity INT(11) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if ($conn->query($sql) === TRUE) {
    echo "Table Prizes created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

// Create User_Prizes join table if it doesn't exist
$sql = "CREATE TABLE IF NOT EXISTS User_Prizes (
    id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    user_id INT(11) UNSIGNED NOT NULL,
    prize_id INT(11) UNSIGNED NOT NULL,
    redeem BOOLEAN DEFAULT FALSE,
    won_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (user_id) REFERENCES User(id) ON DELETE CASCADE,
    FOREIGN KEY (prize_id) REFERENCES Prizes(id) ON DELETE CASCADE
)";
if ($conn->query($sql) === TRUE) {
    echo "Table User_Prizes created successfully<br>";
} else {
    echo "Error creating table: " . $conn->error . "<br>";
}

$conn->close();
?>
