<?php
// Include database connection file
require_once "config.php";

// Check if user ID is provided
if (isset($_GET['id'])) {
    // Get user ID from the URL parameter
    $user_id = $_GET['id'];

    // Retrieve user information from the database
    $sql = "SELECT * FROM users WHERE UserID = ?";
    if ($stmt = $conn->prepare($sql)) {
        // Bind user ID as parameter
        $stmt->bind_param("i", $user_id);

        // Execute the statement
        $stmt->execute();

        // Store result
        $result = $stmt->get_result();

        // Check if user exists
        if ($result->num_rows == 1) {
            // Fetch user data
            $row = $result->fetch_assoc();
            $username = $row['Username'];
            $email = $row['Email'];
            $password = $row['Password'];
            $dateJoined = $row['DateJoined'];
            // You can fetch other fields here and use them in your form

            // Close statement
            $stmt->close();
        } else {
            echo "User not found.";
            exit();
        }
    }

    // Close connection
    $conn->close();
} else {
    // If user ID is not provided, redirect back to the manage_users.php page
    header("location: manage_users.php");
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

    </style>
</head>
<body>
    <h2>Edit User</h2>
    <form action="update_user.php" method="post">
        <input type="hidden" name="user_id" value="<?php echo $user_id; ?>">
        <div>
            <label>UserID</label>
            <input type="text" name="user_id" value="<?php echo $user_id; ?>" readonly>
        </div>
        <div>
            <label>Username</label>
            <input type="text" name="username" value="<?php echo $username; ?>" required>
        </div>
        <div>
            <label>Email</label>
            <input type="email" name="email" value="<?php echo $email; ?>" required>
        </div>
        <div>
            <label>Password</label>
            <input type="password" name="password" value="<?php echo $password; ?>" required>
        </div>
        <div>
            <label>Date Joined</label>
            <input type="text" name="date_joined" value="<?php echo $dateJoined; ?>" readonly>
        </div>
        <!-- You can add fields for other user information here -->
        <div>
            <input type="submit" value="Update">
        </div>
    </form>
</body>
</html>