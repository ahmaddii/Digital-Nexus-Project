<?php
$servername = "localhost";
$username = "root";
$password = "";
$database = "digitalnexus";

$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


$job_id = isset($_GET["job_id"]) ? intval($_GET["job_id"]) : 0;
if ($job_id == 0) {
    die("Invalid job ID.");
}

$sql = "SELECT * FROM jobs WHERE id = $job_id";
$result = $conn->query($sql);
$job = $result->fetch_assoc();
?>

<h2>Apply for: <?php echo $job['title']; ?></h2>

<form action="submit_application.php" method="POST">
    <input type="hidden" name="job_id" value="<?php echo $job_id; ?>">
    <label for="name">Full Name:</label>
    <input type="text" name="name" required>
    
    <label for="email">Email:</label>
    <input type="email" name="email" required>

    <label for="resume">Resume (Paste here):</label>
    <textarea name="resume" required></textarea>

    <button type="submit">Submit Application</button>
</form>

<?php $conn->close(); ?>
