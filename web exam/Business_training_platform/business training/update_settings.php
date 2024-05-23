<?php
session_start();

// Include database connection file
require_once "config.php";

// Check if user is logged in
if (!isset($_SESSION["email"])) {
    header("location: login.html");
    exit;
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Update user information in the database
    $sql = "UPDATE users SET Username = ?, Email = ?, Password = ? WHERE Email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $email, $password, $_SESSION["email"]); // Adjusted to "ssss"
    $stmt->execute();

    // Close prepared statement
    $stmt->close();
}

// Close database connection
$conn->close();

// Redirect to settings page
header("location: settings.php");
exit;
?>
