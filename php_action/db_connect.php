<?php 	

$localhost = "localhost";
$username = "root";
$password = "";
$dbname = "inventory_nw";
$store_url = "http://localhost/inventory/inventory-management/blank.php";
// db connection
$connect = new mysqli($localhost, $username, $password, $dbname);
// check connection
if($connect->connect_error) {
  die("Connection Failed : " . $connect->connect_error);
} else {
  // echo "Successfully connected";
}

?>