<?php
include("methods.php");
session_start();
echo "HI"
$BorNO=$_POST['BorNO'];
$DocID=$_POST['DocID'];
$ReaderID=$_POST['ReaderID'];
$CopyNO=$_POST['CopyNO'];
$LibID=$_POST['LibID'];

docCheckout($BorNO, $ReaderID, $DocID, $CopyNO, $LibID);

?>
