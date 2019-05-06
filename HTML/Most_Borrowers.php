    
<h1>Most Borrows</h1>
<?php
include('methods.php');

$LibID=$_POST['LibID'];
$con = mysqli_connect("localhost", "admin", "password", "Library");
mysqli_select_db($con, "Library");
if (!$con){
	die("Connection failed: " . mysqli_connect_error());
}
frequentBorrowers($LibID);
?>
