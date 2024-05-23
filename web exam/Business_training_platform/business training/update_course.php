<?php
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

            // Close statement
            $stmt->close();
        } else {
            echo "Course not found.";
            exit();
        }
    }

    // Close connection
    $conn->close();
} else {
    // If course ID is not provided, redirect back to the manage_courses.php page
    header("location: admin_dashboard.php");
    exit();
}
?>
