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
<?php
session_start();

$ReaderID=$_POST['CardNumber'];
$_SESSION['CardNumber']=$ReaderID;
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
		//echo "Successful Login";
	}
	else
	{
		//If there are 0 entries then log in fails
		echo "Error in logging in";
		return "Bad Login\n";
	}
	
	
	
	
$q = "Select * from Borrows WHERE ReaderID = $ReaderID";
$result = mysqli_query($con, $q);
$rowCount = mysqli_num_rows($result);
#var_dump(getType(urlICS($rows['Name'], $rows['Location'], $rows['Description'], $rows['Google_Time_Start'], $rows['Google_Time_End'])));
if (mysqli_num_rows($result) != 0)
{
	echo "<table>";
	echo "<table class='table'>";
	echo "<tbody>";
	while($rows = mysqli_fetch_array($result,MYSQLI_ASSOC))
	{
		echo"<tr><th scope='row'>";
		echo'<strong><big><big>Borrow ID: '.$rows['BorNO'] .'</big></big></strong><br> Document ID: '. $rows['DocID']  .'<br><br><u> Copy Number:</u>: '.' <i>'. $rows['CopyNO'].'</i>';
		echo "</th><td>";
	}
	echo "</tbody></table>";
}



	

	
	
?>
<br>
<h2>Return</h2>
Show Documents being borrowed or reserved by user<br><br>
<form action="Return.php">
Document ID:<br>
<input type="text" name="DocID">
<br><br>
Copy:<br>
<input type="Text" name="CopyNum">
<br>
LibID:<br>
<input type="Text" name="LibID">
<br><br>
<input type="submit" value="Return">
</form>
<br><br>
<input type="button" onclick=window.location.href='MainPage.html' value="Back">

</body>
</html>
