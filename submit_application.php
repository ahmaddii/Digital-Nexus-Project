<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "digitalnexus";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Capture form data
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $job_id = intval($_POST["job_id"]);
    $name = $_POST["name"];
    $email = $_POST["email"];
    $resume = $_POST["resume"];
    $applied_date = date("Y-m-d H:i:s");

    // Insert into posed_job_application table
    $sql = "INSERT INTO posed_job_application (job_id, applicant_name, email, resume, applied_date) 
            VALUES ('$job_id', '$name', '$email', '$resume', '$applied_date')";

    if ($conn->query($sql) === TRUE) {
        echo "Application submitted successfully!";
        header("Location: jobs.php"); // Redirect back
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}

$conn->close();
?>
