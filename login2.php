<?PHP
//Link to the database
include ("detail.php");
//Start Session
session_start();
?>

<!DOCTYPE html>
<html lang="zxx">

<head>
    <title>Dublin Party Hire</title>
    <!-- Meta tag Keywords -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta charset="UTF-8" />
    <meta name="keywords" content="" />
    <script>
        addEventListener("load", function () {
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
                        <h1> <a href="index.php"><span class="log-w3pvt">Dublin Party Hire</span> </a> <label
                                class="sub-des">Online Store</label></h1>
                    </div>

                    <div class="forms ml-auto">
                        <a href="login.php" class="btn"><span class="fa fa-user-circle-o"></span> Log In</a>
                        <a href="register_new_customer.php" class="btn"><span class="fa fa-pencil-square-o"></span>
                            Register</a>
                    </div>
                </div>
                <div class="nav-top-wthree">
                    <nav>
                        <label for="drop" class="toggle"><span class="fa fa-bars"></span></label>
                        <input type="checkbox" id="drop" />
                        <ul class="menu">
                            <li class="active"><a href="index.php">Home</a></li>
                            <li><a href="shop.php">Shop</a></li>
                            <li><a href="shop.html">Collections</a></li>
                            <li><a href="contact.html">Contact</a></li>
                        </ul>
                    </nav>
                    <!-- //nav -->
                    <div class="search-form ml-auto">

                    </div>
                    <div class="clearfix"></div>
                </div>
            </div>
        </header>
        <!-- //header -->

    </div>

    <!-- //banner-->
    <!--/login -->
    <section class="banner-bottom py-5">
        <div class="container">
            <div class="content-grid">
                <div class="text-center icon">
                    <span class="fa fa-unlock-alt"></span>
                </div>
                <?php
                if($_SESSION['checkout_login'] == TRUE){
                    echo '<h3 class="title-wthree mb-lg-5 mb-4 text-center">Please Login to place order.</h3>';
                    $_SESSION['checkout_login'] = FALSE;
                }
                ?>
                <div class="content-bottom">
                    <form action="login_check.php" method="post" id="customer_form">
                        <div class="field-group">

                            <div class="content-input-field">
                                <input name="login_email" type="text" 
                                    placeholder="Email" required>
                                <span>
                                <?php 
                                    if($_SESSION['not_customer'] != 'NULL'){
                                        echo $_SESSION['not_customer'];
                                    }
                                    ?>
                                </span>
                            </div>
                        </div>
                       <div class="field-group">
                            <div class="content-input-field">
                                <input name="login_password" id="login_password" type="Password" placeholder="Password" required>
                                <span>
                                <?php 
                                    if($_SESSION['wrong_password'] != 'NULL'){
                                        echo $_SESSION['wrong_password'];
                                    }
                                    ?>
                                </span>
                            </div>
                        </div>
                        <div class="content-input-field">
                            <button type="submit" class="btn">Sign In</button>
                        </div>
                        <ul class="list-login">
                            <li class="">
                                <a href="register_new_customer.php" class="">Don't have an Account?</a>
                            </li>
                            <li class="">
                                <a href="employee_login.php" class="">Employee Login</a>
                            </li>

                        </ul>
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- /login -->
    <!--/shipping-->
    <section class="shipping-wthree">
        <div class="shiopping-grids d-lg-flex">
            <div class="col-lg-4 shiopping-w3pvt-gd text-center">
                <div class="icon-gd"><span class="fa fa-truck" aria-hidden="true"></span>
                </div>
                <div class="icon-gd-info">
                    <h3>FREE SHIPPING</h3>
                    <p>On all order over $2000</p>
                </div>
            </div>
            <div class="col-lg-4 shiopping-w3pvt-gd sec text-center">
                <div class="icon-gd"><span class="fa fa-bullhorn" aria-hidden="true"></span></div>
                <div class="icon-gd-info">
                    <h3>FREE RETURN</h3>
                    <p>On 1st exchange in 30 days</p>
                </div>
            </div>
            <div class="col-lg-4 shiopping-w3pvt-gd text-center">
                <div class="icon-gd"> <span class="fa fa-gift" aria-hidden="true"></span></div>
                <div class="icon-gd-info">
                    <h3>MEMBER DISCOUNT</h3>
                    <p>Register &amp; save up to $29%</p>
                </div>

            </div>
        </div>

    </section>
    <!--//shipping-->
    <!-- footer -->
    
</body>

</html>