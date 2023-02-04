<?php
session_start();
$logged = false;
if (isset($_SESSION["username"])) {
  $logged = true;
  $username = $_SESSION["username"];
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="./css/style.css" />
  <title>ice creme</title>
</head>

<body>
  <!-- header -->
  <div id="header">
    <div class="img-container">
      <img draggable="false" src="./image/Ice.jpg" alt="ice-bgc" />
    </div>
    <div id="nav_bar" class="nav-bar">
      <h1 id="logo" class="nav-item">
        <a href="#logo">ICE <span> CRUSH</span></a>
      </h1>
      <ul id="menu-bar" class="nav-item">
        <li class="menu-item"><a href="./home.php">Home</a></li>
        <li class="menu-item"><a href="./about_us.php">About Us</a></li>
        <li class="menu-item"><a href="./price.php">Price</a></li>
        <li class="menu-item"><a href="./contact_us.php">Contact Us</a></li>
        <li class="menu-item"><a href="./order.php">Order</a></li>
      </ul>
      <div class="join-container nav-item">
        <?php
        if ($logged) { ?>
          <a href="user_profile_settings.php" class="username-title"><?php echo $username; ?></a>
          <a href="./destroy_session.php" class="join-ice-cream">LOGOUT</a>
        <?php } else { ?>
          <a href="./login.php" class="join-ice-cream">Login</a>
          <a href="./sign-up.php" class="join-ice-cream">Sign-up</a>
        <?php } ?>
      </div>
      <a id="cart-link" href="./cart.php">
        <div id="cartBtn" class="cart-container">
          <img src="./image/shopping-cart.png" alt="shopping-cart" />
        </div>
      </a>
    </div>
  </div>
  <!-- end header -->
  <!-- main content -->
  <div class="content">
    <div class="side-bar content-section">
      <ul class="side-menu">
        <li class=""><a href="#">New Flavors</a></li>
        <li class=""><a href="#">Categories</a></li>
        <li class=""><a href="#">Contact Us</a></li>
        <li class=""><a href="#">Order Now</a></li>
        <li class=""><a href="#">Best Flavors</a></li>
      </ul>
      <img src="./image/ice-3.png" alt="" />
      <img src="./image/ice-4.png" alt="" />
    </div>
    <div class="main content-section">
      <div class="summary-order">
        <h2>Summary Order</h2>
        <span>Order Number : 1221</span>
        <span>Cost Order : 75 LYD</span>
      </div>
      <form id="payment-method" action="/confirm-order" method="post">
        <img src="./image/visa.png" alt="visa" />
        <h2>Payment Method</h2>
        <label for="firstname">First Name</label>
        <input type="text" id="firstname" name="firstname" required />
        <label for="lastname">Last Name</label>
        <input type="text" id="lastname" name="lastname" required />
        <label for="card-number">Card Number</label>
        <input type="text" id="card-number" name="card-number" required />
        <br />
        <label for="expiration-date">Expiration Date</label>
        <input type="text" id="expiration-date" name="expiration-date" required />
        <br />
        <label for="cvv">CVV</label>
        <input type="text" id="cvv" name="cvv" required />
        <br />
        <label for="zip-code">Zip Code</label>
        <input type="text" id="zip-code" name="zip-code" required />
        <br />
        <input type="submit" value="Confirm Order" />
      </form>
    </div>
  </div>
  <!-- end main content -->
  <!-- footer -->
  <div class="footer">
    <span id="copy_right">Copy Rights Reserved.</span>
  </div>
  <!-- end footer -->
</body>

</html>