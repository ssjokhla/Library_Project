<?php
include("methods.php");
session_start();

$BorNO=$_POST['BorNO'];
echo "BorNo   : ".$BorNO;


computeFine($BorNO);

?>
