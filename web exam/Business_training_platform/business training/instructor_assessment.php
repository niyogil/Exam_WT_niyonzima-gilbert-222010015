<?php
// Include database connection file
require_once "config.php";

// Define variables and initialize with empty values
$title = $question = $correctAnswer = "";
$title_err = $question_err = $correctAnswer_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  

    // Validate assessment title
    if (empty(trim($_POST["title"]))) {
        $title_err = "Please enter a title.";
    } else {
        $title = trim($_POST["title"]);
    }

    // Validate question
    if (empty(trim($_POST["question"]))) {
        $question_err = "Please enter a question.";
    } else {
        $question = trim($_POST["question"]);
    }

    // Validate correct answer
    if (empty(trim($_POST["correctAnswer"]))) {
        $correctAnswer_err = "Please enter a correct answer.";
    } else {
        $correctAnswer = trim($_POST["correctAnswer"]);
    }

    // Check input errors before inserting into database
    if (empty($title_err) && empty($question_err) && empty($correctAnswer_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO assessments (Title, Question, CorrectAnswer) VALUES (?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("sss", $param_title, $param_question, $param_correctAnswer);

            // Set parameters
            $param_title = $title;
            $param_question = $question;
            $param_correctAnswer = $correctAnswer;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to admin dashboard after successful update
                header("location: instructors_dashboard.php");
                exit();
            } else {
                echo "Something went wrong. Please try again later.";
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
    <title>Add Assessment</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Form Styles */
        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background: #f9f9f9;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        label {
            display: block;
            margin-bottom: 5px;
        }

        input[type="text"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        .error {
            color: red;
            font-size: 14px;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
            font-size: 16px;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <h2>Add New Assessment</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
       
        <div class="form-group">
            <label>Title</label>
            <input type="text" name="title" value="<?php echo $title; ?>">
            <span class="error"><?php echo $title_err; ?></span>
        </div>
        <div class="form-group">
            <label>Question</label>
            <input type="text" name="question" value="<?php echo $question; ?>">
            <span class="error"><?php echo $question_err; ?></span>
        </div>
        <div class="form-group">
            <label>Correct Answer</label>
            <input type="text" name="correctAnswer" value="<?php echo $correctAnswer; ?>">
            <span class="error"><?php echo $correctAnswer_err; ?></span>
        </div>
        <div class="form-group">
            <input type="submit" value="Submit">
        </div>
    </form>
</body>
</html>
