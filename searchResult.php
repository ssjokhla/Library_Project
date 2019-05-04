<!DOCTYPE html>
<html>
<body>
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

$query = "SELECT *FROM documentNATURAL JOIN copyNATURAL JOIN publisherWHERE Title = '$Title'OR docID = '$DocID'or PubName = 'PubName';";

$SearchResult = mysqli_query($con, $query);

echo $SerachResult;
