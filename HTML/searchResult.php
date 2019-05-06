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
$DocID=$_POST['DocID'];
$Title=$_POST['Title'];
$PubName=$_POST['Pubname'];

$con = mysqli_connect("localhost", "admin", "password", "Library");
mysqli_select_db($con, "Library");

if (!$con){
	die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM Document NATURAL JOIN Copy NATURAL JOIN Publisher WHERE Title = '$Title' OR docID = '$DocID' or PubName = 'PubName'";

$SearchResult = mysqli_query($con, $query);
$rowCount = mysqli_num_rows($SearchResult);
if (mysqli_num_rows($SearchResult) != 0)
{
	echo "<table>";
	echo"<tr><th>Title</th><th>Document ID</th><th>Copy Number</th><th>Library ID</th><th>Publisher Name</th></tr>";
	while($rows = mysqli_fetch_array($SearchResult,MYSQLI_ASSOC))
	{
		
		echo "<tr><td>".$rows['Title'];
		echo "</td><td>".$rows['DocID'];
		echo "</td><td>".$rows['CopyNO'];
		echo "</td><td>".$rows['LibID'];
		echo "</td><td>".$rows['PubName']."</td></tr>";
	}
	echo "</table>";
}
?>

</html>
