<?php
// Include database connection file
require_once "config.php";

// Check if user is logged in
session_start();
if (!isset($_SESSION["email"])) {
    header("location: login.html");
    exit;
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate course ID
    if (isset($_POST["course"]) && !empty($_POST["course"])) {
        // Get course ID from the form
        $courseID = $_POST["course"];
        
        // Get user ID from the session
        $userID = $_SESSION["user_id"]; // Assuming "user_id" is the key for user ID in the session

        // Insert enrollment record into the database
        $sql = "INSERT INTO enrollments (UserID, CourseID, EnrollmentDate) VALUES (?, ?, NOW())";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ii", $userID, $courseID);
        $stmt->execute();
        $stmt->close();

        // Enrollment successful, redirect to enrollments page
        header("location: enrollments.php");
        exit;
    } else {
        // Course ID is not provided, redirect back to enrollments page with error message
        header("location: enrollments.php?error=1");
        exit;
    }
} else {
    // If form is not submitted, redirect back to enrollments page
    header("location: enrollments.php");
    exit;
}
?>
