<?php

$con = mysqli_connect("localhost", "admin", "password", "Library");
mysqli_select_db($con, "Library");

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
		echo "Successful Login";
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
<form action="/action_page.php">
Search:<br>
<input type="text" name="firstname">
<br>
<input type="button" value="Checkout">
<input type="button" value="Reserve">
</form>
<br>

<br>

<h2>Return</h2>
<form action="">
Document ID:<br>
<input type="text" name="DocID">
<br>
Copy:<br>
<input type="Text" name="CopyNum">
<br>
<input type="button" value="Return">
</form>



</body>
</html>
