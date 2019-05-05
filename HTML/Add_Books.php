<?php
echo "Hit PHP";
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
$authorName=$_POST['authname'];

echo "<BR> Variables Set, executing method.";

addBook($pubPubID, $pubName, $pubAddress, $docID, $docTitle, $docPDate, $copyCopyNO, $copyPosition, $authorAuthorID, $authorName, $bookISBN);


?>
