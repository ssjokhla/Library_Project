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
}

function docReturn()
{
	$currDT = NOW();
	
	$con = mysqli_connect($ip, $mysqlUser, $mysqlPassword, $mysqlDB);
	mysqli_select_db($con, $mysqlDB);
	
	$query = "INSERT into Borrows ('ReaderID', 'DocID', 'CopyNO', 'LibID', 'RDTime') 
VALUES ($readerID, $docID, $copyNO, $libID, $currDT)";
}

//Administrative Funtions Menu

?>