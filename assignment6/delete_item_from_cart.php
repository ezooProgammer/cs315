<?php
$item_id = $_POST['item_id'];
require "config.php";
// Create connection
$conn = new mysqli($server, $username_db, $password_db, $name_db);
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// sql to delete a record
$sql = "DELETE FROM cart_items WHERE item_id = $item_id";

if ($conn->query($sql) === TRUE) {
    header("location: cart.php?deleted=true");
} else {
    header("location: cart.php?deleted=false");
}

$conn->close();
