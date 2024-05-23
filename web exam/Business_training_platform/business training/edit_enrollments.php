<?php
// Include database connection file
require_once "config.php";

// Check if user ID is provided
if (isset($_GET['id'])) {
    // Get user ID from the URL parameter
    $enrollment_id = $_GET['id'];

    // Retrieve user information from the database
    $sql = "SELECT * FROM enrollments WHERE EnrollmentID = ?";
    if ($stmt = $conn->prepare($sql)) {
        // Bind enrollment ID as parameter
        $stmt->bind_param("i", $enrollment_id);

        // Execute the statement
        $stmt->execute();

        // Store result
        $result = $stmt->get_result();

        // Check if user exists
        if ($result->num_rows == 1) {
            // Fetch user data
            $row = $result->fetch_assoc();
            $user_id = $row['UserID'];
            $course_id = $row['CourseID'];
            $enrollmentdate = $row['EnrollmentDate'];
            // You can fetch other fields here and use them in your form

            // Close statement
            $stmt->close();
        } else {
            echo "Enrollment not found.";
            exit();
        }
    }

    // Close connection
    $conn->close();
} else {
    // If user ID is not provided, redirect back to the manage_enrollments.php page
    header("location: manage_enrollments.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
    <style>
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
        paddinrg: 10px 20px;
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

    </style>
</head>
<body>
    <h2>Edit Enrollment</h2>
    <form action="update_enrollments.php" method="post">
        <input type="hidden" name="enrollment_id" value="<?php echo $enrollment_id; ?>">
        <div>
            <label>EnrollmentID</label>
            <input type="text" name="enrollment_id" value="<?php echo $enrollment_id; ?>" required>
        </div>
        <div>
            <label>UserID</label>
            <input type="text" name="user_id" value="<?php echo $user_id; ?>" required>
        </div>
        <div>
            <label>CourseID</label>
            <input type="course_id" name="course_id" value="<?php echo $course_id; ?>" required>
        </div>
        <div>
            <label>Enrollment Date</label>
            <input type="text" name="enrollment_date" value="<?php echo $enrollmentdate; ?>" readonly>
        </div>
        <!-- You can add fields for other user information here -->
        <div>
            <input type="submit" value="Update">
        </div>
    </form>
</body>
</html>