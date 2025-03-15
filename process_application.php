<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "digitalnexus";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $job_id = isset($_POST['job_id']) ? intval($_POST['job_id']) : 0;
    $name = $conn->real_escape_string($_POST['name']);
    $email = $conn->real_escape_string($_POST['email']);
    $phone = $conn->real_escape_string($_POST['phone']);

    // ✅ Handle File Upload
    $resume = "";
    if (isset($_FILES["resume"]) && $_FILES["resume"]["error"] == 0) {
        $target_dir = "uploads/";
        $resume = basename($_FILES["resume"]["name"]);
        $target_file = $target_dir . $resume;
        move_uploaded_file($_FILES["resume"]["tmp_name"], $target_file);
    }

    // ✅ Insert into database
    $sql = "INSERT INTO job_applications (job_id, name, email, phone, resume) 
            VALUES ('$job_id', '$name', '$email', '$phone', '$resume')";

    if ($conn->query($sql) === TRUE) {
        echo "<script>alert('Application submitted successfully!'); window.location.href='job_listings.php';</script>";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
