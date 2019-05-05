<?php
include("methods.php");
session_start();

$ResNO=$_POST['ResNO'];
echo "ResNo   : ".$ResNO;
$DocID=$_POST['DocID'];
echo "DocID   : ".$DocID;
$ReaderID=$_SESSION['CardNumber'];
echo "ReaderID: ".$ReaderID;
$CopyNO=$_POST['CopyNO'];
echo "CopyNO  : ".$CopyNO;
$LibID=$_POST['LibID'];
echo "LibID   : ".$LibID;

docReserve($ResNO, $ReaderID, $DocID, $CopyNO, $LibID);

?>
