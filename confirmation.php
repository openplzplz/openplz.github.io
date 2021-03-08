<?php
session_start();
include ("detail.php");

function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

$deliverydate = $_SESSION['deliverydate'];
$deliverytime = $_SESSION['deliverytime'];
$pickupdate = $_SESSION['pickupdate'];
$pickuptime = $_SESSION['pickuptime'];
$custid = $_SESSION['cust_id'];
$quantity = $_SESSION['quantity'];
$equipid = $_SESSION['equipid'];
$deliverycollection = $_SESSION['delivery_collection'];
$setup = $_SESSION['setup'];
$equipmentDiscountPrice = $_SESSION['equipmentDiscountPrice'];
$itemVAT = $_SESSION['itemVAT'];
$cartTotalBeforeVatFormat = $_SESSION['cartTotalBeforeVat'];
$vatCalculationFormat = $_SESSION['vatCalculation'];
$cartTotalAfterVatFormat = $_SESSION['cartTotalAfterVat'];
//echo  "name = " . $_SESSION['login_user_name'];

console_log($equipmentDiscountPrice);
console_log($itemVAT);

$idQuery = "SELECT MAX(order_id) FROM Orders";
$idQueryResult = $db->query($idQuery);
$order_idFetch = mysqli_fetch_assoc($idQueryResult);
$order_id = $order_idFetch['MAX(order_id)'];
$order_id = $order_id + 1;
console_log($order_idFetch);
console_log($order_id);

//THis query checks for the members who have not paid their subs.
$equipmentQuery = "SELECT *  FROM `Equipment`";
$equipmentQueryResult = $db->query($equipmentQuery);
$equipmentQueryResultNum_results = mysqli_num_rows($equipmentQueryResult);

for($j=1; $j <= $equipmentQueryResultNum_results; $j++){
    $p = $j -1;
    if ($quantity[$p] > 0){
        $q  = "INSERT INTO Equipment_Order (";
        $q .= "order_id, equipment_id, quantity, cust_id, ";
        $q .= "order_value, vat";
        $q .= ") VALUES (";
        $q .= "'$order_id','$equipid[$p]', '$quantity[$p]', '$custid', '$equipmentDiscountPrice[$p]', '$itemVAT[$p]')";
        console_log($q);
        $result = $db->query($q);
    }
}

$p = $j -1;
$q  = "INSERT INTO Orders (";
$q .= "order_id, cust_id, ";
$q .= "delivery_date, pickup_date, delivery_time, pickup_time, delivery, setup, total_order_value, total_vat";
$q .= ") VALUES (";
$q .= "'$order_id','$custid', '$deliverydate', '$pickupdate', '$deliverytime', '$pickuptime', '$deliverycollection', '$setup', '$cartTotalBeforeVatFormat', '$vatCalculationFormat')";
console_log($q);
$result = $db->query($q);


?>

<!--
Author:W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Baggage Ecommerce Category Bootstrap Responsive Web Template | Shop :: W3layouts</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords" content="Baggage Responsive web template, Bootstrap Web Templates, Flat Web Templates, Android Compatible web template, Smartphone Compatible web template, free webdesigns for Nokia, Samsung, LG, SonyEricsson, Motorola web design" />
    <script>
        addEventListener("load", function() {
            setTimeout(hideURLbar, 0);
        }, false);

        function hideURLbar() {
            window.scrollTo(0, 1);
        }
    </script>
    <!-- //Meta tag Keywords -->
    <!-- Custom-Files -->
    <link rel="stylesheet" href="css/bootstrap.css">
    <!-- Bootstrap-Core-CSS -->
    <link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
    <!-- Style-CSS -->
    <!-- font-awesome-icons -->
    <link href="css/font-awesome.css" rel="stylesheet">
    <!-- //font-awesome-icons -->
    <!-- /Fonts -->
    <link href="//fonts.googleapis.com/css?family=Hind:300,400,500,600,700" rel="stylesheet">
    <!-- //Fonts -->

</head>

<body>
    <div class="main-sec inner-page">
        <!-- //header -->
        <header class="py-sm-3 pt-3 pb-2" id="home">
            <div class="container">
                <!-- nav -->
                <div class="top-w3pvt d-flex">
                    <div id="logo">
                        <h1> <a href="index.php"><span class="log-w3pvt">Dublin Party Hire</span> </a> <label class="sub-des">Online Store</label></h1>
                    </div>

                    <div class="forms ml-auto">
                        <a href="login.php" class="btn"><span class="fa fa-user-circle-o"></span> Log In</a>
                        <a href="register_new_customer.php" class="btn"><span class="fa fa-pencil-square-o"></span> Register</a>
                    </div>
                </div>
                <div class="nav-top-wthree">
                    <nav>
                        <label for="drop" class="toggle"><span class="fa fa-bars"></span></label>
                        <input type="checkbox" id="drop" />
                        <ul class="menu">
                            <li class="active"><a href="index.php">Home</a></li>
                            <li><a href="shop.php">Shop</a></li>
                        </ul>
                    </nav>
                    <!-- //nav -->
                    <div class="search-form ml-auto">
                        <div class="form-w3layouts-grid">
                        <ul class="menu">
                            <?php
                            if($_SESSION['logged_in'] == TRUE){
                            echo '<a>Welcome '.$_SESSION['login_email'].'
                            </a>';
                            }
                            ?>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="clearfix"></div>
                </div>
            </div>
        </header>
        <!-- //header -->
    </div>
    <!-- //banner-->
    <!--/banner-bottom -->
    <section class="banner-bottom py-5">
        <div class="container py-5">
            <h3 class="title-wthree mb-lg-5 mb-4 text-center">Thank You For Your Order!</h3>
            
            <!--/row-->
            <?php 

            $cust_query = "SELECT * FROM Customers WHERE business_id = '$custid'  ";
            $cust_result = $db->query($cust_query);
            $cust_row = mysqli_fetch_assoc($cust_result);


            echo '<h1> Order Confirmation</h1>';
            echo '<h2>Dublin Party Hire</h2>';
            echo '<table>';
            
    

            if ($deliverycollection == "yes"){
                echo '<tr><td>Delivery Address: </td><td>';
                echo ($cust_row['business_address'].'</td></tr>');
                echo '<tr><td> Delivery Date: </td><td>';
                echo ($deliverydate.'</td></tr>');
                echo '</tr><tr><td>Delivery Time: </td><td>';
                echo ($deliverytime.'</tr>');
            } else {
                echo '<tr><td>Collection Date: </td><td>';
                echo ($deliverydate.'</td></tr>');
                echo '</tr><tr><td>Collection Time: </td><td>';
                echo ($deliverytime.'</tr>');
            }
            echo '<tr><td>Pickup Date: </td><td>';
            echo ($pickupdate.'</td></tr>');
            echo '<tr><td>Pickup Time: </td><td>';
            echo ($pickuptime.'</td></tr>');
            echo '<tr><td>Setup required: </td><td>';
            echo ($setup.'</td></tr>');
            echo '<tr><td>Total before VAT: </td><td>';
            echo ('€'.$cartTotalBeforeVatFormat.'</td></tr>');
            echo '<tr><td>VAT: </td><td>';
            echo ('€'.$vatCalculationFormat.'</td></tr>');
            echo '<tr><td>Total after VAT: </td><td>';
            echo ('€'.$cartTotalAfterVatFormat.'</td></tr>');

            
            for($k=1; $k <= $equipmentQueryResultNum_results; $k++){
                    $n = $k - 1;
                    $equip_name_row = mysqli_fetch_assoc($equipmentQueryResult);
                    if($quantity[$n] > 0) {


       

                        echo '<tr><td>Equipment Name: </td><td>';
                        echo ($equip_name_row['equipment_name'].'</tr>');
                        echo '<tr><td>Quantity: </td><td>';
                        echo ($quantity[$n].'</td></tr>');
                    }
            }
            
            echo '</strong></p>';

            echo '</table>';

            //Inserts button to print page.
            echo '<br><br><button onclick="window.print()">Print this page</button>';
            //Inserts link to previous page.
            echo '<br><br><a href="index.php" > Back to homepage </a>';
            ?>
            
    <!-- footer -->

</body>

</html>