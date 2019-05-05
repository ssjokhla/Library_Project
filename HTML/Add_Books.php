<?php
include("methods.php");
session_start();

$DocID=$_POST['docid'];
$DocTitle=$_POST['doctitle'];
$DocPDate=$_POST['docpdate'];
$ISBN=$_POST['isbn'];
$LibID=$_POST['libbrancid'];
$BName=$_POST['brname'];
$BLoc=$_POST['brloc'];
$CopyNO=$_POST['cpno'];
$CopyPOS=$_POST['cpos'];
$PubID=$_POST['pid'];
$PubName=$_POST['pname'];
$PubAddress=$_POST['paddress'];
$authorAuthorID=$_POST['authid'];



addBook
(
//Publisher (pub)
$PubID, $PubName, $PubAddress,
//Document (doc)
$DocID, $DocTitle, $DocPDate,
//Branch (branch)
$LibID, $BName, $BLoc,
//Copy (copy)
$CopyNO, $CopyPOS,
//Author (author)
$authorAuthorID,
//Book (book)
$ISBN
)


?>