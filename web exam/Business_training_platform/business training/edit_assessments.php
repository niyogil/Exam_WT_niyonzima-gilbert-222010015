<?php
// Include database connection file
require_once "config.php";

// Check if user ID is provided
if (isset($_GET['id'])) {
    // Get user ID from the URL parameter
    $assessment_id = $_GET['id'];

    // Retrieve user information from the database
    $sql = "SELECT * FROM assessments WHERE AssessmentID = ?";
    if ($stmt = $conn->prepare($sql)) {
        // Bind user ID as parameter
        $stmt->bind_param("i", $assessment_id);

        // Execute the statement
        $stmt->execute();

        // Store result
        $result = $stmt->get_result();

        // Check if user exists
        if ($result->num_rows == 1) {
            // Fetch user data
            $row = $result->fetch_assoc();
            $assessment_id = $row['AssessmentID'];
            $title = $row['Title'];
            $question = $row['Question'];
            $correctAnswer = $row['CorrectAnswer'];
            // You can fetch other fields here and use them in your form

            // Close statement
            $stmt->close();
        } else {
            echo "Assessment not found.";
            exit();
        }
    }

    // Close connection
    $conn->close();
} else {
    // If user ID is not provided, redirect back to the manage_users.php page
    header("location: manage_assessments.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Assessment</title>
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

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
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
    <h2>Edit Assessment</h2>
    <form action="update_assessments.php" method="post">
        <input type="hidden" name="assessment_id" value="<?php echo $assessment_id; ?>">
        <div>
            <label>Assessment ID</label>
            <input type="text" name="assessment_id" value="<?php echo $assessment_id; ?>" required>
        </div>
        <div>
            <label>Title</label>
            <input type="text" name="title" value="<?php echo $title; ?>" required>
        </div>
        <div>
            <label>Question</label>
            <input type="text" name="question" value="<?php echo $question; ?>" required>
        </div>
        <div>
            <label>Correct Answer</label>
            <input type="text" name="correctAnswer" value="<?php echo $correctAnswer; ?>" required>
        </div>
        
        <!-- You can add fields for other user information here -->
        <div>
            <input type="submit" value="Update">
        </div>
    </form>
</body>
</html>

