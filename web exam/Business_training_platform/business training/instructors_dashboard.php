<?php
session_start();
// Check if user is logged in, if not redirect to login page
if (!isset($_SESSION["email"])) {
    header("location: instructors_login.php");
    exit;
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>INSTRUCTORS Dashboard</title>
    <link rel="stylesheet" href="styles.css">
    <style>
      body {
    font-family: 'Roboto', sans-serif;
    background-color: #f4f4f4;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    min-height: 100vh; 
}

.container {
    max-width: 600px;
    align-items: center;
    height: 600px;
    margin: 30px auto;
    background-color: #c6d1f0;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    flex-grow: 1; /* Allow the container to grow to fill remaining space */
}

/* styles.css */

.button {
    display: inline-block;
    padding: 10px 20px;
    margin: 10px;
    background-color: #4caf50;
    color: white;
    border: none;
    border-radius: 5px;
    text-decoration: none;
    font-size: 16px;
    cursor: pointer;
    transition: background-color 0.3s ease;
}

.button:hover {
    background-color: #45a049;
}

    </style>
</head>
<body>
    <!-- Navigation bar (if applicable) -->
    <!-- Header section -->
    <header>
        <h1>Welcome, <?php echo htmlspecialchars($_SESSION["email"]); ?>!</h1>
    </header>

    <!-- Main content section -->


<div class="container">
    <!-- Personal information section -->
    <a href="instructor_info.php" class="button" target="_blank">Personal Information</a><br><br>



    <!-- Course section -->
    <a href="insert_course.php" class="button" target="_blank">Add Course</a><br><br>



    <!-- Assessment section -->
    <a href="instructor_assessment.php" class="button" target="_blank">Add Assessment</a><br><br>
    

    <!-- Logout section -->
    <a href="logout.php" class="button" target="_blank">Logout</a><br><br>
</div>


    
   <!-- Footer Section -->
<footer class="footer">
      <div class="container2">
        <div class="left-part">
          <p class="mb-0">Designed by Trained Business Experts</p>
          <p class="mb-0">UR, RN1-HUYE</p>
          <p class="mb-0">contact@businessplatform.com</p>
          <p class="mb-0">+250 787109054</p>
        </div>
        <div class="right-part">
          <p class="mb-0">© 2024 Busuness Strategy Platform. All rights reserved.</p>
          <p class="mb-0">Designed by: <a href="#" target="_blank" class="fw-bold">Gilbert</a></p>
          <p class="mb-0">Distributed by: <a href="#" target="_blank" class="fw-bold">Gilbert</a></p>
        </div>
      </div>
    </footer>