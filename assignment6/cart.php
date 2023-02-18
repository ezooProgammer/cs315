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

function total_amount_calc(&$items)
{
  $amount = 0.0;
  foreach ($items as $value) {
    $amount += $value['total_price'];
  }
  return $amount;
}
$items_order = [];
$total_amount = 0.0;

$conn = new mysqli($server, $username_db, $password_db, $name_db);
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}
if (isset($_GET["deleted"]) && $_GET["deleted"] == "true") {
  $sql = "SELECT COUNT(item_id) AS item_count FROM cart_items WHERE u_ID = " . $_SESSION["user_id"] . " ";
  $cart_item_count = $conn->query($sql)->fetch_assoc()["item_count"];
  $_SESSION["cart_item_count"] = $cart_item_count;
}
$sql = "SELECT * FROM cart_items WHERE u_ID = " . $_SESSION["user_id"] . "";
$items_result = $conn->query($sql);
if ($items_result->num_rows > 0) {
  while ($item = $items_result->fetch_assoc()) {
    $sql = "SELECT * FROM ice_creams WHERE f_id = " . $item["f_id"] . "";
    $flavor_result = $conn->query($sql);
    if ($flavor_result->num_rows > 0)
      $flavor = $flavor_result->fetch_assoc();
    $items_order[] = [
      "item_id" => $item["item_id"],
      "name" => $flavor["f_desc"],
      "flavor" => $flavor["f_name"],
      "flavor_id" => $flavor["f_id"],
      "price" => $flavor["f_price"],
      "qty" => $item["item_qty"],
      "total_price" => $flavor["f_price"] * $item["item_qty"]
    ];
  }
  $total_amount = total_amount_calc($items_order);
}
$item = null;
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
      <table class="order-table">
        <thead>
          <tr>
            <th id="prd-det">product details</th>
            <th id="prd-qty">quantity</th>
            <th id="prd-price">price</th>
            <th id="prd-total">total</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($items_order as $key => $item) {
          ?>
            <tr>
              <td class="order-det">
                <img src="./image/<?= $item["flavor_id"] ?>.jpg" alt="" />
                <div class="details">
                  <span>describe: <?= $item["name"] ?></span>
                  <span>Flavor: <?= $item["flavor"] ?></span>
                </div>
              </td>
              <td class="quantity_input">
                <span> <?= $item["qty"] ?> </span>
                <form action="delete_item_from_cart.php" method="post">
                  <button class="delete-product-order" name="item_id" value="<?= $item["item_id"] ?>">X</button>
                </form>
              </td>
              <td id="price_order_1"><?= $item["price"] ?> LYD</td>
              <td id="total_price_order_1"><?= $item["total_price"] ?> LYD</td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <div class="checkout-order">
        <h1>ORDER</h1>
        <p>Item <?= count($items_order) ?></p>
        <p>Total Amount <?= $total_amount ?></p>
        <a href="./payment_info.php"><button title="checkout">Checkout</button></a>
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