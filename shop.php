<?php
session_start();
include ("detail.php"); 

//echo  "name = " . $_SESSION['login_user_name'];

//THis query checks for the members who have not paid their subs.
$equipmentQuery = "SELECT *  FROM `Equipment`";
$equipmentQueryResult = $db->query($equipmentQuery);
$equipmentQueryResultNum_results = mysqli_num_rows($equipmentQueryResult);

function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}
console_log($_SESSION['login_email']);
console_log($_SESSION['cust_id']);


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
            <h3 class="title-wthree mb-lg-5 mb-4 text-center">Shop Now</h3>
            
            <!--/row-->
            <?php
            ini_set('display_errors', 1);
            ini_set('display_startup_errors', 1);
            error_reporting(E_ALL);

            while ($data = mysqli_fetch_assoc($equipmentQueryResult)) {
                $row2[] = $data;
            }
            $form = '<form action="checkout.php" method="post" name="eventform" id="eventform">';
            $form .= '<br><br><h1>Please select the quantity of each item you would like in your order.</h1>';

            echo '<h3 class="title-wthree mb-lg-5 mb-4 text-center" style="color:red">Special Offers</h3>';
            $x = 0;
            for($i=1; $i <= $equipmentQueryResultNum_results; $i++){
                $n= $i - 1;
                $equipmentDiscountPrice = $row2[$n]['equipment_cost'] * $row2[$n]['equipment_discount'] / 100;
                $equipmentDiscountPriceFormat = number_format($equipmentDiscountPrice, 2);

                if($row2[$n]['equipment_discount'] != "100.00"){
                $x = $x + 1;
                    if(($i % 4) == 1){
                        echo '<div class="row shop-wthree-info text-center">';
                    }
                    echo '<div class="col-lg-3 shop-info-grid text-center mt-4">';
                        echo '<div class="product-shoe-info shoe">';
                            echo '<div class="men-thumb-item">';
                                echo '<img src="images/'.$row2[$n]['equipment_name'].'.jpg" class="img-fluid" alt="">';
                            echo '</div>';
                            echo '<div class="item-info-product">';
                                echo '<h4>';
                                    echo ''. $row2[$n]['equipment_name'].'  </a>';
                                echo '</h4>' ;

                                echo '<div class="product_price">';
                                    echo '<div class="grid-price">';
                                        echo '<span class="money"><span>€'.$equipmentDiscountPriceFormat.'';
                                    echo '</div>';
                                echo '</div>';    
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                 
                    if (($i %4 ) == 0){
                        echo "</div>";
                    }
                }
            }
            
        echo '<section class="banner-bottom py-5">';
            echo '<div class="container py-5">';
            echo '<h3 class="title-wthree mb-lg-5 mb-4 text-center">Full Price Items</h3>';
            $x= 0;
            $form .= '<table  align="center">';
            for($j=1; $j <= $equipmentQueryResultNum_results; $j++){
                $n= $j - 1;
                $equipmentDiscountPrice = $row2[$n]['equipment_cost'] * $row2[$n]['equipment_discount'] / 100;
                $equipmentDiscountPriceFormat = number_format($equipmentDiscountPrice, 2);

                $form .= '<div class="content-input-field">';
                $form .='<tr><td><label for="'. $row2[$n]['equipment_id'].'">'. $row2[$n]['equipment_name'].':</label></td>';
                $form .= '<td><select name="'. $row2[$n]['equipment_id'].'">';
                $form .='<option value="0">0</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        </select></td></tr>';

                if($row2[$n]['equipment_discount'] == "100.00"){
                $x = $x + 1;
                    if(($x % 4) == 1){
                        echo '<div class="row shop-wthree-info text-center">';
                    }
                    echo '<div class="col-lg-3 shop-info-grid text-center mt-4">';
                        echo '<div class="product-shoe-info shoe">';
                            echo '<div class="men-thumb-item">';
                                echo '<img src="images/'.$row2[$n]['equipment_name'].'.jpg" class="img-fluid" alt="">';
                            echo '</div>';
                            echo '<div class="item-info-product">';
                                echo '<h4>';
                                    echo '<a>'. $row2[$n]['equipment_name'].'  </a>';
                                echo '</h4>' ;

                                echo '<div class="product_price">';
                                    echo '<div class="grid-price">';
                                        echo '<span class="money"><span>€'.$equipmentDiscountPriceFormat.'';
                                    echo '</div>';
                                echo '</div>';    
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                 
                    if (($x %4 ) == 0){
                        echo "</div>";
                    }
                }
            }
            $form .= '</table><div class="content-input-field">
            <br><h1>Rental Details</h1> <br>

            <div class="content-input-field">
            <label for="delivery_collection">Delivery or collection:</label>
            <select id="delivery_collection" name="delivery_collection">
            <option value="yes">Delivery</option>
            <option value="no">Collection</option></select><br>

            <label for="setup">Would you like the equipment set up?</label>
            <select id="setup" name="setup">
            <option value="yes">Yes</option>
            <option value="no">No</option></select><br>
            
            <div class="content-input-field">
            <label for="delivery">Delivery/Collection Date:</label>
            <input type="date" id="delivery" name="delivery"><br>

            <div class="content-input-field">
            <label for="delivery_time">Choose a delivery/collection time:</label>
            <select id="delivery_time" name="delivery_time">
            <option value="morning">Morning (9am-1pm)</option>
            <option value="afternoon">Afternoon (1pm-5pm)</option></select><br>
            
            <div class="content-input-field">
            <label for="pickup">Pickup Date:</label>
            <input type="date" id="pickup" name="pickup"><br>
            
            <div class="content-input-field">
            <label for="pickup_time">Choose a pickup time:</label>
            <select id="pickup_time" name="pickup_time">
            <option value="morning">Morning (9am-1pm)</option>
            <option value="afternoon">Afternoon (1pm-5pm)</option></select><br>
            
            <div class="content-input-field">
            
            <input type="submit" value="Submit">
            <input type="reset" value="Reset"></form>';
            echo $form;
            
            ?>
            
    <!-- footer -->
    

</body>

</html>