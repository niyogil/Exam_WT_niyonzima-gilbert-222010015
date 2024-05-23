<?php
session_start();

// Check if the user is already logged in, if yes, redirect to dashboard
if(isset($_SESSION["loggedin"]) && $_SESSION["loggedin"] === true){
    header("location: instructors_dashboard.php");
    exit;
}

// Include database connection file
require_once "config.php";

// Define variables and initialize with empty values
$email = $password = "";
$email_err = $password_err = "";

// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){

    // Validate email
    if(empty(trim($_POST["email"]))){
        $email_err = "Please enter email.";
    } else{
        $email = trim($_POST["email"]);
    }

    // Validate password
    if(empty(trim($_POST["password"]))){
        $password_err = "Please enter your password.";
    } else{
        $password = trim($_POST["password"]);
    }

    // Check input errors before querying the database
    if(empty($email_err) && empty($password_err)){
        // Prepare a select statement
        $sql = "SELECT InstructorID, Name, Email, Password FROM instructors WHERE Email = ?";

        if($stmt = $conn->prepare($sql)){
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("s", $param_email);

            // Set parameters
            $param_email = $email;

            // Attempt to execute the prepared statement
            if($stmt->execute()){
                // Store result
                $stmt->store_result();

                // Check if email exists, if yes then verify password
                if($stmt->num_rows == 1){
                    // Bind result variables
                    $stmt->bind_result($instructor_id, $name, $email, $hashed_password);
                    if($stmt->fetch()){
                        if(password_verify($password, $hashed_password)){
                            // Password is correct, start a new session
                            session_start();

                            // Store data in session variables
                            $_SESSION["loggedin"] = true;
                            $_SESSION["instructor_id"] = $instructor_id;
                            $_SESSION["name"] = $name;
                            $_SESSION["email"] = $email;

                            // Redirect user to dashboard page
                            header("location: instructors_dashboard.php");
                        } else{
                            // Display an error message if password is not valid
                            $password_err = "The password you entered was not valid.";
                        }
                    }
                } else{
                    // Display an error message if email doesn't exist
                    $email_err = "No account found with that email.";
                }
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }
    }

    // Close connection
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Login</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 100px auto;
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 24px;
            color: #333333;
            text-align: center;
            margin-bottom: 20px;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input[type="text"],
        .form-group input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 5px;
        }

        .form-group button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: yellow;
            color: #333333;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #e6e600;
        }

        .form-group span {
            color: red;
            font-size: 14px;
        }

        .form-group .success {
            color: green;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: green;
            padding: 10px 20px;
        }

        .navbar a {
            color: #333333;
            text-decoration: none;
            padding: 8px 16px;
        }

        .navbar a:hover {
            background-color: #e6e600;
            color: #333333;
        }

        .navbar .nav-links {
            display: flex;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .navbar .nav-links li {
            margin: 0 10px;
        }

        .navbar .dropdown-content {
            display: none;
            position: absolute;
            background-color: yellow;
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
            z-index: 1;
        }

        .navbar .dropdown:hover .dropdown-content {
            display: block;
        }

        .navbar .dropdown-content a {
            display: block;
            padding: 12px 16px;
        }

        footer {
            background-color: #333333;
            color: #ffffff;
            padding: 20px;
            text-align: center;
            position: fixed;
            width: 100%;
            bottom: 0;
        }

        .footer .container2 {
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .footer .container2 p {
            margin: 0;
        }

        .footer .container2 .left-part,
        .footer .container2 .right-part {
            width: 50%;
        }

        .footer .container2 a {
            color: yellow;
        }

        .footer .container2 a:hover {
            color: #e6e600;
        }
    </style>
</head>
<body>
<header>
      <nav class="navbar">
        <a href="index.html" class="navbar-brand">VBSTP</a>
        <ul class="nav-links">
          <li><a href="index.html">Home</a></li>
          <li><a href="about.html">About Us</a></li>
          <li><a href="contact.html">Contact Us</a></li>
          <li><a href="instructors_login.php">Instructor</a></li>
          <li><a href="resources.php">Resources</a></li>
          <li><a href="certificate.php">Certificate</a></li>
          <li><a href="admin_login.php">Admin</a></li>
          <li class="dropdown">
            <a href="login.html">Login &#9662;</a>
            <div class="dropdown-content">
              <a href="registration.html">Register</a>
            </div>
          </li>
        </ul>
      </nav>
    </header>
    <div class="container">
        <h2>Instructor Login</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group">
                <label>Email</label>
                <input type="text" name="email" value="<?php echo $email; ?>">
                <span class="error"><?php echo $email_err; ?></span>
            </div>
            <div class="form-group">
                <label>Password</label>
                <input type="password" name="password">
                <span class="error"><?php echo $password_err; ?></span>
            </div>
            <div class="form-group">
                <button type="submit">Login</button>
            </div>
            <p>Don't have an account? <a href="instructors.php">Sign up now</a>.</p>
        </form>
    </div>
    <!-- Footer Section -->
    <footer class="footer">
      <div class="container2">
        <div class="left-part">
          <p class="mb-0">Designed by Business Trained Experts</p>
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
