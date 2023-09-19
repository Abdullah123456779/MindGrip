<?php
include("db.php"); // Include your database connection

// Fetch products from the database
$query = "SELECT * FROM `products`";
$result = mysqli_query($con, $query);

// Initialize an empty cart array or retrieve it if it exists in the session
$cart = [];
if (isset($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];
}

// Close the database connection
mysqli_close($con);



?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link to your external CSS file (mindgrips.css) -->
    <link rel="stylesheet" type="text/css" href="styleHome.css">
    <title>MindGrips - Products</title>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <ul>
            <li><a href="mindgrips.php">Home</a></li>
            <li><a href="contact.php">Contact Us</a></li>
            <li><a href="cart.php">Cart</a></li>
            <li><a href="signout.php">Sign out</a></li>
            
           
        </ul>
    </nav>
    <div class="main-content">
        <h4>Our Products</h4>
    <!-- Header -->
    <header>
        <div class="header-content">
            <img src="logo.png" alt="MindGrips Logo" class="logo">
            <h1>MindGrips</h1>
        </div>
    </header>
     <!-- Display products fetched from the database -->
     <?php
        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='product'>";
                echo "<img src='" . $row['image_url'] . "' alt='" . $row['product_name'] . "'>";
                echo "<h3>" . $row['product_name'] . "</h3>";
                echo "<p>Description: " . $row['description'] . "</p>";
                echo "<p>Price: $" . $row['price'] . "</p>";
                echo "<label for='quantity'>Quantity:</label>";
                echo "<input type='number' id='quantity' name='quantity' value='1' min='1'>";
                echo "<button class='add-to-cart' data-product-id='" . $row['product_id'] . "'>Add to Cart</button>";
                echo "</div>";

                echo "<button class='remove-from-cart' data-product-id='" . $row['product_id'] . "'>Remove Item</button>";
            }
        } else {
            echo "Error fetching products: " . mysqli_error($con);
        }
        ?>
        
    <div class="product-container">
        <!-- Add a black line separator -->

    <!-- Main Content -->
    
    <!-- Shopping Cart Link -->
    <div class="cart-link">
        <!-- Update this link to the actual cart page URL -->
        <a href="cart.php">View Cart</a>
    </div>

    <!-- Footer -->
    <footer>
        <!-- Footer content here -->
    </footer>

   <!-- JavaScript for adding products to the cart -->
   <script>
document.addEventListener("DOMContentLoaded", function () {
    const addToCartButtons = document.querySelectorAll(".add-to-cart");
    const removeFromCartButtons = document.querySelectorAll(".remove-from-cart"); // Select remove buttons
    let cart = []; // Initialize an empty cart array

    // Function to add a product to the cart
    function addToCart(productId) {
        cart.push(productId);
        updateCartLink();
    }

    // Function to remove a product from the cart
    function removeFromCart(productId) {
        const index = cart.indexOf(productId);
        if (index !== -1) {
            cart.splice(index, 1);
            updateCartLink();
        }
    }

    // Function to update the cart link
    function updateCartLink() {
        const cartLink = document.querySelector(".cart-link");
        const itemCount = cart.length;

        if (itemCount > 0) {
            cartLink.textContent = `View Cart (${itemCount})`;
            cartLink.href = "cart.php";
        } else {
            cartLink.textContent = "Cart is Empty";
            cartLink.href = "#";
        }
    }

    addToCartButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const productId = button.getAttribute("data-product-id");
            addToCart(productId);
        });
    });

    // Add event listeners for remove buttons
    removeFromCartButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const productId = button.getAttribute("data-product-id");
            removeFromCart(productId);
        });
    });
});
</script>
</body>
</html>