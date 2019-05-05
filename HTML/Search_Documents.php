<?php
include('methods.php');
session_start();

$DocID=$_SESSION['docid'];
$CopyNO=$_SESSION['copyno'];
$LibID=$_SESSION['libid'];

searchDoc($DocID, $CopyNO, $LibID);

?>
