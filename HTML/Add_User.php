<?php
session_start();
$ReaderID=$_POST['readerid'];
$RType=$_POST['rtype'];
$RName=$_POST['rname'];
$RAddress=$_POST['raddress'];

addReader($ReaderID, $RType, $RName, $RAddress);
echo "<br>ReaderID: ".$ReaderID;
echo "<br>RType: ".$RType;
echo "<br>RName: ".$RName;
echo "<br>RAddress : ".$RAddress;
?>
