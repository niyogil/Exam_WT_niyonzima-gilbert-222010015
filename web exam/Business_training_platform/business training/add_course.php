<?php
// Include database connection file
require_once "config.php";

// Define variables and initialize with empty values
$title = $description = $instructor = $link = $course_name = "";
$title_err = $description_err = $instructor_err = $link_err = $course_name_err = "";

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate Title
    if (empty(trim($_POST["title"]))) {
        $title_err = "Please enter the title of the course.";
    } else {
        $title = trim($_POST["title"]);
    }

    // Validate Description
    if (empty(trim($_POST["description"]))) {
        $description_err = "Please enter a description for the course.";
    } else {
        $description = trim($_POST["description"]);
    }

    // Validate Instructor
    if (empty(trim($_POST["instructor"]))) {
        $instructor_err = "Please enter the name of the instructor.";
    } else {
        $instructor = trim($_POST["instructor"]);
    }

    // Validate Link
    $link = trim($_POST["link"]);

    // Validate Course Name
    if (empty(trim($_POST["course_name"]))) {
        $course_name_err = "Please enter the name of the course.";
    } else {
        $course_name = trim($_POST["course_name"]);
    }

    // Check input errors before inserting into database
    if (empty($title_err) && empty($description_err) && empty($instructor_err) && empty($course_name_err)) {
        // Prepare an insert statement
        $sql = "INSERT INTO courses (Title, Description, InstructorID, Link, CourseName) VALUES (?, ?, ?, ?, ?)";

        if ($stmt = $conn->prepare($sql)) {
            // Bind variables to the prepared statement as parameters
            $stmt->bind_param("ssiss", $param_title, $param_description, $param_instructor, $param_link, $param_course_name);

            // Set parameters
            $param_title = $title;
            $param_description = $description;
            $param_instructor = $instructor;
            $param_link = $link;
            $param_course_name = $course_name;

            // Attempt to execute the prepared statement
            if ($stmt->execute()) {
                // Redirect to manage-courses page after adding course
                header("location: manage_courses.php");
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
