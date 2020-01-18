-- MySQL dump 10.13  Distrib 5.7.17, for Win64 (x86_64)
--
-- Host: localhost    Database: bdportaria
-- ------------------------------------------------------
-- Server version	5.7.14

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
-- Table structure for table `hospedagem`
--

DROP TABLE IF EXISTS `hospedagem`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hospedagem` (
  `idHospedagem` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) DEFAULT NULL,
  `mensagem` varchar(50) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `idCidade` int(11) DEFAULT NULL,
  PRIMARY KEY (`idHospedagem`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hospedagem`
--

LOCK TABLES `hospedagem` WRITE;
/*!40000 ALTER TABLE `hospedagem` DISABLE KEYS */;
/*!40000 ALTER TABLE `hospedagem` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `portaria`
--

DROP TABLE IF EXISTS `portaria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `portaria` (
  `idPortaria` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) NOT NULL,
  `texto` text,
  `dataInicio` timestamp NULL DEFAULT NULL,
  `dataTermino` timestamp NULL DEFAULT NULL,
  `arquivo` varchar(255) DEFAULT NULL,
  `idTipo` int(11) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`idPortaria`)
) ENGINE=MyISAM AUTO_INCREMENT=209 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `portaria`
--

LOCK TABLES `portaria` WRITE;
/*!40000 ALTER TABLE `portaria` DISABLE KEYS */;
INSERT INTO `portaria` VALUES (207,0,'<p>V&iacute;nicius, SIAPE: 2131231</p>','2018-02-09 02:00:00','2018-12-12 02:00:00',NULL,3,'Cadastrada'),(208,0,'<p>V&iacute;nicius, SIAPE: 2<strong><em>131231.</em></strong></p>\r\n\r\n<p>&nbsp;</p>','2018-08-02 03:00:00','0000-00-00 00:00:00',NULL,5,'Espera'),(205,9,'<p align=\"center\" style=\"font-family: Times New Roman; font-size: 12;\"><strong>PORTARIA Nº 009, DE 30 DE DEZEMBRO DE 2017 </strong></p><p></p><p></p><br/><br/><p>V&iacute;nicius, SIAPE: 2131231</p><p></p><p></p><br/><br/><p align= \"center\"><img   src=\"http://localhost/CodeIgniter/assets/imagens/assinaturas/logo1.png\" width=\"255\" height=\"117\"  alt=\"\"></p> ','2017-12-30 02:00:00','2018-01-11 02:00:00','./uploads/',6,'Aprovada'),(204,6,'<p align=\"center\" style=\"font-family: Times New Roman; font-size: 12;\"><strong>PORTARIA Nº 006, DE 30 DE DEZEMBRO DE 2017 </strong></p><p></p><p></p><br/><br/><p>V&iacute;nicius, SIAPE: 2131231</p><p></p><p></p><br/><br/><p align= \"center\"><img   src=\"http://localhost/CodeIgniter/assets/imagens/assinaturas/logo1.png\" width=\"255\" height=\"117\"  alt=\"\"></p> ','2017-12-30 02:00:00','2018-01-11 02:00:00','./uploads/',3,'Arquivada'),(201,0,'<p>Admin, SIAPE: 1231212</p>','2017-12-27 02:00:00','2018-01-11 02:00:00',NULL,4,'Cadastrada'),(202,0,'<p>Agmar de &Aacute;vila Torres, SIAPE: 1231212</p>\r\n\r\n<p>Agmar de &Aacute;vila Torres, SIAPE: 12312121312312</p>','2018-01-04 02:00:00','2018-01-11 02:00:00','',3,'Espera'),(203,0,'<p>Agmar de &Aacute;vila Torres, SIAPE: 1231212</p>\r\n\r\n<p>Agmar de &Aacute;vila Torres, SIAPE: 1231212</p>','2017-12-27 02:00:00','2018-01-11 02:00:00',NULL,3,'Espera'),(206,0,'<p>V&iacute;nicius, SIAPE: 2131231</p>\r\n\r\n<p>V&iacute;nicius, SIAPE: 2131231</p>\r\n\r\n<p>V&iacute;nicius, SIAPE: 2131231</p>\r\n\r\n<p>Agmar de &Aacute;vila Torre, SIAPE: 1231212</p>\r\n\r\n<p>Agmar de &Aacute;vila Torre, SIAPE: 1231212</p>','2018-02-09 02:00:00','2018-12-12 02:00:00',NULL,6,'Cadastrada'),(196,5,'<p align=\"center\"><strong>PORTARIA Nº 005, DE 20 DE DEZEMBRO DE 2017 </strong></p><br><br> <p>Admin, SIAPE: 1231212</p>	<p align= \"center\"><img   src=\"http://localhost/CodeIgniter/assets/imagens/assinaturas/logo.png\" width=\"100\" height=\"100\"  alt=\"\"></p> ','2017-12-20 02:00:00','2018-01-11 02:00:00','http://localhost/CodeIgniter/uploads/005_20122017.pdf',3,'Arquivada'),(197,6,'<p align=\"center\"><strong>PORTARIA Nº 006, DE 20 DE DEZEMBRO DE 2017 </strong></p><br><br> <p>V&iacute;nicius, SIAPE: 2131231</p>\r\n\r\n<p>V&iacute;nicius, SIAPE: 2131231</p>\r\n\r\n<p>aasd</p>\r\n\r\n<p>V&iacute;nicius, SIAPE: 2131231</p>\r\n\r\n<p>zzxcz</p>	<p align= \"center\"><img   src=\"http://localhost/CodeIgniter/assets/imagens/assinaturas/logo.png\" width=\"100\" height=\"100\"  alt=\"\"></p> ','2017-12-20 02:00:00','2018-01-11 02:00:00','http://localhost/CodeIgniter/uploads/006_20122017.pdf',4,'Aprovada'),(198,7,'<p align=\"center\" style=\"font-family: Times New Roman; font-size: 12;\"><strong>PORTARIA Nº 007, DE 30 DE DEZEMBRO DE 2017 </strong></p><p></p><p></p><br/><br/><p>Admin, SIAPE: 1231212</p><p></p><p></p><br/><br/><p align= \"center\"><img   src=\"http://localhost/CodeIgniter/assets/imagens/assinaturas/logo1.png\" width=\"255\" height=\"117\"  alt=\"\"></p> ','2017-12-30 02:00:00','2018-01-11 02:00:00','./uploads/',6,'Publicada'),(199,8,'<p align=\"center\" style=\"font-family: Times New Roman; font-size: 12;\"><strong>PORTARIA Nº 008, DE 30 DE DEZEMBRO DE 2017 </strong></p><p></p><p></p><br/><br/><p>Admin, SIAPE: 1231212</p><p></p><p></p><br/><br/><p align= \"center\"><img   src=\"http://localhost/CodeIgniter/assets/imagens/assinaturas/logo1.png\" width=\"255\" height=\"117\"  alt=\"\"></p> ','2017-12-30 02:00:00','2018-01-11 02:00:00','./uploads/',3,'Publicada'),(200,7,'<p align=\"center\"><strong>PORTARIA Nº 007, DE 20 DE DEZEMBRO DE 2017 </strong></p><br><br> <h1>Agmar de &Aacute;vila Torres, SIAPE: 1231212</h1>\r\n\r\n<p style=\"text-align:center\">Agma<em>r de &Aacute;vila Torres, SIAPE: 123</em>1212</p>\r\n\r\n<p><u><strong>Agmar de &Aacute;vila Torres, SIAPE: 1231212</strong></u></p>	<p align= \"center\"><img   src=\"http://localhost/CodeIgniter/assets/imagens/assinaturas/logo.png\" width=\"100\" height=\"100\"  alt=\"\"></p> ','2017-12-20 02:00:00','2018-01-11 02:00:00','./uploads/',4,'Aprovada'),(194,3,'<p align=\"center\"><strong>PORTARIA Nº 003, DE 20 DE DEZEMBRO DE 2017 </strong></p><br><br> <p>Admin, SIAPE: 1231212</p>\r\n\r\n<p>Admin, SIAPE: 1231212</p>\r\n\r\n<p>Admin, SIAPE: 1231212</p>\r\n\r\n<p>Admin, SIAPE: 1231212</p>	<p align= \"center\"><img   src=\"http://localhost/CodeIgniter/assets/imagens/assinaturas/logo.png\" width=\"100\" height=\"100\"  alt=\"\"></p> ','2017-12-20 02:00:00','2018-01-11 02:00:00','./uploads/',5,'Publicada'),(195,4,'<p align=\'center\'><strong>PORTARIA Nº 004, DE 20 DE DEZEMBRO DE 2017</strong></p><br><br><p>Agmar de &Aacute;vila Torres, SIAPE: 1231212</p>\r\n\r\n<p>Agmar de &Aacute;vila Torres, SIAPE: 1231212</p>\r\n\r\n<p>Agmar de &Aacute;vila Torres, SIAPE: 1231212</p>\r\n\r\n<p>&nbsp;</p>\r\n\r\n<p>asdasdasdasd</p><img src=http://localhost/CodeIgniter/assets/imagens/assinaturas/logo.png width=\'100\' height=\'100\'>','2017-12-20 02:00:00','2018-01-11 02:00:00','http://localhost/CodeIgniter/uploads/004_20122017.pdf',3,'Publicada'),(192,1,'<p align=\"center\"><strong>PORTARIA Nº 001, DE 20 DE DEZEMBRO DE 2017 </strong></p><br><br> $portaria->texto	<p align= \"center\"><img   src=\"http://localhost/CodeIgniter/assets/imagens/assinaturas/logo.png\" width=\"100\" height=\"100\"  alt=\"\"></p> ','2017-12-20 02:00:00','2018-01-11 02:00:00','./uploads/',3,'Arquivada'),(193,2,'<p align=\"center\"><strong>PORTARIA Nº 002, DE 20 DE DEZEMBRO DE 2017 </strong></p><br><br> <p>Agmar de &Aacute;vila Torres, SIAPE: 1231212</p>\r\n\r\n<p>Agmar de &Aacute;vila Torres, SIAPE: 1231212</p>\r\n\r\n<p>Agmar de &Aacute;vila Torres, SIAPE: 1231212</p>	<p align= \"center\"><img   src=http://localhost/CodeIgniter/assets/imagens/assinaturas/logo.png width=\"100\" height=\"100\"  alt=\"\"></p> ','2017-12-20 02:00:00','2018-01-11 02:00:00','./uploads/',4,'Aprovada');
/*!40000 ALTER TABLE `portaria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servidores`
--

DROP TABLE IF EXISTS `servidores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servidores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  `siape` varchar(7) DEFAULT NULL,
  `cargo` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servidores`
--

LOCK TABLES `servidores` WRITE;
/*!40000 ALTER TABLE `servidores` DISABLE KEYS */;
INSERT INTO `servidores` VALUES (2,' Agmar de Ávila Torres','1231212','12'),(8,'Vínicius','2131231','Professor'),(10,'Admq','Admsd',NULL),(11,'Agmar de Ávila Torres','123',NULL),(12,'Teste1','teste1',NULL),(13,'Teste1234','123123','Administrador'),(14,'Agmar123213','1312','testei1234');
/*!40000 ALTER TABLE `servidores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servidorportaria`
--

DROP TABLE IF EXISTS `servidorportaria`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servidorportaria` (
  `codigo` int(11) NOT NULL AUTO_INCREMENT,
  `idServidor` int(11) DEFAULT NULL,
  `idPortaria` int(11) DEFAULT NULL,
  PRIMARY KEY (`codigo`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servidorportaria`
--

LOCK TABLES `servidorportaria` WRITE;
/*!40000 ALTER TABLE `servidorportaria` DISABLE KEYS */;
/*!40000 ALTER TABLE `servidorportaria` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo`
--

DROP TABLE IF EXISTS `tipo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo` (
  `idTipo` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`idTipo`),
  UNIQUE KEY `nome` (`nome`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo`
--

LOCK TABLES `tipo` WRITE;
/*!40000 ALTER TABLE `tipo` DISABLE KEYS */;
INSERT INTO `tipo` VALUES (3,'eventos'),(5,'colegiado'),(6,'Nucleo de Inovação, Pesquisa e Extensão do IFSULDEMINAS -  Campus Passos'),(7,'Motorista'),(8,'ELITT'),(13,'if'),(12,'colegiado1');
/*!40000 ALTER TABLE `tipo` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario`
--

DROP TABLE IF EXISTS `usuario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuario` (
  `idUsuario` int(11) NOT NULL AUTO_INCREMENT,
  `nmLogin` varchar(25) DEFAULT NULL,
  `nmUsuario` varchar(100) DEFAULT NULL,
  `senha` varchar(41) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `nivelAcesso` varchar(20) DEFAULT NULL,
  `assinatura` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`idUsuario`),
  UNIQUE KEY `UK_USUARIO_NmLogin` (`nmLogin`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario`
--

LOCK TABLES `usuario` WRITE;
/*!40000 ALTER TABLE `usuario` DISABLE KEYS */;
INSERT INTO `usuario` VALUES (30,'depp','depp','81dc9bdb52d04dc20036dbd8313ed055','depp@gmail.com','Administrador','http://localhost/CodeIgniter/assets/imagens/assinaturas/'),(6,'admin','admin','21232f297a57a5a743894a0e4a801fc3','admin@gmail.com','Administrador',NULL),(8,'js','John Snow','81dc9bdb52d04dc20036dbd8313ed055','jon@gmail.com','Administrador',NULL),(29,'joao','João Paulo de Toledo Gomes','81dc9bdb52d04dc20036dbd8313ed055','jp@gmail.com','Administrador','http://localhost/CodeIgniter/assets/imagens/assinaturas/logoGoverno.png'),(38,'diretor','diretor','0d669851f36b8949a81a909de8d45ad1','diretor@gmail.com','Diretor','http://localhost/CodeIgniter/assets/imagens/assinaturas/ER.png'),(33,'Vinícius','Vinícius de Souza Gonçalves','25d55ad283aa400af464c76d713c07ad','vinisouzax@gmail.com','Administrador',NULL),(34,'diretor1','diretor1','0d669851f36b8949a81a909de8d45ad1','diretor@gmail.com','Diretor','http://localhost/CodeIgniter/assets/imagens/assinaturas/logo2.png'),(35,'asddasd','asddasd','789721f9379d033fc3aa41118bf19128','asddasd@gmail.com','Administrador',NULL),(36,'aaaaaaaaa','aaaaaaaaa','2c60c24e7087e18e45055a33f9a5be91','aaaaaaaaa@gmail.com','Administrador',NULL),(37,'aaaaa','aaaaa','e09c80c42fda55f9d992e59ca6b3307d','1111111@gmail.com','Administrador',NULL);
/*!40000 ALTER TABLE `usuario` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-08-01 21:03:24
