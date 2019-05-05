<?php
include("methods.php");
session_start();

$docID=$_POST['docid'];
$docTitle=$_POST['doctitle'];
$docPDate=$_POST['docpdate'];
$bookISBN=$_POST['isbn'];
$branchLibID=$_POST['libbrancid'];
$branchLName=$_POST['brname'];
$branchLLocation=$_POST['brloc'];
$copyCopyNO=$_POST['cpno'];
$CopyPOS=$_POST['cpos'];
$copyPosition=$_POST['pid'];
$pubName=$_POST['pname'];
$pubAddress=$_POST['paddress'];
$authorAuthorID=$_POST['authid'];



addBook
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

?>
