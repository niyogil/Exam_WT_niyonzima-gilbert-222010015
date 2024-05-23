<?php
// Include database connection file
require_once "config.php";

// Check if course ID is provided
if (isset($_GET['id'])) {
    // Get course ID from the URL parameter
    $course_id = $_GET['id'];

    // Prepare a delete statement
    $sql = "DELETE FROM courses WHERE CourseID = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind course ID as parameter
        $stmt->bind_param("i", $course_id);

        // Attempt to execute the statement
        if ($stmt->execute()) {
            // Course deleted successfully, redirect to manage_courses.php
            header("location: manage_courses.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();
} else {
    // Redirect back to the manage_courses.php page if course ID is not provided
    header("location: manage_courses.php");
    exit();
}
?>
