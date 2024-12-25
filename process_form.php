<?php

error_reporting(E_ALL);
ini_set('display_errors', 1);

// Database connection settings
$host = 'localhost'; // Your MySQL host
$dbname = 'team_applications'; // Your database name
$username = 'your_username'; // Your MySQL username
$password = 'your_password'; // Your MySQL password

// Connect to the database
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $position = $_POST['position'];
    $termsAccepted = isset($_POST['agree']) ? 1 : 0;

    // Handle file upload
    $resumeDir = "uploads/";
    $resumePath = $resumeDir . basename($_FILES['resume']['name']);

    if (move_uploaded_file($_FILES['resume']['tmp_name'], $resumePath)) {
        try {
            // Insert form data into the database
            $sql = "INSERT INTO applications (name, email, phone, position, resume_path, terms_accepted)
                    VALUES (:name, :email, :phone, :position, :resume_path, :terms_accepted)";
            $stmt = $pdo->prepare($sql);
            $stmt->execute([
                ':name' => $name,
                ':email' => $email,
                ':phone' => $phone,
                ':position' => $position,
                ':resume_path' => $resumePath,
                ':terms_accepted' => $termsAccepted,
            ]);

            // Redirect to the success modal
            echo "<script>
                    alert('Your application has been submitted successfully!');
                    window.location.href = '/'; // Replace with your homepage URL
                  </script>";
        } catch (PDOException $e) {
            die("Error saving data: " . $e->getMessage());
        }
    } else {
        echo "Error uploading the resume.";
    }
}
?>
