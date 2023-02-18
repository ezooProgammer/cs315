<?php
require_once "config.php";
session_start();
$logged = false;
if (isset($_SESSION["username"])) {
  $logged = true;
  $username = $_SESSION["username"];
  $cart_item_count = $_SESSION["cart_item_count"];
} else {
  header("location:login.php");
}

$conn = new mysqli($server, $username_db, $password_db, $name_db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM ice_creams;";
$result = $conn->query($sql);
$ice_creams = [];
if ($result->num_rows > 0)
  $ice_creams = $result->fetch_all(MYSQLI_ASSOC);
else
  array_push($ice_creams, [['f_id' => 0], ['f_name' => 'unknown'], ['f_desc' => 'unknown'], ['f_price' => 0.0]]);

if (isset($_POST["order"])) {
  $ice_creams_orders = $_POST["ice_cream"];
  $filtered_ice_creams = array_filter($ice_creams_orders, function ($ice_cream) {
    return +$ice_cream["qty"] > 0 && isset($ice_cream["id"]);
  });

  if (!empty($filtered_ice_creams) && isset($_SESSION["user_id"])) {
    foreach ($filtered_ice_creams as $key => $value) {
      $sql = "INSERT INTO cart_items (f_id, item_qty,u_ID) VALUES ('" . $value["id"] . "','" . $value["qty"] . "','" . $_SESSION["user_id"] . "')";
      $conn->query($sql);
    }
  }
  $filtered_ice_creams = null;
  $sql = "SELECT COUNT(item_id) AS item_count FROM cart_items WHERE u_ID = " . $_SESSION["user_id"] . " ";
  $cart_item_count = $conn->query($sql)->fetch_assoc()["item_count"];
  $_SESSION["cart_item_count"] = $cart_item_count;
}
$conn->close();
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
          <span class="cart-item-count"><?= $cart_item_count ?></span>
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
        <form action="" method="post">
          <?php foreach ($ice_creams as $key => $ice) { ?>
            <div class="prd-order">
              <img class="prd-order-img" src="image/<?= $ice['f_id'] ?>.jpg" alt="cup-ice" />
              <label for="<?= $ice['f_id'] ?>"><?= $ice['f_desc'] ?></label>
              <input class="prd-qty" type="number" name="ice_cream[<?= $ice['f_id'] ?>][qty]" value="0" placeholder="quantity" />
              <span class="flavor-label" for="">Flavor</span>
              <span><?= $ice['f_name'] ?></span>
              <input type="checkbox" placeholder="ice-cream" id="<?= $ice['f_id'] ?>" name="ice_cream[<?= $ice['f_id'] ?>][id]" value="<?= $ice['f_id'] ?>" />
              <span><?= $ice['f_price'] ?> LYD</span>
            </div>
          <?php
          } ?>
          <!--  -->

          <!--  -->

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