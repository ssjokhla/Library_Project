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
	
	$query = "SELECT * FROM Admins WHERE username = '$id' and password = '$pw'";
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
	
	$query = "SELECT * FROM Document WHERE DocID = '$input'";
	$result = mysqli_query($con, $s);
	
	echo($result);
	
	
}

function searchTitle($input)
{
	$con = mysqli_connect($ip, $mysqlUser, $mysqlPassword, $mysqlDB);
	mysqli_select_db($con, $mysqlDB);
	
	$query = "SELECT * FROM Document WHERE Title = '$input'";
	$result = mysqli_query($con, $s);
	
	return $result;
}

function searchPubName($input)
{
	$con = mysqli_connect($ip, $mysqlUser, $mysqlPassword, $mysqlDB);
	mysqli_select_db($con, $mysqlDB);
	
	$query = "SELECT * FROM Document,Publisher WHERE Pubname = '$input'";
	$result = mysqli_query($con, $s);
	
	return $result;
}

function docCheckout($BorNO, $readerID, $docID, $copyNO, $libID)
{
	
	$con = mysqli_connect("localhost", "admin", "password", "Library");
	mysqli_select_db($con, "Library");

	if (!$con){
		die("Connection failed: " . mysqli_connect_error());
	}
	//$query = "INSERT into Borrows (BorNO, ReaderID, DocID, CopyNO, LibID, BDTime) VALUES ('1111', '111111', '1111', '1', '1111', NOW())";
	$query = "INSERT into Borrows (BorNO, ReaderID, DocID, CopyNO, LibID, BDTime) VALUES ('$BorNO', '$readerID', '$docID', '$copyNO', '$libID', NOW())";	
	mysqli_query($con, $query);
	echo $result;
	echo "Query sent";
}

function docReturn()
{
	$con = mysqli_connect($ip, $mysqlUser, $mysqlPassword, $mysqlDB);
	mysqli_select_db($con, $mysqlDB);
	
	$query = "INSERT into Borrows (ReaderID, DocID, CopyNO, LibID, RDTime) VALUES ('$readerID', '$docID', '$copyNO', '$libID', NOW())";
}

function docReserve($ResNO, $readerID, $docID, $copyNO, $libID)
{
	$con = mysqli_connect($ip, $mysqlUser, $mysqlPassword, $mysqlDB);
	mysqli_select_db($con, $mysqlDB);
	
	$query1 = "SELECT * from numReserved WHERE ReaderID = '$readerID'";
	$result1 = mysqli_query($con, $query2);
	if($result1 < 10)
	{
		$query = "INSERT into Reserves (ResNO, ReaderID, DocID, CopyNO, LibID, DTime) VALUES ('$ResNO', '$readerID', '$docID', '$copyNO', '$libID', NOW())";
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
	
	$query1 = "Select BDTime FROM Borrows WHERE Bornumber = '$Bornumber' AND  ReaderID = '$readerID'";
	$BDTime = mysqli_query($con, $query1);
	
	$query2 = "Select RDTime FROM Borrows WHERE Bornumber = '$Bornumber' AND  ReaderID = '$readerID'";
	$RDTime = mysqli_query($con, $query2);
	
	$diffTime = $RDTime - $BDTime;
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
	$query1 = "Select Title FROM Reader NATURAL JOIN Reserves NATURAL JOIN Document WHERE Reader.ReaderID = '$readerID'";
	$BDTime = mysqli_query($con, $query1);
	
	echo "These are the documents that are borrowed";
	$query2 = "Select Title FROM Reader NATURAL JOIN Borrows NATURAL JOIN Document WHERE Reader.ReaderID = '$readerID'";
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
$docID, $docTitle, $docPDate,
//Branch (branch)
$branchLibID, $branchLName, $branchLLocation,
//Copy (copy)
$copyCopyNO, $copyPosition,
//Author (author)
$authorAuthorID,
//Book (book)
$bookISBN
)
{
	$con = mysqli_connect($ip, $mysqlUser, $mysqlPassword, $mysqlDB);
	mysqli_select_db($con, $mysqlDB);
	
	$queryPublisher = "INSERT INTO Publisher VALUES ('$pubPubID', '$pubName', '$pubAddress')";
	$queryDocument = "INSERT INTO Document VALUES ('$docID', '$docTitle', '$docPDate', '$docPubID')";
	$queryBranch = "INSERT INTO Branch VALUES ('$branchLibID', '$branchLName', '$branchLLocation')";
	$queryCopy = "INSERT INTO Copy VALUES ('$docID', '$copyCopyNO', '$branchLibID', '$copyPosition')";
	$queryAuthor = "INSERT INTO Author VALUES ('$authorAuthorID', '$docID')";
	$queryBook = "INSERT INTO Book VALUES ('$docID', '$bookISBN')";
	$queryWrites = "INSERT INTO Writes VALUES ('$authorAuthorID', '$docID')";
	
	
	
	mysqli_query($con, $queryPublisher);
	mysqli_query($con, $queryDocument);
	mysqli_query($con, $queryBranch);
	mysqli_query($con, $queryCopy);
	mysqli_query($con, $queryAuthor);
	mysqli_query($con, $queryBook);
	mysqli_query($con, $queryWrites);
	
}

function addProceeding
(
//Publisher (pub)
$pubPubID, $pubName, $pubAddress,
//Document (doc)
$docID, $docTitle, $docPDate,
//Copy (copy)
$copyCopyNO, $copyLibID, $copyPosition,
//Proceeding (proc)
$procCDate, $procLocation, $procCEditor
)
{
	$con = mysqli_connect($ip, $mysqlUser, $mysqlPassword, $mysqlDB);
	mysqli_select_db($con, $mysqlDB);
	
	$queryPublisher = "INSERT INTO Publisher VALUES ('$pubPubID', '$pubName', '$pubAddress')";
	$queryDocument = "INSERT INTO Document VALUES ('$docID', '$docTitle', '$docPDate', '$pubPubID')";
	$queryCopy = "INSERT INTO Copy VALUES ('$docID', '$copyCopyNO', '$copyLibID', '$copyPosition')";
	$queryProceeding = "INSERT INTO Proceeding VALUES ('$$docID', '$procCDate', '$procLocation', '$procCEditor')";

	mysqli_query($con, $queryPublisher);
	mysqli_query($con, $queryDocument);
	mysqli_query($con, $queryCopy);
	mysqli_query($con, $queryProceeding);
	
}

function addJournalVolume
(
//Branch (branch)
$branchLibID, $branchLName, $branchLLocation,
//Publisher (pub)
$pubPubID, $pubName, $pubAddress,
//Document (doc)
$docID, $docTitle, $docPDate,
//Journal_Volume
$jVolume, $editorID,
//Journal_Issue
$issueNo, $scope,
//Chief_Editor
$eName,
//Inv_Editor
$iEName,
//Copy (copy)
$copyCopyNO, $copyPosition

)
{
	$con = mysqli_connect($ip, $mysqlUser, $mysqlPassword, $mysqlDB);
	mysqli_select_db($con, $mysqlDB);
	
	$queryBranch = "INSERT INTO Branch VALUES ('$branchLibID', '$branchLName', '$branchLLocation')";
	$queryPublisher = "INSERT INTO Publisher VALUES ('$pubPubID', '$pubName', '$pubAddress')";
	$queryDocument = "INSERT INTO Document VALUES ('$docID', '$docTitle', '$docPDate', '$pubPubID')";
	$queryJournal_Volume = "INSERT INTO Journal_Volume VALUES ('$docID', '$jVolume', '$editorID')";
	$queryJournal_Issue = "INSERT INTO Journal_Issue VALUES ('$docID', '$issueNo', $scope')";
	$queryChief_Editor = "INSERT INTO Chief_Editor VALUES ('$editorID', '$eName')";
	$queryInv_Editor = "INSERT INTO Inv_Editor VALUES ('$docID', '$issueNo', '$iEName')";
	$queryCopy = "INSERT INTO Copy VALUES ('$docID', '$copyCopyNO', '$branchLibID', '$copyPosition')";
	
	
	mysqli_query($con, $queryBranch);
	mysqli_query($con, $queryPublisher);
	mysqli_query($con, $queryDocument);
	mysqli_query($con, $queryJournal_Volume);
	mysqli_query($con, $queryJournal_Issue);
	mysqli_query($con, $queryChief_Editor);
	mysqli_query($con, $queryInv_Editor);
	mysqli_query($con, $queryCopy);
	
}

function searchDoc($docID, $copyNo, $libID)
{
	$con = mysqli_connect($ip, $mysqlUser, $mysqlPassword, $mysqlDB);
	mysqli_select_db($con, $mysqlDB);
	
	$query1 = "SELECT * FROM Borrows WHERE DocID = '$docID' and CopyNO = '$copyNo' and LibID = '$LibID' and RDTime = Null";
	$result = mysqli_query($con, $query1);
	$resultCount = mysqli_num_rows($result);
	
	if($resultCount > 0)
	{
		echo "Status is available";
	}
	else
	{
		echo "Book has been borrowed";
	}
}

function addReader($readerID, $rType, $rName, $rAddress)
{
	$con = mysqli_connect($ip, $mysqlUser, $mysqlPassword, $mysqlDB);
	mysqli_select_db($con, $mysqlDB);
	
	$query1 = "INSERT INTO Reader VALUES('$readerID', '$rtype', '$rName', '$rAddress')";
	mysqli_query($con, $query1);
}

function printBranchInfo($libID)
{
	$con = mysqli_connect($ip, $mysqlUser, $mysqlPassword, $mysqlDB);
	mysqli_select_db($con, $mysqlDB);
	
	$query1 = "SELECT LName,LLocation FROM Branch";
	mysqli_query($con, $query1);
}

function frequentBorrowers()
{
	$con = mysqli_connect($ip, $mysqlUser, $mysqlPassword, $mysqlDB);
	mysqli_select_db($con, $mysqlDB);
	
	$query1 = "SELECT * FROM Borrows ORDERY BY ReaderID DESC limit 10";
	mysqli_query($con, $query1);
}

function frequentBorrowedBooks()
{
	$con = mysqli_connect($ip, $mysqlUser, $mysqlPassword, $mysqlDB);
	mysqli_select_db($con, $mysqlDB);
	
	$query1 = "SELECT * FROM Borrows, Copy, Document ORDERY BY Title DESC limit 10";
	mysqli_query($con, $query1);
}


function computeAverageFine($Bornumber, $readerID, $BDTime, $RDTime)
{
	$diffTime = 0;
	$fine = 0;
	$con = mysqli_connect($ip, $mysqlUser, $mysqlPassword, $mysqlDB);
	mysqli_select_db($con, $mysqlDB);
	
	$query1 = "Select BDTime FROM Borrows WHERE Bornumber = '$Bornumber' AND ReaderID = '$readerID'";
	$BDTime = mysqli_query($con, $query1);
	
	$query2 = "Select RDTime FROM Borrows WHERE Bornumber = '$Bornumber' AND ReaderID = '$readerID'";
	$RDTime = mysqli_query($con, $query2);
	
	$diffTime = $RDTime - $BDTime;
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
?>
