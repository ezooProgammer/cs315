<?php
session_start();
$wrong_message = false;
function checkUser($info_user, $users)
{
  foreach ($users as $user)
    if ($info_user === $user)
      return true;
  return false;
}
if (isset($_POST["submit"])) {
  $username = $_POST["username"];
  $password = $_POST["password"];
  $users = [["sa", "sa"], ["user1", "user1"], ["user2", "user2"]];
  if (checkUser([strtolower($username), strtolower($password)], $users)) {
    $_SESSION["username"] = $username;
    header("location:home.php");
  } else
    $wrong_message = true;
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