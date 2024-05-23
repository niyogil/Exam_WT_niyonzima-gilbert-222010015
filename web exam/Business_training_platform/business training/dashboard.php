<?php
session_start();
// Check if user is logged in, if not redirect to login page
if (!isset($_SESSION["email"])) {
    header("location: login.html");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profile Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        .footer {
            background-color: violet; /* Replaced blue with pink */
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
            color: blue; /* Replaced blue with dark pink */
            text-decoration: none;
            font-weight: bold;
        }

        .navbar {
            background-color: #ff1493; /* Replaced blue with dark pink */
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

        .button {
            display: inline-block;
            padding: 10px 20px;
            margin: 10px;
            background-color: #ff1493; /* Replaced blue with dark pink */
            color: white;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        .button:hover {
            background-color: #c71585; /* Replaced blue with medium violet red */
        }

        .container {
            align-items: center;
            display: flex;
            max-width: 1300px;
            align-items: center;
            height: 400px;
            margin: 30px auto;
            background-color: Purple; /* Replaced blue with light pink */
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            flex-grow: 1; /* Allow the container to grow to fill remaining space */
        }
    </style>
</head>
<body>
    <header>
        <nav class="navbar">
            <a href="index.html" class="navbar-brand">VBSTP</a>
            <ul class="nav-links">
                <li><a href="personal_info.php">Profile</a></li>
                <li><a href="enrollments.php">Courses</a></li>
                <li><a href="transaction_history.php">Transactions</a></li>
                <li><a href="settings.php">Update</a></li>
                <li><a href="assessment.php">Assessments</a></li>
                <li><a href="payment.html">Pay</a></li>
                <li><a href="course_dashboard.php">Study</a></li>
                <li><a href="goal.php">Goals</a></li>
                <li><a href="feedback.php">Rate Us</a></li>
                <li><a href="resources.php">Resources</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <!-- Header section -->
    <header>
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION["email"]); ?>!</h1>
    </header>

    <!-- Main content section -->
    <div class="container">
        <!-- Personal information section -->
        <a href="personal_info.php" class="button" target="_blank">Personal Information</a><br><br>

        <!-- Transaction history section -->
        <a href="transaction_history.php" class="button" target="_blank">Transaction History</a><br><br>

        <!-- Settings and preferences section -->
        <a href="settings.php" class="button" target="_blank">Settings and Preferences</a><br><br>

        <!-- Assessment section -->
        <a href="assessment.php" class="button" target="_blank">Assessment</a><br><br>

        <!-- Enrollments section -->
        <a href="enrollments.php" class="button" target="_blank">Enrollments</a><br><br>

        <!-- Goals section -->
        <a href="goal.php" class="button" target="_blank">Goals</a><br><br>

        <!-- Resources section -->
        <a href="resources.php" class="button" target="_blank">Resources</a><br><br>

        <!-- Logout section -->
        <a href="logout.php" class="button" target="_blank">Logout</a><br><br>
    </div>

    <!-- Footer section -->
    <footer class="footer">
        <div class="container2">
            <div class="left-part">
                <p class="mb-0">Designed by Business Trained Experts</p>
                <p class="mb-0">UR, RN1-HUYE</p>
                <p class="mb-0">contact@businessplatform.com</p>
                <p class="mb-0">+250 72 45 67 890</p>
            </div>
            <div class="right-part">
                <p class="mb-0">© 2024 Business Platform. All rights reserved.</p>
                <p class="mb-0">Designed by: <a href="#" target="_blank" class="fw-bold">Gilbert</a></p>
                <p class="mb-0">Distributed by: <a href="#" target="_blank" class="fw-bold">Gilbert</a></p>
            </div>
        </div>
    </footer>
</body>
</html>
