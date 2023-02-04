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
  <!-- header -->
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
      <h1 class="title-page">Contact Us</h1>
      <div class="contact-services">
        <div class="contact-way" id="contact-email">
          <span>Email</span>
          <a href="#">ice_crush_shop@mail.com</a>
        </div>
        <div class="contact-way" id="contact-phone">
          <span>Phone Number</span>
          <a href="#">+218928292482</a>
        </div>
        <div class="contact-way" id="contact-address">
          <span>Address</span>
          <a href="#">Tripoli/El-drebie</a>
        </div>
      </div>
      <div class="map-shop">
        <h2>Location Map</h2>
        <img src="./image/map.jpg" alt="map" />
      </div>
      <div class="contact-form">
        <h2>Mail us</h2>
        <form action="">
          <input type="email" placeholder="your contact email here..." />
          <br />
          <textarea name="describe" id="describe" cols="30" rows="10" placeholder="your opinion..."></textarea>
          <br />
          <button type="button" title="contactUs">Send</button>
        </form>
      </div>
    </div>
  </div>
  <div class="footer">
    <span id="copy_right">Copy Rights Reserved.</span>
  </div>
</body>

</html>