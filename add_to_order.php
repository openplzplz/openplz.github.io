<?php
session_start();
include ("detail.php"); 

$q = "INSERT INTO `Equipment_Order` (`order_id`,'equipment_id') VALUES (". $_SESSION['order_id'].", ".$_SESSION['current_equipment_id']." )";
$result = $db->query($q);

$_SESSION['current_equipment_id']="";

$q2 = "SELECT COUNT(*) AS 'COUNT' FROM `Equipment_Order` WHERE order_id= ". $_SESSION['order_id'];
$count_result = $db2->query($q2);
for($i=1; $i <= 1; $i++){
    $row = mysqli_fetch_assoc($count_result);
    $_SESSION["equipment_in_order"] = $row['COUNT'];}

header('Location: shop.php');
?>
