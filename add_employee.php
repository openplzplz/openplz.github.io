<?PHP
/*Code takes input from form and uses it to insert into employees table.
 The user is then taken to html page thankYou.html which informs them their entry was received */
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include ("detail.php"); 

$employee_name = $_POST["emp_name"];
$employee_phone = $_POST["emp_phone"];
$employee_email = $_POST["emp_email"];
$employee_password = $_POST["emp_password"];



$q  = "INSERT INTO Employees (";
$q .= "employee_name, employee_phone, employee_email, employee_password";
$q .= ") VALUES (";
$q .= "'$employee_name', '$employee_phone', '$employee_email','$employee_password')";

$result = $db->query($q);

?>
<script language="javascript">

	document.location.replace("employee_dashboard.php");

</script>