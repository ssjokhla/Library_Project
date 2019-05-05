<?php
include("methods.php");
session_start();

$docID=$_POST['docid'];
$docTitle=$_POST['doctitle'];
$docPDate=$_POST['docpdate'];
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
//Copy (copy)
$copyCopyNO, $copyPosition,
//Proceeding (proc)
$procCDate, $procLocation, $procCEditor
)
?>
