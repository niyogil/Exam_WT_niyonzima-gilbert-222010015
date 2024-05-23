<?php
// Define variables and initialize with empty values
$name = $email = $password = $confirm_password = $bio = "";
$name_err = $email_err = $password_err = $confirm_password_err = $bio_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Name
    if (empty(trim($_POST["name"]))) {
        $name_err = "Please enter a name.";
    } else {
        $name = trim($_POST["name"]);
    }

    // Validate Email
    if (empty(trim($_POST["email"]))) {
        $email_err = "Please enter an email.";
    } else {
        $email = trim($_POST["email"]);
    }

    // Validate Password
    if (empty(trim($_POST["password"]))) {
        $password_err = "Please enter a password.";
    } elseif (strlen(trim($_POST["password"])) < 6) {
        $password_err = "Password must have at least 6 characters.";
    } else {
        $password = trim($_POST["password"]);
    }

    // Validate Confirm Password
    if (empty(trim($_POST["confirm_password"]))) {
        $confirm_password_err = "Please confirm password.";
    } else {
        $confirm_password = trim($_POST["confirm_password"]);
        if (empty($password_err) && ($password != $confirm_password)) {
            $confirm_password_err = "Password did not match.";
        }
    }

    // Validate Bio
    if (empty(trim($_POST["bio"]))) {
        $bio_err = "Please enter a bio.";
    } else {
        $bio = trim($_POST["bio"]);
    }

    // Check input errors before inserting into database
    if (empty($name_err) && empty($email_err) && empty($password_err) && empty($confirm_password_err) && empty($bio_err)) {
        // Include database connection file
        require_once "config.php";

        // Prepare an insert statement
        $sql = "INSERT INTO instructors (Name, Email, Password, Bio) VALUES (?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssss", $param_name, $param_email, $param_password, $param_bio);

            // Set parameters
            $param_name = $name;
            $param_email = $email;
            $param_password = password_hash($password, PASSWORD_DEFAULT); // Creates a password hash
            $param_bio = $bio;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to login page
                header("location: instructors_login.php");
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            $stmt->close();
        }

        // Close connection
        $conn->close();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Instructor Registration</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: gray;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 400px;
            margin: 20px auto;
            background-color: orange;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            font-size: 24px;
            color: red;
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
        .form-group input[type="email"],
        .form-group input[type="password"],
        .form-group textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #cccccc;
            border-radius: 5px;
        }

        .form-group span {
            color: red;
        }

        .form-group button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: pink;
            color: #ffffff;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: yellow;
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
          <li><a href="contact.html">Contact us</a></li>
          <li><a href="resources.php">resources</a></li>
          <li><a href="instructors_login.php">Instructor</a></li>
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
        <h2>Instructor Registration</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($name_err)) ? 'has-error' : ''; ?>">
                <label>Name</label>
                <input type="text" name="name" value="<?php echo $name; ?>">
                <span><?php echo $name_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($email_err)) ? 'has-error' : ''; ?>">
                <label>Email</label>
                <input type="email" name="email" value="<?php echo $email; ?>">
                <span><?php echo $email_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($password_err)) ? 'has-error' : ''; ?>">
                <label>Password</label>
                <input type="password" name="password" value="<?php echo $password; ?>">
                <span><?php echo $password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($confirm_password_err)) ? 'has-error' : ''; ?>">
                <label>Confirm Password</label>
                <input type="password" name="confirm_password" value="<?php echo $confirm_password; ?>">
                <span><?php echo $confirm_password_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($bio_err)) ? 'has-error' : ''; ?>">
                <label>Bio</label>
                <textarea name="bio"><?php echo $bio; ?></textarea>
                <span><?php echo $bio_err; ?></span>
            </div>
            <div class="form-group">
                <button type="submit">Register</button>
            </div>
            <p>Already in the System ? <a href="instructors_login.php">Login Here</a>.</p>
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
