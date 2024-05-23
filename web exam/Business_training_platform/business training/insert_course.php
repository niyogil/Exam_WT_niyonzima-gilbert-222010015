

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>Instructor DETAILS</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <meta content="" name="keywords">
    <meta content="" name="description">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&family=Red+Rose:wght@600;700&display=swap"
        rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <style>
    body {
    font-family: 'Roboto', sans-serif;
    background-color: #c9daff;
    margin: 0;
    padding: 0;
    display: flex;
    flex-direction: column;
    min-height: 100vh; /* Ensure the body takes up at least the height of the viewport */
}


/* styles.css */

.container {
    max-width: 600px;
    margin: 20px auto;
    background-color: #f9f9f9;
    padding: 30px;
    border-radius: 10px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
}

h1 {
    font-size: 28px;
    color: #333;
    text-align: center;
    margin-bottom: 20px;
}

.form-group {
    margin-bottom: 20px;
}

label {
    display: block;
    font-weight: bold;
    margin-bottom: 5px;
}

input[type="text"],
textarea {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 5px;
    box-sizing: border-box;
    font-size: 16px;
}

textarea {
    resize: vertical; /* Allow vertical resizing */
}

button[type="submit"] {
    background-color: #4caf50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    font-size: 16px;
}

button[type="submit"]:hover {
    background-color: #45a049;
}


.container h1 {
    font-size: 28px;
    color: #333;
    text-align: center;
    margin-bottom: 20px;
}

.container p {
    font-size: 16px;
    color: #555;
    margin-bottom: 10px;
}

.container p strong {
    color: #007bff;
}

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
    color: #fff;
    text-decoration: none;
    font-size: 16px;
}

.nav-links li a:hover {
    text-decoration: underline;
}

    </style>
</head>
<body>
<header>
      <nav class="navbar">
        <a href="index.html" class="navbar-brand">VBSTP</a>
        <ul class="nav-links">
          <li><a href="personal_info.php">Plofile</a></li>
          <li><a href="enrollments.php">Courses</a></li>
          <li><a href="logout.php">Logout</a></li>
          
        </ul>
      </nav>
    </header>

    <section class="main-content">
        <div class="container">
            <h1>Add New Course</h1>
            <form action="insert_course_process.php" method="POST">
                <div class="form-group">
                    <label for="title">Title:</label>
                    <input type="text" id="title" name="title" required>
                </div>
                <div class="form-group">
                    <label for="description">Description:</label>
                    <textarea id="description" name="description" rows="4" required></textarea>
                </div>
                <div class="form-group">
                    <label for="instructorID">Instructor ID:</label>
                    <input type="text" id="instructorID" name="instructorID" required>
                </div>
                <div class="form-group">
                    <label for="link">Link:</label>
                    <input type="text" id="link" name="link" required>
                </div>
                <button type="submit">Add Course</button>
            </form>
        </div>
    </section>
    
<!-- Footer Section -->
<footer class="footer">
      <div class="container2">
        <div class="left-part">
          <p class="mb-0">Designed by Trained Business Experts</p>
          <p class="mb-0">UR, RN1-HUYE</p>
          <p class="mb-0">contact@businessplatform.com</p>
          <p class="mb-0">+250 787109054</p>
        </div>
        <div class="right-part">
          <p class="mb-0">© 2024 Busuness Strategy Platform. All rights reserved.</p>
          <p class="mb-0">Designed by: <a href="#" target="_blank" class="fw-bold">Gilbert</a></p>
          <p class="mb-0">Distributed by: <a href="#" target="_blank" class="fw-bold">Gilbert</a></p>
        </div>
      </div>
    </footer>

<!-- JavaScript Libraries -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
<script src="lib/wow/wow.min.js"></script>
<script src="lib/easing/easing.min.js"></script>
<script src="lib/waypoints/waypoints.min.js"></script>
<script src="lib/counterup/counterup.min.js"></script>
<script src="lib/owlcarousel/owl.carousel.min.js"></script>

<!-- Javascript -->
<script src="js/main.js"></script>
</body>
</html>
