<?php

//Mysql IP either localhost or ipaddress
$IP = "localhost";
//Mysql Username
$mysqlUser = "admin";
//Mysql Password
$mysqlPassword = "password";
//Mysql Database Name
$mysqlDB = "Library";
//-------------------------------------------------------//


//Main Menu Functions
function checkReader($input)
{
	//Connect to mysql
	$con = mysqli_connect("localhost", "admin", "password", "Library");
	mysqli_select_db($con, "Library");

	if (!$con)
	{
		die("Connection failed: " . mysqli_connect_error());
	}
	$query = "SELECT * from Reader";
	$result = mysqli_query($con, $s);
	
	return $result;
	
}

function checkAdmin($id, $pw)
{
	$con = mysqli_connect("localhost", "admin", "password", "Library");
	mysqli_select_db($con, "Library");

	if (!$con)
	{
		die("Connection failed: " . mysqli_connect_error());
	}
	$query = "SELECT * FROM Admins WHERE username = '$id' and password = '$pw'";
	$result = mysqli_query($con, $query);
	$rowCount = mysqli_num_rows($result);
	if($rowCount > 0)
	{
		echo "Successful Login";
	}
	else
	{
		echo "Error in logging in";
		return "Bad Login\n";
	}
	return true;
}

//-------------------------------------------------------//

//Reader Functions
function searchID($input)
{
	$con = mysqli_connect("localhost", "admin", "password", "Library");
	mysqli_select_db($con, "Library");

	if (!$con)
	{
		die("Connection failed: " . mysqli_connect_error());
	}	
	$query = "SELECT * FROM Document WHERE DocID = '$input'";
	$result = mysqli_query($con, $s);
	
	echo($result);
	
	
}

function searchTitle($input)
{
	$con = mysqli_connect("localhost", "admin", "password", "Library");
	mysqli_select_db($con, "Library");

	if (!$con)
	{
		die("Connection failed: " . mysqli_connect_error());
	}
	$query = "SELECT * FROM Document WHERE Title = '$input'";
	$result = mysqli_query($con, $s);
	
	return $result;
}

function searchPubName($input)
{
	$con = mysqli_connect("localhost", "admin", "password", "Library");
	mysqli_select_db($con, "Library");

	if (!$con)
	{
		die("Connection failed: " . mysqli_connect_error());
	}
	$query = "SELECT * FROM Document,Publisher WHERE Pubname = '$input'";
	$result = mysqli_query($con, $s);
	
	return $result;
}

function docCheckout($BorNO, $readerID, $docID, $copyNO, $libID)
{
	
	$con = mysqli_connect("localhost", "admin", "password", "Library");
	mysqli_select_db($con, "Library");

	if (!$con)
	{
		die("Connection failed: " . mysqli_connect_error());
	}
	//$query = "INSERT into Borrows (BorNO, ReaderID, DocID, CopyNO, LibID, BDTime) VALUES ('1111', '111111', '1111', '1', '1111', NOW())";
	$query = "INSERT into Borrows (BorNO, ReaderID, DocID, CopyNO, LibID, BDTime) VALUES ('$BorNO', '$readerID', '$docID', '$copyNO', '$libID', NOW())";	
	mysqli_query($con, $query);
	echo $result;
	echo "Query sent";
}

function docReturn($Bornumber)
{
	
	$con = mysqli_connect("localhost", "admin", "password", "Library");
	mysqli_select_db($con, "Library");
	if (!$con)
	{
		die("Connection failed: " . mysqli_connect_error());
	}
	
	$query = "UPDATE Borrows SET RDTime = NOW() WHERE BorNO = '$Bornumber'";
	mysqli_query($con,$query);
	echo "Query Sent";
}

function docReserve($ResNO, $readerID, $docID, $copyNO, $libID)
{
	$con = mysqli_connect("localhost", "admin", "password", "Library");
	mysqli_select_db($con, "Library");

	if (!$con)
	{
		die("Connection failed: " . mysqli_connect_error());
	}
		$query = "INSERT into Reserves (ResNO, ReaderID, DocID, CopyNO, LibID, DTime) VALUES ('$ResNO', '$readerID', '$docID', '$copyNO', '$libID', NOW())";
		mysqli_query($con, $query);
}

function computeFine($Bornumber)
{
	echo "<br>Method hit";
	echo "<br>Bornumber is: ".$Bornumber;
	echo "<br>";
	$fine = 0;
	$con = mysqli_connect("localhost", "admin", "password", "Library");
	mysqli_select_db($con, "Library");

	if (!$con)
	{
		die("Connection failed: " . mysqli_connect_error());
	}
	$queryd1 = "SELECT BDTime FROM Borrows WHERE BorNO = '$Bornumber'";
	$queryd2 = "SELECT NOW()";
	
	$date1 = mysqli_query($con, $queryd1);
	$date2 = mysqli_query($con, $queryd2);

	$strDate1 = "";
	$strDate2 = "";
        if (mysqli_num_rows($date1) != 0)
        {	
             while($rows = mysqli_fetch_array($date1,MYSQLI_ASSOC))
		{
			$strDate1 = $rows['BDTime'];
			echo "String Date1: ".$strDate1;
			echo "<br>";
               	}
        }

	if (mysqli_num_rows($date2) != 0)
        {
             while($row = mysqli_fetch_array($date2,MYSQLI_ASSOC))
             {
		     $strDate2 = $row['NOW()'];
		     echo "String Date2: ".$strDate2;
		     echo "<br>";
             }
        }


	//$strd1 = strtotime($date1);
	$fine = 0;
	$diff = 20;
	$sstrDate1 = strtotime($strDate1);
	echo "THE DATE STRING FOR D1 IS: ".$sstrDate1;
	$sstrDate2 = strtotime($strDate2);
	echo "<br>THE CURRENT DATE STRING IS: ".$sstrDate2;
	$diff = abs($sstrDate2 - $sstrDate1);
	echo "<br> The Difference is: ".$diff;
	$diffDays = floor($diff/86400);
	echo "<br>The difference in days is : ".$diffDays;
	if($diffDays < 20)
	{
		$fine = 0;
	}
	else
	{
		$fine = $diffDays*.20;
	}
	echo "<br>Fine is: $" . $fine;
}

function printDocs($readerID)
{
	$con = mysqli_connect("localhost", "admin", "password", "Library");
	mysqli_select_db($con, "Library");

	if (!$con)
	{
		die("Connection failed: " . mysqli_connect_error());
	}
	echo "These are the documents that are reserved";
	$query1 = "Select Title FROM Reader NATURAL JOIN Reserves NATURAL JOIN Document WHERE Reader.ReaderID = '$readerID'";
	$BDTime = mysqli_query($con, $query1);
	
	echo "These are the documents that are borrowed";
	$query2 = "Select Title FROM Reader NATURAL JOIN Borrows NATURAL JOIN Document WHERE Reader.ReaderID = '$readerID'";
	$BDTime = mysqli_query($con, $query2);
}

function printPublisher($pubID)
{
	$con = mysqli_connect("localhost", "admin", "password", "Library");
	mysqli_select_db($con, "Library");

	if (!$con)
	{
		die("Connection failed: " . mysqli_connect_error());
	}
	$query1 = "Select DocID, Title FROM Document,Publisher WHERE Publisher.PublisherID = '$pubID'";
	$result = mysqli_query($con, $query1);
	if (mysqli_num_rows($result) != 0)
	{
        	echo "<table>";
        	echo "<table class='table'>";
        	//echo "<tbody>";
        	echo"<tr><th>Borrow ID</th><th>Title</th></tr>";
        	while($rows = mysqli_fetch_array($result,MYSQLI_ASSOC))
        	{
	
                	echo "</td><td>".$rows['DocID'];
               		echo "</td><td>".$rows['Title']."</td></tr>";
        	}
        echo "</table>";
	}
	
}

//Administrative Funtions Menu
function addBook($pubPubID, $pubName, $pubAddress,$docID, $docTitle, $docPDate, $copyCopyNO, $copyPosition,$authorAuthorID, $authorName,$bookISBN)
{
	echo "Method Hit.<br>";
	echo "<br> pubID: ".$pubPubID;
	echo "<br> pubName: ".$pubName;
	echo "<br> pubAddress: ".$pubAddress;
	echo "<br> documentID: ".$docID;
	echo "<br> documentTitle: ".$docTitle;
	echo "<br> docPDate: ".$docPDate;
	echo "<br> copyNO: ".$copyCopyNO;
	echo "<br> copyPos: ".$copyPosition;
	echo "<br> authorID: ".$authorAuthorID;
	echo "<br> authorName: ".$authorName;
	echo "<br> bookISBN: ".$bookISBN;
	$con = mysqli_connect("localhost", "admin", "password", "Library");
	mysqli_select_db($con, "Library");

	if (!$con)
	{
		die("Connection failed: " . mysqli_connect_error());
	}

	$queryPublisher = "INSERT INTO Publisher VALUES ('$pubPubID', '$pubName', '$pubAddress')";
	$queryDocument = "INSERT INTO Document VALUES ('$docID', '$docTitle', '$docPDate', '$pubPubID')";
	$queryCopy = "INSERT INTO Copy VALUES ('$docID', '$copyCopyNO', '1111', '$copyPosition')";
	$queryAuthor = "INSERT INTO Author VALUES ('$authorAuthorID', '$authorName')";
	$queryBook = "INSERT INTO Book VALUES ('$docID', '$bookISBN')";
	$queryWrites = "INSERT INTO Writes VALUES ('$authorAuthorID', '$docID')";
	
	
	echo "<BR> Variables Set";
	
	mysqli_query($con, $queryPublisher);
	mysqli_query($con, $queryDocument);
	mysqli_query($con, $queryCopy);
	mysqli_query($con, $queryAuthor);
	mysqli_query($con, $queryBook);
	mysqli_query($con, $queryWrites);

	echo "<BR> All Queries Ran";
}

function addProceeding
(
//Publisher (pub)
$pubPubID, $pubName, $pubAddress,
//Document (doc)
$docID, $docTitle, $docPDate,
//Copy (copy)
$copyCopyNO, $copyPosition,
//Proceeding (proc)
$procCDate, $procLocation, $procCEditor
)
{

	echo "PubID: ".$pubPubID;
	$con = mysqli_connect("localhost", "admin", "password", "Library");
        mysqli_select_db($con, "Library");

        if (!$con)
        {
                die("Connection failed: " . mysqli_connect_error());
	}

	echo "<br> After Database Connect";
	$queryPublisher = "INSERT INTO Publisher VALUES ('$pubPubID', '$pubName', '$pubAddress')";
	$queryDocument = "INSERT INTO Document VALUES ('$docID', '$docTitle', '$docPDate', '$pubPubID')";
	$queryCopy = "INSERT INTO Copy VALUES ('$docID', '$copyCopyNO', '1111', '$copyPosition')";
	$queryProceeding = "INSERT INTO Proceedings VALUES ('$docID', '$procCDate', '$procLocation', '$procCEditor')";

	echo "<br> Sending SQL Queries";
	mysqli_query($con, $queryPublisher);
	mysqli_query($con, $queryDocument);
	mysqli_query($con, $queryCopy);
	mysqli_query($con, $queryProceeding);
	echo "<br> SQL Queries Sent";

}

function addJournalVolume
(
//Publisher (pub)
$pubPubID, $pubName, $pubAddress,
//Document (doc)
$docID, $docTitle, $docPDate,
//Journal_Volume
$jVolume, $editorID,
//Journal_Issue
$issueNo, $scope,
//Chief_Editor
$eName,
//Inv_Editor
$iEName,
//Copy (copy)
$copyCopyNO, $copyPosition

)
{
	$con = mysqli_connect("localhost", "admin", "password", "Library");
	mysqli_select_db($con, "Library");

	if (!$con)
	{
		die("Connection failed: " . mysqli_connect_error());
	}
	$queryPublisher = "INSERT INTO Publisher VALUES ('$pubPubID', '$pubName', '$pubAddress')";
	$queryDocument = "INSERT INTO Document VALUES ('$docID', '$docTitle', '$docPDate', '$pubPubID')";
	$queryJournal_Volume = "INSERT INTO Journal_Volume VALUES ('$docID', '$jVolume', '$editorID')";
	$queryJournal_Issue = "INSERT INTO Journal_Issue VALUES ('$docID', '$issueNo', '$scope')";
	$queryChief_Editor = "INSERT INTO Chief_Editor VALUES ('$editorID', '$eName')";
	$queryInv_Editor = "INSERT INTO Inv_Editor VALUES ('$docID', '$issueNo', '$iEName')";
	$queryCopy = "INSERT INTO Copy VALUES ('$docID', '$copyCopyNO', '1111', '$copyPosition')";
	
	
	mysqli_query($con, $queryPublisher);
	mysqli_query($con, $queryDocument);
	mysqli_query($con, $queryJournal_Volume);
	mysqli_query($con, $queryJournal_Issue);
	mysqli_query($con, $queryChief_Editor);
	mysqli_query($con, $queryInv_Editor);
	mysqli_query($con, $queryCopy);
	
}

function searchDoc($docID, $copyNo, $libID)
{
	$con = mysqli_connect("localhost", "admin", "password", "Library");
	mysqli_select_db($con, "Library");

	if (!$con)
	{
		die("Connection failed: " . mysqli_connect_error());
	}
	$query1 = "SELECT * FROM Borrows WHERE DocID = '$docID' and CopyNO = '$copyNo' and LibID = '$LibID' and RDTime = Null";
	$result = mysqli_query($con, $query1);
	$resultCount = mysqli_num_rows($result);
	
	if($resultCount > 0)
	{
		echo "Status is available";
	}
	else
	{
		echo "Book has been borrowed";
	}
}

function addReader($readerID, $rType, $rName, $rAddress)
{
	echo "<br> Function Hit.";
	$con = mysqli_connect("localhost", "admin", "password", "Library");
	mysqli_select_db($con, "Library");

	if (!$con)
	{
		die("Connection failed: " . mysqli_connect_error());
	}
	$query1 = "INSERT INTO Reader VALUES('$readerID', '$rType', '$rName', '$rAddress', '0')";
	mysqli_query($con, $query1);
}

function printBranchInfo()
{
	$con = mysqli_connect("localhost", "admin", "password", "Library");
	mysqli_select_db($con, "Library");

	if (!$con)
	{
		die("Connection failed: " . mysqli_connect_error());
	}	
	$query = "SELECT LName,LLocation FROM Branch";
	$SearchResult = mysqli_query($con, $query);
	$rowCount = mysqli_num_rows($SearchResult);
	#var_dump(getType(urlICS($rows['Name'], $rows['Location'], $rows['Description'], $rows['Google_Time_Start'], $rows['Google_Time_End'])));
	if (mysqli_num_rows($result) != 0)
	{
		echo "result /=0<br>";
		echo "<table>";
		echo"<tr><th>Branch Name</th><th>Branch Location</th></tr>";
		while($rows = mysqli_fetch_array($result,MYSQLI_ASSOC))
		{
		
			echo "<tr><td>".$rows['LName'];
			echo "</td><td>".$rows['LLocation']."</td></tr>";
		}
	echo "</table>";
	}
}

function frequentBorrowers($LibID)
{
	$con = mysqli_connect("localhost", "admin", "password", "Library");
	mysqli_select_db($con, "Library");

	if (!$con)
	{
		die("Connection failed: " . mysqli_connect_error());
	}
	$query = "select * from Borrows left join Reserves on Borrows.ReaderID = Reserves.ReaderID WHERE Borrows.LibID = '$LibID' union select * from Borrows right join Reserves on Borrows.ReaderID = Reserves.ReaderID WHERE Reserves.LibID = '$LibID' limit 10";

	$SearchResult = mysqli_query($con, $query);
	
	$rowCount = mysqli_num_rows($SearchResult);
	if (mysqli_num_rows($rowCount) != 0)
	{
		echo "<table>";
		echo"<tr><th>Branch Name</th><th>Branch Location</th></tr>";
		while($rows = mysqli_fetch_array($SearchResult,MYSQLI_ASSOC))
		{
		
			echo "<tr><td>".$rows['ReaderID']."</td></tr>";
		}
	echo "</table>";
	}		
}

function frequentBorrowedBooks()
{
	$con = mysqli_connect("localhost", "admin", "password", "Library");
	mysqli_select_db($con, "Library");

	if (!$con)
	{
		die("Connection failed: " . mysqli_connect_error());
	}
	//$query = "select * from Borrows left join Reserves on Borrows.ReaderID = Reserves.ReaderID union select * from Borrows right join Reserves on Borrows.ReaderID = Reserves.ReaderID where extract(year from BDtime) limit 10";
	$query = "select * from Borrows , Reserves full join Reserves where extract(year from BDtime) group by Reserves.DocID and Borrows.DocID having max(Borrows.DocID) and max(Reserves.DocID) limit 10; 
	$SearchResult = mysqli_query($con, $query);
	
	$rowCount = mysqli_num_rows($SearchResult);
	if (mysqli_num_rows($rowCount) != 0)
	{
		echo "result /=0<br>";
		echo "<table>";
		echo"<tr><th>Branch Name</th><th>Branch Location</th></tr>";
		while($rows = mysqli_fetch_array($SearchResult,MYSQLI_ASSOC))
		{
		
			echo "<tr><td>".$rows['ReaderID']."</td></tr>";
		}
	echo "</table>";
	}		
}


function computeAverageFine($Bornumber, $readerID, $BDTime, $RDTime)
{

	$con = mysqli_connect("localhost", "admin", "password", "Library");
	mysqli_select_db($con, "Library");

	if (!$con)
	{
		die("Connection failed: " . mysqli_connect_error());
	}	
	$query = "select * from Borrows left join Reserves on Borrows.ReaderID = Reserves.ReaderID union select * from Borrows right join Reserves on Borrows.ReaderID = Reserves.ReaderID where extract(year from BDtime) limit 10";
	$SearchResult = mysqli_query($con, $query);
	
	$rowCount = mysqli_num_rows($SearchResult);
	if (mysqli_num_rows($rowCount) != 0)
	{
		echo "result /=0<br>";
		echo "<table>";
		echo"<tr><th>Branch Name</th><th>Branch Location</th></tr>";
		while($rows = mysqli_fetch_array($SearchResult,MYSQLI_ASSOC))
		{
		
			echo "<tr><td>".$rows['ReaderID']."</td></tr>";
		}
	echo "</table>";
	}		
}
?>
