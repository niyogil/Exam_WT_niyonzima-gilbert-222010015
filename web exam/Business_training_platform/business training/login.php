<?php




// Database connection parameters
require_once "config.php";

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Retrieve form data
$email = $_POST['email'];
$password = $_POST['password'];

// Prepare SQL statement to fetch user data
$stmt = $conn->prepare("SELECT username FROM users WHERE email=? AND password=?");
$stmt->bind_param("ss", $email, $password);
$stmt->execute();
$result = $stmt->get_result();

// Check if user exists
if ($result->num_rows > 0) {
    // User found, redirect to user home page
    session_start();
    $_SESSION['email'] = $email; // Store user email in session for further authentication
    header("Location: dashboard.php"); 
    exit();
} else {
    // User not found, display error message
    echo "<script>alert('Wrong Email or Password, Please Verify Credentials');</script>";
    echo "<script>window.location.href = 'login.html';</script>"; // Replace 'login.html' with the login page
}

// Close database connection
$stmt->close();
$conn->close();


?>
