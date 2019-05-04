<?php
include("methods.php");
session_start();

$DocID=$_POST['DocID'];
$ReaderID=$_POST['ReaderID'];
$CopyNO=$_POST['CopyNO'];
$LibID=$_POST['LibID'];

docCheckout($ReaderID, $DocID, $CopyNO, $LibID);

?>
