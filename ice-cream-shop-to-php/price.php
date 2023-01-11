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
    <div class="main main-content">
      <h1 class="title-page">Prices</h1>
      <div class="categories-items">
        <h2>ice cream corn</h2>
        <ul class="ice-cream-menu">
          <li>
            <img src="./image/pro1.jpg" alt="" />
            <span class="flavors">chocolate & strawberry</span>
            <span class="price">5.0 LYD</span>
            <!-- <button type="button" title="buy-now">BUY</button> -->
          </li>
          <li>
            <img src="./image/pro2.jpg" alt="" />
            <span class="flavors">chocolate & strawberry</span>
            <span class="price">5.0 LYD</span>
            <!-- <button type="button" title="buy-now">BUY</button> -->
          </li>
          <li>
            <img src="./image/pro3.jpg" alt="" />
            <span id="flavors">chocolate & strawberry</span>
            <span id="price">5.0 LYD</span>
            <!-- <button type="button" title="buy-now">BUY</button> -->
          </li>
        </ul>
      </div>
      <br />
      <hr />
      <br />
      <div class="categories-items">
        <h2>ice cream corn</h2>
        <ul class="ice-cream-menu">
          <li>
            <img src="./image/pro4.jpg" alt="" />
            <span class="flavors">chocolate & strawberry</span>
            <span class="price">5.0 LYD</span>
            <!-- <button type="button" title="buy-now">BUY</button> -->
          </li>
          <li>
            <img src="./image/pro5.jpg" alt="" />
            <span class="flavors">chocolate & strawberry</span>
            <span class="price">5.0 LYD</span>
            <!-- <button type="button" title="buy-now">BUY</button> -->
          </li>
          <li>
            <img src="./image/pro6.jpg" alt="" />
            <span class="flavors">chocolate & strawberry</span>
            <span class="price">5.0 LYD</span>
            <!-- <button type="button" title="buy-now">BUY</button> -->
          </li>
        </ul>
      </div>
      <br />
      <hr />
      <br />

      <div class="categories-items">
        <h2>ice cream corn</h2>
        <ul class="ice-cream-menu">
          <li>
            <img src="./image/pro7.jpg" alt="" />
            <span class="flavors">chocolate & strawberry</span>
            <span class="price">5.0 LYD</span>
            <!-- <button type="button" title="buy-now">BUY</button> -->
          </li>
          <li>
            <img src="./image/pro8.jpg" alt="" />
            <span class="flavors">chocolate & strawberry</span>
            <span class="price">5.0 LYD</span>
            <!-- <button type="button" title="buy-now">BUY</button> -->
          </li>
          <li>
            <img src="./image/pro9.jpg" alt="" />
            <span class="flavors">chocolate & strawberry</span>
            <span class="price">5.0 LYD</span>
            <!-- <button type="button" title="buy-now">BUY</button> -->
          </li>
        </ul>
      </div>
    </div>
  </div>
  <div class="footer">
    <span id="copy_right">Copy Rights Reserved.</span>
  </div>
</body>

</html>