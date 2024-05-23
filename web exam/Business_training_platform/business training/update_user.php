<?php
// Include database connection file
require_once "config.php";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if user ID and other necessary fields are set
    if (isset($_POST["user_id"]) && isset($_POST["username"]) && isset($_POST["email"]) && isset($_POST["password"])) {
        // Get form data
        $user_id = $_POST["user_id"];
        $username = $_POST["username"];
        $email = $_POST["email"];
        $password = $_POST["password"];

        // Update user information in the database
        $sql = "UPDATE users SET Username = ?, Email = ?, Password = ? WHERE UserID = ?";
        if ($stmt = $conn->prepare($sql)) {
            // Bind parameters
            $stmt->bind_param("sssi", $username, $email, $password, $user_id);

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to manage_users.php after successful update
                header("location: admin_dashboard.php");
                exit();
            } else {
                echo "Error updating user.";
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
