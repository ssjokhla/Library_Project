<?php
session_start();

$admUser=$_POST['admUser'];
$admPass=$_POST['admPass'];

$con = mysqli_connect("localhost", "admin", "password", "Library");
mysqli_select_db($con, "Library");

$s = "select * from Admins where Username = '$admUser' and Password = '$admPass'";
$t = mysqli_query($con, $s);
$rowCount = mysqli_num_rows($t);
if($rowCount > 0)
	{
		//If there are users log in works
		//echo "Successful Login";
	}
	else
	{
		//If there are 0 entries then log in fails
		echo "Error in logging in";
		return "Bad Login\n";
	}


?>
<HTML>
    <BODY>  
		   		        <P> Which type of functionality do you want to perform from below list : </p> <br><br>
						
						<input type = button value = Add_Documents onclick=window.location.href='Documents_Add_Option.html' size = 40>  <br><br>
						
						<input type = button value = Search_Documents onclick=window.location.href='Search_Documents.html' size= 40> <br><br>
			   
			            <input type = button value = Add_New_User onclick=window.location.href='Add_User.html' size= 40> <br><br>

                        <input type = button value = View_Branch_Information onclick=window.location.href='View_Branch_Information.html' size= 40>  <br><br>

						<input type = button value = Most_Frequent_Borrowers onclick=window.location.href='Most_Borrowers.html' size= 40> <br><br>
						
						<input type = button value = View_Most_Borrowed_Books onclick = window.location.href='Most_Borrowed_Books.html' size = 40> <br><br>
						
						<input type = button value = View_Most_Popular_Books onclick = window.location.href='Most_Popular_Books.html' size = 40> <br><br>
						
						<input type = button value = Calculate_Average_Fine onclick = window.location.href='Avg_Price.html' size = 40> <br><br>
						
						<input type = button value = Quit onclick = window.location.href='Admin_Menu.html' size = 40> <br><br>
						
			
    </body>
</html>	