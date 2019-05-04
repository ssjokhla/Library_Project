<!DOCTYPE html>
<html>

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
	logError("Connection Failed: " . mysqli_connect_error());
	die("Connection failed: " . mysqli_connect_error());
}

$query = "SELECT * FROM document NATURAL JOIN copy NATURAL JOIN publisher WHERE Title = '$Title' OR docID = '$DocID' or PubName = 'PubName';";

$SearchResult = mysqli_query($con, $query);

echo $SerachResult;
?>
<body>
<h2>Checking Out</h2>
<form action="Chckout.php" method="post">
Reader ID:
<input type="text" name="ReaderID">
Document ID:
<input type="text" name="DocID">
Copy Number:
<input type="text" name="CopyNO">
Library ID:
<input type="text" name="LibID">
<br>
<input type="submit" value="Login">
</form>

</html>
