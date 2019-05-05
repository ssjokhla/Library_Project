<?php
include("methods.php");
session_start();

$PubName=$_POST['PubName'];
echo "PubName   : ".$PubName;


printPublisher($PubName);

?>
