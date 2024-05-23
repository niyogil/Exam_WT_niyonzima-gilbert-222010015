<?php
session_start();

// Include database connection file
require_once "config.php";



// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Query to fetch courses from the database
$sql = "SELECT CourseID, Title, Description, Link FROM courses";
$result = $conn->query($sql);


// Function to insert achievement into the database
function insertAchievement($conn, $userID) {
    // Achievement name
    $achievementName = "Completion of courses";

    // Achievement date (current timestamp)
    $achievementDate = date("Y-m-d H:i:s");

    // Prepare and execute SQL statement
    $stmt = $conn->prepare("INSERT INTO archivements (UserID, ArchivementName, ArchivementDate) VALUES (?, ?, ?)");
    $stmt->bind_param("iss", $userID, $achievementName, $achievementDate);
    $stmt->execute();
    $stmt->close();
}

// Check if UserID is set and not empty
if (isset($_POST['userID']) && !empty($_POST['userID'])) {
    // Get UserID from POST data
    $userID = $_POST['userID'];

    // Call the function to insert achievement
    insertAchievement($conn, $userID);

    // Redirect to the same page or any other page as needed
    // header("Location: your_page.php");
    // exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business strategy Training Dashboard</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="styles.css">
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            margin-top: 50px;
            width: 200%;
        }
        .card-container {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            width: 100%;
        }
        .card h5{
            color: black;
            text-align: center;
            font-weight: bold;
            font-size: 25px;
        }
        .card {
            margin: 10px;
            width: 300px;
            background-color: #ffc107; /* Default background color */
        }
        .card:nth-child(2n) {
            background-color: #17a2b8; /* Alternate background color */
        }
        .card-body {
            color: #fff;
        }
        .btn-finish {
            margin-top: 20px;
            width: 50%;
            margin-left:270px;
            margin-bottom: 20px;
        }
        /* Footer styles */

        .footer {
    background-color: #5cc4cd;
    padding: 20px;
    margin-top: auto;
}

.footer .container2 {
    display: flex;
    justify-content: space-between;
}

.footer .container2 .left-part p,
.footer .container2 .right-part p {
    font-size: 14px;
    color: #170101;
    margin-bottom: 5px;
}

.footer .container2 .right-part p a {
    color: #007bff;
    text-decoration: none;
    font-weight: bold;
}

.navbar {
    background-color: #007bff;
    padding: 10px 0;
}

.navbar-brand {
    color: #fff;
    font-size: 24px;
    text-decoration: none;
    margin-left: 20px;
}

.nav-links {
    list-style: none;
    padding: 0;
    margin: 0;
}

.nav-links li {
    display: inline;
    margin-left: 20px;
}

.nav-links li a {
    color: black;
    text-decoration: none;
    font-size: 16px;
    margin-right: 5px;
}


.nav-links li a:hover {
    text-decoration: underline;
}

  
    </style>
</head>
<!-- Navigation Bar -->

<header>
      <nav class="navbar">
        <a href="index.html" class="navbar-brand">VBSTP</a>
        <ul class="nav-links">
          <li><a href="personal_info.php">Plofile</a></li>
          <li><a href="enrollments.php">Courses</a></li>
          <li><a href="transaction_history.php">Transactions</a></li>
          <li><a href="settings.php">Update</a></li>
          <li><a href="assessment.php">Assessments</a></li>
          <li><a href="payment.html">Pay</a></li>
          <li><a href="course_dashboard.php">Study</a></li>
          <li><a href="goal.php">Goals</a></li>
          <li><a href="resources.php">Resources</a></li>
          <li><a href="feedback.php">Rate Us</a></li>
          <li><a href="logout.php">Logout</a></li>
          
        </ul>
      </nav>
    </header>
    <body>
    <div class="container">
        <h1 class="text-center">Business strategy Training Dashboard</h1>
        <a href="insert_enrollment.php" class="nav-item nav-link" style="color: rgb(255, 0, 136); background-color: cyan; text-align:center;">Befor you start, Enroll Now</a>
        <div class="card-container">
            <?php
            if ($result->num_rows > 0) {
                // Output data of each row
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title"><?php echo $row["Title"]; ?></h5>
                            <p class="card-text"><?php echo $row["Description"]; ?></p>
                            <button class="btn btn-primary start-course" data-link="<?php echo $row["Link"]; ?>">Start Course</button>
                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "No courses found";
            }
            ?>
        </div>
        
        <button class="btn btn-success btn-finish" data-toggle="modal" data-target="#finishModal">Finish</button>
    </div>
    
    <!-- Modal for Finish -->
<div class="modal fade" id="finishModal" tabindex="-1" role="dialog" aria-labelledby="finishModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="finishModalLabel">Finish and Insert Achievement</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="achievementForm" method="post" action="">
                    <div class="form-group">
                        <label for="userID">Enter Your UserID:</label>
                        <input type="text" class="form-control" id="userID" name="userID" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Insert Achievement</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <!-- Modal for Video -->
    <div class="modal fade" id="videoModal" tabindex="-1" role="dialog" aria-labelledby="videoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="videoModalLabel">Course Video</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div id="videoContainer"></div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <script>
        $(document).ready(function() {
    $(".start-course").click(function() {
        var videoLink = $(this).data("link");
        var videoId = extractVideoId(videoLink);
        var embedUrl = 'https://www.youtube.com/embed/' + videoId;
        $("#videoContainer").html('<iframe width="100%" height="400" src="' + embedUrl + '" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>');
        $("#videoModal").modal("show");
    });
});

function extractVideoId(url) {
    var regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
    var match = url.match(regExp);
    return (match && match[7].length === 11) ? match[7] : false;
}

    </script>
    <!-- Footer Section -->
    <footer class="footer">
      <div class="container2">
        <div class="left-part">
          <p class="mb-0">Designed by Business trained Experts</p>
          <p class="mb-0">UR, RN1-HUYE</p>
          <p class="mb-0">contact@businessplatform.com</p>
          <p class="mb-0">+250 78546 890</p>
        </div>
        <div class="right-part">
          <p class="mb-0">© 2024 Business strategy Platform. All rights reserved.</p>
          <p class="mb-0">Designed by: <a href="#" target="_blank" class="fw-bold">Gilbert</a></p>
          <p class="mb-0">Distributed by: <a href="#" target="_blank" class="fw-bold">Gilbert</a></p>
        </div>
      </div>
    </footer>
</body>
</html>

<?php
// Close connection
$conn->close();
?>