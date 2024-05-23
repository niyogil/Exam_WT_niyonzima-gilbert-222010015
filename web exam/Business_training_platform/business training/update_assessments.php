<?php
// Include database connection file
require_once "config.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if user ID and other necessary fields are set
    if (isset($_POST["assessment_id"]) && isset($_POST["title"]) && isset($_POST["question"]) && isset($_POST["correctAnswer"])) {
        // Get form data
        $assessment_id = $_POST["assessment_id"];
        $title = $_POST["title"];
        $question = $_POST["question"];
        $correctAnswer = $_POST["correctAnswer"];

        // Update user information in the database
        $sql = "UPDATE assessments SET Title = ?, Question = ?, CorrectAnswer = ? WHERE AssessmentID = ?";
        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters
            $stmt->bind_param("ssss", $title, $question, $correctAnswer, $assessment_id);


            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to manage_users.php after successful update
                header("location: admin_dashboard.php");
                exit();
            } else {
                echo "Error updating assessment.";
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
