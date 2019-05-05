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
$pubPubID=$_POST['pid'];
$pubName=$_POST['pname'];
$pubAddress=$_POST['paddress'];
$issueNo=$_POST['isno'];
$jVolume=$_POST['volno'];
$scope=$_POST['iscope'];
$editorID=$_POST['edid'];
$eName=$_POST['edname'];
$iEName=$_POST['iedname'];

addJournalVolume
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
	$con = mysqli_connect("localhost", "admin", "password", "Library");
	mysqli_select_db($con, "Library");
	if (!$con)
	{
		die("Connection failed: " . mysqli_connect_error());
	}
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
?>
