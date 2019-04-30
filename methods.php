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
	$query1 = "Select Title FROM Reader,Reserves,Docuemnt WHERE ReaderID = '$readerID'";
	$BDTime = mysqli_query($con, $query1);
	
	echo "These are the documents that are borrowed";
	$query2 = "Select Title FROM Reader,Borrows,Docuemnt WHERE ReaderID = '$readerID'";
	$BDTime = mysqli_query($con, $query2);
}

function printPublisher($pubID)
{
	$con = mysqli_connect($ip, $mysqlUser, $mysqlPassword, $mysqlDB);
	mysqli_select_db($con, $mysqlDB);
	
	
	$query1 = "Select DocID, Title FROM Document,Publisher WHERE PublisherID = '$pubID'";
	$BDTime = mysqli_query($con, $query1);
}

//Administrative Funtions Menu
function addBook
(
//Publisher (pub)
$pubPubID, $pubName, $pubAddress,
//Document (doc)
$docDocID, $docTitle, $docPDate, $docPubID,
//Branch (branch)
$branchLibID, $branchLName, $branchLLocation,
//Copy (copy)
$copyDocID, $copyCopyNO, $copyLibID, $copyPosition,
//Author (author)
$authorAuthorID, $authorDocID,
//Book (book)
$bookDocID, $bookISBN,
//Writes (writes)
$writeAuthorID, $writeDocID
)
{
	$con = mysqli_connect($ip, $mysqlUser, $mysqlPassword, $mysqlDB);
	mysqli_select_db($con, $mysqlDB);
	
	$queryPublisher = "INSERT INTO Publisher VALUES ('$pubPubID', '$pubName', '$pubAddress')";
	$queryDocument = "INSERT INTO Docuemnt VALUES ('$docDocID', '$docTitle', '$docPDate', '$docPubID')";
	$queryBranch = "INSERT INTO Branch VALUES ('$branchLibID', '$branchLName', '$branchLLocation')";
	$queryCopy = "INSERT INTO Copy VALUES ('$copyDocID', '$copyCopyNO', '$copyLibID', '$copyPosition')";
	$queryAuthor = "INSERT INTO Author VALUES ('$authorAuthorID', '$authorDocID')";
	$queryBook = "INSERT INTO Book VALUES ('$bookDocID', '$bookISBN')";
	$queryWrites = "INSERT INTO Writes VALUES ('$writeAuthorID', '$writeDocID')";
	
	mysqli_query($con, $queryPublisher);
	mysqli_query($con, $queryDocument);
	mysqli_query($con, $queryBranch);
	mysqli_query($con, $queryCopy);
	mysqli_query($con, $queryAuthor);
	mysqli_query($con, $queryBook);
	mysqli_query($con, $queryWrites);
	
}
	
?>