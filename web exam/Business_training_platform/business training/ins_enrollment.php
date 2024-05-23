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

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $userId = $_POST["user_id"]; // Retrieve UserID from the form
    $courseId = $_POST["course_id"];

    // Insert data into goals table
    $sql = "INSERT INTO enrollments (UserID, CourseID) VALUES (?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("id", $userId, $courseId);
    $stmt->execute();

    // Close prepared statement
    $stmt->close();

    // Close database connection
    $conn->close();

    // Redirect to a success page or back to the dashboard
    header("location: dashboard.php");
    exit;
}
?>
