--CREATE DATABASE Library;
--USE Library;
CREATE TABLE Author (
	AuthorID int NOT NULL,
	AName VARCHAR(20) NOT NULL,
	PRIMARY KEY (AuthorID)
	);
	
CREATE TABLE Branch(
	LibID INT NOT NULL,
	Lname VARCHAR(20) NOT NULL,
	Llocation VARCHAR(20) NOT NULL,
	PRIMARY KEY(LibID)
	);
	
CREATE TABLE Publisher (
	PublisherID INT NOT NULL,
	PubName VARCHAR(20) NOT NULL,
	Address VARCHAR(50) NOT NULL,
	PRIMARY KEY (PublisherID)
	);

CREATE TABLE Chief_Editor (
	Editor_ID INT NOT NULL,
	EName VARCHAR(20) NOT NULL,
	PRIMARY KEY (Editor_ID)
	);

CREATE TABLE Reader (
	ReaderID INT NOT NULL,
	RType VARCHAR(10) NOT NULL,
	RName VARCHAR(10) NOT NULL,
	Address VARCHAR(10) NOT NULL,
    numReserved INT,
	PRIMARY KEY(ReaderID)     
	);	

CREATE TABLE Document (
	DocID INT NOT NULL,
	Title VARCHAR(300) NOT NULL,
	PDate DATETIME NOT NULL,
	PublisherID INT NOT NULL,
	PRIMARY KEY (DocID),
	FOREIGN KEY (PublisherID) REFERENCES Publisher(PublisherID)
	);

CREATE TABLE Book (
	DocID INT NOT NULL,
	ISBN INT NOT NULL,
	PRIMARY KEY (DocID),
	FOREIGN KEY (DocID) REFERENCES Document(DocID)
	);
	
CREATE TABLE Writes (
	AuthorID INT NOT NULL,
	DocID INT NOT NULL,
	FOREIGN KEY (AuthorID) REFERENCES Author(AuthorID),
	FOREIGN KEY (DocID) REFERENCES Book(DocID),
	PRIMARY KEY (AuthorID, DocID)
	);

CREATE TABLE Journal_Volume (
	DocID INT NOT NULL,
	JVolume INT NOT NULL,
	Editor_ID INT NOT NULL,
	PRIMARY KEY (DocID),
	FOREIGN KEY (DocID) REFERENCES Document(DocID)
	);
	
CREATE TABLE Journal_Issue (
	DocID INT NOT NULL,
	Issue_No INT NOT NULL,
	Scope VARCHAR(300) NOT NULL,
	PRIMARY KEY (DocID, Issue_No),
	FOREIGN KEY (DocID) REFERENCES Journal_Volume(DocID)
	);		

CREATE TABLE Inv_Editor (
	DocID INT NOT NULL,
	Issue_No INT NOT NULL,
	IEName VARCHAR(20) NOT NULL,
	PRIMARY KEY (DocID, Issue_No, IEName),
	FOREIGN KEY (DocID, Issue_No) REFERENCES Journal_Issue(DocID, Issue_No)
	);
	
CREATE TABLE Proceedings (
	DocID INT NOT NULL,
	CDate DATETIME NOT NULL,
	CLoacation VARCHAR(20) NOT NULL,
	CEditor VARCHAR(20) NOT NULL,
	PRIMARY KEY (DocID),
	FOREIGN KEY (DocID) REFERENCES Document(DocID)
	);
	
CREATE TABLE Admins (
	Username VARCHAR(20) NOT NULL,
	Password VARCHAR(20) NOT NULL
	);
	
CREATE TABLE Copy(
	DocID INT NOT NULL,
	CopyNO INT NOT NULL,
	LibID INT NOT NULL,
	Position VARCHAR(10) NOT NULL,
    	PRIMARY KEY(DocID, CopyNO , LibID),
    	FOREIGN KEY(DocID) REFERENCES Document(DocID),
	FOREIGN KEY(LibID) REFERENCES Branch(LibID)
 	);
	
CREATE TABLE Reserves(
	ResNO INT NOT NULL,
	ReaderID INT NOT NULL,
	DocID INT NOT NULL,
	CopyNO INT NOT NULL,
	LibID INT NOT NULL,
	DTime DATETIME NOT NULL,
	PRIMARY KEY(ResNO),
	FOREIGN KEY(ReaderID) REFERENCES Reader(ReaderID),
	FOREIGN KEY(DocID,CopyNO,LibID) REFERENCES Copy(DocID,CopyNO,LibID)
	);
	
CREATE TABLE Borrows(
	BorNO INT NOT NULL,
	ReaderID INT NOT NULL,
   	DocID INT NOT NULL,
	CopyNO INT NOT NULL,
	LibID INT NOT NULL,
	BDTime DATETIME NOT NULL,
    RDTime DATETIME NOT NULL, 	
	PRIMARY KEY(BorNO),
	FOREIGN KEY(ReaderID) REFERENCES Reader(ReaderID),
	FOREIGN KEY(DocID,CopyNO,LibID) REFERENCES Copy(DocID,CopyNO,LibID)
	);

-- Hunger Games
INSERT INTO Publisher
VALUES ("1111", "Publisher 1", "123 Address Ln");

INSERT INTO Document 
VALUES ("1111", "The Hunger Games", "2005-10-20", "1111");

INSERT INTO Branch
VALUES ("1111", "Library1", "Newark" );

INSERT INTO Copy
VALUES ("1111", "1", "1111", "South");

INSERT INTO Author
VALUES ("1111", "Suzanne Collins");

INSERT INTO Book
VALUES ('1111', '998877');

INSERT INTO Writes
VALUES ("1111", "1111");

-- Great Gatsby
INSERT INTO Publisher
VALUES ("1112", "Publisher 2", "456 Address Ln");

INSERT INTO Document 
VALUES ("1112", "The Great Gatsby", "1950-10-20", "1112");

INSERT INTO Copy
VALUES ("1112", "1", "1111", "South");

INSERT INTO Author
VALUES ("1112", "F. Scott Fitzgerald");

INSERT INTO Book
VALUES ('1112', '998876');

INSERT INTO Writes
VALUES ("1112", "1112");
	
-- Moby Dick
INSERT INTO Publisher
VALUES ("1113", "Publisher 3", "789 Address Ln");

INSERT INTO Document 
VALUES ("1113", "Moby Dick", "1930-10-20", "1113");

INSERT INTO Branch
VALUES ("1112", "Library2", "Jersey City" );

INSERT INTO Copy
VALUES ("1113", "1", "1112", "South");

INSERT INTO Author
VALUES ("1113", "Herman Melville");

INSERT INTO Book
VALUES ('1113', '998878');

INSERT INTO Writes
VALUES ("1113", "1113");

-- Hamlet
INSERT INTO Publisher
VALUES ("1114", "Publisher 4", "987 Address Ln");

INSERT INTO Document 
VALUES ("1114", "Hamlet", "1700-10-20", "1114");

INSERT INTO Branch
VALUES ("1113", "Library3", "Bayonne" );

INSERT INTO Copy
VALUES ("1114", "1", "1113", "South");

INSERT INTO Author
VALUES ("1114", "William Shakespear");

INSERT INTO Book
VALUES ('1114', '998879');

INSERT INTO Writes
VALUES ("1114", "1114");

-- War and Peace
INSERT INTO Publisher
VALUES ("1115", "Publisher 5", "654 Address Ln");

INSERT INTO Document 
VALUES ("1115", "War and Peace", "1200-10-20", "1115");

INSERT INTO Branch
VALUES ("1115", "Library5", "Nutley" );

INSERT INTO Copy
VALUES ("1115", "1", "1115", "South");

INSERT INTO Author
VALUES ("1115", "Leo Tolstoy");

INSERT INTO Book
VALUES ('1115', '998889');

INSERT INTO Writes
VALUES ("1115", "1115");

-- The Oddyssey
INSERT INTO Publisher
VALUES ("1116", "Publisher 6", "321 Address Ln");

INSERT INTO Document 
VALUES ("1116", "The Odyssey", "1950-10-20", "1116");

INSERT INTO Branch
VALUES ("1116", "Library6", "Clifton" );

INSERT INTO Copy
VALUES ("1116", "1", "1116", "South");

INSERT INTO Author
VALUES ("1116", "Homer");

INSERT INTO Book
VALUES ('1116', '998888');

INSERT INTO Writes
VALUES ("1116", "1116");

-- The Iliad
INSERT INTO Document 
VALUES ("1117", "The Iliad", "1950-10-20", "1116");

INSERT INTO Copy
VALUES ("1117", "1", "1116", "South");

INSERT INTO Book
VALUES ('1117', '998887');

INSERT INTO Writes
VALUES ("1116", "1117");


-- Alice's Adventures in Wonderland
INSERT INTO Publisher
VALUES ("1118", "Publisher 8", "159 Address Ln");

INSERT INTO Document 
VALUES ("1118", "Alice's Adventures in Wonderland", "1862-10-20", "1118");

INSERT INTO Branch
VALUES ("1117", "Library7", "Teaneck" );

INSERT INTO Copy
VALUES ("1118", "1", "1117", "South");

INSERT INTO Author
VALUES ("1118", "Lewis Carroll");

INSERT INTO Book
VALUES ('1118', '998886');

INSERT INTO Writes
VALUES ("1118", "1118");


-- Pride and Prejudice
INSERT INTO Publisher
VALUES ("1119", "Publisher 9", "685 Address Ln");

INSERT INTO Document 
VALUES ("1119", "Pride and Prejudice", "1765-10-20", "1119");

INSERT INTO Branch
VALUES ("1119", "Library9", "Lodi" );

INSERT INTO Copy
VALUES ("1119", "1", "1119", "South");

INSERT INTO Author
VALUES ("1119", "Jane Auston");

INSERT INTO Book
VALUES ('1119', '998885');

INSERT INTO Writes
VALUES ("1119", "1119");


-- The Catcher in the Rye
INSERT INTO Publisher
VALUES ("1110", "Publisher 10", "354 Address Ln");

INSERT INTO Document 
VALUES ("1110", "The Catcher in the Rye", "1945-10-20", "1110");

INSERT INTO Copy
VALUES ("1110", "1", "1119", "South");

INSERT INTO Author
VALUES ("1110", "J.D. Salinger");

INSERT INTO Book
VALUES ('1110', '998884');

INSERT INTO Writes
VALUES ("1110", "1110");


-- 1984
INSERT INTO Publisher
VALUES ("1121", "Publisher 10", "741 Address Ln");

INSERT INTO Document 
VALUES ("1121", "1984", "1954-10-20", "1121");

INSERT INTO Branch
VALUES ("1121", "Library11", "Branch Brook" );

INSERT INTO Copy
VALUES ("1121", "1", "1121", "South");

INSERT INTO Author
VALUES ("1121", "George Orwell");

INSERT INTO Book
VALUES ('1121', '998884');

INSERT INTO Writes
VALUES ("1121", "1121");


-- Catch-22
INSERT INTO Publisher
VALUES ("1122", "Publisher 11", "852 Address Ln");

INSERT INTO Document 
VALUES ("1122", "Catch-22", "1961-10-20", "1122");

INSERT INTO Copy
VALUES ("1122", "1", "1121", "South");

INSERT INTO Author
VALUES ("1122", "Joseph Heller");

INSERT INTO Book
VALUES ('1122', '998883');

INSERT INTO Writes
VALUES ("1122", "1122");


-- The Grapes of Wrath
INSERT INTO Publisher
VALUES ("1123", "Publisher 12", "963 Address Ln");

INSERT INTO Document 
VALUES ("1123", "The Grapes of Wrath", "1400-10-20", "1123");

INSERT INTO Branch
VALUES ("1123", "Library12", "Morrisetown" );

INSERT INTO Copy
VALUES ("1123", "1", "1123", "South");

INSERT INTO Author
VALUES ("1123", "John Steinbeck");

INSERT INTO Book
VALUES ('1123', '998883');

INSERT INTO Writes
VALUES ("1123", "1123");

INSERT INTO Publisher
VALUES ("1234", "Publisher 1234", "1234 Publisher Ln");

Insert into Document
VALUES ("1234", "Proceeding 1234", "2009-05-21", "1234");

INSERT INTO Copy
VALUES ("1234", "1", "1111", "NE");

INSERT INTO Proceedings
VALUES ("1234", "2019-04-27 03:25:32", "NE", "Hodor");


-- Next Proceeding



INSERT INTO Publisher
VALUES ("8960", "Publisher 8960", "8960 Publisher Ln");

Insert into Document
VALUES ("8960", "Proceeding 8960", "2007-12-21", "8960");


INSERT INTO Copy
VALUES ("8960", "1", "1111", "SE");

INSERT INTO Proceedings
VALUES ("8960", "2018-08-27 03:25:32", "SE", "Riley");


-- Next Proceeding

INSERT INTO Publisher
VALUES ("5200", "Publisher 5200", "5200 Publisher Ln");

Insert into Document
VALUES ("5200", "Proceeding 5200", "2012-05-21", "5200");

INSERT INTO Copy
VALUES ("5200", "1", "1111", "NW");

INSERT INTO Proceedings
VALUES ("5200", "2019-02-17 03:25:32", "NW", "Samwell");


-- Next Proceeding

INSERT INTO Publisher
VALUES ("1928", "Publisher 1928", "1928 Publisher Ln");

Insert into Document
VALUES ("1928", "Proceeding 1928", "2011-08-22", "1928");

INSERT INTO Copy
VALUES ("1928", "1", "1111", "SW");

INSERT INTO Proceedings
VALUES ("1928", "2019-03-19 03:25:32", "SW", "Jerome");


-- Next Proceeding

INSERT INTO Publisher
VALUES ("1293", "Publisher 1293", "1928 Publisher Ln");

Insert into Document
VALUES ("1293", "Proceeding 1293", "2017-12-15", "1293");

INSERT INTO Copy
VALUES ("1293", "1", "1111", "SW");

INSERT INTO Proceedings
VALUES ("1293", "2019-03-19 03:25:32", "SW", "Jerome");


-- Next Proceeding

INSERT INTO Publisher
VALUES ("1294", "Publisher 1294", "1928 Publisher Ln");

Insert into Document
VALUES ("1294", "Proceeding 1294", "2013-04-07", "1293");


INSERT INTO Copy
VALUES ("1294", "1", "1111", "NW");

INSERT INTO Proceedings
VALUES ("1294", "2019-03-19 03:25:32", "NW", "Jerome");


-- Next Proceeding

INSERT INTO Publisher
VALUES ("9872", "Publisher 9872", "1928 Publisher Ln");

Insert into Document
VALUES ("9872", "Proceeding 9872", "2015-07-14", "9872");


INSERT INTO Copy
VALUES ("9872", "1", "1111", "NE");

INSERT INTO Proceedings
VALUES ("9872", "2019-03-19 03:25:32", "NE", "Jerome");

-- Next Proceeding

INSERT INTO Publisher
VALUES ("2198", "Publisher 2198", "1928 Publisher Ln");

Insert into Document
VALUES ("2198", "Proceeding 2198", "2011-11-11", "2198");


INSERT INTO Copy
VALUES ("2198", "1", "1111", "SW");

INSERT INTO Proceedings
VALUES ("2198", "2019-03-19 03:25:32", "SW", "Jerome");

-- Next Proceeding

INSERT INTO Publisher
VALUES ("6876", "Publisher 6876", "1928 Publisher Ln");

Insert into Document
VALUES ("6876", "Proceeding 6876", "2015-09-21", "6876");


INSERT INTO Copy
VALUES ("6876", "1", "1111", "NE");

INSERT INTO Proceedings
VALUES ("6876", "2019-03-19 03:25:32", "NE", "Jerome");

-- Next Proceeding

INSERT INTO Publisher
VALUES ("5312", "Publisher 5312", "1928 Publisher Ln");

Insert into Document
VALUES ("5312", "Proceeding 5312", "2015-06-06", "5312");


INSERT INTO Copy
VALUES ("5312", "1", "1111", "SE");

INSERT INTO Proceedings
VALUES ("5312", "2019-03-19 03:25:32", "SE", "Jerome");

-- Next Proceeding

INSERT INTO Publisher
VALUES ("4235", "Publisher 4235", "1928 Publisher Ln");

Insert into Document
VALUES ("4235", "Proceeding 4235", "2015-07-07", "4235");


INSERT INTO Copy
VALUES ("4235", "1", "1111", "SW");

INSERT INTO Proceedings
VALUES ("4235", "2019-03-19 03:25:32", "SW", "Jerome");

-- Next Proceeding

INSERT INTO Publisher
VALUES ("2351", "Publisher 2351", "1928 Publisher Ln");

Insert into Document
VALUES ("2351", "Proceeding 2351", "2015-08-08", "2351");


INSERT INTO Copy
VALUES ("2351", "1", "1111", "NE");

INSERT INTO Proceedings
VALUES ("2351", "2019-03-19 03:25:32", "NE", "Jerome");

-- Next Proceeding

INSERT INTO Publisher
VALUES ("9978", "Publisher 9978", "1928 Publisher Ln");

Insert into Document
VALUES ("9978", "Proceeding 9978", "2015-09-09", "9978");


INSERT INTO Copy
VALUES ("9978", "1", "1111", "NW");

INSERT INTO Proceedings
VALUES ("9978", "2019-03-19 03:25:32", "NW", "Jerome");

INSERT INTO Branch VALUES("601", "Van Houten", "Newark");

INSERT INTO Publisher VALUES("4001", "Journal of ACM" , "New York");
INSERT INTO Publisher VALUES("4002", "Springer" , "New York");
INSERT INTO Publisher VALUES("4003", "IEEE" , "New York");

INSERT INTO Document VALUES ("2001", "Exact Algorithms via Monotone Local Search", "2019-04-02", "4001");
INSERT INTO Document VALUES ("2002", "Capacity Upper Bounds for Deletion-type Channels", "2019-04-02", "4001");
INSERT INTO Document VALUES ("2003", "Approximate Counting and inference in Graphical Methods", "2019-04-03", "4001");
INSERT INTO Document VALUES ("2004", "International Journal of Computer Vision", "2019-04-03", "4002");
INSERT INTO Document VALUES ("2005", "Advances in Data Analysis and Classification", "2019-04-07", "4002");
INSERT INTO Document VALUES ("2006", "Archival Science", "2019-04-07", "4002");
INSERT INTO Document VALUES ("2007", "Artificial Intelligence and Law", "2019-04-09", "4002");
INSERT INTO Document VALUES ("2008", "Transcaction on Pattern Analysis and Machine Intelligence", "2017-04-09", "4003");
INSERT INTO Document VALUES ("2009", "Computational Intelligence Magazine", "2014-04-07", "4003");
INSERT INTO Document VALUES ("2010", "Transaction on Fuzzy system", "2014-04-07", "4003");
INSERT INTO Document VALUES ("2011", "Big Data Analytics", "2014-04-07", "4002");
INSERT INTO Document VALUES ("2012", "Data Science and Engineering", "2014-04-07", "4002");

INSERT INTO Journal_Volume VALUES("2001","66","3001");
INSERT INTO Journal_Volume VALUES("2002","66","3002");
INSERT INTO Journal_Volume VALUES("2003","66","3003");
INSERT INTO Journal_Volume VALUES("2004","21","3004");
INSERT INTO Journal_Volume VALUES("2005","2","3005");
INSERT INTO Journal_Volume VALUES("2006","12","3006");
INSERT INTO Journal_Volume VALUES("2007","12","3007");
INSERT INTO Journal_Volume VALUES("2008","1","3008");
INSERT INTO Journal_Volume VALUES("2009","6","3009");
INSERT INTO Journal_Volume VALUES("2010","13","3010");
INSERT INTO Journal_Volume VALUES("2011","126","3011");
INSERT INTO Journal_Volume VALUES("2012","80","3012");

INSERT INTO Journal_Issue VALUES("2001", "1","a new general approach for designing exact exponential-time algorithms for subset problems.");
INSERT INTO Journal_Issue VALUES("2002","2", "We develop a systematic approach, based on convex programming.");
INSERT INTO Journal_Issue VALUES("2003","3" , "introduce a new approach to approximate counting in bounded degree systems.");
INSERT INTO Journal_Issue VALUES("2004","4" , "provides a forum for the dissemination of new research results in the rapidly growing field of computer vision.");
INSERT INTO Journal_Issue VALUES("2005","5", "extraction of knowable aspects from many types of data.");
INSERT INTO Journal_Issue VALUES("2006","6", "peer-reviewed journal on archival science.");
INSERT INTO Journal_Issue VALUES("2007","7", "explores the legacy of the influential HYPO system of Rissland and Ashley.");
INSERT INTO Journal_Issue VALUES("2008","8", "publish the articles on pattern analysis and recognition in selected areas of Computer vision and image processing.");
INSERT INTO Journal_Issue VALUES("2009","9", "publish the articles and research paper that present novel insights in all area of computational intelligenc.");
INSERT INTO Journal_Issue VALUES("2010","10", " publishes high quality technical papers in the theory, design and application of fuzzy systems.");
INSERT INTO Journal_Issue VALUES("2011","11", "present cutting edge articles in all aspects of big data analytics.");
INSERT INTO Journal_Issue VALUES("2012","12", "It provides in-depth coverage of the latest advances in the closely related fields of data science and data engineering.");

INSERT INTO Chief_Editor VALUES("3001", "Eva Tardos");
INSERT INTO Chief_Editor VALUES("3002", "Mahdi Cheraghchi");
INSERT INTO Chief_Editor VALUES("3003", "Ankur Moitra");
INSERT INTO Chief_Editor VALUES("3004", "M. Hebert");
INSERT INTO Chief_Editor VALUES("3005", "M. Vichi");
INSERT INTO Chief_Editor VALUES("3006", "K. Anderson");
INSERT INTO Chief_Editor VALUES("3007", "K.D. Ashley");
INSERT INTO Chief_Editor VALUES("3008", "Sven Dickinson");
INSERT INTO Chief_Editor VALUES("3009", "Hisao Ishibuchi");
INSERT INTO Chief_Editor VALUES("3010", "Jonathan Garibaldi");
INSERT INTO Chief_Editor VALUES("3011", "Amir Hussain");
INSERT INTO Chief_Editor VALUES("3012", "X. S. Wang");

INSERT INTO Inv_Editor VALUES("2001","1","Fedor V. fomin");
INSERT INTO Inv_Editor VALUES("2002","2","Serge Gaspers");
INSERT INTO Inv_Editor VALUES("2003","3","Daniel Lokshtanov");
INSERT INTO Inv_Editor VALUES("2004","4","X. Tang");
INSERT INTO Inv_Editor VALUES("2005","5","A. Okada");
INSERT INTO Inv_Editor VALUES("2006","6","G. Oliver");
INSERT INTO Inv_Editor VALUES("2007","7","T. Bench-Capon");
INSERT INTO Inv_Editor VALUES("2008","8","Kristen Grauman");
INSERT INTO Inv_Editor VALUES("2009","9","Mark David");
INSERT INTO Inv_Editor VALUES("2010","10","Hamid R. Berenji");
INSERT INTO Inv_Editor VALUES("2011","11","Asim Roy");
INSERT INTO Inv_Editor VALUES("2012","12","Elisa Bertino");

INSERT INTO Copy VALUES("2001", "501", "601" , "NE");
INSERT INTO Copy VALUES("2002", "502", "601" , "NE");
INSERT INTO Copy VALUES("2003", "503", "601" , "NE");
INSERT INTO Copy VALUES("2004", "504", "601" , "NE");
INSERT INTO Copy VALUES("2005", "505", "601" , "NE");
INSERT INTO Copy VALUES("2006", "506", "601" , "NE");
INSERT INTO Copy VALUES("2007", "507", "601" , "NE");
INSERT INTO Copy VALUES("2008", "508", "601" , "NE");
INSERT INTO Copy VALUES("2009", "509", "601" , "NE");
INSERT INTO Copy VALUES("2010", "510", "601" , "NE");
INSERT INTO Copy VALUES("2011", "511", "601" , "NE");
INSERT INTO Copy VALUES("2012", "512", "601" , "NE");
