<?php

//Mysql IP either localhost or ipaddress
$IP = "localhost";
//Mysql Username
$mysqlUser = "admin";
//Mysql Password
$mysqlPassword = "password";
//Mysql Database Name
$mysqlDB = "Library";
//-------------------------------------------------------//


//Main Menu Functions
function checkReader($input)
{
	//Connect to mysql
	$con = mysqli_connect($ip, $mysqlUser, $mysqlPassword, $mysqlDB);
	mysqli_select_db($con, $mysqlDB);
	
	$query = "SELECT * from Reader";
	$result = mysqli_query($con, $s);
	
	return $result;
	
}

function checkAdmin($id, $pw)
{
	$con = mysqli_connect($ip, $mysqlUser, $mysqlPassword, $mysqlDB);
	mysqli_select_db($con, $mysqlDB);
	
	$query = "select * from Admins where username = '$id' and password = '$pw'";
	$result = mysqli_query($con, $query);
	$rowCount = mysqli_num_rows($result);
	if($rowCount > 0)
	{
		echo "Successful Login";
	}
	else
	{
		echo "Error in logging in";
		return "Bad Login\n";
	}
	return true;
}

//-------------------------------------------------------//

//Reader Functions
function searchID($input)
{
	$con = mysqli_connect($ip, $mysqlUser, $mysqlPassword, $mysqlDB);
	mysqli_select_db($con, $mysqlDB);
	
	$query = "SELECT * from Document WHERE DocID = '$input'";
	$result = mysqli_query($con, $s);
	
	return $result;
	
	
}

function searchTitle($input)
{
	$con = mysqli_connect($ip, $mysqlUser, $mysqlPassword, $mysqlDB);
	mysqli_select_db($con, $mysqlDB);
	
	$query = "SELECT * from Document WHERE Title = '$input'";
	$result = mysqli_query($con, $s);
	
	return $result;
}

function searchPubName($input)
{
	$con = mysqli_connect($ip, $mysqlUser, $mysqlPassword, $mysqlDB);
	mysqli_select_db($con, $mysqlDB);
	
	$query = "SELECT * from Document,Publisher WHERE Pubname = '$input'";
	$result = mysqli_query($con, $s);
	
	return $result;
}

function docCheckout($readerID, $docID, $copyNO, $libID)
{
	$currDT = NOW();
	
	$con = mysqli_connect($ip, $mysqlUser, $mysqlPassword, $mysqlDB);
	mysqli_select_db($con, $mysqlDB);
	
	$query = "INSERT into Borrows ('ReaderID', 'DocID', 'CopyNO', 'LibID', 'BDTime') 
VALUES ($readerID, $docID, $copyNO, $libID, $currDT)";	
	mysqli_query($con, $query);
}

function docReturn()
{
	$currDT = NOW();
	
	$con = mysqli_connect($ip, $mysqlUser, $mysqlPassword, $mysqlDB);
	mysqli_select_db($con, $mysqlDB);
	
	$query = "INSERT into Borrows ('ReaderID', 'DocID', 'CopyNO', 'LibID', 'RDTime') 
VALUES ($readerID, $docID, $copyNO, $libID, $currDT)";
}

function docReserve($readerID, $docID, $copyNO, $libID)
{
	$currDT = NOW();
	
	$con = mysqli_connect($ip, $mysqlUser, $mysqlPassword, $mysqlDB);
	mysqli_select_db($con, $mysqlDB);
	
	$query1 = "SELECT * from numReserved WHERE ReaderID = '$readerID'";
	$result1 = mysqli_query($con, $query2);
	if($result1 < 10)
	{
		$query2 = "INSERT into Reserves ('ReaderID', 'DocID', 'CopyNO', 'LibID', 'DTime') VALUES ('$readerID', '$docID', '$copyNO', '$libID', '$currDT')";
		mysqli_query($con, $query2);
	}
	else
	{
		echo "The user already has 10 reservatoins.";
	}
}

function computeFine($Bornumber, $readerID, $BDTime, $RDTime)
{
	$diffTime = 0;
	$fine = 0;
	$con = mysqli_connect($ip, $mysqlUser, $mysqlPassword, $mysqlDB);
	mysqli_select_db($con, $mysqlDB);
	
	$query1 = "Select BDTime from Borrows WHERE Bornumber = '$Bornumber' AND ReaderID = '$readerID'";
	$BDTime = mysqli_query($con, $query1);
	
	$query2 = "Select RDTime from Borrows WHERE Bornumber = '$Bornumber' AND ReaderID = '$readerID'";
	$RDTime = mysqli_query($con, $query2);
	
	$diffTime = RDTime - BDTime
	if($diffTime > 20)
	{
		//Floor apparently rounds the number down to the nearest whole number
		$fine = (floor($diffTime) * .20);
	}
	else
	{
		$fine = 0;
	}
	
}

function printDocs($readerID)
{
	$con = mysqli_connect($ip, $mysqlUser, $mysqlPassword, $mysqlDB);
	mysqli_select_db($con, $mysqlDB);
	
	echo "These are the documents that are reserved";
	$query1 = "Select Title FROM Reader,Reserves,Docuemnt WHERE ReaderID = $readerID";
	$BDTime = mysqli_query($con, $query1);
	
	echo "These are the documents that are borrowed";
	$query2 = "Select Title FROM Reader,Borrows,Docuemnt WHERE ReaderID = $readerID";
	$BDTime = mysqli_query($con, $query2);
}
//Administrative Funtions Menu

?>