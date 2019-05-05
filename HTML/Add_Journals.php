<?php
include("methods.php");
session_start();

$docID=$_POST['docid'];
$docTitle=$_POST['doctitle'];
$docPDate=$_POST['docpdate'];
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
?>
