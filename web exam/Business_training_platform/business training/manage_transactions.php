<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Transaction</title>
    <link rel="stylesheet" href="styles.css">
    <style>
        /* Table Styles */
        .styled-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.15);
        }

        .styled-table thead th {
            background-color: #007bff;
            color: #fff;
            font-weight: bold;
            text-align: left;
            padding: 12px;
        }

        .styled-table tbody td {
            padding: 12px;
            border-bottom: 1px solid #ddd;
        }

        .styled-table tbody tr:nth-child(even) {
            background-color: #f2f2f2;
        }

        .styled-table tbody tr:hover {
            background-color: #e0e0e0;
        }

        .styled-table tbody td a {
            text-decoration: none;
            color: #007bff;
            cursor: pointer;
            margin-right: 10px;
        }
    </style>
</head>
<body>

    <!-- Table to display user information -->
    <table class="styled-table">
        <thead>
            <tr>
                <th>Transaction ID</th>
                <th>User ID</th>
                <th>Amount</th>
                <th>Category</th>
                <th>Transaction Date</th>
                <th>Notes</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Include database connection file
            require_once "config.php";

            // Retrieve all enrollments from the database
            $sql = "SELECT * FROM transactions";
            $result = $conn->query($sql);

            // Check if users exist
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["TransactionID"] . "</td>";
                    echo "<td>" . $row["UserID"] . "</td>";
                    echo "<td>" . $row["Amount"] . "</td>";
                    echo "<td>" . $row["Category"] . "</td>";
                    echo "<td>" . $row["TransactionDate"] . "</td>";
                    echo "<td>" . $row["Notes"] . "</td>";
                    echo "<td>";
                    // Add action buttons (Edit and Delete)
                    echo "<a href='delete_transactions.php?id=" . $row["TransactionID"] . "' onclick='return confirm(\"Are you sure you want to delete this Transaction?\")'>Delete</a>";
                    echo "</td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>No users found.</td></tr>";
            }

            // Close database connection
            
            ?>
        </tbody>
    </table>
</body>
</html>
