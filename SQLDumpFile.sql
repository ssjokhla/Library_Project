-- MySQL dump 10.13  Distrib 5.7.26, for Linux (x86_64)
--
-- Host: localhost    Database: Library
-- ------------------------------------------------------
-- Server version	5.7.26-0ubuntu0.18.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Admins`
--

DROP TABLE IF EXISTS `Admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Admins` (
  `Username` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Admins`
--

LOCK TABLES `Admins` WRITE;
/*!40000 ALTER TABLE `Admins` DISABLE KEYS */;
INSERT INTO `Admins` VALUES ('Admin','Password');
/*!40000 ALTER TABLE `Admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Author`
--

DROP TABLE IF EXISTS `Author`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Author` (
  `AuthorID` int(11) NOT NULL,
  `AName` varchar(20) NOT NULL,
  PRIMARY KEY (`AuthorID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Author`
--

LOCK TABLES `Author` WRITE;
/*!40000 ALTER TABLE `Author` DISABLE KEYS */;
INSERT INTO `Author` VALUES (1110,'J.D. Salinger'),(1111,'Suzanne Collins'),(1112,'F. Scott Fitzgerald'),(1113,'Herman Melville'),(1114,'William Shakespear'),(1115,'Leo Tolstoy'),(1116,'Homer'),(1118,'Lewis Carroll'),(1119,'Jane Auston'),(1121,'George Orwell'),(1122,'Joseph Heller'),(1123,'John Steinbeck');
/*!40000 ALTER TABLE `Author` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Book`
--

DROP TABLE IF EXISTS `Book`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Book` (
  `DocID` int(11) NOT NULL,
  `ISBN` int(11) NOT NULL,
  PRIMARY KEY (`DocID`),
  CONSTRAINT `Book_ibfk_1` FOREIGN KEY (`DocID`) REFERENCES `Document` (`DocID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Book`
--

LOCK TABLES `Book` WRITE;
/*!40000 ALTER TABLE `Book` DISABLE KEYS */;
INSERT INTO `Book` VALUES (1110,998884),(1111,998877),(1112,998876),(1113,998878),(1114,998879),(1115,998889),(1116,998888),(1117,998887),(1118,998886),(1119,998885),(1121,998884),(1122,998883),(1123,998883);
/*!40000 ALTER TABLE `Book` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Borrows`
--

DROP TABLE IF EXISTS `Borrows`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Borrows` (
  `BorNO` int(11) NOT NULL,
  `ReaderID` int(11) NOT NULL,
  `DocID` int(11) NOT NULL,
  `CopyNO` int(11) NOT NULL,
  `LibID` int(11) NOT NULL,
  `BDTime` datetime NOT NULL,
  `RDTime` datetime NOT NULL,
  PRIMARY KEY (`BorNO`),
  KEY `ReaderID` (`ReaderID`),
  KEY `DocID` (`DocID`,`CopyNO`,`LibID`),
  CONSTRAINT `Borrows_ibfk_1` FOREIGN KEY (`ReaderID`) REFERENCES `Reader` (`ReaderID`),
  CONSTRAINT `Borrows_ibfk_2` FOREIGN KEY (`DocID`, `CopyNO`, `LibID`) REFERENCES `Copy` (`DocID`, `CopyNO`, `LibID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Borrows`
--

LOCK TABLES `Borrows` WRITE;
/*!40000 ALTER TABLE `Borrows` DISABLE KEYS */;
/*!40000 ALTER TABLE `Borrows` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Branch`
--

DROP TABLE IF EXISTS `Branch`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Branch` (
  `LibID` int(11) NOT NULL,
  `Lname` varchar(20) NOT NULL,
  `Llocation` varchar(20) NOT NULL,
  PRIMARY KEY (`LibID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Branch`
--

LOCK TABLES `Branch` WRITE;
/*!40000 ALTER TABLE `Branch` DISABLE KEYS */;
INSERT INTO `Branch` VALUES (601,'Van Houten','Newark'),(1111,'Library1','Newark'),(1112,'Library2','Jersey City'),(1113,'Library3','Bayonne'),(1115,'Library5','Nutley'),(1116,'Library6','Clifton'),(1117,'Library7','Teaneck'),(1119,'Library9','Lodi'),(1121,'Library11','Branch Brook'),(1123,'Library12','Morrisetown');
/*!40000 ALTER TABLE `Branch` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Chief_Editor`
--

DROP TABLE IF EXISTS `Chief_Editor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Chief_Editor` (
  `Editor_ID` int(11) NOT NULL,
  `EName` varchar(20) NOT NULL,
  PRIMARY KEY (`Editor_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Chief_Editor`
--

LOCK TABLES `Chief_Editor` WRITE;
/*!40000 ALTER TABLE `Chief_Editor` DISABLE KEYS */;
INSERT INTO `Chief_Editor` VALUES (3001,'Eva Tardos'),(3002,'Mahdi Cheraghchi'),(3003,'Ankur Moitra'),(3004,'M. Hebert'),(3005,'M. Vichi'),(3006,'K. Anderson'),(3007,'K.D. Ashley'),(3008,'Sven Dickinson'),(3009,'Hisao Ishibuchi'),(3010,'Jonathan Garibaldi'),(3011,'Amir Hussain'),(3012,'X. S. Wang');
/*!40000 ALTER TABLE `Chief_Editor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Copy`
--

DROP TABLE IF EXISTS `Copy`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Copy` (
  `DocID` int(11) NOT NULL,
  `CopyNO` int(11) NOT NULL,
  `LibID` int(11) NOT NULL,
  `Position` varchar(10) NOT NULL,
  PRIMARY KEY (`DocID`,`CopyNO`,`LibID`),
  KEY `LibID` (`LibID`),
  CONSTRAINT `Copy_ibfk_1` FOREIGN KEY (`DocID`) REFERENCES `Document` (`DocID`),
  CONSTRAINT `Copy_ibfk_2` FOREIGN KEY (`LibID`) REFERENCES `Branch` (`LibID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Copy`
--

LOCK TABLES `Copy` WRITE;
/*!40000 ALTER TABLE `Copy` DISABLE KEYS */;
INSERT INTO `Copy` VALUES (1110,1,1119,'South'),(1111,1,1111,'South'),(1112,1,1111,'South'),(1113,1,1112,'South'),(1114,1,1113,'South'),(1115,1,1115,'South'),(1116,1,1116,'South'),(1117,1,1116,'South'),(1118,1,1117,'South'),(1119,1,1119,'South'),(1121,1,1121,'South'),(1122,1,1121,'South'),(1123,1,1123,'South'),(1234,1,1111,'NE'),(1293,1,1111,'SW'),(1294,1,1111,'NW'),(1928,1,1111,'SW'),(2001,501,601,'NE'),(2002,502,601,'NE'),(2003,503,601,'NE'),(2004,504,601,'NE'),(2005,505,601,'NE'),(2006,506,601,'NE'),(2007,507,601,'NE'),(2008,508,601,'NE'),(2009,509,601,'NE'),(2010,510,601,'NE'),(2011,511,601,'NE'),(2012,512,601,'NE'),(2198,1,1111,'SW'),(2351,1,1111,'NE'),(4235,1,1111,'SW'),(5200,1,1111,'NW'),(5312,1,1111,'SE'),(6876,1,1111,'NE'),(8960,1,1111,'SE'),(9872,1,1111,'NE'),(9978,1,1111,'NW');
/*!40000 ALTER TABLE `Copy` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Document`
--

DROP TABLE IF EXISTS `Document`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Document` (
  `DocID` int(11) NOT NULL,
  `Title` varchar(300) NOT NULL,
  `PDate` datetime NOT NULL,
  `PublisherID` int(11) NOT NULL,
  PRIMARY KEY (`DocID`),
  KEY `PublisherID` (`PublisherID`),
  CONSTRAINT `Document_ibfk_1` FOREIGN KEY (`PublisherID`) REFERENCES `Publisher` (`PublisherID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Document`
--

LOCK TABLES `Document` WRITE;
/*!40000 ALTER TABLE `Document` DISABLE KEYS */;
INSERT INTO `Document` VALUES (1110,'The Catcher in the Rye','1945-10-20 00:00:00',1110),(1111,'The Hunger Games','2005-10-20 00:00:00',1111),(1112,'The Great Gatsby','1950-10-20 00:00:00',1112),(1113,'Moby Dick','1930-10-20 00:00:00',1113),(1114,'Hamlet','1700-10-20 00:00:00',1114),(1115,'War and Peace','1200-10-20 00:00:00',1115),(1116,'The Odyssey','1950-10-20 00:00:00',1116),(1117,'The Iliad','1950-10-20 00:00:00',1116),(1118,'Alice\'s Adventures in Wonderland','1862-10-20 00:00:00',1118),(1119,'Pride and Prejudice','1765-10-20 00:00:00',1119),(1121,'1984','1954-10-20 00:00:00',1121),(1122,'Catch-22','1961-10-20 00:00:00',1122),(1123,'The Grapes of Wrath','1400-10-20 00:00:00',1123),(1234,'Proceeding 1234','2009-05-21 00:00:00',1234),(1293,'Proceeding 1293','2017-12-15 00:00:00',1293),(1294,'Proceeding 1294','2013-04-07 00:00:00',1293),(1928,'Proceeding 1928','2011-08-22 00:00:00',1928),(2001,'Exact Algorithms via Monotone Local Search','2019-04-02 00:00:00',4001),(2002,'Capacity Upper Bounds for Deletion-type Channels','2019-04-02 00:00:00',4001),(2003,'Approximate Counting and inference in Graphical Methods','2019-04-03 00:00:00',4001),(2004,'International Journal of Computer Vision','2019-04-03 00:00:00',4002),(2005,'Advances in Data Analysis and Classification','2019-04-07 00:00:00',4002),(2006,'Archival Science','2019-04-07 00:00:00',4002),(2007,'Artificial Intelligence and Law','2019-04-09 00:00:00',4002),(2008,'Transcaction on Pattern Analysis and Machine Intelligence','2017-04-09 00:00:00',4003),(2009,'Computational Intelligence Magazine','2014-04-07 00:00:00',4003),(2010,'Transaction on Fuzzy system','2014-04-07 00:00:00',4003),(2011,'Big Data Analytics','2014-04-07 00:00:00',4002),(2012,'Data Science and Engineering','2014-04-07 00:00:00',4002),(2198,'Proceeding 2198','2011-11-11 00:00:00',2198),(2351,'Proceeding 2351','2015-08-08 00:00:00',2351),(4235,'Proceeding 4235','2015-07-07 00:00:00',4235),(5200,'Proceeding 5200','2012-05-21 00:00:00',5200),(5312,'Proceeding 5312','2015-06-06 00:00:00',5312),(6876,'Proceeding 6876','2015-09-21 00:00:00',6876),(8960,'Proceeding 8960','2007-12-21 00:00:00',8960),(9872,'Proceeding 9872','2015-07-14 00:00:00',9872),(9978,'Proceeding 9978','2015-09-09 00:00:00',9978);
/*!40000 ALTER TABLE `Document` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Inv_Editor`
--

DROP TABLE IF EXISTS `Inv_Editor`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Inv_Editor` (
  `DocID` int(11) NOT NULL,
  `Issue_No` int(11) NOT NULL,
  `IEName` varchar(20) NOT NULL,
  PRIMARY KEY (`DocID`,`Issue_No`,`IEName`),
  CONSTRAINT `Inv_Editor_ibfk_1` FOREIGN KEY (`DocID`, `Issue_No`) REFERENCES `Journal_Issue` (`DocID`, `Issue_No`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Inv_Editor`
--

LOCK TABLES `Inv_Editor` WRITE;
/*!40000 ALTER TABLE `Inv_Editor` DISABLE KEYS */;
INSERT INTO `Inv_Editor` VALUES (2001,1,'Fedor V. fomin'),(2002,2,'Serge Gaspers'),(2003,3,'Daniel Lokshtanov'),(2004,4,'X. Tang'),(2005,5,'A. Okada'),(2006,6,'G. Oliver'),(2007,7,'T. Bench-Capon'),(2008,8,'Kristen Grauman'),(2009,9,'Mark David'),(2010,10,'Hamid R. Berenji'),(2011,11,'Asim Roy'),(2012,12,'Elisa Bertino');
/*!40000 ALTER TABLE `Inv_Editor` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Journal_Issue`
--

DROP TABLE IF EXISTS `Journal_Issue`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Journal_Issue` (
  `DocID` int(11) NOT NULL,
  `Issue_No` int(11) NOT NULL,
  `Scope` varchar(300) NOT NULL,
  PRIMARY KEY (`DocID`,`Issue_No`),
  CONSTRAINT `Journal_Issue_ibfk_1` FOREIGN KEY (`DocID`) REFERENCES `Journal_Volume` (`DocID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Journal_Issue`
--

LOCK TABLES `Journal_Issue` WRITE;
/*!40000 ALTER TABLE `Journal_Issue` DISABLE KEYS */;
INSERT INTO `Journal_Issue` VALUES (2001,1,'a new general approach for designing exact exponential-time algorithms for subset problems.'),(2002,2,'We develop a systematic approach, based on convex programming.'),(2003,3,'introduce a new approach to approximate counting in bounded degree systems.'),(2004,4,'provides a forum for the dissemination of new research results in the rapidly growing field of computer vision.'),(2005,5,'extraction of knowable aspects from many types of data.'),(2006,6,'peer-reviewed journal on archival science.'),(2007,7,'explores the legacy of the influential HYPO system of Rissland and Ashley.'),(2008,8,'publish the articles on pattern analysis and recognition in selected areas of Computer vision and image processing.'),(2009,9,'publish the articles and research paper that present novel insights in all area of computational intelligenc.'),(2010,10,' publishes high quality technical papers in the theory, design and application of fuzzy systems.'),(2011,11,'present cutting edge articles in all aspects of big data analytics.'),(2012,12,'It provides in-depth coverage of the latest advances in the closely related fields of data science and data engineering.');
/*!40000 ALTER TABLE `Journal_Issue` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Journal_Volume`
--

DROP TABLE IF EXISTS `Journal_Volume`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Journal_Volume` (
  `DocID` int(11) NOT NULL,
  `JVolume` int(11) NOT NULL,
  `Editor_ID` int(11) NOT NULL,
  PRIMARY KEY (`DocID`),
  CONSTRAINT `Journal_Volume_ibfk_1` FOREIGN KEY (`DocID`) REFERENCES `Document` (`DocID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Journal_Volume`
--

LOCK TABLES `Journal_Volume` WRITE;
/*!40000 ALTER TABLE `Journal_Volume` DISABLE KEYS */;
INSERT INTO `Journal_Volume` VALUES (2001,66,3001),(2002,66,3002),(2003,66,3003),(2004,21,3004),(2005,2,3005),(2006,12,3006),(2007,12,3007),(2008,1,3008),(2009,6,3009),(2010,13,3010),(2011,126,3011),(2012,80,3012);
/*!40000 ALTER TABLE `Journal_Volume` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Proceedings`
--

DROP TABLE IF EXISTS `Proceedings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Proceedings` (
  `DocID` int(11) NOT NULL,
  `CDate` datetime NOT NULL,
  `CLoacation` varchar(20) NOT NULL,
  `CEditor` varchar(20) NOT NULL,
  PRIMARY KEY (`DocID`),
  CONSTRAINT `Proceedings_ibfk_1` FOREIGN KEY (`DocID`) REFERENCES `Document` (`DocID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Proceedings`
--

LOCK TABLES `Proceedings` WRITE;
/*!40000 ALTER TABLE `Proceedings` DISABLE KEYS */;
INSERT INTO `Proceedings` VALUES (1234,'2019-04-27 03:25:32','NE','Hodor'),(1293,'2019-03-19 03:25:32','SW','Jerome'),(1294,'2019-03-19 03:25:32','NW','Jerome'),(1928,'2019-03-19 03:25:32','SW','Jerome'),(2198,'2019-03-19 03:25:32','SW','Jerome'),(2351,'2019-03-19 03:25:32','NE','Jerome'),(4235,'2019-03-19 03:25:32','SW','Jerome'),(5200,'2019-02-17 03:25:32','NW','Samwell'),(5312,'2019-03-19 03:25:32','SE','Jerome'),(6876,'2019-03-19 03:25:32','NE','Jerome'),(8960,'2018-08-27 03:25:32','SE','Riley'),(9872,'2019-03-19 03:25:32','NE','Jerome'),(9978,'2019-03-19 03:25:32','NW','Jerome');
/*!40000 ALTER TABLE `Proceedings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Publisher`
--

DROP TABLE IF EXISTS `Publisher`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Publisher` (
  `PublisherID` int(11) NOT NULL,
  `PubName` varchar(20) NOT NULL,
  `Address` varchar(50) NOT NULL,
  PRIMARY KEY (`PublisherID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Publisher`
--

LOCK TABLES `Publisher` WRITE;
/*!40000 ALTER TABLE `Publisher` DISABLE KEYS */;
INSERT INTO `Publisher` VALUES (1110,'Publisher 10','354 Address Ln'),(1111,'Publisher 1','123 Address Ln'),(1112,'Publisher 2','456 Address Ln'),(1113,'Publisher 3','789 Address Ln'),(1114,'Publisher 4','987 Address Ln'),(1115,'Publisher 5','654 Address Ln'),(1116,'Publisher 6','321 Address Ln'),(1118,'Publisher 8','159 Address Ln'),(1119,'Publisher 9','685 Address Ln'),(1121,'Publisher 10','741 Address Ln'),(1122,'Publisher 11','852 Address Ln'),(1123,'Publisher 12','963 Address Ln'),(1234,'Publisher 1234','1234 Publisher Ln'),(1293,'Publisher 1293','1928 Publisher Ln'),(1294,'Publisher 1294','1928 Publisher Ln'),(1928,'Publisher 1928','1928 Publisher Ln'),(2198,'Publisher 2198','1928 Publisher Ln'),(2351,'Publisher 2351','1928 Publisher Ln'),(4001,'Journal of ACM','New York'),(4002,'Springer','New York'),(4003,'IEEE','New York'),(4235,'Publisher 4235','1928 Publisher Ln'),(5200,'Publisher 5200','5200 Publisher Ln'),(5312,'Publisher 5312','1928 Publisher Ln'),(6876,'Publisher 6876','1928 Publisher Ln'),(8960,'Publisher 8960','8960 Publisher Ln'),(9872,'Publisher 9872','1928 Publisher Ln'),(9978,'Publisher 9978','1928 Publisher Ln');
/*!40000 ALTER TABLE `Publisher` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Reader`
--

DROP TABLE IF EXISTS `Reader`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Reader` (
  `ReaderID` int(11) NOT NULL,
  `RType` varchar(10) NOT NULL,
  `RName` varchar(10) NOT NULL,
  `Address` varchar(10) NOT NULL,
  `numReserved` int(11) DEFAULT NULL,
  PRIMARY KEY (`ReaderID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Reader`
--

LOCK TABLES `Reader` WRITE;
/*!40000 ALTER TABLE `Reader` DISABLE KEYS */;
INSERT INTO `Reader` VALUES (111111,'student','Sam Mish','456 Road',NULL);
/*!40000 ALTER TABLE `Reader` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Reserves`
--

DROP TABLE IF EXISTS `Reserves`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Reserves` (
  `ResNO` int(11) NOT NULL,
  `ReaderID` int(11) NOT NULL,
  `DocID` int(11) NOT NULL,
  `CopyNO` int(11) NOT NULL,
  `LibID` int(11) NOT NULL,
  `DTime` datetime NOT NULL,
  PRIMARY KEY (`ResNO`),
  KEY `ReaderID` (`ReaderID`),
  KEY `DocID` (`DocID`,`CopyNO`,`LibID`),
  CONSTRAINT `Reserves_ibfk_1` FOREIGN KEY (`ReaderID`) REFERENCES `Reader` (`ReaderID`),
  CONSTRAINT `Reserves_ibfk_2` FOREIGN KEY (`DocID`, `CopyNO`, `LibID`) REFERENCES `Copy` (`DocID`, `CopyNO`, `LibID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Reserves`
--

LOCK TABLES `Reserves` WRITE;
/*!40000 ALTER TABLE `Reserves` DISABLE KEYS */;
/*!40000 ALTER TABLE `Reserves` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Writes`
--

DROP TABLE IF EXISTS `Writes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Writes` (
  `AuthorID` int(11) NOT NULL,
  `DocID` int(11) NOT NULL,
  PRIMARY KEY (`AuthorID`,`DocID`),
  KEY `DocID` (`DocID`),
  CONSTRAINT `Writes_ibfk_1` FOREIGN KEY (`AuthorID`) REFERENCES `Author` (`AuthorID`),
  CONSTRAINT `Writes_ibfk_2` FOREIGN KEY (`DocID`) REFERENCES `Book` (`DocID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Writes`
--

LOCK TABLES `Writes` WRITE;
/*!40000 ALTER TABLE `Writes` DISABLE KEYS */;
INSERT INTO `Writes` VALUES (1110,1110),(1111,1111),(1112,1112),(1113,1113),(1114,1114),(1115,1115),(1116,1116),(1116,1117),(1118,1118),(1119,1119),(1121,1121),(1122,1122),(1123,1123);
/*!40000 ALTER TABLE `Writes` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2019-05-04 21:21:06
