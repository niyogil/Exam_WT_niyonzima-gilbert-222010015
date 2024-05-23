<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Certificate Form</title>
    <style>
        /* Your CSS styles */
        body {
            font-family: Arial, sans-serif;
            background-color: skyblue;
        }

        .form-container {
            background: grey;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            width: 300px;
            margin: 0 auto;
            margin-top: 50px;
        }

        h1 {
            margin-bottom: 20px;
            font-size: 24px;
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #333;
        }

        input[type="text"],
        input[type="date"] {
            width: calc(100% - 16px);
            padding: 8px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            margin-right: 16px;
            box-sizing: border-box;
        }

        button {
            width: 100%;
            padding: 10px;
            background: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }

        button:hover {
            background: #218838;
        }

        /* Certificate Styles */
        .certificate {
            background-color: #fff;
            border: 2px solid #007bff;
            border-radius: 8px;
            padding: 20px;
            width: 400px;
            margin: 20px auto;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .certificate h2 {
            font-size: 28px;
            margin-bottom: 20px;
            color: #007bff;
        }

        .certificate p {
            font-size: 18px;
            margin: 10px 0;
            color: #333;
        }

        .name {
            font-weight: bold;
            color: #007bff;
        }

        .course {
            font-style: italic;
            color: #28a745;
        }

        .date {
            color: #dc3545;
        }

        /* Certificate Results Colors */
        .certificate.success {
            border-color: #28a745;
        }

        .certificate.warning {
            border-color: #ffc107;
        }

        .certificate.error {
            border-color: #dc3545;
        }

        .certificate.info {
            border-color: #17a2b8;
        }

        .certificate.pink {
            background-color: #ff69b4; /* Pink background color */
            border-color: #ff69b4; /* Pink border color */
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
                <li class="nav-item"><a class="nav-link" href="resources.php">Resources</a></li>
                <li class="nav-item"><a class="nav-link" href="feedback.php">Rate Us</a></li>
                <li class="nav-item"><a class="nav-link" href="logout.php">Logout</a></li>
            </ul>
        </div>
    </nav>

    <div class="form-container">
        <h1>Certificate Form</h1>
        <form id="certificateForm" action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="course">Course:</label>
            <input type="text" id="course" name="course" required>

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" required>

            <button type="submit">Generate Certificate</button>
        </form>
    </div>

    <?php
    // Database configuration
    $servername = "localhost";
    $username = "root";
    $password = ""; // Add your database password here
    $dbname = "tutu";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $name = $_POST['name'];
        $course = $_POST['course'];
        $date = $_POST['date'];

        // Prepare SQL statement
        $sql = "INSERT INTO certificates (name, course, date) VALUES ('$name', '$course', '$date')";

        // Execute SQL statement
        if ($conn->query($sql) === TRUE) {
            echo '<div class="certificate pink">
                    <h2>Certificate of Completion</h2>
                    <p>This is to certify that</p>
                    <p><span class="name">' . $name . '</span></p>
                    <p>has successfully completed the course</p>
                    <p><span class="course">' . $course . '</span></p>
                    <p>on <span class="date">' . $date . '</span></p>
                </div>';
        } else {
            echo '<div class="certificate error">
                    <h2>Error</h2>
                    <p>Sorry, there was an error generating the certificate.</p>
                </div>';
        }
    }

    // Close connection
    $conn->close();
    ?>
</body>
</html>
