<?php
require_once "config.php";
$wrong_message = false;
$sign_up_fail = true;
$isDuplicate = false;
if (isset($_POST["submit"])) {
  if ($_POST["password"] !== $_POST["confirm-password"])
    $wrong_message = true;
  else {
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $conn = new mysqli($server, $username_db, $password_db, $name_db);
    if ($conn->connect_error) {
      die("Connection failed: " . $conn->connect_error);
    }
    $sql = "SELECT u_ID from users WHERE user_name = '$username' OR u_email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
      $isDuplicate = true;
    else {
      $sql = "INSERT INTO users (user_name, u_email, u_password) VALUES ('$username', '$email', '$password')";
      if ($conn->query($sql) === TRUE)
        $sign_up_fail = false;
    }
    $conn->close();
  }
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
      <a href="./login.php" class="join-ice-cream">Login</a>
      <?php if ($sign_up_fail) { ?>
        <h1>Sign-in</h1>
        <form action="" method="post" class="sign-up">
          <label for="username">username</label>
          <input type="text" name="username" id="username" placeholder="enter your name" required />
          <label for="email">Email</label>
          <input type="email" name="email" id="email" placeholder="enter your email" required />
          <label for="password">password</label>
          <input type="password" name="password" id="password" placeholder="enter your password" required />

          <label for="confirm-password">re-password</label>
          <input type="password" name="confirm-password" id="confirm-password" placeholder="match the password" required />
          <?php
          if ($wrong_message)
            echo '<p class="wrong-login-message" >the password is not match tray again.</p>';
          if ($isDuplicate)
            echo '<p class="wrong-login-message" >the username or email is take it try another one.</p>';
          ?>
          <button type="submit" id="submit" name="submit" value="submit">
            Submit
          </button>
        </form>
      <?php } else { ?>
        <div class="sign-up-done">
          <h3>username: <?php echo $username ?></h3>
          <h3>email: <?php echo $email ?></h3>
          <h3>password: <?php echo $password ?></h3>
        </div>
      <?php } ?>
    </div>
  </div>
</body>

</html>