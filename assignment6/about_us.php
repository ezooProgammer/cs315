<?php
session_start();
$logged = false;
if (isset($_SESSION["username"])) {
  $logged = true;
  $username = $_SESSION["username"];
  $cart_item_count = $_SESSION["cart_item_count"];
} else {
  header("location:login.php");
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
          <span class="cart-item-count"><?= $cart_item_count ?></span>
        </div>
      </a>
    </div>
  </div>
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
      <h1 id="about-title" class="title-page">About</h1>
      <div class="about-describe">
        <h2>our story</h2>
        <p>
          Ice Crush is an award winning creative design agency. <br />

          You will find the "Contact" page at the top of the list under the
          "Lists" section.
        </p>
      </div>
      <div class="our-team">
        <h2 class="our-team-label">our team</h2>
        <div class="team-member">
          <img src="./image/person3.jfif" alt="" />
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
        </div>
        <div class="team-member">
          <img src="./image/person3.jfif" alt="" />
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
        </div>
        <div class="team-member">
          <img src="./image/person3.jfif" alt="" />
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
          <p>Lorem ipsum dolor sit amet consectetur adipisicing elit</p>
        </div>
      </div>
    </div>
  </div>
  <div class="footer">
    <span id="copy_right">Copy Rights Reserved.</span>
  </div>
</body>

</html>