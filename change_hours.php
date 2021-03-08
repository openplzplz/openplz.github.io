
<?PHP
/*Code takes input from form and uses it to insert into events table. The user is then taken to html page thankYou.html which informs them their entry was received */
ini_set('display_errors', '1');
ini_set('display_startup_errors', '1');
error_reporting(E_ALL);

include ("detail.php"); 
$clock_id ='';
$status= $_POST["status"];
$new_time = $_POST["new_time"];
$employee_id = $_POST["employee_id"];

$sql1 = "SELECT * FROM `Hours` Where employee_id = ".$employee_id." ORDER BY `Hours`.`clock_in` DESC LIMIT 1";
        $result1 = mysqli_query($db, $sql1);
        while ($row1 = mysqli_fetch_array($result1)){
            $clock_id = $row1['clock_id'];
        }



$q  = "UPDATE `Hours` SET ".$status." = '".$new_time."' WHERE employee_id = '".  $employee_id."' AND clock_id = ".$clock_id.";";

$result = $db->query($q);

?>
<script language="javascript">

	document.location.replace("employee_status.php");

</script>