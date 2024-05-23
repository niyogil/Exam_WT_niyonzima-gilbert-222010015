<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Strategy Resources Form</title>
    <!-- Bootstrap CSS -->
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
            margin: 0;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        .form-container {
            background: #fff;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            margin: auto;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
        }

        .navbar {
            margin-bottom: 20px;
        }

        .footer {
            background-color: #343a40;
            color: #ffffff;
            padding: 10px 0;
            text-align: center;
            margin-top: auto;
        }

        .footer a {
            color: #ffc107;
            text-decoration: none;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark w-100">
        <a class="navbar-brand" href="index.html">VBSTP</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item"><a class="nav-link" href="personal_info.php">Profile</a></li>
                <li class="nav-item"><a class="nav-link" href="enrollments.php">Courses</a></li>
                <li class="nav-item"><a class="nav-link" href="transaction_history.php">Transactions</a></li>
                <li class="nav-item"><a class="nav-link" href="settings.php">Update</a></li>
                <li class="nav-item"><a class="nav-link" href="assessment.php">Assessments</a></li>
                <li class="nav-item"><a class="nav-link" href="payment.html">Study</a></li>
                <li class="nav-item"><a class="nav-link" href="goal.php">Goals</a></li>
                <li class="nav-item"><a class="nav-link" href="certificate.php">Certificate</a></li>
                <li class="nav-item"><a class="nav-link" href="resources.php">Resources</a></li>
                <li class="nav-item"><a class="nav-link" href="feedback.php">Rate Us</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="form-container">
        <h1>Add New Resource</h1>
        <form id="resourceForm" action="" method="POST">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" id="title" name="title" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="url">URL:</label>
                <input type="url" id="url" name="url" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="description">Description:</label>
                <textarea id="description" name="description" class="form-control" rows="3" required></textarea>
            </div>
            <button type="submit" class="btn btn-success btn-block">Submit</button>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $servername = "localhost";  // Change if necessary
            $username = "root";  // Change if necessary
            $password = "";  // Change if necessary
            $dbname = "tutu";

            // Create connection
            $conn = new mysqli($servername, $username, $password, $dbname);

            // Check connection
            if ($conn->connect_error) {
                die("Connection failed: " . $conn->connect_error);
            }

            $title = $conn->real_escape_string($_POST['title']);
            $url = $conn->real_escape_string($_POST['url']);
            $description = $conn->real_escape_string($_POST['description']);

            // Validate URL
            if (!filter_var($url, FILTER_VALIDATE_URL)) {
                echo "<div class='alert alert-danger mt-3'>Invalid URL format</div>";
                exit;
            }

            // Prepare and bind
            $stmt = $conn->prepare("INSERT INTO resources (title, url, description) VALUES (?, ?, ?)");
            $stmt->bind_param("sss", $title, $url, $description);

            // Execute statement
            if ($stmt->execute()) {
                echo "<div class='alert alert-success mt-3'>New resource added successfully</div>";
            } else {
                echo "<div class='alert alert-danger mt-3'>Error: " . $stmt->error . "</div>";
            }

            // Close connection
            $stmt->close();
            $conn->close();
        }
        ?>
    </div>

    <!-- Footer Section -->
    <footer class="footer">
        <div class="container">
            <p class="mb-0">Designed by Trained Business Experts</p>
            <p class="mb-0">UR, RN1-HUYE</p>
            <p class="mb-0">contact@businessplatform.com</p>
            <p class="mb-0">+250 787109054</p>
            <p class="mt-3">© 2024 Business Strategy Platform. All rights reserved.</p>
            <p class="mb-0">Designed by: <a href="#" target="_blank" class="fw-bold">Gilbert</a></p>
            <p class="mb-0">Distributed by: <a href="#" target="_blank" class="fw-bold">Gilbert</a></p>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
        document.getElementById('resourceForm').addEventListener('submit', function(event) {
            const title = document.getElementById('title').value;
            const url = document.getElementById('url').value;
            const description = document.getElementById('description').value;

            if (title === '' || url === '' || description === '') {
                alert('All fields are required!');
                event.preventDefault();
                return;
            }

            if (!isValidURL(url)) {
                alert('Please enter a valid URL');
                event.preventDefault();
                return;
            }
        });

        function isValidURL(string) {
            var res = string.match(/(https?:\/\/)?([-\w]+\.\w+)(\/[-\w]*)*/i);
            return (res !== null);
        }
    </script>
</body>

</html>
