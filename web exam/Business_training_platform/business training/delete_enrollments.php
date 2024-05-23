<?php
// Include database connection file
require_once "config.php";

// Check if user ID is provided
if (isset($_GET['id'])) {
    // Get enrollment ID from the URL parameter
    $enrollment_id = $_GET['id'];

    // Prepare a delete statement
    $sql = "DELETE FROM enrollments WHERE EnrollmentID = ?";

    if ($stmt = $conn->prepare($sql)) {
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("i", $enrollment_id);

        // Attempt to execute the prepared statement
        if ($stmt->execute()) {
            // Redirect to the manage_users.php page after deleting
            header("location: admin_dashboard.php");
            exit();
        } else {
            echo "Error deleting user.";
        }

        // Close statement
        $stmt->close();
    }

    // Close connection
    $conn->close();
} else {
    // If user ID is not provided, redirect back to the manage_users.php page
    header("location: manage_enrollments.php");
    exit();
}
?>
