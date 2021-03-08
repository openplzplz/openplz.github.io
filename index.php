<?PHP
//Link to the database
include ("detail.php");
//Start Session
session_start();
?>
<!--
Author:W3layouts
Author URL: http://w3layouts.com
License: Creative Commons Attribution 3.0 Unported
License URL: http://creativecommons.org/licenses/by/3.0/
-->

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dublin Party Hire</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords" content="" />
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
<?php   
function console_log($output, $with_script_tags = true) {
    $js_code = 'console.log(' . json_encode($output, JSON_HEX_TAG) . 
');';
    if ($with_script_tags) {
        $js_code = '<script>' . $js_code . '</script>';
    }
    echo $js_code;
}
console_log($_SESSION['login_email']); 
?>
<body>
    <div class="main-sec">
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
                            <li><a href="customer_order_status.php">Status Checker</a></li>
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
        </div>
        <!-- //header -->
        <!--/banner-->
        <div class="banner-wthree-info container">
            <div class="row">
                <div class="col-lg-5 banner-left-info">
                    <h3>The Largest Range <span>of Party Hire</span></h3>
                    <a href="login.php" class="btn shop">Log In</a>
                </div>

                <div class="col-lg-7 banner-img">
                    <!-- <img src="images/logo.jpg" alt="part image" class="img-fluid"> -->
                </div>
            </div>
        </div>
    </div>
    

    <!-- //banner-->
    <!--/banner-bottom -->
    <section class="banner-bottom py-5">
        <div class="container py-md-3">
            <div class="row grids-wthree-info text-center">
                <div class="col-lg-4 ab-content">
                    <div class="ab-info-con">
                        <h4>Fast & Free Delivery</h4>
                        <p>Lorem ipsum dolor sit,Nulla pellentesque dolor ipsum laoreet eleifend integer,Pellentesque maximus libero.</p>
                    </div>
                </div>
                <div class="col-lg-4 ab-content">
                    <div class="ab-info-con">
                        <h4>Safe & Secure Payments</h4>
                        <p>Lorem ipsum dolor sit,Nulla pellentesque dolor ipsum laoreet eleifend integer,Pellentesque maximus libero.</p>
                    </div>
                </div>
                <div class="col-lg-4 ab-content">
                    <div class="ab-info-con">
                        <h4>100% Money Back Guarantee</h4>
                        <p>Lorem ipsum dolor sit,Nulla pellentesque dolor ipsum laoreet eleifend integer,Pellentesque maximus libero.</p>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- /banner-bottom -->
    <!--/banner-bottom -->
    
    <!-- footer -->
    <div class="footer_agileinfo_topf py-5">
        <div class="container py-md-5">
            <div class="row">
                <div class="col-lg-3 footer_wthree_gridf mt-lg-5">
                    <h2><a href="index.php"><span>Dublin Party Hire</span>
                        </a> </h2>
                    <label class="sub-des2">Online Store</label>
                </div>
      

           
            </div>

            <div class="w3ls-fsocial-grid">
                <h3 class="sub-w3ls-headf">Follow Us</h3>
                <div class="social-ficons">
                    <ul>
                        <li><a href="#"><span class="fa fa-facebook"></span> Facebook</a></li>
                        <li><a href="#"><span class="fa fa-twitter"></span> Twitter</a></li>
                        <li><a href="#"><span class="fa fa-google"></span>Google</a></li>
                    </ul>
                </div>
            </div>
            <div class="move-top text-center mt-lg-4 mt-3">
                <a href="#home"><span class="fa fa-angle-double-up" aria-hidden="true"></span></a>
            </div>
        </div>
    </div>
    <!-- //footer -->

    <!-- copyright -->
    <div class="cpy-right text-center py-3">
        <p>© 2019 Baggage. All rights reserved | Design by
            <a href="http://w3layouts.com"> W3layouts.</a>
        </p>

    </div>
    <!-- //copyright -->

</body>

</html>
