<?php
// Include database connection file
require_once "config.php";

// Define variables and initialize with empty values
$title = $description = $instructor_id = $link = $course_name = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate title
    $input_title = trim($_POST["title"]);
    if(empty($input_title)){
        echo "Please enter a title.";
        exit();
    } else{
        $title = $input_title;
    }
    
    // Validate description
    $input_description = trim($_POST["description"]);
    if(empty($input_description)){
        echo "Please enter a description."; 
        exit();
    } else{
        $description = $input_description;
    }

    // Validate instructor ID
    $input_instructor_id = trim($_POST["instructor_id"]);
    if(empty($input_instructor_id)){
        echo "Please enter an instructor ID."; 
        exit();
    } else{
        $instructor_id = $input_instructor_id;
    }
    
    // Validate link
    $input_link = trim($_POST["link"]);
    if(empty($input_link)){
        echo "Please enter a link."; 
        exit();
    } else{
        $link = $input_link;
    }
    
    // Validate course name
    $input_course_name = trim($_POST["course_name"]);
    if(empty($input_course_name)){
        echo "Please enter a course name."; 
        exit();
    } else{
        $course_name = $input_course_name;
    }
    
    // Prepare an insert statement
    $sql = "INSERT INTO courses (Title, Description, InstructorID, Link, CourseName) VALUES (?, ?, ?, ?, ?)";
     
    if($stmt = $conn->prepare($sql)){
        // Bind variables to the prepared statement as parameters
        $stmt->bind_param("ssiss", $param_title, $param_description, $param_instructor_id, $param_link, $param_course_name);
        
        // Set parameters
        $param_title = $title;
        $param_description = $description;
        $param_instructor_id = $instructor_id;
        $param_link = $link;
        $param_course_name = $course_name;
        
        // Attempt to execute the prepared statement
        if($stmt->execute()){
            // Redirect to manage_courses.php
            header("location: manage_courses.php");
            exit();
        } else{
            echo "Oops! Something went wrong. Please try again later.";
        }
    }
     
    // Close statement
    $stmt->close();
    
    // Close connection
    $conn->close();
}
?>
