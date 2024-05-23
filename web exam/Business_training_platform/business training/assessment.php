<?php
// Include database connection file
require_once "config.php";

// Retrieve assessments from the database
$sql = "SELECT * FROM assessments";
$result = $conn->query($sql);

// Fetch assessments as an associative array
$assessments = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $assessments[] = $row;
    }
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Assessments</title>
    <link rel="stylesheet" href="styles.css">
    <!-- Add any CSS stylesheets if needed -->
    <style>
        
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f0f0f0;
        }
        .assessment {
            background-color: #fff;
            width: 90%;
            margin-left:40px;
            border-radius: 5px;
            padding: 20px;
            margin-bottom: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        h3 {
            margin-top: 0;
            
        }
        .question-label, .correct-answer-label {
            display: none;
            font-weight: bold;
            margin-top: 10px;
        }
        .question, .correct-answer {
            display: none;
        }
        .view-btn {
            background-color: #007bff;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
        }
    
        .assessment {
            margin-bottom: 20px;
        }
        .question {
            display: none;
        }
        .correct-answer {
            display: none;
        }
        h2{
            text-align: center;
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
          <li><a href="goal.php">Goals</a></li>
          <li><a href="resources.php">Resources</a></li>
          <li><a href="feedback.php">Rate Us</a></li>
          <li><a href="logout.php">Logout</a></li>
          
        </ul>
      </nav>
    </header>

<h2>You're going to view the questions. <br>After a few seconds, the correct answer will be displayed. <br>Thank you.</h2>

<?php foreach ($assessments as $assessment): ?>
    <div class="assessment">
        <h3><?php echo $assessment['Title']; ?></h3>
        <p class="question-label" style="display: none;">Question:</p>
        <p class="question"><?php echo $assessment['Question']; ?></p>
        <button class="view-btn">View</button>
        <p class="correct-answer-label" style="display: none;">Correct Answer:</p>
        <p class="correct-answer" style="display: none;"><?php echo $assessment['CorrectAnswer']; ?></p>
    </div>
<?php endforeach; ?>

<script>
    // Add JavaScript to handle the functionality
    document.addEventListener("DOMContentLoaded", function() {
        var viewBtns = document.querySelectorAll(".view-btn");
        viewBtns.forEach(function(btn) {
            btn.addEventListener("click", function() {
                var parent = this.parentElement;
                var question = parent.querySelector(".question");
                var correctAnswer = parent.querySelector(".correct-answer");
                var questionLabel = parent.querySelector(".question-label");
                var correctAnswerLabel = parent.querySelector(".correct-answer-label");
                
                // Show question and label
                question.style.display = "block";
                questionLabel.style.display = "block";
                
                // After 10 seconds, reveal the correct answer and label
                setTimeout(function() {
                    correctAnswer.style.display = "block";
                    correctAnswerLabel.style.display = "block";
                }, 5000);
            });
        });
    });
</script>

<!-- Footer Section -->
<footer class="footer">
      <div class="container2">
        <div class="left-part">
          <p class="mb-0">Designed by Business Trained Experts</p>
          <p class="mb-0">UR, RN1-HUYE</p>
          <p class="mb-0">contact@businessplatform.com</p>
          <p class="mb-0">+250 784567390</p>
        </div>
        <div class="right-part">
          <p class="mb-0">© 2024 Business Platform. All rights reserved.</p>
          <p class="mb-0">Designed by: <a href="#" target="_blank" class="fw-bold">Gilbert</a></p>
          <p class="mb-0">Distributed by: <a href="#" target="_blank" class="fw-bold">Gilbert</a></p>
        </div>
      </div>
    </footer>

</body>
</html>
