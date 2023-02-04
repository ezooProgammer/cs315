<?php
session_start();
$logged = false;
if (isset($_SESSION["username"])) {
  $logged = true;
  $username = $_SESSION["username"];
}
function filter_post_req(string $category, array $product_list)
{
  if (+$product_list["$category-qty"] === 0 || !isset($product_list["ice-$category-price"]))
    return null;
  $product_data = [
    "name" => $product_list["ice-cream-$category"],
    "flavor" => $product_list["ice-$category-flavor"],
    "qty" => $product_list["$category-qty"],
    "price" => $product_list["ice-$category-price"],
  ];
  $product_data["total-price"] = $product_data["price"] * $product_data["qty"];
  return $product_data;
}
$item_order = [];
$total_amount = 0;

if (isset($_POST["order"])) {
  $item_order["corn"] = filter_post_req("corn", $_POST);
  $item_order["cup"] = filter_post_req("cup", $_POST);
  $item_order["stick"] = filter_post_req("stick", $_POST);
  $item_order = array_filter($item_order, function ($item) {
    return $item !== null;
  });
  $total_amount = array_sum(array_map(function ($item) {
    return $item["total-price"];
  }, $item_order));
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
          <?php foreach ($item_order as $key => $item) {
          ?>
            <tr>
              <td class="order-det">
                <img src="./image/<?= $key ?>-1.jpg" alt="" />
                <div class="details">
                  <span>describe: <?= $item["name"] ?></span>
                  <span>Flavor: <?= $item["flavor"] ?></span>
                </div>
              </td>
              <td class="quantity_input">
                <span> <?= $item["qty"] ?> </span>
                <button class="delete-product-order">X</button>
              </td>
              <td id="price_order_1"><?= $item["price"] ?> LYD</td>
              <td id="total_price_order_1"><?= $item["total-price"] ?> LYD</td>
            </tr>
          <?php } ?>
        </tbody>
      </table>
      <div class="checkout-order">
        <h1>ORDER</h1>
        <p>Item <?= count($item_order) ?></p>
        <p>Total Amount <?= $total_amount ?></p>
        <a href="./payment_info.php"><button title="checkout">Cheackout</button></a>
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