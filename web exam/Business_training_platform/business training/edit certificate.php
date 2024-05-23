<?php
// Database connection
$servername = "localhost"; // Change if necessary
$username = "root"; // Change if necessary
$password = ""; // Change if necessary
$dbname = "tutu";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$id = $name = $course = $date = "";
$is_edit = false;

// Handle GET requests (edit or delete operations)
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['id']) && isset($_GET['action'])) {
        $id = $_GET['id'];
        $action = $_GET['action'];

        if ($action == "edit") {
            // Retrieve certificate information for editing
            $sql = "SELECT * FROM certificates WHERE id = ?";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("i", $id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    $name = $row['name'];
                    $course = $row['course'];
                    $date = $row['date'];
                    $is_edit = true;
                } else {
                    echo "Certificate not found.";
                    exit();
                }
            }
        } elseif ($action == "delete") {
            // Delete certificate
            $sql = "DELETE FROM certificates WHERE id = ?";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("i", $id);
                if ($stmt->execute()) {
                    header("Location: " . $_SERVER['PHP_SELF']);
                    exit();
                } else {
                    echo "Error deleting record: " . $stmt->error;
                }
            }
        }
    }
}

// Handle POST requests (add or update certificate)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $name = $conn->real_escape_string($_POST['name']);
    $course = $conn->real_escape_string($_POST['course']);
    $date = $conn->real_escape_string($_POST['date']);

    if (!empty($id)) {
        // Update existing certificate
        $stmt = $conn->prepare("UPDATE certificates SET name = ?, course = ?, date = ? WHERE id = ?");
        $stmt->bind_param("sssi", $name, $course, $date, $id);
    } else {
        // Add new certificate
        $stmt = $conn->prepare("INSERT INTO certificates (name, course, date) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $course, $date);
    }

    if ($stmt->execute()) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch all certificates for display
$sql = "SELECT * FROM certificates";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Certificates</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 10px;
            border: 1px solid #ddd;
        }
        th {
            background-color: #f4f4f4;
        }
        .actions {
            display: flex;
            gap: 10px;
        }
        .btn {
            padding: 5px 10px;
            text-decoration: none;
            color: #fff;
            border-radius: 3px;
        }
        .edit-btn {
            background-color: #4caf50;
        }
        .delete-btn {
            background-color: #f44336;
        }
        body {
            font-family: Arial, sans-serif;
            margin: 20px;
        }
        .form-container {
            margin: 20px 0;
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }
        input[type="text"], input[type="date"], textarea {
            width: 100%;
            padding: 8px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
        }
        button {
            width: 100%;
            padding: 10px;
            background: #28a745;
            color: #fff;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            font-size: 16px;
        }
        button:hover {
            background: #218838;
        }
    </style>
</head>
<body>
    <h1>Manage Certificates</h1>
    <div class="form-container">
        <h2><?php echo $is_edit ? 'Edit Certificate' : 'Add New Certificate'; ?></h2>
        <form id="certificateForm" action="" method="POST">
            <input type="hidden" id="id" name="id" value="<?php echo $id; ?>">

            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo $name; ?>" required>

            <label for="course">Course:</label>
            <input type="text" id="course" name="course" value="<?php echo $course; ?>" required>

            <label for="date">Date:</label>
            <input type="date" id="date" name="date" value="<?php echo $date; ?>" required>

            <button type="submit"><?php echo $is_edit ? 'Update' : 'Submit'; ?></button>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Course</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo $row['name']; ?></td>
                        <td><?php echo $row['course']; ?></td>
                        <td><?php echo $row['date']; ?></td>
                        <td class="actions">
                            <a href="?id=<?php echo $row['id']; ?>&action=edit" class="btn edit-btn">Edit</a>
                            <a href="?id=<?php echo $row['id']; ?>&action=delete" class="btn delete-btn" onclick="return confirm('Are you sure you want to delete this certificate?')">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5">No certificates found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</body>
</html>

<?php
$conn->close();
?>
