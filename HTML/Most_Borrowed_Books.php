<h1>Most Borrowed Books</h1>
<?php
include('methods.php');
$con = mysqli_connect("localhost", "admin", "password", "Library");
mysqli_select_db($con, "Library");
if (!$con){
	die("Connection failed: " . mysqli_connect_error());
}

frequentBorrowedBooks($LibID)
?>
