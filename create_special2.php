
<?PHP
/*Code takes input from form and uses it to insert into events table. The user is then taken to html page thankYou.html which informs them their entry was received */
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include ("detail.php"); 
$equipment_id= $_POST["equipment_id"];
$rate= $_POST["rate"];
$discount= 100-$rate;

$q  = "UPDATE `Equipment` SET `equipment_discount` = '$discount' WHERE `Equipment`.`equipment_id` = $equipment_id;";

$result = $db->query($q);

?>
<script language="javascript">

	document.location.replace("employee_dashboard.php");

</script>