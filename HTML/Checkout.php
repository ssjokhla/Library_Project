<?php
//include("methods.php");
session_start();

$DocID=$_POST['DocID'];
$ReaderID=$_POST['ReaderID'];
$CopyNO=$_POST['CopyNO'];
$LibID=$_POST['LibID'];

$currDT = NOW();
	
$con = mysqli_connect("localhost", "admin", "password", "Library");
mysqli_select_db($con, "Library");
	
$query = "INSERT into Borrows ('ReaderID', 'DocID', 'CopyNO', 'LibID', 'BDTime') VALUES ('$ReaderID', '$DocID', '$VopyNO', '$LibID', '$currDT')";	
mysqli_query($con, $query);

?>
