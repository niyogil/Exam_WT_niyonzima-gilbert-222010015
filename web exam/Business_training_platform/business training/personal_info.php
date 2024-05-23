<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION["email"])) {
    // Redirect to login page
    header("location: login.html");
    exit;
}

// Include database connection file
require_once "config.php";

// Retrieve user details from the database
$email = $_SESSION["email"];
$sql = "SELECT Username, Email, Password, UserID FROM users WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();

// Check if user data is found
if ($result->num_rows > 0) {
    $userData = $result->fetch_assoc();
} else {
    // Handle case where user data is not found
    echo "User data not found.";
    exit;
}

// Close prepared statement
$stmt->close();

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>USER DETAILS</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Red+Rose:wght@600;700&display=swap"
        rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>body {
    font-family: 'Roboto', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    min-height: 100vh; /* Ensure the body takes up at least the height of the viewport */
}

.container {
    max-width: 600px;
    margin: 30px auto;
    background-color: #c6d1f0;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    flex-grow: 1; /* Allow the container to grow to fill remaining space */
}

.container h1 {
    font-size: 28px;
    color: #333;
    text-align: center;
    margin-bottom: 20px;
}

.container p {
    font-size: 16px;
    color: #555;
    margin-bottom: 10px;
}

.container p strong {
    color: #007bff;
}

.footer {
    background-color: #5cc4cd;
    padding: 20px;
    margin-top: auto;
}

.footer .container2 {
    display: flex;
    justify-content: space-between;
}

.footer .container2 .left-part p,
.footer .container2 .right-part p {
    font-size: 14px;
    color: #170101;
    margin-bottom: 5px;
}

.footer .container2 .right-part p a {
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
}

.navbar {
    background-color: #007bff;
    padding: 10px 0;
}

.navbar-brand {
    color: #fff;
    font-size: 24px;
    text-decoration: none;
    margin-left: 20px;
}

.nav-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.nav-links li {
    display: inline;
    margin-left: 20px;
}

.nav-links li a {
    color: black;
    text-decoration: none;
    font-size: 16px;
    margin-right: 5px;
}


.nav-links li a:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>
<header>
      <nav class="navbar">
        <a href="index.html" class="navbar-brand">VBSTP</a>
        <ul class="nav-links">
          <li><a href="personal_info.php">Plofile</a></li>
          <li><a href="enrollments.php">Courses</a></li>
          <li><a href="transaction_history.php">Transactions</a></li>
          <li><a href="settings.php">Update</a></li>
          <li><a href="assessment.php">Assessments</a></li>
          <li><a href="payment.html">Pay</a></li>
          <li><a href="certificate.php">Certificate</a></li>
          <li><a href="resources.php">resources</a></li>
          <li><a href="course_dashboard.php">Study</a></li>
          <li><a href="goal.php">Goals</a></li>
          <li><a href="feedback.php">Rate Us</a></li>
          <li><a href="logout.php">Logout</a></li>
          
        </ul>
      </nav>
    </header>

<!-- Personal information section -->
<div class="container">
    <h1>Personal Information</h1>
    <p><strong>UserID:</strong> <?php echo isset($userData["UserID"]) ? $userData["UserID"] : "N/A"; ?></p>
    <p><strong>Name:</strong> <?php echo isset($userData["Username"]) ? $userData["Username"] : "N/A"; ?></p>
    <p><strong>Email:</strong> <?php echo isset($userData["Email"]) ? $userData["Email"] : "N/A"; ?></p>
    <p><strong>Password:</strong> <?php echo isset($userData["Password"]) ? $userData["Password"] : "N/A"; ?></p>
</div>
<!-- Footer Section -->
<footer class="footer">
      <div class="container2">
        <div class="left-part">
          <p class="mb-0">Designed by Trained Business Experts</p>
          <p class="mb-0">UR, RN1-HUYE</p>
          <p class="mb-0">contact@businessplatform.com</p>
          <p class="mb-0">+250 787109054</p>
        </div>
        <div class="right-part">
          <p class="mb-0">© 2024 Business Strategy Platform. All rights reserved.</p>
          <p class="mb-0">Designed by: <a href="#" target="_blank" class="fw-bold">Gilbert</a></p>
          <p class="mb-0">Distributed by: <a href="#" target="_blank" class="fw-bold">Gilbert</a></p>
        </div>
      </div>
    </footer>

<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/counterup/counterup.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Javascript -->
<script src="js/main.js"></script>
</body>
</html>
