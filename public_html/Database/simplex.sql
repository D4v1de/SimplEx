-- phpMyAdmin SQL Dump
-- version 4.4.15.1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Creato il: Dic 01, 2015 alle 15:42
-- Versione del server: 5.5.41-0ubuntu0.12.04.1
-- Versione PHP: 5.3.10-1ubuntu3.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `simplex`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `abilitazione`
--

CREATE TABLE IF NOT EXISTS `abilitazione` (
  `studente_matricola` varchar(10) CHARACTER SET latin1 NOT NULL,
  `sessione_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `alternativa`
--

CREATE TABLE IF NOT EXISTS `alternativa` (
  `id` int(11) NOT NULL,
  `domanda_multipla_id` int(8) NOT NULL,
  `domanda_multipla_argomento_id` int(3) NOT NULL,
  `domanda_multipla_argomento_corso_id` int(8) NOT NULL,
  `testo` varchar(100) CHARACTER SET latin1 NOT NULL,
  `percentuale_scelta` float NOT NULL DEFAULT '0',
  `corretta` enum('Si','No') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `argomento`
--

CREATE TABLE IF NOT EXISTS `argomento` (
  `id` int(3) NOT NULL,
  `corso_id` int(8) NOT NULL,
  `nome` varchar(50) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `cdl`
--

CREATE TABLE IF NOT EXISTS `cdl` (
  `matricola` varchar(10) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `tipologia` enum('Triennale','Magistrale') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struttura della tabella `compone_aperta`
--

CREATE TABLE IF NOT EXISTS `compone_aperta` (
  `domanda_aperta_id` int(8) NOT NULL,
  `domanda_aperta_argomento_id` int(3) NOT NULL,
  `domanda_aperta_argomento_corso_id` int(8) NOT NULL,
  `test_id` int(8) NOT NULL,
  `punteggio_max_alternativo` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `compone_multipla`
--

CREATE TABLE IF NOT EXISTS `compone_multipla` (
  `domanda_multipla_id` int(8) NOT NULL,
  `domanda_multipla_argomento_id` int(3) NOT NULL,
  `domanda_multipla_argomento_corso_id` int(8) NOT NULL,
  `test_id` int(8) NOT NULL,
  `punteggio_corretta_alternativo` float DEFAULT NULL,
  `punteggio_errata_alternativo` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `contatto`
--

CREATE TABLE IF NOT EXISTS `contatto` (
  `id` int(8) NOT NULL,
  `valore` varchar(20) CHARACTER SET latin1 NOT NULL,
  `tipologia` enum('Telefono','E-mail','Fax','Cellulare') CHARACTER SET latin1 NOT NULL,
  `utente_matricola` varchar(10) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `corso`
--

CREATE TABLE IF NOT EXISTS `corso` (
  `id` int(8) NOT NULL,
  `matricola` varchar(10) CHARACTER SET latin1 NOT NULL,
  `nome` varchar(40) CHARACTER SET latin1 NOT NULL,
  `tipologia` enum('Semestrale','Annuale','','') CHARACTER SET latin1 NOT NULL,
  `cdl_matricola` varchar(10) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `domanda_aperta`
--

CREATE TABLE IF NOT EXISTS `domanda_aperta` (
  `id` int(8) NOT NULL,
  `argomento_id` int(3) NOT NULL,
  `argomento_corso_id` int(8) NOT NULL,
  `testo` varchar(500) NOT NULL,
  `punteggio_max` float NOT NULL DEFAULT '1',
  `percentuale_scelta` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `domanda_multipla`
--

CREATE TABLE IF NOT EXISTS `domanda_multipla` (
  `id` int(8) NOT NULL,
  `argomento_id` int(3) NOT NULL,
  `argomento_corso_id` int(8) NOT NULL,
  `testo` varchar(500) CHARACTER SET latin1 NOT NULL,
  `punteggio_corretta` float NOT NULL DEFAULT '1',
  `punteggio_errata` float NOT NULL DEFAULT '0',
  `percentuale_scelta` float NOT NULL DEFAULT '0',
  `percentuale_risposta_corretta` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `elaborato`
--

CREATE TABLE IF NOT EXISTS `elaborato` (
  `studente_matricola` varchar(10) CHARACTER SET latin1 NOT NULL,
  `sessione_id` int(10) NOT NULL,
  `esito_parziale` float DEFAULT NULL,
  `esito_finale` float DEFAULT NULL,
  `test_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `frequenta`
--

CREATE TABLE IF NOT EXISTS `frequenta` (
  `corso_id` int(8) NOT NULL,
  `studente_matricola` varchar(10) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `insegnamento`
--

CREATE TABLE IF NOT EXISTS `insegnamento` (
  `corso_id` int(8) NOT NULL,
  `docente_matricola` varchar(10) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(10) NOT NULL,
  `level` enum('Debug','Info','Warning','Error') CHARACTER SET latin1 NOT NULL,
  `message` varchar(1024) CHARACTER SET latin1 NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `risposta_aperta`
--

CREATE TABLE IF NOT EXISTS `risposta_aperta` (
  `id` int(10) NOT NULL,
  `elaborato_sessione_id` int(10) NOT NULL,
  `elaborato_studente_matricola` varchar(10) CHARACTER SET latin1 NOT NULL,
  `testo` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `punteggio` float DEFAULT NULL,
  `domanda_aperta_id` int(8) NOT NULL,
  `domanda_aperta_argomento_id` int(3) NOT NULL,
  `domanda_aperta_argomento_corso_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `risposta_multipla`
--

CREATE TABLE IF NOT EXISTS `risposta_multipla` (
  `id` int(10) NOT NULL,
  `elaborato_sessione_id` int(10) NOT NULL,
  `elaborato_studente_matricola` varchar(10) CHARACTER SET latin1 NOT NULL,
  `punteggio` float DEFAULT NULL,
  `alternativa_id` int(8) DEFAULT NULL,
  `alternativa_domanda_multipla_id` int(8) DEFAULT NULL,
  `alternativa_domanda_multipla_argomento_id` int(3) DEFAULT NULL,
  `alternativa_domanda_multipla_argomento_corso_id` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `sessione`
--

CREATE TABLE IF NOT EXISTS `sessione` (
  `id` int(10) NOT NULL,
  `data_inizio` datetime NOT NULL,
  `data_fine` datetime NOT NULL,
  `soglia_ammissione` float NOT NULL,
  `stato` enum('Eseguita','Non eseguita') CHARACTER SET latin1 NOT NULL,
  `tipologia` enum('Esercitativa','Valutativa','','') NOT NULL,
  `corso_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `sessione_test`
--

CREATE TABLE IF NOT EXISTS `sessione_test` (
  `sessione_id` int(8) NOT NULL,
  `test_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `test`
--

CREATE TABLE IF NOT EXISTS `test` (
  `id` int(8) NOT NULL,
  `descrizione` varchar(50) DEFAULT NULL,
  `punteggio_max` int(4) NOT NULL,
  `n_multiple` int(4) NOT NULL,
  `n_aperte` int(4) NOT NULL,
  `percentuale_scelto` float NOT NULL DEFAULT '0',
  `percentuale_successo` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE IF NOT EXISTS `utente` (
  `matricola` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `tipologia` enum('Studente','Docente','Admin') NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `cognome` varchar(30) DEFAULT NULL,
  `cdl_matricola` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `abilitazione`
--
ALTER TABLE `abilitazione`
  ADD PRIMARY KEY (`studente_matricola`,`sessione_id`),
  ADD KEY `sessione_id` (`sessione_id`);

--
-- Indici per le tabelle `alternativa`
--
ALTER TABLE `alternativa`
  ADD PRIMARY KEY (`id`,`domanda_multipla_id`,`domanda_multipla_argomento_id`,`domanda_multipla_argomento_corso_id`),
  ADD KEY `domanda_multipla_id` (`domanda_multipla_id`),
  ADD KEY `domanda_multipla_argomento_id` (`domanda_multipla_argomento_id`),
  ADD KEY `domanda_multipla_argomento_corso_id` (`domanda_multipla_argomento_corso_id`);

--
-- Indici per le tabelle `argomento`
--
ALTER TABLE `argomento`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQUE` (`nome`,`corso_id`) USING BTREE,
  ADD KEY `corso_id` (`corso_id`);

--
-- Indici per le tabelle `cdl`
--
ALTER TABLE `cdl`
  ADD PRIMARY KEY (`matricola`),
  ADD UNIQUE KEY `nome_UNIQUE` (`nome`);

--
-- Indici per le tabelle `compone_aperta`
--
ALTER TABLE `compone_aperta`
  ADD PRIMARY KEY (`domanda_aperta_id`,`domanda_aperta_argomento_id`,`domanda_aperta_argomento_corso_id`,`test_id`),
  ADD KEY `domanda_aperta_id` (`domanda_aperta_id`),
  ADD KEY `domanda_aperta_argomento_id` (`domanda_aperta_argomento_id`),
  ADD KEY `domanda_aperta_argomento_corso_id` (`domanda_aperta_argomento_corso_id`),
  ADD KEY `test_id` (`test_id`);

--
-- Indici per le tabelle `compone_multipla`
--
ALTER TABLE `compone_multipla`
  ADD PRIMARY KEY (`domanda_multipla_id`,`domanda_multipla_argomento_id`,`domanda_multipla_argomento_corso_id`,`test_id`),
  ADD KEY `domanda_multipla_id` (`domanda_multipla_id`),
  ADD KEY `domanda_multipla_argomento_id` (`domanda_multipla_argomento_id`),
  ADD KEY `domanda_multipla_argomento_corso_id` (`domanda_multipla_argomento_corso_id`),
  ADD KEY `test_id` (`test_id`);

--
-- Indici per le tabelle `contatto`
--
ALTER TABLE `contatto`
  ADD PRIMARY KEY (`id`),
  ADD KEY `utente_matricola` (`utente_matricola`),
  ADD KEY `utente_mat` (`utente_matricola`);

--
-- Indici per le tabelle `corso`
--
ALTER TABLE `corso`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cdl_matricola` (`cdl_matricola`);

--
-- Indici per le tabelle `domanda_aperta`
--
ALTER TABLE `domanda_aperta`
  ADD PRIMARY KEY (`id`,`argomento_id`,`argomento_corso_id`),
  ADD KEY `argomento_id` (`argomento_id`),
  ADD KEY `argomento_corso_id` (`argomento_corso_id`) USING BTREE;

--
-- Indici per le tabelle `domanda_multipla`
--
ALTER TABLE `domanda_multipla`
  ADD PRIMARY KEY (`id`,`argomento_id`,`argomento_corso_id`),
  ADD KEY `argomento_id` (`argomento_id`),
  ADD KEY `argomento_corso_id` (`argomento_corso_id`);

--
-- Indici per le tabelle `elaborato`
--
ALTER TABLE `elaborato`
  ADD PRIMARY KEY (`studente_matricola`,`sessione_id`),
  ADD KEY `test_id` (`test_id`),
  ADD KEY `studente_matricola` (`studente_matricola`),
  ADD KEY `sessione_id` (`sessione_id`);

--
-- Indici per le tabelle `frequenta`
--
ALTER TABLE `frequenta`
  ADD PRIMARY KEY (`corso_id`,`studente_matricola`),
  ADD KEY `corso_id` (`corso_id`),
  ADD KEY `studente_matricola` (`studente_matricola`);

--
-- Indici per le tabelle `insegnamento`
--
ALTER TABLE `insegnamento`
  ADD PRIMARY KEY (`corso_id`,`docente_matricola`),
  ADD KEY `docente_matricola` (`docente_matricola`),
  ADD KEY `corso_id` (`corso_id`);

--
-- Indici per le tabelle `log`
--
ALTER TABLE `log`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `risposta_aperta`
--
ALTER TABLE `risposta_aperta`
  ADD PRIMARY KEY (`id`,`elaborato_sessione_id`,`elaborato_studente_matricola`),
  ADD KEY `elaborato_sessione_id` (`elaborato_sessione_id`),
  ADD KEY `elaborato_studente_matricola` (`elaborato_studente_matricola`),
  ADD KEY `domanda_aperta_id` (`domanda_aperta_id`),
  ADD KEY `domanda_aperta_argomento_id` (`domanda_aperta_argomento_id`),
  ADD KEY `domanda_aperta_argomento_corso_id` (`domanda_aperta_argomento_corso_id`);

--
-- Indici per le tabelle `risposta_multipla`
--
ALTER TABLE `risposta_multipla`
  ADD PRIMARY KEY (`id`,`elaborato_sessione_id`,`elaborato_studente_matricola`),
  ADD KEY `alternativa_id` (`alternativa_id`),
  ADD KEY `alternativa_domanda_multipla_argomento_id` (`alternativa_domanda_multipla_argomento_id`),
  ADD KEY `alternativa_domanda_multipla_argomento_corso_id` (`alternativa_domanda_multipla_argomento_corso_id`),
  ADD KEY `elaborato_sessione_id` (`elaborato_sessione_id`),
  ADD KEY `elaborato_studente_matricola` (`elaborato_studente_matricola`),
  ADD KEY `alternativa_domanda_multipla_id` (`alternativa_domanda_multipla_id`);

--
-- Indici per le tabelle `sessione`
--
ALTER TABLE `sessione`
  ADD PRIMARY KEY (`id`),
  ADD KEY `corso_id` (`corso_id`);

--
-- Indici per le tabelle `sessione_test`
--
ALTER TABLE `sessione_test`
  ADD PRIMARY KEY (`sessione_id`,`test_id`),
  ADD KEY `sessione_id` (`sessione_id`),
  ADD KEY `test_id` (`test_id`);

--
-- Indici per le tabelle `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `utente`
--
ALTER TABLE `utente`
  ADD PRIMARY KEY (`matricola`),
  ADD UNIQUE KEY `username_UNIQUE` (`username`),
  ADD KEY `cdl_matricola_idx` (`cdl_matricola`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `alternativa`
--
ALTER TABLE `alternativa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `argomento`
--
ALTER TABLE `argomento`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `contatto`
--
ALTER TABLE `contatto`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `corso`
--
ALTER TABLE `corso`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `domanda_aperta`
--
ALTER TABLE `domanda_aperta`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `domanda_multipla`
--
ALTER TABLE `domanda_multipla`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `log`
--
ALTER TABLE `log`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT per la tabella `sessione`
--
ALTER TABLE `sessione`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `abilitazione`
--
ALTER TABLE `abilitazione`
  ADD CONSTRAINT `abilitazione_ibfk_2` FOREIGN KEY (`sessione_id`) REFERENCES `sessione` (`id`),
  ADD CONSTRAINT `abilitazione_ibfk_1` FOREIGN KEY (`studente_matricola`) REFERENCES `utente` (`matricola`);

--
-- Limiti per la tabella `alternativa`
--
ALTER TABLE `alternativa`
  ADD CONSTRAINT `alternativa_ibfk_3` FOREIGN KEY (`domanda_multipla_id`) REFERENCES `domanda_multipla` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alternativa_ibfk_1` FOREIGN KEY (`domanda_multipla_argomento_corso_id`) REFERENCES `domanda_multipla` (`argomento_corso_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `alternativa_ibfk_2` FOREIGN KEY (`domanda_multipla_argomento_id`) REFERENCES `domanda_multipla` (`argomento_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `argomento`
--
ALTER TABLE `argomento`
  ADD CONSTRAINT `argomento_ibfk_1` FOREIGN KEY (`corso_id`) REFERENCES `corso` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `compone_aperta`
--
ALTER TABLE `compone_aperta`
  ADD CONSTRAINT `compone_aperta_ibfk_4` FOREIGN KEY (`test_id`) REFERENCES `test` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compone_aperta_ibfk_1` FOREIGN KEY (`domanda_aperta_id`) REFERENCES `domanda_aperta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compone_aperta_ibfk_2` FOREIGN KEY (`domanda_aperta_argomento_id`) REFERENCES `domanda_aperta` (`argomento_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compone_aperta_ibfk_3` FOREIGN KEY (`domanda_aperta_argomento_corso_id`) REFERENCES `domanda_aperta` (`argomento_corso_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `compone_multipla`
--
ALTER TABLE `compone_multipla`
  ADD CONSTRAINT `compone_multipla_ibfk_4` FOREIGN KEY (`test_id`) REFERENCES `test` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compone_multipla_ibfk_1` FOREIGN KEY (`domanda_multipla_id`) REFERENCES `domanda_multipla` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compone_multipla_ibfk_2` FOREIGN KEY (`domanda_multipla_argomento_id`) REFERENCES `domanda_multipla` (`argomento_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compone_multipla_ibfk_3` FOREIGN KEY (`domanda_multipla_argomento_corso_id`) REFERENCES `domanda_multipla` (`argomento_corso_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `contatto`
--
ALTER TABLE `contatto`
  ADD CONSTRAINT `contatto_ibfk_1` FOREIGN KEY (`utente_matricola`) REFERENCES `utente` (`matricola`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `corso`
--
ALTER TABLE `corso`
  ADD CONSTRAINT `corso_ibfk_1` FOREIGN KEY (`cdl_matricola`) REFERENCES `cdl` (`matricola`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `domanda_aperta`
--
ALTER TABLE `domanda_aperta`
  ADD CONSTRAINT `domanda_aperta_ibfk_1` FOREIGN KEY (`argomento_corso_id`) REFERENCES `argomento` (`corso_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `domanda_aperta_ibfk_2` FOREIGN KEY (`argomento_id`) REFERENCES `argomento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `domanda_multipla`
--
ALTER TABLE `domanda_multipla`
  ADD CONSTRAINT `domanda_multipla_ibfk_2` FOREIGN KEY (`argomento_id`) REFERENCES `argomento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `domanda_multipla_ibfk_1` FOREIGN KEY (`argomento_corso_id`) REFERENCES `argomento` (`corso_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `elaborato`
--
ALTER TABLE `elaborato`
  ADD CONSTRAINT `elaborato_ibfk_3` FOREIGN KEY (`test_id`) REFERENCES `test` (`id`),
  ADD CONSTRAINT `elaborato_ibfk_1` FOREIGN KEY (`studente_matricola`) REFERENCES `utente` (`matricola`),
  ADD CONSTRAINT `elaborato_ibfk_2` FOREIGN KEY (`sessione_id`) REFERENCES `sessione` (`id`);

--
-- Limiti per la tabella `frequenta`
--
ALTER TABLE `frequenta`
  ADD CONSTRAINT `frequenta_ibfk_1` FOREIGN KEY (`corso_id`) REFERENCES `corso` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `frequenta_ibfk_2` FOREIGN KEY (`studente_matricola`) REFERENCES `utente` (`matricola`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `insegnamento`
--
ALTER TABLE `insegnamento`
  ADD CONSTRAINT `insegnamento_ibfk_1` FOREIGN KEY (`corso_id`) REFERENCES `corso` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `insegnamento_ibfk_2` FOREIGN KEY (`docente_matricola`) REFERENCES `utente` (`matricola`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `risposta_aperta`
--
ALTER TABLE `risposta_aperta`
  ADD CONSTRAINT `risposta_aperta_ibfk_5` FOREIGN KEY (`domanda_aperta_argomento_corso_id`) REFERENCES `domanda_aperta` (`argomento_corso_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `risposta_aperta_ibfk_1` FOREIGN KEY (`elaborato_sessione_id`) REFERENCES `elaborato` (`sessione_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `risposta_aperta_ibfk_2` FOREIGN KEY (`elaborato_studente_matricola`) REFERENCES `elaborato` (`studente_matricola`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `risposta_aperta_ibfk_3` FOREIGN KEY (`domanda_aperta_id`) REFERENCES `domanda_aperta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `risposta_aperta_ibfk_4` FOREIGN KEY (`domanda_aperta_argomento_id`) REFERENCES `domanda_aperta` (`argomento_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `risposta_multipla`
--
ALTER TABLE `risposta_multipla`
  ADD CONSTRAINT `risposta_multipla_ibfk_6` FOREIGN KEY (`alternativa_domanda_multipla_argomento_corso_id`) REFERENCES `alternativa` (`domanda_multipla_argomento_corso_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `risposta_multipla_ibfk_1` FOREIGN KEY (`elaborato_sessione_id`) REFERENCES `elaborato` (`sessione_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `risposta_multipla_ibfk_2` FOREIGN KEY (`elaborato_studente_matricola`) REFERENCES `elaborato` (`studente_matricola`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `risposta_multipla_ibfk_3` FOREIGN KEY (`alternativa_id`) REFERENCES `alternativa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `risposta_multipla_ibfk_4` FOREIGN KEY (`alternativa_domanda_multipla_id`) REFERENCES `alternativa` (`domanda_multipla_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `risposta_multipla_ibfk_5` FOREIGN KEY (`alternativa_domanda_multipla_argomento_id`) REFERENCES `alternativa` (`domanda_multipla_argomento_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `sessione`
--
ALTER TABLE `sessione`
  ADD CONSTRAINT `sessione_ibfk_1` FOREIGN KEY (`corso_id`) REFERENCES `corso` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `sessione_test`
--
ALTER TABLE `sessione_test`
  ADD CONSTRAINT `sessione_test_ibfk_1` FOREIGN KEY (`sessione_id`) REFERENCES `sessione` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `sessione_test_ibfk_2` FOREIGN KEY (`test_id`) REFERENCES `test` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `utente`
--
ALTER TABLE `utente`
  ADD CONSTRAINT `utente_ibfk_1` FOREIGN KEY (`cdl_matricola`) REFERENCES `cdl` (`matricola`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
