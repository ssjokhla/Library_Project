<?php
session_start();
$ReaderID=$_POST['readerid'];
$RType=$_POST['rtype'];
$RName=$_POST['rname'];
$RAddress=$_POST['raddress'];

addReader($ReaderID, $RType, $RName, $RAddress);



?>
