<?php
include("methods.php");
session_start();

$BorNO=$_POST['BorNO'];
$DocID=$_POST['DocID'];
$ReaderID=$_SESSION['CardNumber'];
$CopyNO=$_POST['CopyNO'];
$LibID=$_POST['LibID'];

docCheckout($BorNO, $ReaderID, $DocID, $CopyNO, $LibID);

?>
