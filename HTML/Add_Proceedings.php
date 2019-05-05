<?php
include("methods.php");
session_start();

$docID=$_POST['docid'];
$docTitle=$_POST['doctitle'];
$docPDate=$_POST['docpdate'];
$branchLibID=$_POST['libbrancid'];
$branchLName=$_POST['brname'];
$branchLLocation=$_POST['brloc'];
$copyCopyNO=$_POST['cpno'];
$copyPosition=$_POST['cpos'];
$PubID=$_POST['pid'];
$PubName=$_POST['pname'];
$PubAddress=$_POST['paddress'];
$procCDate=$_POST['iedname'];
$procLocation=$_POST['ploc'];
$procCEditor=$_POST['edname'];



addProceeding
(
//Publisher (pub)
$pubPubID, $pubName, $pubAddress,
//Document (doc)
$docID, $docTitle, $docPDate,
//Branch (branch)
$branchLibID, $branchLName, $branchLLocation,
//Copy (copy)
$copyCopyNO, $branchLibID, $copyPosition,
//Proceeding (proc)
$procCDate, $procLocation, $procCEditor
)
{
	$con = mysqli_connect($ip, $mysqlUser, $mysqlPassword, $mysqlDB);
	mysqli_select_db($con, $mysqlDB);
	
	$queryPublisher = "INSERT INTO Publisher VALUES ('$pubPubID', '$pubName', '$pubAddress')";
	$queryDocument = "INSERT INTO Document VALUES ('$docID', '$docTitle', '$docPDate', '$pubPubID')";
	$queryBranch = "INSERT INTO Branch VALUES ('$branchLibID', '$branchLName', '$branchLLocation')";
	$queryCopy = "INSERT INTO Copy VALUES ('$docID', '$copyCopyNO', '$copyLibID', '$copyPosition')";
	$queryProceeding = "INSERT INTO Proceeding VALUES ('$$docID', '$procCDate', '$procLocation', '$procCEditor')";

	mysqli_query($con, $queryPublisher);
	mysqli_query($con, $queryDocument);
	mysqli_query($con, $queryCopy);
	mysqli_query($con, $queryProceeding);
	
}
?>