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

<body>
<div class="main-sec inner-page">
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
                            <li class="active">
                                <a href="index.php">Home</a></li>
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
        </div>

    <!-- //banner-->
    <section class="banner-bottom py-5">
        <div class="container">
            <div class="content-grid">
<h2>Order Status Checker</h2>
            <?php
 /* This code connects to the sql database and performs 
 a select query on the event_attendee table where the event 
 name matches. It then displays the results on the php page.
 Adapted from searchcheese.php */
  include ("detail.php"); 
  
  $order_ID= $_POST['order_ID'];
 

  
$query = "SELECT * FROM Orders WHERE order_ID = '$order_ID'  ";
$result = $db->query($query);

$num_results = mysqli_num_rows ($result);


echo '<table>';
for ($i=0; $i <$num_results; $i++)
{
    $row = mysqli_fetch_assoc($result);
    $ID = $row['cust_id'];
    $cust_query = "SELECT * FROM Customers WHERE business_id = '$ID'  ";
    $cust_result = $db->query($cust_query);

    $cust_num_results = mysqli_num_rows ($cust_result);
    $cust_row = mysqli_fetch_assoc($cust_result);

    $ORD = $row['order_id'];
    $status_query = "SELECT * FROM Order_Status WHERE order_id = '$ORD'  ";
    $status_result = $db->query($status_query);

    $status_num_results = mysqli_num_rows ($status_result);
    $status_row = mysqli_fetch_assoc($status_result);

    $NUM = $row['order_id'];
    $equip_query = "SELECT * FROM Equipment_Order WHERE order_id = '$NUM'  ";
    $equip_result = $db->query($equip_query);
    $equip_num_results = mysqli_num_rows ($equip_result);

    
    echo '<tr><td><p><strong>Order ID: </td><td>';
    echo ($row['order_id'].'</td></tr>');
    echo '<tr><td>Customer ID: </td><td>';
    echo ($row['cust_id'].'</td></tr>');
    echo '<tr><td>Customer Name: </td><td>';
    echo ($cust_row['business_name'].'</td></tr>');
    echo '<tr><td>Delivery Date: </td><td>';
    echo ($row['delivery_date'].'</td></tr>');
    echo '<tr><td>Pickup Date: </td><td>';
    echo ($row['pickup_date'].'</td></tr>');
   
    for ($j=0; $j <$equip_num_results; $j++)
    {
        $equip_row = mysqli_fetch_assoc($equip_result);

        $equip_name_query = "SELECT * FROM Equipment Where equipment_id = ".$equip_row['equipment_id'].";";
        $equip_name_result = $db->query($equip_name_query);
        $equip_name_row = mysqli_fetch_assoc($equip_name_result);

       

        echo '<tr><td>Equipment Name: </td><td>';
        echo ($equip_name_row['equipment_name'].'</tr>');
        echo '<tr><td>Quantity: </td><td>';
        echo ($equip_row['quantity'].'</td></tr>');
    }
    echo '<tr><td>Status: </td><td>';
    echo ($status_row['status'].'</td></tr>');
    echo '</strong></p>';
}
echo '</table>';
echo '<br><br><br><br><br>';
?>
    <h4> Please enter your order ID to view the order status.</h4>
    <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" name="memberform" id="memberform">
<label>
<div class="content-input-field">
                            <table>
                               
                                <tr>
                                    <td><label for="order_ID">Order ID:</label></td>
                                    <td><input type="number" name="order_ID" id="order_ID" size=30></td>
                                </tr>
    </table>
        <input type="submit" lass="btn shop" value="Submit">
        <input type="reset" lass="btn shop" value="Reset">
</form>
 
</body>
</html>