<?php
session_start();
include("db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['full-name'];
    $Email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the database connection was established successfully
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare an SQL statement
    $query = "INSERT INTO signup (`Full Name`, Email, Password) VALUES (?, ?, ?)";
    $stmt = mysqli_prepare($con, $query);

    // Check if the statement was prepared successfully
    if ($stmt) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "sss", $username, $Email, $password);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            echo "<script type ='text/javascript'> alert ('Successfully signed up, now you can go to sign in page')</script>";
        } else {
            echo "<script type ='text/javascript'> alert ('Error: " . mysqli_error($con) . "')</script>";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Handle statement preparation error
        echo "<script type ='text/javascript'> alert ('Error in preparing the statement: " . mysqli_error($con) . "')</script>";
    }
} else {
    // Handle other cases or provide feedback to the user
}
?>


<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link to your external CSS file (mindgrips.css) -->
    <link rel="stylesheet" type="text/css" href="styleHome.css">
    <title>MindGrips - Sign Up</title>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <ul>
            <li><a href="mindgrips.php">Home</a></li>
            <li><a href="signin.php">Sign In</a></li>
            <li><a href="contact.php">Contact Us</a></li>
        </ul>
    </nav>

    <!-- Header -->
    <header>
        <h1>Sign Up for MindGrips</h1>
    </header>

    <!-- Main Content -->
   
    <div class="main-content">
        
        <form method="POST"  class="signup-form">
             <div class="form-group">
                <label for="username">Full Name:</label>
                <input type="text" id="full-name" name="full-name" required>
            </div>

            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>

            <div class="form-group">
                <label for="confirm-password">Confirm Password:</label>
                <input type="password" id="confirm-password" name="confirm-password" required>
            </div>

            <button class="signup-button" harf="signin.php" type="submit">Sign Up</button>
        </form>
    </div>

    <!-- Footer -->
    <footer>
        <!-- Footer content here -->
    </footer>

    <!-- JavaScript for form validation (you can add this) -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const signupForm = document.querySelector(".signup-form");

            signupForm.addEventListener("submit", function (event) {
                const password = document.getElementById("password").value;
                const confirmPassword = document.getElementById("confirm-password").value;

                if (password !== confirmPassword) {
                    alert("Passwords do not match. Please try again.");
                    event.preventDefault();
                }
            });
        });
    </script>
</body>
</html>