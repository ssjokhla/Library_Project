    
<?php
include('methods.php');
$Year=$_POST['Year'];

echo "Main php page this is the year: ".$Year;
echo "<h1>Most Popular Books for ".$Year."</h1>";
$con = mysqli_connect("localhost", "admin", "password", "Library");
mysqli_select_db($con, "Library");
if (!$con){
	die("Connection failed: " . mysqli_connect_error());
}
mostPopularYear($Year);
?>
