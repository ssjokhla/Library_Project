<?php
echo "Hit PHP";
include("methods.php");
session_start();
$libid=$_POST['branchinfo'];

echo "<BR> Variables Set, executing method.";
printBranchInfo($libid);
?>
