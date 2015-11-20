-- MySQL dump 10.13  Distrib 5.6.23, for Win64 (x86_64)
--
-- Host: localhost    Database: simplex
-- ------------------------------------------------------
-- Server version	5.6.26

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
-- Table structure for table `abilitatazione`
--

DROP TABLE IF EXISTS `abilitatazione`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `abilitatazione` (
  `sessione_id` int(10) NOT NULL,
  `studente_matricola` varchar(10) NOT NULL,
  PRIMARY KEY (`sessione_id`,`studente_matricola`),
  KEY `studente_mat_idx` (`studente_matricola`),
  CONSTRAINT `sessione_id` FOREIGN KEY (`sessione_id`) REFERENCES `sessione` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `studente_mat` FOREIGN KEY (`studente_matricola`) REFERENCES `studente` (`matricola`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `abilitatazione`
--

LOCK TABLES `abilitatazione` WRITE;
/*!40000 ALTER TABLE `abilitatazione` DISABLE KEYS */;
/*!40000 ALTER TABLE `abilitatazione` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `alternativa`
--

DROP TABLE IF EXISTS `alternativa`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `alternativa` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `testo` varchar(30) NOT NULL,
  `percentuale_scelta` varchar(45) DEFAULT '0',
  `domanda_multipla_argomento_id` int(3) NOT NULL,
  `domanda_multipla_argomento_insegnamento_id` int(2) NOT NULL,
  `domanda_multipla_argomento_insegnamento_corso_matricola` varchar(10) NOT NULL,
  PRIMARY KEY (`id`,`domanda_multipla_argomento_id`,`domanda_multipla_argomento_insegnamento_id`,`domanda_multipla_argomento_insegnamento_corso_matricola`),
  KEY `domanda_multipla_argomento_id_idx` (`domanda_multipla_argomento_id`),
  KEY `domanda_multipla_argomento_insegnamento_id_idx` (`domanda_multipla_argomento_insegnamento_id`),
  KEY `domanda_multipla_argomento_insegnamento_corso_matricola_idx` (`domanda_multipla_argomento_insegnamento_corso_matricola`),
  CONSTRAINT `domanda_multipla_argomento_id` FOREIGN KEY (`domanda_multipla_argomento_id`) REFERENCES `domanda_multipla` (`argomento_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `domanda_multipla_argomento_insegnamento_corso_matricola` FOREIGN KEY (`domanda_multipla_argomento_insegnamento_corso_matricola`) REFERENCES `domanda_multipla` (`argomento_insegnamento_corso_matricola`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `domanda_multipla_argomento_insegnamento_id` FOREIGN KEY (`domanda_multipla_argomento_insegnamento_id`) REFERENCES `domanda_multipla` (`argomento_insegnamento_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `alternativa`
--

LOCK TABLES `alternativa` WRITE;
/*!40000 ALTER TABLE `alternativa` DISABLE KEYS */;
/*!40000 ALTER TABLE `alternativa` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `argomento`
--

DROP TABLE IF EXISTS `argomento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `argomento` (
  `id` int(3) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `insegnamento_id` int(2) NOT NULL,
  `insegnamento_corso_matricola` varchar(10) NOT NULL,
  PRIMARY KEY (`id`,`insegnamento_id`,`insegnamento_corso_matricola`),
  KEY `insegnamento_id_idx` (`insegnamento_id`),
  KEY `corso_matricola_idx` (`insegnamento_corso_matricola`),
  CONSTRAINT `corso_matricola` FOREIGN KEY (`insegnamento_corso_matricola`) REFERENCES `insegnamento` (`corso_matricola`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `insegnamento_id` FOREIGN KEY (`insegnamento_id`) REFERENCES `insegnamento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `argomento`
--

LOCK TABLES `argomento` WRITE;
/*!40000 ALTER TABLE `argomento` DISABLE KEYS */;
/*!40000 ALTER TABLE `argomento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cdl`
--

DROP TABLE IF EXISTS `cdl`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `cdl` (
  `matricola` varchar(10) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `tipologia` varchar(20) NOT NULL,
  PRIMARY KEY (`matricola`),
  UNIQUE KEY `nome_UNIQUE` (`nome`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cdl`
--

LOCK TABLES `cdl` WRITE;
/*!40000 ALTER TABLE `cdl` DISABLE KEYS */;
/*!40000 ALTER TABLE `cdl` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compone_aperta`
--

DROP TABLE IF EXISTS `compone_aperta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compone_aperta` (
  `punteggio_max_alternativa` float DEFAULT NULL,
  `domanda_aperta_id` int(8) NOT NULL,
  `test_id` int(8) NOT NULL,
  `domanda_aperta_argomento_id` int(3) NOT NULL,
  `domanda_aperta_argomento_insegnamento_id` int(2) NOT NULL,
  `domanda_aperta_argomento_insegnamento_corso_matricola` varchar(10) NOT NULL,
  PRIMARY KEY (`domanda_aperta_argomento_id`,`domanda_aperta_argomento_insegnamento_id`,`domanda_aperta_argomento_insegnamento_corso_matricola`,`test_id`,`domanda_aperta_id`),
  KEY `domanda_aperta_id_idx` (`domanda_aperta_id`),
  KEY `test_id_idx` (`test_id`),
  KEY `domanda_aperta_argomento_insegnamento_id_idx` (`domanda_aperta_argomento_insegnamento_id`),
  KEY `domanda_aperta_argomento_insegnamento_corso_matricola_idx` (`domanda_aperta_argomento_insegnamento_corso_matricola`),
  CONSTRAINT `compone_aperta_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `test` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `compone_aperta_ibfk_2` FOREIGN KEY (`domanda_aperta_argomento_id`) REFERENCES `domanda_aperta` (`argomento_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `domanda_aperta_argomento_insegnamento_corso_matricola` FOREIGN KEY (`domanda_aperta_argomento_insegnamento_corso_matricola`) REFERENCES `domanda_aperta` (`argomento_insegnamento_corso_matricola`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `domanda_aperta_argomento_insegnamento_id` FOREIGN KEY (`domanda_aperta_argomento_insegnamento_id`) REFERENCES `domanda_aperta` (`argomento_insegnamento_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `domanda_aperta_id` FOREIGN KEY (`domanda_aperta_id`) REFERENCES `domanda_aperta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compone_aperta`
--

LOCK TABLES `compone_aperta` WRITE;
/*!40000 ALTER TABLE `compone_aperta` DISABLE KEYS */;
/*!40000 ALTER TABLE `compone_aperta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `compone_multipla`
--

DROP TABLE IF EXISTS `compone_multipla`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `compone_multipla` (
  `punteggio_corretto_altrenativo` float DEFAULT NULL,
  `punteggio_errata_alternativo` float DEFAULT NULL,
  `domanda_multipla_id` int(8) DEFAULT NULL,
  `test_id` int(8) DEFAULT NULL,
  `domanda_multipla_argomento_id` int(3) DEFAULT NULL,
  `domanda_multipla_argomento_insegnamento_id` int(2) DEFAULT NULL,
  `domanda_multipla_argomento_insegnamento_corso_matricola` varchar(10) DEFAULT NULL,
  KEY `domanda_multipla_id_idx` (`domanda_multipla_id`),
  KEY `test_id_idx` (`test_id`),
  KEY `domanda_multipla_argomento_id_idx` (`domanda_multipla_argomento_id`),
  KEY `compone_multipla_ibfk_3` (`domanda_multipla_argomento_insegnamento_id`),
  KEY `compone_multipla_ibfk_4` (`domanda_multipla_argomento_insegnamento_corso_matricola`),
  CONSTRAINT `compone_multipla_ibfk_1` FOREIGN KEY (`test_id`) REFERENCES `test` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `compone_multipla_ibfk_2` FOREIGN KEY (`domanda_multipla_argomento_id`) REFERENCES `domanda_multipla` (`argomento_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `compone_multipla_ibfk_3` FOREIGN KEY (`domanda_multipla_argomento_insegnamento_id`) REFERENCES `domanda_multipla` (`argomento_insegnamento_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `compone_multipla_ibfk_4` FOREIGN KEY (`domanda_multipla_argomento_insegnamento_corso_matricola`) REFERENCES `domanda_multipla` (`argomento_insegnamento_corso_matricola`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `domanda_multipla_id` FOREIGN KEY (`domanda_multipla_id`) REFERENCES `domanda_multipla` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `compone_multipla`
--

LOCK TABLES `compone_multipla` WRITE;
/*!40000 ALTER TABLE `compone_multipla` DISABLE KEYS */;
/*!40000 ALTER TABLE `compone_multipla` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contatto`
--

DROP TABLE IF EXISTS `contatto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `contatto` (
  `valore` varchar(20) NOT NULL,
  `tipologia` varchar(15) DEFAULT NULL,
  `docente_matricola` varchar(10) NOT NULL,
  PRIMARY KEY (`valore`),
  KEY `docente_matricola_idx` (`docente_matricola`),
  CONSTRAINT `docente_matricola` FOREIGN KEY (`docente_matricola`) REFERENCES `docente` (`matricola`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contatto`
--

LOCK TABLES `contatto` WRITE;
/*!40000 ALTER TABLE `contatto` DISABLE KEYS */;
/*!40000 ALTER TABLE `contatto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `corso`
--

DROP TABLE IF EXISTS `corso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `corso` (
  `matricola` varchar(10) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `tipologia` varchar(20) DEFAULT NULL,
  `cdl_matricola` varchar(10) NOT NULL,
  PRIMARY KEY (`matricola`),
  UNIQUE KEY `nome_UNIQUE` (`nome`),
  KEY `corso_ibfk_1` (`cdl_matricola`),
  CONSTRAINT `corso_ibfk_1` FOREIGN KEY (`cdl_matricola`) REFERENCES `cdl` (`matricola`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `corso`
--

LOCK TABLES `corso` WRITE;
/*!40000 ALTER TABLE `corso` DISABLE KEYS */;
/*!40000 ALTER TABLE `corso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `credenziali`
--

DROP TABLE IF EXISTS `credenziali`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `credenziali` (
  `username` varchar(15) NOT NULL,
  `password` varchar(32) NOT NULL,
  `matricola_studente` varchar(10) DEFAULT NULL,
  `matricola_docente` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`username`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  KEY `matricola_studente_idx` (`matricola_studente`),
  KEY `matricola_docente_idx` (`matricola_docente`),
  CONSTRAINT `matricola_docente` FOREIGN KEY (`matricola_docente`) REFERENCES `docente` (`matricola`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `matricola_studente` FOREIGN KEY (`matricola_studente`) REFERENCES `studente` (`matricola`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `credenziali`
--

LOCK TABLES `credenziali` WRITE;
/*!40000 ALTER TABLE `credenziali` DISABLE KEYS */;
/*!40000 ALTER TABLE `credenziali` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `docente`
--

DROP TABLE IF EXISTS `docente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `docente` (
  `matricola` varchar(10) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  PRIMARY KEY (`matricola`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `docente`
--

LOCK TABLES `docente` WRITE;
/*!40000 ALTER TABLE `docente` DISABLE KEYS */;
/*!40000 ALTER TABLE `docente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `docente_insegnamento`
--

DROP TABLE IF EXISTS `docente_insegnamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `docente_insegnamento` (
  `docente_matrciola` varchar(10) NOT NULL,
  `insegnamento_id` int(2) NOT NULL,
  `insegnamento_corso_matricola` varchar(10) NOT NULL,
  PRIMARY KEY (`docente_matrciola`,`insegnamento_id`,`insegnamento_corso_matricola`),
  KEY `docente_insegnamento_ibfk_2` (`insegnamento_id`),
  KEY `docente_insegnamento_ibfk_3` (`insegnamento_corso_matricola`),
  CONSTRAINT `docente_insegnamento_ibfk_1` FOREIGN KEY (`docente_matrciola`) REFERENCES `docente` (`matricola`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `docente_insegnamento_ibfk_2` FOREIGN KEY (`insegnamento_id`) REFERENCES `insegnamento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `docente_insegnamento_ibfk_3` FOREIGN KEY (`insegnamento_corso_matricola`) REFERENCES `insegnamento` (`corso_matricola`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `docente_insegnamento`
--

LOCK TABLES `docente_insegnamento` WRITE;
/*!40000 ALTER TABLE `docente_insegnamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `docente_insegnamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `domanda_aperta`
--

DROP TABLE IF EXISTS `domanda_aperta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domanda_aperta` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `testo` varchar(100) DEFAULT NULL,
  `punteggio_max` float DEFAULT NULL,
  `argomento_id` int(3) NOT NULL,
  `argomento_insegnamento_corso_matricola` varchar(10) NOT NULL,
  `argomento_insegnamento_id` int(2) NOT NULL,
  `percentuale_scelta` float DEFAULT '0',
  PRIMARY KEY (`id`,`argomento_id`,`argomento_insegnamento_corso_matricola`,`argomento_insegnamento_id`),
  KEY `argomento_id_idx` (`argomento_id`),
  KEY `argomento_insegnamento_id_idx` (`argomento_insegnamento_id`),
  KEY `argomento_insegnamento_corso_matricola_idx` (`argomento_insegnamento_corso_matricola`),
  CONSTRAINT `argomento_id` FOREIGN KEY (`argomento_id`) REFERENCES `argomento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `argomento_insegnamento_corso_matricola` FOREIGN KEY (`argomento_insegnamento_corso_matricola`) REFERENCES `argomento` (`insegnamento_corso_matricola`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `argomento_insegnamento_id` FOREIGN KEY (`argomento_insegnamento_id`) REFERENCES `argomento` (`insegnamento_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `domanda_aperta`
--

LOCK TABLES `domanda_aperta` WRITE;
/*!40000 ALTER TABLE `domanda_aperta` DISABLE KEYS */;
/*!40000 ALTER TABLE `domanda_aperta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `domanda_multipla`
--

DROP TABLE IF EXISTS `domanda_multipla`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `domanda_multipla` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `testo` varchar(100) NOT NULL,
  `punteggio_corretta` float DEFAULT '1',
  `punteggio_errata` float DEFAULT '0',
  `percentuale_scelta` float DEFAULT '0',
  `percentuale_rispota_corretta` float DEFAULT '0',
  `argomento_id` int(3) DEFAULT NULL,
  `argomento_insegnamento_id` int(2) DEFAULT NULL,
  `argomento_insegnamento_corso_matricola` varchar(10) DEFAULT NULL,
  `alternativa_corretta` int(8) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `argomento_id_idx` (`argomento_id`),
  KEY `argomento_insegnamento_id_idx` (`argomento_insegnamento_id`),
  KEY `argomento_insegnamento_corso_matricola_idx` (`argomento_insegnamento_corso_matricola`),
  KEY `alternativa_corretta_idx` (`alternativa_corretta`),
  CONSTRAINT `alternativa_corretta` FOREIGN KEY (`alternativa_corretta`) REFERENCES `alternativa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `domanda_multipla_ibfk_1` FOREIGN KEY (`argomento_id`) REFERENCES `argomento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `domanda_multipla_ibfk_2` FOREIGN KEY (`argomento_insegnamento_id`) REFERENCES `argomento` (`insegnamento_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `domanda_multipla_ibfk_3` FOREIGN KEY (`argomento_insegnamento_corso_matricola`) REFERENCES `argomento` (`insegnamento_corso_matricola`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `domanda_multipla`
--

LOCK TABLES `domanda_multipla` WRITE;
/*!40000 ALTER TABLE `domanda_multipla` DISABLE KEYS */;
/*!40000 ALTER TABLE `domanda_multipla` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `elaborato`
--

DROP TABLE IF EXISTS `elaborato`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `elaborato` (
  `studente_matricola` varchar(10) NOT NULL,
  `sessione_id` int(10) NOT NULL,
  `esito_parziale` float DEFAULT NULL,
  `esito_finale` float DEFAULT NULL,
  PRIMARY KEY (`studente_matricola`,`sessione_id`),
  KEY `sessione_id_idx` (`sessione_id`),
  CONSTRAINT `elaborato_ibfk_1` FOREIGN KEY (`studente_matricola`) REFERENCES `studente` (`matricola`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `elaborato_ibfk_2` FOREIGN KEY (`sessione_id`) REFERENCES `sessione` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `elaborato`
--

LOCK TABLES `elaborato` WRITE;
/*!40000 ALTER TABLE `elaborato` DISABLE KEYS */;
/*!40000 ALTER TABLE `elaborato` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `frequenta`
--

DROP TABLE IF EXISTS `frequenta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `frequenta` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `studente_matricola` varchar(10) NOT NULL,
  `insegnamento_id` int(2) NOT NULL,
  `insegnamento_corso_matricola` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `studente_matricola_idx` (`studente_matricola`),
  KEY `insegnamento_id_idx` (`insegnamento_id`),
  KEY `frequenta_ibfk_2` (`insegnamento_corso_matricola`),
  CONSTRAINT `frequenta_ibfk_1` FOREIGN KEY (`insegnamento_id`) REFERENCES `insegnamento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `frequenta_ibfk_2` FOREIGN KEY (`insegnamento_corso_matricola`) REFERENCES `insegnamento` (`corso_matricola`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `studente_matricola` FOREIGN KEY (`studente_matricola`) REFERENCES `studente` (`matricola`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `frequenta`
--

LOCK TABLES `frequenta` WRITE;
/*!40000 ALTER TABLE `frequenta` DISABLE KEYS */;
/*!40000 ALTER TABLE `frequenta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `insegnamento`
--

DROP TABLE IF EXISTS `insegnamento`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `insegnamento` (
  `id` int(2) NOT NULL,
  `corso_matricola` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `matricola_corso_idx` (`corso_matricola`),
  CONSTRAINT `matricola_corso` FOREIGN KEY (`corso_matricola`) REFERENCES `corso` (`matricola`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `insegnamento`
--

LOCK TABLES `insegnamento` WRITE;
/*!40000 ALTER TABLE `insegnamento` DISABLE KEYS */;
/*!40000 ALTER TABLE `insegnamento` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `risposta_aperta`
--

DROP TABLE IF EXISTS `risposta_aperta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `risposta_aperta` (
  `elaborato_studente_matricola` varchar(10) NOT NULL,
  `elaborato_sessione_id` int(10) NOT NULL,
  `domanda_aperta_id` int(8) DEFAULT NULL,
  `testo` varchar(400) DEFAULT NULL,
  `domanda_aperta_argomento_id` int(3) DEFAULT NULL,
  `domanda_aperta_argomento_insegnamento_id` int(2) DEFAULT NULL,
  `domada_aperta_argomento_insegnamento_corso_mat` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`elaborato_studente_matricola`,`elaborato_sessione_id`),
  KEY `elaborato_sessione_id_idx` (`elaborato_sessione_id`),
  KEY `risposta_aperta_ibfk_3` (`domanda_aperta_id`),
  KEY `risposta_aperta_ibfk_4` (`domanda_aperta_argomento_id`),
  KEY `risposta_aperta_ibfk_5` (`domanda_aperta_argomento_insegnamento_id`),
  KEY `risposta_aperta_ibfk_6` (`domada_aperta_argomento_insegnamento_corso_mat`),
  CONSTRAINT `risposta_aperta_ibfk_1` FOREIGN KEY (`elaborato_studente_matricola`) REFERENCES `elaborato` (`studente_matricola`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `risposta_aperta_ibfk_2` FOREIGN KEY (`elaborato_sessione_id`) REFERENCES `elaborato` (`sessione_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `risposta_aperta_ibfk_3` FOREIGN KEY (`domanda_aperta_id`) REFERENCES `domanda_aperta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `risposta_aperta_ibfk_4` FOREIGN KEY (`domanda_aperta_argomento_id`) REFERENCES `domanda_aperta` (`argomento_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `risposta_aperta_ibfk_5` FOREIGN KEY (`domanda_aperta_argomento_insegnamento_id`) REFERENCES `domanda_aperta` (`argomento_insegnamento_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `risposta_aperta_ibfk_6` FOREIGN KEY (`domada_aperta_argomento_insegnamento_corso_mat`) REFERENCES `domanda_aperta` (`argomento_insegnamento_corso_matricola`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `risposta_aperta`
--

LOCK TABLES `risposta_aperta` WRITE;
/*!40000 ALTER TABLE `risposta_aperta` DISABLE KEYS */;
/*!40000 ALTER TABLE `risposta_aperta` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `risposta_multipla`
--

DROP TABLE IF EXISTS `risposta_multipla`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `risposta_multipla` (
  `elaborato_studente_matricola` varchar(10) NOT NULL,
  `elaborato_sessione_id` int(10) NOT NULL,
  `alternativa_id` int(8) DEFAULT NULL,
  `alternativa_domanda_multipla_argomento_id` int(3) NOT NULL,
  `alternativa_domanda_multipla_argomento_insegnamento_id` int(2) NOT NULL,
  `alternativa_domanda_multipla_argomento_insegnamento_corso_mat` varchar(10) NOT NULL,
  PRIMARY KEY (`elaborato_studente_matricola`,`elaborato_sessione_id`),
  KEY `elaborato_sessione_id_idx` (`elaborato_sessione_id`),
  KEY `alternativa_id_idx` (`alternativa_id`),
  KEY `alternativa_domanda_multipla_argomento_id_idx` (`alternativa_domanda_multipla_argomento_id`),
  KEY `alternativa_domanda_multipla_argomento_insegnamento_id_idx` (`alternativa_domanda_multipla_argomento_insegnamento_id`),
  KEY `alternativa_domanda_multipla_argomento_insegnamento_corso_m_idx` (`alternativa_domanda_multipla_argomento_insegnamento_corso_mat`),
  CONSTRAINT `alternativa_domanda_multipla_argomento_id` FOREIGN KEY (`alternativa_domanda_multipla_argomento_id`) REFERENCES `alternativa` (`domanda_multipla_argomento_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `alternativa_domanda_multipla_argomento_insegnamento_corso_mat` FOREIGN KEY (`alternativa_domanda_multipla_argomento_insegnamento_corso_mat`) REFERENCES `alternativa` (`domanda_multipla_argomento_insegnamento_corso_matricola`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `alternativa_domanda_multipla_argomento_insegnamento_id` FOREIGN KEY (`alternativa_domanda_multipla_argomento_insegnamento_id`) REFERENCES `alternativa` (`domanda_multipla_argomento_insegnamento_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `alternativa_id` FOREIGN KEY (`alternativa_id`) REFERENCES `alternativa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `elaborato_sessione_id` FOREIGN KEY (`elaborato_sessione_id`) REFERENCES `elaborato` (`sessione_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `elaborato_studente_matricola` FOREIGN KEY (`elaborato_studente_matricola`) REFERENCES `elaborato` (`studente_matricola`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `risposta_multipla`
--

LOCK TABLES `risposta_multipla` WRITE;
/*!40000 ALTER TABLE `risposta_multipla` DISABLE KEYS */;
/*!40000 ALTER TABLE `risposta_multipla` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessione`
--

DROP TABLE IF EXISTS `sessione`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessione` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `tipologia` bit(1) NOT NULL,
  `data_inizio` date NOT NULL,
  `data_fine` date NOT NULL,
  `soglia_ammissione` float DEFAULT NULL,
  `insegnamento_id` int(2) NOT NULL,
  `insegnamento_corso_matricola` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `insegnamento_id_idx` (`insegnamento_id`),
  KEY `sessione_ibfk_2` (`insegnamento_corso_matricola`),
  CONSTRAINT `sessione_ibfk_1` FOREIGN KEY (`insegnamento_id`) REFERENCES `insegnamento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `sessione_ibfk_2` FOREIGN KEY (`insegnamento_corso_matricola`) REFERENCES `insegnamento` (`corso_matricola`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessione`
--

LOCK TABLES `sessione` WRITE;
/*!40000 ALTER TABLE `sessione` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessione` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sessione_test`
--

DROP TABLE IF EXISTS `sessione_test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `sessione_test` (
  `test_id` int(8) NOT NULL,
  `sessione_id` int(10) NOT NULL,
  PRIMARY KEY (`test_id`,`sessione_id`),
  KEY `sessione_id_idx` (`sessione_id`),
  CONSTRAINT `sessione_test_ibfk_1` FOREIGN KEY (`sessione_id`) REFERENCES `sessione` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `test_id` FOREIGN KEY (`test_id`) REFERENCES `test` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sessione_test`
--

LOCK TABLES `sessione_test` WRITE;
/*!40000 ALTER TABLE `sessione_test` DISABLE KEYS */;
/*!40000 ALTER TABLE `sessione_test` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `studente`
--

DROP TABLE IF EXISTS `studente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `studente` (
  `matricola` varchar(10) NOT NULL,
  `username` varchar(15) NOT NULL,
  `password` varchar(32) NOT NULL,
  `nome` varchar(30) NOT NULL,
  `cognome` varchar(30) NOT NULL,
  `cdl_matricola` varchar(10) NOT NULL,
  PRIMARY KEY (`matricola`),
  UNIQUE KEY `username_UNIQUE` (`username`),
  KEY `cdl_matricola_idx` (`cdl_matricola`),
  CONSTRAINT `cdl_matricola` FOREIGN KEY (`cdl_matricola`) REFERENCES `cdl` (`matricola`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `studente`
--

LOCK TABLES `studente` WRITE;
/*!40000 ALTER TABLE `studente` DISABLE KEYS */;
/*!40000 ALTER TABLE `studente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `test`
--

DROP TABLE IF EXISTS `test`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `test` (
  `id` int(8) NOT NULL,
  `descrizione` varchar(50) DEFAULT NULL,
  `punteggio_max` varchar(4) DEFAULT '0',
  `n_multiple` int(4) DEFAULT '0',
  `n_aperte` int(4) DEFAULT '0',
  `percentuale_scelto` float DEFAULT '0',
  `percentuale_successo` float DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `test`
--

LOCK TABLES `test` WRITE;
/*!40000 ALTER TABLE `test` DISABLE KEYS */;
/*!40000 ALTER TABLE `test` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-11-19 20:00:40
