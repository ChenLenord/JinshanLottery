<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbName = "JinshanLottery";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbName);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Function to generate a random string with specified length and characters
function generateRandomString($length, $characters) {
    $charLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charLength - 1)];
    }
    return $randomString;
}

// Generate 100 users
for ($i = 0; $i < 100; $i++) {
    $id_number = generateRandomString(1, 'ABCDEFGHIJKLMNOPQRSTUVWXYZ') . generateRandomString(9, '0123456789'); // One capital letter plus 9 digits
    $phone_number = generateRandomString(10, '0123456789'); // 10 digits
    $email = "user" . $i . "@example.com"; // Replace with your own logic for email addresses
    $sql = "INSERT INTO User (ID_number, phone_number, email) VALUES ('$id_number', '$phone_number', '$email')";
    $conn->query($sql);
}

// Generate 10 stores and assign 50 consumption records and store records
for ($i = 0; $i < 10; $i++) {
    $store_id = generateRandomString(8, '0123456789abcdef') . '-' . generateRandomString(4, '0123456789abcdef') . '-' . generateRandomString(4, '0123456789abcdef') . '-' . generateRandomString(4, '0123456789abcdef') . '-' . generateRandomString(8, '0123456789abcdef'); // UUID format
    $store_name = "Store " . ($i + 1);
    $pin = generateRandomString(6, '0123456789'); // 6 digit pin
    $sql = "INSERT INTO Store (store_id, store_name, pin) VALUES ('$store_id', '$store_name', '$pin')";
    $conn->query($sql);

    // Generate 5 consumption records for this store
    for ($j = 0; $j < 5; $j++) {
        $user_id = rand(1, 100);
        $amount = rand(10, 1000);
        $sql = "INSERT INTO Consumption (user_id, amount, store_id) VALUES ($user_id, $amount, '$store_id')";
        $conn->query($sql);
    }
}

// Generate 10 prize records
for ($i = 0; $i < 10; $i++) {
    $name = "Prize " . ($i + 1);
    $remaining_quantity = rand(1, 10);
    $sql = "INSERT INTO Prizes (name, remaining_quantity) VALUES ('$name', $remaining_quantity)";
    $conn->query($sql);
}

// Generate 7 User_Prizes data
for ($i = 0; $i < 7; $i++) {
    $user_id = rand(1, 100);
    $prize_id = rand(1, 10);
    $sql = "INSERT INTO User_Prizes (user_id, prize_id) VALUES ($user_id, $prize_id)";
    $conn->query($sql);
}

$conn->close();
?>
