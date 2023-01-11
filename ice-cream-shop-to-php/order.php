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
          <span class="username-title"><?php echo $username; ?></span>
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
      <h1 class="order-icecream-title">Order Your Ice Cream</h1>
      <div class="order-container">
        <form action="cart.php" method="post">
          <div class="prd-order">
            <img class="prd-order-img" src="image/cup-1.jpg" alt="cup-ice" />
            <label for="ice-cup-price">ice cream cup</label>
            <input class="prd-qty" type="number" name="cup-qty" value="0" placeholder="quantity" />
            <label class="flavor-label" for="ice-cup-flavor">Flavor</label>
            <select name="ice-cup-flavor" id="ice-cup-flavor">
              <option value="chocolate">chocolate</option>
              <option value="vanilla">vanilla</option>
              <option value="fraise">fraise</option>
            </select>
            <input type="checkbox" placeholder="ice-cream" id="ice-cup-price" name="ice-cup-price" value="5" />
            <input type="text" placeholder="ice cream" name="ice-cream-cup" value="ice cream cup" hidden="true" />
            <span>price 5 LYD</span>
          </div>
          <!--  -->
          <div class="prd-order">
            <img class="prd-order-img" src="image/stick-1.jpg" alt="stick-ice" />
            <label for="ice-stick-price">ice cream stick</label>
            <input class="prd-qty" type="number" name="stick-qty" value="0" placeholder="quantity" />
            <label class="flavor-label" for="ice-stick-flavor">Flavor</label>
            <select name="ice-stick-flavor" id="ice-stick-flavor">
              <option value="chocolate">chocolate</option>
              <option value="vanilla">vanilla</option>
              <option value="fraise">fraise</option>
            </select>
            <input type="checkbox" placeholder="ice-cream" id="ice-stick-price" name="ice-stick-price" value="6" />
            <input type="text" placeholder="ice cream" name="ice-cream-stick" value="ice cream stick" hidden="true" />
            <span>price 6 LYD</span>
          </div>
          <!--  -->
          <div class="prd-order">
            <img class="prd-order-img" src="image/corn-1.jpg" alt="corn-ice" />
            <label for="ice-corn-price">ice cream corn</label>
            <input class="prd-qty" type="number" name="corn-qty" value="0" placeholder="quantity" />
            <label class="flavor-label" for="ice-corn-flavor">Flavor</label>
            <select name="ice-corn-flavor" id="ice-corn-flavor">
              <option value="chocolate">chocolate</option>
              <option value="vanilla">vanilla</option>
              <option value="fraise">fraise</option>
            </select>
            <input type="checkbox" placeholder="ice-cream" id="ice-corn-price" name="ice-corn-price" value="7" />
            <input type="text" placeholder="ice cream" name="ice-cream-corn" value="ice cream corn" hidden="true" />
            <span>price 7 LYD</span>
          </div>
          <!--  -->
          <input type="submit" name="order" class="order-btn" value="order" />
        </form>
      </div>
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