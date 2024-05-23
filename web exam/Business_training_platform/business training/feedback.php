<?php
// Define variables and initialize with empty values
$user_id = $rating = $comment = "";
$rating_err = $comment_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate UserID
    if (empty(trim($_POST["user_id"]))) {
        $rating_err = "Please enter your UserID.";
    } else {
        $user_id = trim($_POST["user_id"]);
    }
    
    // Validate Rating
    if (empty(trim($_POST["rating"]))) {
        $rating_err = "Please enter your rating.";
    } elseif (intval($_POST["rating"]) < 1 || intval($_POST["rating"]) > 5) {
        $rating_err = "Rating must be between 1 and 5.";
    } else {
        $rating = trim($_POST["rating"]);
    }
    
    // Validate Comment
    if (empty(trim($_POST["comment"]))) {
        $comment_err = "Please enter your comment.";
    } else {
        $comment = trim($_POST["comment"]);
    }

    // Check input errors before inserting into database
    if (empty($user_id_err) && empty($rating_err) && empty($comment_err)) {
        // Include database connection file
        require_once "config.php";
        
        // Prepare an insert statement
        $sql = "INSERT INTO feedback (UserID, Rating, Comment, FeedbackDate) VALUES (?, ?, ?, NOW())";
        
        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("iis", $param_user_id, $param_rating, $param_comment);
            
            // Set parameters
            $param_user_id = $user_id;
            $param_rating = $rating;
            $param_comment = $comment;
            
            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to feedback success page
                header("location: dashboard.php");
                exit();
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
    <title>Feedback Form</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .wrapper {
            width: 50%;
            margin: 50px auto;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
        }

        .form-group input[type="number"],
        .form-group textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group .help-block {
            color: #ff0000;
        }

        .form-group .btn-primary {
            padding: 10px 20px;
            background-color: #007bff;
            border: none;
            color: #ffffff;
            border-radius: 5px;
            cursor: pointer;
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
          <li><a href="resources.php">resources</a></li>
          <li><a href="course_dashboard.php">Study</a></li>
          <li><a href="goal.php">Goals</a></li>
          <li><a href="certificate.php">Certificate</a></li>
          <li><a href="feedback.php">Rate Us</a></li>
          <li><a href="logout.php">Logout</a></li>
          
        </ul>
      </nav>
    </header>
<body>
    <div class="wrapper">
        <h2>Feedback Form</h2>
        <p>Please fill in your feedback below:</p>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="form-group <?php echo (!empty($rating_err)) ? 'has-error' : ''; ?>">
                <label>UserID</label>
                <input type="number" name="user_id" class="form-control" value="<?php echo $user_id; ?>">
            </div>
            <div class="form-group <?php echo (!empty($rating_err)) ? 'has-error' : ''; ?>">
                <label>Rating (1-5)</label>
                <input type="number" name="rating" class="form-control" min="1" max="5" value="<?php echo $rating; ?>">
                <span class="help-block"><?php echo $rating_err; ?></span>
            </div>
            <div class="form-group <?php echo (!empty($comment_err)) ? 'has-error' : ''; ?>">
                <label>Comment</label>
                <textarea name="comment" class="form-control"><?php echo $comment; ?></textarea>
                <span class="help-block"><?php echo $comment_err; ?></span>
            </div>
            <div class="form-group">
                <input type="submit" class="btn btn-primary" value="Submit">
            </div>
        </form>
    </div>
    <!-- Footer Section -->
    <footer class="footer">
      <div class="container2">
        <div class="left-part">
          <p class="mb-0">Designed by Trained Business Experts</p>
          <p class="mb-0">UR, RN1-HUYE</p>
          <p class="mb-0">contact@businessplatform.com</p>
          <p class="mb-0">+250 787 737 890</p>
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
