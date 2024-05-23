<?php
session_start();
include_once "config.php";

if(isset($_POST['submit'])) {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $photoName = $_FILES['photo']['name'];
    $photoTmpName = $_FILES['photo']['tmp_name'];

    // Upload photo to server
    $photoPath = 'uploads/' . $photoName;
    move_uploaded_file($photoTmpName, $photoPath);

    // Insert user data into database
    $sql = "INSERT INTO users (username, email, password, photo) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $email, $password, $photoPath);
    $stmt->execute();
    $stmt->close();
    $conn->close();

    // Set success message and redirect to login page
    $_SESSION['registration_success'] = true;
    header("Location: login.html");
    exit();
}
?>
