<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "digitalnexus";

// Connect to MySQL
$conn = new mysqli($servername, $username, $password, $database);

// Check Connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Save Form Data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $position = $_POST['position'];
    $message = $_POST['message'];

    $sql = "INSERT INTO team_applications (name, email, phone, position, message) 
            VALUES ('$name', '$email', '$phone', '$position', '$message')";

    if ($conn->query($sql) === TRUE) {
        echo "Application submitted!";
    } else {
        echo "Error: " . $conn->error;
    }
}

$conn->close();
?>
