<?php
require_once "config.php";
session_start();
$wrong_message = false;
if (isset($_POST["submit"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];
  $conn = new mysqli($server, $username_db, $password_db, $name_db);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  $sql = "SELECT u_ID FROM users WHERE user_name='$username' AND u_password='$password'";
  $result = $conn->query($sql);
  if ($result->num_rows > 0) {
    $_SESSION["user_id"] = $result->fetch_assoc()["u_ID"];
    $_SESSION["username"] = $username;
    $sql = "SELECT COUNT(item_id) AS item_count FROM cart_items WHERE u_ID = " . $_SESSION["user_id"] . " ";
    $cart_item_count = $conn->query($sql)->fetch_assoc()["item_count"];
    if ($cart_item_count > 0)
      $_SESSION["cart_item_count"] = $cart_item_count;
    else $_SESSION["cart_item_count"] = 0;
    header("location:home.php");
  } else {
    $wrong_message = true;
  }
  $conn->close();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Document</title>
  <link rel="stylesheet" href="./css/style.css" />
</head>

<body>
  <div class="subscribe-background">
    <div class="subscribe-container">
      <a href="./sign-up.php" class="join-ice-cream">Sign-up</a>

      <h1>Log-in</h1>
      <form action="<?php echo $_SERVER["PHP_SELF"]; ?>" class="login" method="POST">
        <label for="username">username</label>
        <input type="text" name="username" id="username" placeholder="enter your username" required />
        <label for="password">password</label>
        <input type="password" name="password" id="password" placeholder="enter your password" required />
        <span>forget your password? <a href="#">click here</a></span>
        <?php
        if ($wrong_message)
          echo '<p class="wrong-login-message" >the user is not found, please check the validity of the user inputs.</p>';
        ?>
        <button type="submit" id="submit" name="submit" value="submit">
          Submit
        </button>
      </form>
    </div>
  </div>
</body>

</html>
