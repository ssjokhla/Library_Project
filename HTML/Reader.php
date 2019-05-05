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
	//echo "<tbody>";
	echo"<tr><th>Borrow ID</th><th>Document ID</th><th>Copy Number</th></tr>";
	while($rows = mysqli_fetch_array($result,MYSQLI_ASSOC))
	{
		
		echo "<tr><td>".$rows['BorNO'];
		echo "</td><td>".$rows['DocID'];
		echo "</td><td>".$rows['CopyNO']."</td></tr>";
	}
	echo "</table>";
}




	

	
	
?>
<br>
<h2>Return</h2>
Show Documents being borrowed or reserved by user<br><br>
<form action="Return.php" method="post">
Borrow Number:<br>
<input type="text" name="BorNO">
<input type="submit" name="Return">
</form><br><br>

<h2>Check Fine</h2>
<form action="CheckFine.php" method="post">
Borrow Number:<br>
<input type="text" name="BorNO">
<input type="submit" value="Check Fine">
</form><br><br>

<h2>Search Publisher</h2>
<form action="SearchPublisher.php" method="post">
Publisher:<br>
<input type="text" name="PubName">
<input type="submit" value="Search">
</form><br><br>


<br><br>
<input type="button" onclick=window.location.href='MainPage.html' value="Back">

</body>
</html>
