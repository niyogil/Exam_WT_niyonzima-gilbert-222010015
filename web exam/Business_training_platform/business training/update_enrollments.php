<?php
// Include database connection file
require_once "config.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if user ID and other necessary fields are set
    if (isset($_POST["enrollment_id"]) && isset($_POST["user_id"]) && isset($_POST["course_id"])) {
        // Get form data
        $enrollment_id = $_POST["enrollment_id"];
        $user_id = $_POST["user_id"];
        $course_id = $_POST["course_id"];

        // Update user information in the database
        $sql = "UPDATE enrollments SET UserID = ?, CourseID = ? WHERE EnrollmentID = ?";
        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters
            $stmt->bind_param("ssi", $user_id, $course_id, $enrollment_id);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to manage_users.php after successful update
                header("location: admin_dashboard.php");
                exit();
            } else {
                echo "Error updating enrollments.";
            }

            // Close statement
            $stmt->close();
        } else {
            echo "Error preparing statement.";
        }
    } else {
        echo "Required fields are missing.";
    }
} else {
    echo "Invalid request.";
}

// Close connection
$conn->close();
?>
