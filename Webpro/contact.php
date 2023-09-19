<?php
require("db.php");

if($_SERVER['REQUEST_METHOD']=='POST'){
$sql="INSERT INTO login (username,password) values (:username,:password)";
$statement=$pdo->prepare($sql);
$username=$_POST['username']; 
$Email=$_POST['Email'];
$message=$_POST['message'];

$statement->bindParam(":username",$username,PDO::PARAM_STR);
$statement->bindParam(":Email",$Email,PDO::PARAM_STR);
$statement->bindParam(":message",$message,PDO::PARAM_STR);
$statement->execute();

echo "thank you for sharing ";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link to your external CSS file (mindgrips.css) -->
    <link rel="stylesheet" type="text/css" href="styleHome.css">
    <title>MindGrips - Contact Us</title>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <ul>
            <li><a href="mindgrips.php">Home</a></li>
        </ul>
    </nav>

    <!-- Header -->
    <header>
        <h1>Contact MindGrips</h1>
    </header>

    <!-- Main Content -->
    <div class="main-content">
        <p>If you have any questions or feedback, please feel free to contact us using the form below:</p>
    </div>
        <form class="co">
            <div class="fg">
                <label for="username">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>

            <div class="form-group">
                <label for="Email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" required></textarea>
            </div>

            <button class="submit-button" type="submit">Submit</button>
        </form>

        <!-- Contact Information -->
        <div class="cn">
            <p>Follow us on Instagram: <a href="https://www.instagram.com/mindgrips/">@abood_mindgrip</a></p>
            <p>Contact us at: <a href="tel:+1234567890">+962 77596764</a></p>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <!-- Footer content here -->
    </footer>
</body>
</html>