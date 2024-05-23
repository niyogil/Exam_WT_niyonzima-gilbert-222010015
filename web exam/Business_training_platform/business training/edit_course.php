<?php
// Include database connection file
require_once "config.php";

// Initialize variables
$title = "";
$description = "";
$instructor_id = "";
$link = "";
$course_name = "";

// Check if course ID is provided
if (isset($_GET['id'])) {
    // Get course ID from the URL parameter
    $course_id = $_GET['id'];

    // Retrieve course information from the database
    $sql = "SELECT * FROM courses WHERE CourseID = ?";
    if ($stmt = $conn->prepare($sql)) {
        // Bind course ID as parameter
        $stmt->bind_param("i", $course_id);

        // Execute the statement
        $stmt->execute();

        // Store result
        $result = $stmt->get_result();

        // Check if course exists
        if ($result->num_rows == 1) {
            // Fetch course data
            $row = $result->fetch_assoc();
            $title = $row['Title'];
            $description = $row['Description'];
            $instructor_id = $row['InstructorID'];
            $link = $row['Link'];
            $course_name = $row['CourseName'];
            // You can fetch other fields here and use them in your form
        } else {
            echo "Course not found.";
            exit();
        }
    } else {
        echo "Error: " . $conn->error;
        exit();
    }

    // Close statement
    $stmt->close();
} else {
    // If course ID is not provided, redirect back to the manage_courses.php page
    header("location: admin_dashboard.php");
    exit();
}

// Close connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Course</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        h2 {
            text-align: center;
            margin-top: 20px;
        }

        form {
            width: 50%;
            margin: 20px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        form div {
            margin-bottom: 10px;
        }

        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        input[type="text"],
        input[type="password"],
        input[type="email"],
        textarea {
            width: 100%;
            padding: 8px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }

        textarea {
            resize: vertical;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }

        a {
            text-decoration: none;
            color: #333;
            margin-left: 10px;
        }
    </style>
</head>
<body>
    <h2>Edit Course</h2>
    <form action="update_course.php" method="post">
        <input type="hidden" name="course_id" value="<?php echo $course_id; ?>">
        <div>
            <label>Title</label>
            <input type="text" name="title" value="<?php echo $title; ?>" required>
        </div>
        <div>
            <label>Description</label>
            <textarea name="description" rows="5" required><?php echo $description; ?></textarea>
        </div>
        <div>
            <label>Instructor ID</label>
            <input type="text" name="instructor_id" value="<?php echo $instructor_id; ?>" required>
        </div>
        <div>
            <label>Link</label>
            <input type="text" name="link" value="<?php echo $link; ?>" required>
        </div>
        <div>
            <label>Course Name</label>
            <input type="text" name="course_name" value="<?php echo $course_name; ?>" required>
        </div>
        <div>
            <input type="submit" value="Update">
            <a href="manage_courses.php">Cancel</a>
        </div>
    </form>
</body>
</html>
