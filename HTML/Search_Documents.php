<?php
include('methods.php');
session_start();

$DocID=$_POST['docid'];
$CopyNO=$_POST['copyno'];
$LibID=$_POST['libid'];

searchDoc($DocID, $CopyNO, $LibID);

?>
