-- MySQL dump 10.13  Distrib 5.6.33, for osx10.9 (x86_64)
--
-- Host: localhost    Database: shop
-- ------------------------------------------------------
-- Server version	5.6.33-log

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
-- Table structure for table `shop_admin`
--

DROP TABLE IF EXISTS `shop_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_admin` (
  `id` tinyint(3) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` char(32) NOT NULL,
  `email` varchar(60) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_admin`
--

LOCK TABLES `shop_admin` WRITE;
/*!40000 ALTER TABLE `shop_admin` DISABLE KEYS */;
INSERT INTO `shop_admin` VALUES (1,'admin','e10adc3949ba59abbe56e057f20f883e','1026251951@qq.com'),(9,'dsadsa','979d472a84804b9f647bc185a877a8b5','3123123@qqdsa'),(13,'ssad','38c55423e123aca445982dfd897a552d','dadddd'),(15,'123','9bd5ee6fe55aaeb673025dbcb8f939c1','323'),(16,'21321321','8335bf9d6e71a33e3806b16ed3a5b441','3123123'),(17,'sda','77d5a3ce97ccff226dcdaaf07d5721f5','dasdasd');
/*!40000 ALTER TABLE `shop_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_album`
--

DROP TABLE IF EXISTS `shop_album`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_album` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pid` int(10) unsigned NOT NULL,
  `albumPath` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_album`
--

LOCK TABLES `shop_album` WRITE;
/*!40000 ALTER TABLE `shop_album` DISABLE KEYS */;
INSERT INTO `shop_album` VALUES (10,10,'f370b299b094217564dc262ed24179e3.jpg'),(11,10,'8bf0dbb540f20d34cf7167f4519f44c4.jpg'),(12,9,'9594294982d9a53546fde674770ce84d.jpg'),(14,19,'3b5a7efc8bc580c13fafa9c44964776f.jpg'),(15,20,'a30574122740b2e359a5f22f60638786.jpg'),(16,21,'64bee6410cba0b6d28bfe6e11372b42a.jpg'),(17,21,'8c213a65489cfc0a9a29b6a06d3ee4e8.jpg'),(18,21,'52a67d34ecb605acf30b55eb73137e4c.jpg'),(19,23,'8fbe097508d16135eb50516eda19d826.jpg'),(20,23,'4447965149b640daa6b1092f56844cfe.jpg'),(21,9,'f90f9a4857625679ba1b85bd68310063.jpg'),(22,9,'f5b4eaeea94d780108774102d7071700.png'),(23,9,'8d9e3dd5e36a2ba2c67185ca7c1c393e.png');
/*!40000 ALTER TABLE `shop_album` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_cate`
--

DROP TABLE IF EXISTS `shop_cate`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_cate` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `cName` varchar(30) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `cName` (`cName`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_cate`
--

LOCK TABLES `shop_cate` WRITE;
/*!40000 ALTER TABLE `shop_cate` DISABLE KEYS */;
INSERT INTO `shop_cate` VALUES (10,'家用电器'),(12,'服装专区'),(13,'精品家具'),(14,'美食诱惑');
/*!40000 ALTER TABLE `shop_cate` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_pro`
--

DROP TABLE IF EXISTS `shop_pro`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_pro` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `pName` varchar(255) CHARACTER SET utf8 NOT NULL,
  `cId` int(10) unsigned NOT NULL,
  `pSn` varchar(50) NOT NULL,
  `pNum` int(10) unsigned DEFAULT '1',
  `mPrice` decimal(10,2) NOT NULL,
  `iPrice` decimal(10,2) NOT NULL,
  `pDesc` mediumtext CHARACTER SET utf8,
  `pubTime` int(10) unsigned NOT NULL,
  `isShow` tinyint(1) DEFAULT '1',
  `isHot` tinyint(1) DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `pName` (`pName`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_pro`
--

LOCK TABLES `shop_pro` WRITE;
/*!40000 ALTER TABLE `shop_pro` DISABLE KEYS */;
INSERT INTO `shop_pro` VALUES (9,'2',10,'2',3,3.00,3.00,'3',1470554656,1,0),(10,'1',13,'2',3,2.00,1.00,'222',1470554698,1,0),(12,'sdas',12,'123',321,321.00,123.00,'321',1470575268,1,0),(14,'213',10,'1',1,1.00,1.00,'1',1470575514,1,0),(17,'22222111',10,'1',1,1.00,2.00,'1',1470577273,1,0),(19,'123',10,'32',312,321.00,321.00,'3123',1470653473,1,0),(20,'dsd',10,'11',11,123.00,32.00,'2',1470653496,1,0),(21,'dasdsa',14,'1123',213,3123.00,3213.00,'321',1470659524,1,0),(22,'123ws',12,'321',312,321.00,321.00,'321',1470729630,1,0),(23,'1sdsa',0,'',0,0.00,0.00,'',1470729801,1,0),(24,'',0,'',0,0.00,0.00,'',1493968261,1,0),(26,'11',10,'11',2,11.00,11.00,'',1493968617,1,0);
/*!40000 ALTER TABLE `shop_pro` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shop_user`
--

DROP TABLE IF EXISTS `shop_user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shop_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(30) NOT NULL,
  `password` varchar(32) NOT NULL,
  `sex` enum('男','女','保密') NOT NULL DEFAULT '保密',
  `email` varchar(60) NOT NULL,
  `face` varchar(50) NOT NULL,
  `regTime` int(10) unsigned NOT NULL,
  `activeFlag` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shop_user`
--

LOCK TABLES `shop_user` WRITE;
/*!40000 ALTER TABLE `shop_user` DISABLE KEYS */;
INSERT INTO `shop_user` VALUES (4,'1213','caf1a3dfb505ffed0d024130f58c5cfa','女','312@qq.com','6587b0caaa877175f49c9c01b18e0b4b.jpg',1470733782,0),(6,'dsa','5315f0e93dda4c072fe44f489207ae3a','保密','123@qq.com','fa0262bc45b4f815458a8c65392b3899.jpg',1470733837,0),(7,'111','9a952cd91000872a8d7d1f5ee0c87317','女','1111@qq.com','10ddb354582c760e6db9ddf216d4e7c0.jpg',1470747657,0),(9,'123s','202cb962ac59075b964b07152d234b70','男','11@qq.com','15065d17dfc26d6f896f653ed5e37638.jpg',1470748023,0),(10,'admin','e10adc3949ba59abbe56e057f20f883e','男','11@qq.com','1eb7787de956d0f464eb15ce6a89e950.jpg',1472643268,0);
/*!40000 ALTER TABLE `shop_user` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-12-26 15:53:39
