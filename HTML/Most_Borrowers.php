    
<h1>Most Borrows</h1>
<?php
include('methods.php');
$con = mysqli_connect("localhost", "admin", "password", "Library");
mysqli_select_db($con, "Library");
if (!$con){
	logError("Connection Failed: " . mysqli_connect_error());
	die("Connection failed: " . mysqli_connect_error());
}
frequentBorrowers()
?>
