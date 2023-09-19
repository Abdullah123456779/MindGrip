<?php
session_start();
include("db.php");

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $Email = $_POST['email'];
    $password = $_POST['password'];

    // Check if the database connection was established successfully
    if (!$con) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Prepare an SQL statement to check the credentials
    $query = "SELECT `Full Name` FROM signup WHERE Email = ? AND Password = ?";
    $stmt = mysqli_prepare($con, $query);

    // Check if the statement was prepared successfully
    if ($stmt) {
        // Bind parameters
        mysqli_stmt_bind_param($stmt, "ss", $Email, $password);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            // Bind the result to a variable
            mysqli_stmt_bind_result($stmt, $fullName);

            // Fetch the result
            if (mysqli_stmt_fetch($stmt)) {
                // Login successful; store user information in the session
                $_SESSION['loggedIn'] = true;
                $_SESSION['email'] = $Email;

                // Redirect to a dashboard or another page
                header("Location: prodacts.php");
                exit;
            } else {
                echo "<script type='text/javascript'>alert('Incorrect email or password. Please try again.')</script>";
            }
        } else {
            echo "<script type='text/javascript'>alert('Error: " . mysqli_error($con) . "')</script>";
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    } else {
        // Handle statement preparation error
        echo "<script type='text/javascript'>alert('Error in preparing the statement: " . mysqli_error($con) . "')</script>";
    }
} else {
    // Handle other cases or provide feedback to the user
}
?>

    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <!-- Link to your external CSS file (mindgrips.css) -->
        <link rel="stylesheet" type="text/css" href="styleHome.css">
        <title>MindGrips - Sign In</title>
    </head>
    <body>
        <!-- Navigation Bar -->
        <nav class="navbar">
            <ul>
                <li><a href="mindgrips.php">Home</a></li>
                <li><a href="signup.php">Sign Up</a></li>
                <li><a href="signin.php">Sign In</a></li>
                <li><a href="contact.php">Contact Us</a></li>
            </ul>
        </nav>

        <!-- Header -->
        <header>
            <h1>Sign In to MindGrips</h1>
        </header>

        <!-- Main Content -->
        <div class="main-content">
            <form method="POST" class="signin-form">
                
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>

                <button class="signin-button"  type="submit">Log in</button>
            
            </form>
        </div>

        <!-- Footer -->
        <footer>
            <!-- Footer content here -->
        </footer>
    </body>
    </html>