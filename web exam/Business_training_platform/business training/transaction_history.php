<?php
// Start the session
session_start();

// Include database connection file
require_once "config.php";

// Retrieve user's transaction history from the database
$email = $_SESSION["email"];
$sql = "SELECT * FROM transactions WHERE UserID = (SELECT UserID FROM users WHERE Email = ? LIMIT 1)";

// Prepare and execute the SQL query
if ($stmt = $conn->prepare($sql)) {
    $stmt->bind_param("s", $email);
    $stmt->execute();

    // Get the result set
    $result = $stmt->get_result();

    // Check if there are any results
    if ($result) {
        // Output the transaction history
        // Close prepared statement
        $stmt->close();
    } else {
        // Handle case where no results are found
        echo "No transaction history found.";
    }
} else {
    // Handle case where SQL query preparation fails
    echo "Error preparing SQL statement: " . $conn->error;
}

// Close database connection
$conn->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Transaction History</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container1 {
            max-width: 800px;
            height: 400px;
            margin: 20px auto;
            background-color: orange;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 36px;
            color: #333333;
            text-align: center;
            margin-bottom: 20px;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
            color: #333333;
        }
       
        .footer {
            background-color: #ff69b4; /* Replaced blue with pink */
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
            color: #ff1493; /* Replaced blue with dark pink */
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
          <li><a href="certificate.php">Certificate</a></li>
          <li><a href="resources.php">Resources</a></li>
          <li><a href="feedback.php">Rate Us</a></li>
          <li><a href="logout.php">Logout</a></li>
          
        </ul>
      </nav>
    </header>
<!-- Transaction history -->
<div class="container1">
    <h1>Transaction History</h1>
    <table>
        <thead>
            <tr>
                <th>Transaction ID</th>
                <th>Amount</th>
                <th>Category</th>
                <th>Date</th>
                <th>Notes</th>
            </tr>
        </thead>
        <tbody>
            <?php
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["TransactionID"] . "</td>";
                echo "<td>" . $row["Amount"] . "</td>";
                echo "<td>" . $row["Category"] . "</td>";
                echo "<td>" . $row["TransactionDate"] . "</td>";
                echo "<td>" . $row["Notes"] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
<!-- Footer Section -->
<footer class="footer">
      <div class="container2">
        <div class="left-part">
          <p class="mb-0">Designed by Trained Business Experts</p>
          <p class="mb-0">UR, RN1-HUYE</p>
          <p class="mb-0">contact@businessplatform.com</p>
          <p class="mb-0">+250 723 567 890</p>
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
