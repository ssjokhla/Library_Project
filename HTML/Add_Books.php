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
$copyPosition=$_POST['cpos'];
$pubPubID=$_POST['pid'];
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


?>
