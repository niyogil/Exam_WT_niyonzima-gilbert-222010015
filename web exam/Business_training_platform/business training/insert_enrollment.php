<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add New Goal</title>
    <link rel="stylesheet" href="styles.css">
    <style>
      /* Global Styles */
body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f4f4f4;
}

.container {
    max-width: 800px;
    height: 430px;
    margin: 20px auto;
    background-color: #fff;
    padding: 20px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    font-size: 36px;
    color: #333;
    text-align: center;
    margin-bottom: 20px;
}

form {
    display: flex;
    flex-direction: column;
}

.form-group {
    margin-bottom: 20px;
}

label {
    font-size: 18px;
    color: #333;
    margin-bottom: 5px;
}

input[type="text"],
input[type="date"],
button[type="submit"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
}

button[type="submit"] {
    background-color: #4caf50;
    color: white;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 18px;
}

button[type="submit"]:hover {
    background-color: #45a049;
}

.footer {
    background-color: #5cc4cd;
    padding: 20px;
    margin-top: auto;
}

.footer .container2 {
    display: flex;
    justify-content: space-between;
}

.footer .container2 .left-part p,
.footer .container2 .right-part p {
    font-size: 14px;
    color: #170101;
    margin-bottom: 5px;
}

.footer .container2 .right-part p a {
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
}

.navbar {
    background-color: #007bff;
    padding: 10px 0;
}

.navbar-brand {
    color: #fff;
    font-size: 24px;
    text-decoration: none;
    margin-left: 20px;
}

.nav-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.nav-links li {
    display: inline;
    margin-left: 20px;
}

.nav-links li a {
    color: black;
    text-decoration: none;
    font-size: 16px;
    margin-right: 5px;
}


.nav-links li a:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>
<header>
      <nav class="navbar">
        <a href="index.html" class="navbar-brand">VBSTP</a>
        <ul class="nav-links">
          <li><a href="personal_info.php">Plofile</a></li>
          <li><a href="enrollments.php">Courses</a></li>
          <li><a href="transaction_history.php">Transactions</a></li>
          <li><a href="settings.php">Update</a></li>
          <li><a href="assessment.php">Assessments</a></li>
          <li><a href="payment.html">Pay</a></li>
          <li><a href="course_dashboard.php">Study</a></li>
          <li><a href="resources.php">resources</a></li>
          <li><a href="certificate.php">Certificate</a></li>
          <li><a href="goal.php">Goals</a></li>
          <li><a href="feedback.php">Rate Us</a></li>
          <li><a href="logout.php">Logout</a></li>
          
        </ul>
      </nav>
    </header>

    <div class="container">
    <h1>Enrollment Form</h1>
    <form action="ins_enrollment.php" method="POST">
        <!-- Add UserID field -->
        <div class="form-group">
            <label for="user_id">User ID:</label>
            <input type="text" id="user_id" name="user_id" required>
        </div>
        <!-- End of UserID field -->
        <div class="form-group">
            <label for="course_id">Course ID:</label>
            <input type="text" id="course_id" name="course_id" required>
        </div>
      
        <button type="submit">Enroll</button>
    </form>
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
          <p class="mb-0">© 2024 Business Strategy Platform. All rights reserved.</p>
          <p class="mb-0">Designed by: <a href="#" target="_blank" class="fw-bold">Gilbert</a></p>
          <p class="mb-0">Distributed by: <a href="#" target="_blank" class="fw-bold">Gilbert</a></p>
        </div>
      </div>
    </footer>
</body>
</html>
