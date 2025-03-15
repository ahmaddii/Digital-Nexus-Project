<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Job Postings | Digital Nexus</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .job-listing {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
        }
        .job-listing:hover {
            transform: scale(1.02);
        }
        .apply-btn {
            background-color: #007BFF;
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 5px;
            transition: background 0.3s;
        }
        .apply-btn:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center mb-4">Latest Job Postings</h2>
        
        <div class="row">
            <?php
            $servername = "localhost";
            $username = "root";
            $password = "";
            $database = "digitalnexus";
            
            $conn = new mysqli($servername, $username, $password, $database);
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }
            
            $sql = "SELECT * FROM jobs ORDER BY posted_date DESC";
            $result = $conn->query($sql);
            
            while ($row = $result->fetch_assoc()) {
                echo "<div class='col-md-6 mb-4'>";
                echo "<div class='job-listing p-3'>";
                echo "<h4 class='text-primary'>" . $row["title"] . "</h4>";
                echo "<p><strong>Company:</strong> " . $row["company"] . "</p>";
                echo "<p><strong>Location:</strong> " . $row["location"] . "</p>";
                echo "<p><strong>Salary:</strong> " . $row["salary"] . "</p>";
                echo "<p>" . substr($row["description"], 0, 100) . "...</p>";
                echo "<a href='apply.php?job_id=" . $row["id"] . "' class='apply-btn btn btn-primary'>Apply Now</a>";
                echo "</div></div>";
            }
            $conn->close();
            ?>
        </div>
        <div class="text-center mt-4">
            <a href="index.php" class="btn btn-outline-primary">Go Back</a>
        </div>
    </div>
</body>
</html>