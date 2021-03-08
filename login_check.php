<?PHP
session_start();
//Link to the database
include ("detail.php");

$checkout = $_SESSION['checkout_login'];


//Collecting The Input From The Log In (index.php) Page
$login_email = $_POST['login_email'];
$login_password= $_POST['login_password'];

//PHP Error Handling For index.php Page
$_SESSION['not_customer'] = 'NULL';
$_SESSION['wrong_password'] = 'NULL';
$_SESSION['logged_in'] = FALSE;
$_SESSION['login_email']='NULL';

//Query Retreiving Information From Employees Table
$query = "select * from Customers where business_email = '".$login_email."'";
$result = $db->query($query);
$row=mysqli_fetch_assoc($result);
$Password = $row['business_password'];
$num_result =mysqli_num_rows($result);

//If No Results Found - Displays Employee ID Not Found Error Message
if($num_result == 0) {
	$_SESSION['not_customer'] = 'Please Enter an existing customer email';
	?>
	<script language="javascript">
	window.location.replace("login.php");
	</script>
	<?php
}
//If Employee ID Found But Inputted Password Doesn't Match - Displays Password Not A Match Error Message
else {
		if($Password != $login_password){ 
		$_SESSION['wrong_password'] = 'You Entered The incorrect password.';
		?>
		<script language="javascript">
		window.location.replace("login.php");
		</script>
		<?PHP
		} 
		//If Employee ID & Password Found And A Match - Checks Position And Brings To Appropriate Page
		
			//Else Position = Driver - Brings Them To Driver Side Of The Website
			else {$_SESSION['logged_in'] = TRUE;
                $_SESSION['login_email'] = $login_email ;

				$custidQuery = "SELECT business_id  FROM `Customers` WHERE business_email = '$login_email'  ";
				$custidQueryResult = $db->query($custidQuery);
				$custidFetch = mysqli_fetch_assoc($custidQueryResult);
				$cust_id = $custidFetch['business_id'];
				$_SESSION['cust_id']= $cust_id;

			?>
			<script language="javascript">

			var checkout_login = "<?php echo json_encode($checkout); ?>";
			console.log(checkout_login);
            
			if (checkout_login == "true") {
				window.location.replace("checkout.php");
			} else {
				window.location.replace("index.php");
			}

			</script>
			<?PHP
			$_SESSION['checkout_login'] = FALSE;
			}
		}

mysqli_close ($db);
?>
