<?php
session_start();

// Include database connection file
require_once "config.php";

// Retrieve form data
$title = $_POST['title'];
$description = $_POST['description'];
$instructorID = $_POST['instructorID'];
$link = $_POST['link'];

// SQL query to insert data into the database
$sql = "INSERT INTO courses (Title, Description, InstructorID, Link) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssis", $title, $description, $instructorID, $link);

if ($stmt->execute()) {
    echo "Course added successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$stmt->close();
$conn->close();
?>
