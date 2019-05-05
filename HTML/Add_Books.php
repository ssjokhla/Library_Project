<?php
include("methods.php");
session_start();

$docID=$_POST['docid'];
$docTitle=$_POST['doctitle'];
$docPDate=$_POST['docpdate'];
$bookISBN=$_POST['isbn'];
$copyCopyNO=$_POST['cpno'];
$copyPosition=$_POST['cpos'];
$pubPubID=$_POST['pid'];
$pubName=$_POST['pname'];
$pubAddress=$_POST['paddress'];
$authorAuthorID=$_POST['authid'];
$authorName=$_POST['authname']



addBook
(
//Publisher (pub)
$pubPubID, $pubName, $pubAddress,
//Document (doc)
$docID, $docTitle, $docPDate,
//Copy (copy)
$copyCopyNO, $copyPosition,
//Author (author)
$authorAuthorID, $authorName
//Book (book)
$bookISBN
)


?>
