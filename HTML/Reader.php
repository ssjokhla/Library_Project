<?php
session_start();

$ReaderID=$_POST['CardNumber'];
$_SESSION['CardNumber']=$ReaderID;
$con = mysqli_connect("localhost", "admin", "password", "Library");
mysqli_select_db($con, "Library");
echo "BLah";

if (!$con){
	logError("Connection Failed: " . mysqli_connect_error());
	die("Connection failed: " . mysqli_connect_error());
}

$s = "select * from Reader where ReaderID = '$ReaderID'";
$t = mysqli_query($con, $s);
$rowCount = mysqli_num_rows($t);
if($rowCount > 0)
	{
		//If there are users log in works
		//echo "Successful Login";
	}
	else
	{
		//If there are 0 entries then log in fails
		echo "Error in logging in";
		return "Bad Login\n";
	}
?>
<!DOCTYPE html>
<html>
<body>

<h1>Reader Page</h1>
<h2>Browse</h2>
<form action="/searchResult.php" method="post">
Document ID:<br>
<input type="text" name="DocID">
<br><br>
Title:<br>
<input type="text" name="Title">
<br><br>
Publisher Name:<br>
<input type="text" name="Pubname">
<br><br>
<input type="submit" value="Search">
</form>
<br>

<br>

<h2>Return</h2>
Show Documents being borrowed or reserved by user<br>
<form action="">
Document ID:<br>
<input type="text" name="DocID">
<br>
Copy:<br>
<input type="Text" name="CopyNum">
<br>
<input type="submit" value="Return">
</form>

<input type="button" onclick=window.location.href='MainPage.html' value="Return">

</body>
</html>
