<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Courses</title>
    <style>
        /* Global Styles */
      

        /* Sidebar Styles */
        .sidebar {
            height: 100%;
            width: 250px;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #333;
            padding-top: 20px;
        }

        .sidebar h2 {
            color: #fff;
            text-align: center;
            margin-bottom: 30px;
        }

        .sidebar ul {
            list-style-type: none;
            padding: 0;
        }

        .sidebar li {
            padding: 10px;
            text-align: center;
        }

        .sidebar a {
            text-decoration: none;
            color: #fff;
            font-size: 18px;
        }

        .sidebar a:hover {
            background-color: #555;
        }

        /* Main Content Styles */
        .content {
            margin-left: 250px;
            padding: 20px;
        }

        .content h2 {
            color: #333;
            margin-bottom: 20px;
        }

        /* Table Styles */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        th, td {
            padding: 10px;
            border-bottom: 1px solid #ddd;
            text-align: left;
        }

        th {
            background-color: #007bff;
            color: #333;
        }
    </style>
</head>
<body>
    <!-- Main content area -->
    <div class="content" style="margin-left: -15px;">
        
        <a href="add_course.php">Add New Course</a>
        <table>
            <tr>
                <th>Course ID</th>
                <th>Title</th>
                <th>Description</th>
                <th>Instructor ID</th>
                <th>Link</th>
                <th>Action</th>
            </tr>
            <!-- PHP code to fetch and display courses from the database -->
            <?php
            // Include database connection file
            require_once "config.php";

            // Check if the connection is valid
            if ($conn) {
                // Prepare a select statement
                $sql = "SELECT * FROM courses";

                // Execute the query
                $result = $conn->query($sql);

                // Check if the query was successful
                if ($result) {
                    // Loop through each row in the result set
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr>";
                        echo "<td>" . $row["CourseID"] . "</td>";
                        echo "<td>" . $row["Title"] . "</td>";
                        echo "<td>" . $row["Description"] . "</td>";
                        echo "<td>" . $row["InstructorID"] . "</td>";
                        echo "<td>" . $row["Link"] . "</td>";
                        echo "<td>";
                        echo "<a href='edit_course.php?id=" . $row["CourseID"] . "'>Edit</a>";
                        echo " | ";
                        echo "<a href='delete_course.php?id=" . $row["CourseID"] . "' onclick='return confirm(\"Are you sure you want to delete this course?\")'>Delete</a>";
                        echo "</td>";
                        echo "</tr>";
                    }
                    // Free result set
                    $result->free();
                } else {
                    echo "Error: " . $conn->error;
                }
            } else {
                echo "Error: Unable to connect to the database.";
            }

            // Close connection
           
            ?>
        </table>
    </div>
</body>
</html>
