<?php
include("methods.php");
session_start();

$BorNO=$_POST['BorNO'];
echo "BorNo   : ".$BorNO;
$DocID=$_POST['DocID'];
echo "DocID   : ".$DocID;
$ReaderID=$_SESSION['CardNumber'];
echo "ReaderID: ".$ReaderID
$CopyNO=$_POST['CopyNO'];
echo "CopyNO  : ".$CopyNO;
$LibID=$_POST['LibID'];
echo "LibID   : ".$LibID;

docCheckout($BorNO, $ReaderID, $DocID, $CopyNO, $LibID);

?>
