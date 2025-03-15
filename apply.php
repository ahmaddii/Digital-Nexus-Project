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

// ✅ Ensure job_id is retrieved correctly
$job_id = isset($_GET['job_id']) && is_numeric($_GET['job_id']) ? intval($_GET['job_id']) : 0;

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Apply for Job</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Apply for Job</h2>
        
        <?php if ($job_id === 0): ?>
            <!-- 🔴 Show error if job_id is missing -->
            <div class="alert alert-danger">Error: Job ID is missing. Please apply through a valid job listing.</div>
        <?php else: ?>

        <form action="process_application.php" method="POST" enctype="multipart/form-data">
            <!-- ✅ Ensure job_id is correctly passed -->
            <input type="hidden" name="job_id" value="<?php echo $job_id; ?>">

            <div class="mb-3">
                <label class="form-label">Full Name</label>
                <input type="text" class="form-control" name="name" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Phone</label>
                <input type="tel" class="form-control" name="phone" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Resume (PDF, DOCX)</label>
                <input type="file" class="form-control" name="resume" accept=".pdf,.docx" required>
            </div>

            <button type="submit" class="btn btn-primary">Submit Application</button>
        </form>

        <?php endif; ?>
    </div>
</body>
</html>
