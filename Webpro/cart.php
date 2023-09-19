<?php
require("db.php");

// Check if productId is received from the POST request
if (isset($_POST['productId'])) {
    $productId = $_POST['productId'];

    // TODO: Implement a database query to remove the product with $productId

    // Check if the database query was successful
    if ($conn->query(/*your delete query here*/)) {
        $response = ["success" => true];
    } else {
        $response = ["success" => false];
    }

    // Return a JSON response
    echo json_encode($response);
} else {
    // Handle the case where productId is not provided in the request
    echo json_encode(["success" => false]);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Link to your external CSS file (mindgrips.css) -->
    <link rel="stylesheet" type="text/css" href="styleHome.css">
    <title>MindGrips - View Cart</title>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar">
        <ul>
            <li><a href="prodacts.php">Home</a></li>
            <li><a href="contact.php">Contact Us</a></li>
        </ul>
    </nav>

    <!-- Header -->
    <header>
        <div class="header-content">
            <img src="logo.png" alt="MindGrips Logo" class="logo">
            <h1>MindGrips</h1>
        </div>
    </header>

    <!-- Cart Content -->
    <div class="main-content">
        <h2>Your Shopping Cart</h2>
        <!-- Display cart items here -->
        <?php
    // Fetch products from the database based on the cart items
    $cart = []; // You need to populate this array with product IDs from the cart
    if (!empty($cart)) {
        $cartIds = implode(',', $cart);
        $query = "SELECT * FROM `products` WHERE `product_id` IN ($cartIds)";
        $result = mysqli_query($conn, $query);

        if ($result) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='cart-item' data-product-id='" . $row['product_id'] . "'>";
                echo "<img src='" . $row['image_url'] . "' alt='" . $row['product_name'] . "'>";
                echo "<h3>" . $row['product_name'] . "</h3>";
                echo "<p>Price: $" . $row['price'] . "</p>";
                echo "<button class='remove-from-cart' data-product-id='" . $row['product_id'] . "'>Remove</button>";
                echo "</div>";
            }
        } else {
            echo "Error fetching cart items: " . mysqli_error($conn);
        }
    } else {
        echo "<p>Your cart is empty.</p>";
    }
    ?>
    </div>

    <!-- Continue Shopping Link -->
    <div class="cart-link">
        <a href="prodacts.php">Continue Shopping</a>
    </div>

    <!-- JavaScript for removing items from the cart -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const removeFromCartButtons = document.querySelectorAll(".remove-from-cart");
            const cartItems = document.querySelectorAll(".cart-item");
            let cart = []; // Initialize the cart array with product IDs

            // Function to remove a product from the cart
            function removeFromCart(productId) {
                // Find the index of the product in the cart array
                const index = cart.indexOf(productId);
                if (index !== -1) {
                    // Remove the product from the cart array
                    cart.splice(index, 1);
                    // Update the cart display by removing the corresponding cart item
                    const cartItem = document.querySelector(`[data-product-id="${productId}"]`);
                    if (cartItem) {
                        cartItem.remove();
                    }
                }
            }

            removeFromCartButtons.forEach((button) => {
                button.addEventListener("click", function () {
                    const productId = button.getAttribute("data-product-id");
                    removeFromCart(productId);
                });
            });

            // Initialize the cart array with product IDs from the displayed items
            cartItems.forEach((cartItem) => {
                const productId = cartItem.getAttribute("data-product-id");
                cart.push(productId);
            });
        });
    </script>
</body>
</html>