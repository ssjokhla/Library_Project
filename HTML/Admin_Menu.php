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

                      				<input type = button value = View_Branch_Information onclick=window.location.href='View_Branch_Information.php' size= 40>  <br><br>
						<form action="/Most_Borrowers.php" method="post">
							Library ID:<br>
							<input type="text" name="DocID">
						<input type="submit" value="Most_Frequent_Borrowers">
						</form>

						<form action="/Most_Borrowed_Books.php" method="post">
                                                        Library ID:<br>
                                                        <input type="text" name="DocID">
                                                <input type="submit" value="View_Most_Borrowed_Books">
                                                </form>
	
						<form action="/Most_Popular_Books.php" method="post">
                                                        Year:<br>
                                                        <input type="text" name="Year">
                                                <input type="submit" value="View_Most_Popular_Books">
                                                </form>
					
						<input type = button value = Calculate_Average_Fine onclick = window.location.href='Avg_Price.html' size = 40> <br><br>
						
						<input type = button value = Quit onclick = window.location.href='MainPage.html' size = 40> <br><br>
						
			
    </body>
</html>	
