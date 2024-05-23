<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Course</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #87CEEB; /* Sky blue background */
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        
        h2 {
            color: #333;
            text-align: center;
            margin-bottom: 20px;
        }
        
        form {
            background-color: #D3D3D3; /* Grey background for container */
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            padding: 20px;
            max-width: 400px;
            width: 100%;
            margin: 20px;
        }
        
        label {
            display: block;
            margin-bottom: 5px;
            color: #333;
        }
        
        input[type="text"],
        textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
            font-size: 14px;
        }
        
        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 4px;
            padding: 10px 20px;
            cursor: pointer;
            font-size: 16px;
            width: 100%;
        }
        
        input[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <div>
        <h2>Add Course</h2>
        <form action="add_course_process.php" method="post">
            <div>
                <label for="title">Title</label>
                <input type="text" id="title" name="title" required>
            </div>
            <div>
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="3" required></textarea>
            </div>
            <div>
                <label for="instructor_id">Instructor ID</label>
                <input type="text" id="instructor_id" name="instructor_id" required>
            </div>
            <div>
                <label for="link">Link</label>
                <input type="text" id="link" name="link" required>
            </div>
            <div>
                <label for="course_name">Course Name</label>
                <input type="text" id="course_name" name="course_name" required>
            </div>
            <div>
                <input type="submit" value="Add Course">
            </div>
        </form>
    </div>
</body>
</html>
