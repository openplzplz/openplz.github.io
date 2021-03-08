<?php
session_start();
include ("detail.php"); 
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] == 'POST'){

    $_SESSION['deliverydate'] = $_POST['delivery'];
    $_SESSION['deliverytime'] = $_POST['delivery_time'];
    $_SESSION['pickupdate'] = $_POST['pickup'];
    $_SESSION['pickuptime'] = $_POST['pickup_time'];
    $_SESSION['delivery_collection'] = $_POST['delivery_collection'];
    $_SESSION['setup'] = $_POST['setup'];
}
$custid = '12';
console_log($_SESSION['login_email']);

$deliverydate = $_SESSION['deliverydate'];
$deliverytime = $_SESSION['deliverytime'];
$pickupdate = $_SESSION['pickupdate'];
$pickuptime = $_SESSION['pickuptime'];
$deliverycollection = $_SESSION['delivery_collection'];
$setup = $_SESSION['setup'];

function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}

$vatDeliveryChargeQuery = "SELECT *  FROM `Miscellaneous`";
$vatDeliveryChargeQueryResult = $db->query($vatDeliveryChargeQuery);

$rowx = array();
while ($datax = mysqli_fetch_assoc($vatDeliveryChargeQueryResult)) {
    $rowx[] = $datax;
}
console_log($rowx);
$vat = $rowx[0]['vat'];
if($deliverycollection == 'yes'){
    $deliveryfee = $rowx[0]['delivery_fee'];
} else {
    $deliveryfee = 0;
}


//THis query checks for the members who have not paid their subs.
$equipmentQuery = "SELECT *  FROM `Equipment`";
$equipmentQueryResult = $db->query($equipmentQuery);
console_log($equipmentQueryResult);
$equipmentQueryResultNum_results = mysqli_num_rows($equipmentQueryResult);
console_log($equipmentQueryResultNum_results);
$quantity = array();
$equip = array();

$row3 = array();
while ($data = mysqli_fetch_assoc($equipmentQueryResult)) {
    $row3[] = $data;
}
console_log($row3);
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    for($i=1; $i <= $equipmentQueryResultNum_results; $i++){
        $h = $i -1;
        $number1 = $_POST[$row3[$h]['equipment_id']];
        $quantity[$h] = $number1;
    }
    $_SESSION['quantity'] = $quantity;
}
$quantity = $_SESSION['quantity'];

for($i=1; $i <= $equipmentQueryResultNum_results; $i++){
$h = $i -1;
$equip[$h] = $row3[$h]['equipment_name'];
$equipid[$h] = $row3[$h]['equipment_id'];
$equipmentDiscountPrice[$h] = $row3[$h]['equipment_cost'] * $row3[$h]['equipment_discount'] * $quantity[$h] / 100;
$itemVAT[$h] = $equipmentDiscountPrice[$h] * $vat * $quantity[$h] / 100;

}

$_SESSION['quantity'] = $quantity;
$_SESSION['equipid'] = $equipid;
$_SESSION['equipmentDiscountPrice'] = $equipmentDiscountPrice;
$_SESSION['itemVAT'] = $itemVAT;

console_log($_SESSION['equipmentDiscountPrice']);
console_log($_SESSION['itemVAT']);
/*
console_log($_SESSION['deliverydate']);
console_log($_SESSION['deliverytime']);
console_log($_SESSION['pickupdate']
console_log($_SESSION['pickuptime']);
console_log($_SESSION['quantity']);
console_log($_SESSION['equipid']);
*/

console_log($quantity);
console_log($equipid);
console_log($custid);
console_log($deliverydate);
console_log($deliverytime);
console_log($pickupdate);
console_log($pickuptime);
console_log($deliverycollection);
console_log($setup);

/*for($j=1; $j <= $equipmentQueryResultNum_results; $j++){
    $p = $j -1;
    $q  = "INSERT INTO Cart (";
    $q .= "equipment_id, quantity, cust_id, ";
    $q .= "delivery_date, delivery_time, pickup_date, pickup_time ";
    $q .= ") VALUES (";
    $q .= "'$equipid[$p]', '$quantity[$p]', '$custid', '$deliverydate', '$deliverytime', '$pickupdate', '$pickuptime')";

$result = $db->query($q);
console_log($q);
}*/
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
                            echo '<a>Welcome '.$_SESSION['login_email'].'</a><br>';
                            echo '<a href="sign_out.php">Sign Out</a>';
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
            <h3 class="title-wthree mb-lg-5 mb-4 text-center">Checkout</h3>
            <!--/row-->
            <?php
            $amount = 1;
            $amount2 = 0;
            $cartSubtotal= 0;
            $dtime = DateTime::createFromFormat('Y-m-d', $deliverydate);
            $ptime = DateTime::createFromFormat('Y-m-d', $pickupdate);
            $orderPeriods = ceil(($dtime->diff($ptime)->format("%d")) / 2);
            for($k=1; $k <= $equipmentQueryResultNum_results; $k++){
                $n = $k - 1;
                console_log($row3);
                if(($amount % 4 ) == 1){
                    echo '<div class="row shop-wthree-info text-center">';
                }
                if($quantity[$n] > 0) {
                    $equipmentDiscountPrice = $row3[$n]['equipment_cost'] * $row3[$n]['equipment_discount'] / 100;
                    $equipmentDiscountPriceFormat = number_format($equipmentDiscountPrice, 2);
                    $amount = $amount + 1;
                    $amount2 = $amount2 + 1;
                    $fltAmount = floatval($quantity[$n]);
                    $fltPrice = floatval($equipmentDiscountPriceFormat);
                    $total = $fltAmount*$fltPrice;
                    $cartSubtotal= $cartSubtotal + $total;
                    $vatMultiplier = $vat / 100;
                    console_log($total);

                    echo '<div class="col-lg-3 shop-info-grid text-center mt-4">';
                        echo '<div class="product-shoe-info shoe">';
                            echo '<div class="men-thumb-item">';
                                echo '<img src="images/'.$row3[$n]['equipment_name'].'.jpg" class="img-fluid" alt="">';
                            echo '</div>';
                            echo '<div class="item-info-product">';
                                echo '<h4>';
                                    echo '<a href="single.html">'. $row3[$n]['equipment_name'].'  </a>';
                                echo '</h4>' ;

                                echo '<div class="product_price">';
                                    echo '<div class="grid-price">';
                                        echo '<span class="money"><span>€'.$equipmentDiscountPriceFormat.' X ' .$quantity[$n].' = €'.$total.'</span></span>';
                                    echo '</div>';
                                echo '</div>';    
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                }
                if (($amount2 %4 ) == 0){
                        echo "</div>";
                    }
            }
            ?>
            <?php
                 $cartTotal = $cartSubtotal * $orderPeriods; 
                 $cartTotalFormat = number_format($cartTotal, 2);
                 
                 $deliveryfeeFormat = number_format($deliveryfee, 2); 

                 $cartTotalBeforeVat = $cartTotal + $deliveryfee; 
                 $cartTotalBeforeVatFormat = number_format($cartTotalBeforeVat, 2);

                 $vatCalculation = $cartTotalBeforeVat *($vat/100); 
                 $vatCalculationFormat = number_format($vatCalculation, 2); 

                 $cartTotalAfterVat = $cartTotalBeforeVat + $vatCalculation; 
                 $cartTotalAfterVatFormat = number_format($cartTotalAfterVat, 2);
                 
                 $_SESSION['cartTotalBeforeVat'] = $cartTotalBeforeVatFormat;
                 $_SESSION['vatCalculation'] = $vatCalculationFormat;
                 $_SESSION['cartTotalAfterVat'] = $cartTotalAfterVatFormat;

                 if($_SESSION['logged_in'] == TRUE){
                            $link = "confirmation.php";
                            } else {
                                $link = "login.php";
                                $_SESSION['checkout_login'] = TRUE;
                                //$_SESSION['checkout_login_heading'] = TRUE;
                            }
            ?>
            <div class="content-input-field">
            <form action="<?php echo $link ?>" method="post" name="eventform" id="eventform">
            <table>
            <tr><td>Order price for duration of order: €<?php echo $cartTotalFormat; ?></td></tr>
            <tr><td>Delivery Charge: €<?php echo $deliveryfeeFormat; ?></td></tr>
            <tr><td>Total before VAT: €<?php echo $cartTotalBeforeVatFormat; ?></td></tr>
            <tr><td>VAT at <?php echo $vat ?>%: €<?php echo $vatCalculationFormat; ?></td></tr>
            <tr><td>Total after VAT: €<?php echo $cartTotalAfterVatFormat; ?></td></tr>
            <tr><td><input type="submit" value="Submit Order"></td></tr>
            <tr><td><input type="reset" value="Cancel"></td></tr>
            </table>
            </div>
    <!-- footer -->

</body>

</html>