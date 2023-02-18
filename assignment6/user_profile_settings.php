<?php
require_once "config.php";
session_start();
$wrong_message = false;
$isDuplicate = false;
$update_done = false;
if (isset($_POST["update"])) {
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
        //  التحقق ما اذا كان الاسم المدخل او البريد الالكتروني مستخدم مسبقا او موجود في قاعدة البيانات لتفادي خطاء المفاتبح المميزو مكررة
        $sql = "SELECT u_ID from users WHERE (user_name = '$username' OR u_email = '$email') AND u_ID != '" . $_SESSION["user_id"] . "';";
        $result = $conn->query($sql);
        if ($result->num_rows > 0)
            $isDuplicate = true;
        else {
            $sql = "UPDATE users SET user_name = '$username', u_password = '$password', u_email = '$email' WHERE u_ID = '" . $_SESSION["user_id"] . "';";
            if ($conn->query($sql) === TRUE) {
                $_SESSION["username"] = $username;
                $update_done = true;
            }
        }

        $conn->close();
    }
}
$user = null;
$logged = false;
if (isset($_SESSION["username"])) {
    $logged = true;
    $username = $_SESSION["username"];
    $cart_item_count = $_SESSION["cart_item_count"];
    // حتى يتم عرض بيانات حساب المستخدم الحالي في حقول تعديل البيانات
    $conn = new mysqli($server, $username_db, $password_db, $name_db);
    if ($conn->connect_error)
        die("Connection failed: " . $conn->connect_error);
    $sql = "SELECT user_name,u_email FROM users WHERE u_ID = '" . $_SESSION["user_id"] . "';";
    $result = $conn->query($sql);
    if ($result->num_rows > 0)
        $user = $result->fetch_assoc();
    $conn->close();
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
            <h1 class="title-page">Profile Settings</h1>
            <div class="edit-profile-account">
                <h1>Update Profile</h1>
                <form action="" method="post" class="sign-up">
                    <label for="username">username</label>
                    <input type="text" name="username" id="username" placeholder="new name" value="<?= $user["user_name"] ?>" required />
                    <label for="email">Email</label>
                    <input type="email" name="email" id="email" placeholder="new email" value="<?= $user["u_email"] ?>" required />
                    <label for="password">password</label>
                    <input type="password" name="password" id="password" placeholder="new password" required />
                    <label for="confirm-password">re-password</label>
                    <input type="password" name="confirm-password" id="confirm-password" placeholder="match the password" required />
                    <?php
                    if ($wrong_message)
                        echo '<p class="wrong-login-message" >the password is not match tray again.</p>';
                    if ($isDuplicate)
                        echo '<p class="wrong-login-message" >the username or email is take it try another one.</p>';
                    ?>
                    <button type="submit" id="update" name="update" value="update">
                        Update
                    </button>
                </form>
                <?php if ($update_done) { ?>
                    <div class="update-done">
                        <p>the update is done successfully!!</p>
                    </div>
                <?php } ?>
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