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

$resource_id = $title = $url = $description = "";
$is_edit = false;

// Handle GET requests (edit or delete operations)
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    if (isset($_GET['id']) && isset($_GET['action'])) {
        $resource_id = $_GET['id'];
        $action = $_GET['action'];

        if ($action == "edit") {
            // Retrieve resource information for editing
            $sql = "SELECT * FROM resources WHERE resource_id = ?";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("i", $resource_id);
                $stmt->execute();
                $result = $stmt->get_result();

                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    $title = $row['title'];
                    $url = $row['url'];
                    $description = $row['description'];
                    $is_edit = true;
                } else {
                    echo "Resource not found.";
                    exit();
                }
            }
        } elseif ($action == "delete") {
            // Delete resource
            $sql = "DELETE FROM resources WHERE resource_id = ?";
            if ($stmt = $conn->prepare($sql)) {
                $stmt->bind_param("i", $resource_id);
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

// Handle POST requests (add or update resource)
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $resource_id = $_POST['resource_id'];
    $title = $conn->real_escape_string($_POST['title']);
    $url = $conn->real_escape_string($_POST['url']);
    $description = $conn->real_escape_string($_POST['description']);

    if (!filter_var($url, FILTER_VALIDATE_URL)) {
        echo "Invalid URL format";
        exit;
    }

    if (!empty($resource_id)) {
        // Update existing resource
        $stmt = $conn->prepare("UPDATE resources SET title = ?, url = ?, description = ? WHERE resource_id = ?");
        $stmt->bind_param("sssi", $title, $url, $description, $resource_id);
    } else {
        // Add new resource
        $stmt = $conn->prepare("INSERT INTO resources (title, url, description) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $title, $url, $description);
    }

    if ($stmt->execute()) {
        header("Location: " . $_SERVER['PHP_SELF']);
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}

// Fetch all resources for display
$sql = "SELECT * FROM resources";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Resources</title>
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
        input[type="text"], input[type="url"], textarea {
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
    <h1>Manage Resources</h1>
    <div class="form-container">
        <h2><?php echo $is_edit ? 'Edit Resource' : 'Add New Resource'; ?></h2>
        <form id="resourceForm" action="" method="POST">
            <input type="hidden" id="resource_id" name="resource_id" value="<?php echo $resource_id; ?>">

            <label for="title">Title:</label>
            <input type="text" id="title" name="title" value="<?php echo $title; ?>" required>

            <label for="url">URL:</label>
            <input type="url" id="url" name="url" value="<?php echo $url; ?>" required>

            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?php echo $description; ?></textarea>

            <button type="submit"><?php echo $is_edit ? 'Update' : 'Submit'; ?></button>
        </form>
    </div>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>URL</th>
                <th>Description</th>
                <th>Created At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if ($result->num_rows > 0): ?>
                <?php while($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo $row['resource_id']; ?></td>
                        <td><?php echo $row['title']; ?></td>
                        <td><?php echo $row['url']; ?></td>
                        <td><?php echo $row['description']; ?></td>
                        <td><?php echo $row['created_at']; ?></td>
                        <td class="actions">
                            <a href="?id=<?php echo $row['resource_id']; ?>&action=edit" class="btn edit-btn">Edit</a>
                            <a href="?id=<?php echo $row['resource_id']; ?>&action=delete" class="btn delete-btn">Delete</a>
                        </td>
                    </tr>
                <?php endwhile; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6">No resources found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <script>
        document.getElementById('resourceForm').addEventListener('submit', function(event) {
            const title = document.getElementById('title').value;
            const url = document.getElementById('url').value;
            const description = document.getElementById('description').value;

            if (title === '' || url === '' || description === '') {
                alert('All fields are required!');
                event.preventDefault();
                return;
            }

            if (!isValidURL(url)) {
                alert('Please enter a valid URL');
                event.preventDefault();
                return;
            }
        });

        function isValidURL(string) {
            var res = string.match(/(https?:\/\/)?([-\w]+\.\w+)(\/[-\w]*)*/i);
            return (res !== null);
        }
    </script>
</body>
</html>

<?php
$conn->close();
?>
