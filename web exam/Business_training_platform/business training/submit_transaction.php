<?php
// Database connection
session_start();

// Include database connection file
require_once "config.php";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$userID = $_POST['userID'];
$amount = $_POST['amount'];
$category = $_POST['category'];
$transactionDate = $_POST['transactionDate'];
$notes = $_POST['notes'];

// SQL query to insert data into the database
$sql = "INSERT INTO transactions (UserID, Amount, Category, TransactionDate, Notes) VALUES ('$userID', '$amount', '$category', '$transactionDate', '$notes')";

if ($conn->query($sql) === TRUE) {
        // Redirect to the course_dashboard page
header("Location: course_dashboard.php");
exit; // Make sure to exit after the redire
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
