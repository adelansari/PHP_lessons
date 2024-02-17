<?php
    // this is the associative array for our shopping cart 
    $cart = [];

    $errorMessage = '';
    $secondsPerDay = 24 * 60 * 60;
    $days = 30;

    // check if the cookie for shopping cart has been set (you can choose the name)
    // if it's been set, overwrite $cart variable with it. The easiest way to switch between array and string is to use JSON.
    // so e.g. $cart = json_decode($_COOKIE["cart"], true);

    if (isset($_COOKIE["cart"])) {
        $cart = json_decode($_COOKIE["cart"], true);
    }

    // check if the add form has been sent
    // if yes, add the new product to the $cart array and send the updated cookie
    // let's use JSON again, so e.g. $json = json_encode($cart);
    
    if (isset($_POST["addproduct"])) {
        $productname = $_POST["productname"];
        $productamount = $_POST["productamount"];
        
        if ($productamount > 0 && is_numeric($productamount)) {
            $cart[$productname] = intval($productamount);
            $json = json_encode($cart);
            setcookie("cart", $json, time() + ($secondsPerDay * $days));
        } else {
            $errorMessage = "Error: Amount must be a positive number.";
        }
    }

    // check if the empty cart button has been pressed (key "emptycart" - the button's name attribute - exists in $_POST array)
    // if yes, empty the $cart array and set a new cookie that's set to expire in the past

    if (isset($_POST["emptycart"])) {
        $cart = [];
        setcookie("cart", "", time() - 3600);
    }
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">

        <form action="shoppingcart.php" method="post">
            <p>Choose product (choosing the same product will overwrite old entry):</p>
            <p><label for="productname">Product name:</label><br>
                <select id="productname" name="productname">
                    <option value="Book">Book</option>
                    <option value="Computer">Computer</option>
                    <option value="Phone">Phone</option>
                </select>
            </p>
            <p><label for="productamount">Amount:</label><br>
                <input type="text" id="productamount" name="productamount">
            </p>
            <p class="error"><?php echo $errorMessage; ?></p>
            <p><input type="submit" name="addproduct" value="Add to cart"></p>
        </form>
    
        <h3>Current shopping cart</h3>
        <div id="cart">
            <?php
                // print the contents of the cart here (loop through the $cart array's key - value pairs)
                // print e.g. 1 x Book
        
                foreach ($cart as $productname => $productamount) {
                    echo $productamount . " x " . $productname . "<br>";
                }
        
                // Here's a fun little function: empty($cart) will tell you if the $cart array is empty
                // if you check for emptiness before looping, then you could print e.g. "No items." if there's nothing in the cart
        
                if (empty($cart)) {
                    echo "No items.";
                }
        
            ?>
        
            <form action="shoppingcart.php" method="post">
                <input type="submit" id="emptycart" name="emptycart" value="Empty cart">
            </form>
        </div>
    </div>
</body>
</html>