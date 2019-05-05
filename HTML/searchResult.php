<!DOCTYPE html>
<html>
<body>
<h2>Checking Out</h2>
<form action="Checkout.php" method="post">
Borrow Number:
<input type="text" name="BorNO"><br>
Document ID:
<input type="text" name="DocID"><br>
Copy Number:
<input type="text" name="CopyNO"><br>
Library ID:
<input type="text" name="LibID">
<br>
<input type="submit" value="Checkout">
</form>

<br><br>
<h2>Reserve</h2>
<form action="Reserve.php" method="post">
Reserve Number:
<input type="text" name="ResNO"><br>
Document ID:
<input type="text" name="DocID"><br>
Copy Number:
<input type="text" name="CopyNO"><br>
Library ID:
<input type="text" name="LibID">
<br>
<input type="submit" value="Checkout">
</form>

<h1>Results Page</h1>
<?php
include('methods.php');
session_start();

$ReaderID=$_SESSION['CardNumber'];
echo "Reader ID is: ".$ReaderID;
$DocID=$_POST['DocID'];
$Title=$_POST['Title'];
$PubName=$_POST['Pubname'];

$con = mysqli_connect("localhost", "admin", "password", "Library");
mysqli_select_db($con, "Library");

if (!$con){
	logError("Connection Failed: " . mysqli_connect_error());
	die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM document NATURAL JOIN copy NATURAL JOIN publisher WHERE Title = '$Title' OR docID = '$DocID' or PubName = 'PubName';";

$SearchResult = mysqli_query($con, $query);
$rowCount = mysqli_num_rows($SearchResult);
#var_dump(getType(urlICS($rows['Name'], $rows['Location'], $rows['Description'], $rows['Google_Time_Start'], $rows['Google_Time_End'])));
if (mysqli_num_rows($result) != 0)
{
	echo "result /=0<br>";
	echo "<table>";
	echo"<tr><th>Borrow ID</th><th>Document ID</th><th>Copy Number</th></tr>";
	while($rows = mysqli_fetch_array($result,MYSQLI_ASSOC))
	{
		
		echo "<tr><td>".$rows['Title'];
		echo "</td><td>".$rows['DocID'];
		echo "</td><td>".$rows['CopyNo'];
		echo "</td><td>".$rows['LibID'];
		echo "</td><td>".$rows['PubName']."</td></tr>";
	}
	echo "</table>";
}
?>

</html>
