-- phpMyAdmin SQL Dump
-- version 4.5.0.2
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Creato il: Dic 05, 2015 alle 15:16
-- Versione del server: 10.0.17-MariaDB
-- Versione PHP: 5.6.14

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

CREATE TABLE `abilitazione` (
  `studente_matricola` varchar(10) CHARACTER SET latin1 NOT NULL,
  `sessione_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `abilitazione`
--

INSERT INTO `abilitazione` (`studente_matricola`, `sessione_id`) VALUES
('0512102396', 1),
('0512109992', 2),
('0512109993', 3),
('0512109994', 4);

-- --------------------------------------------------------

--
-- Struttura della tabella `alternativa`
--

CREATE TABLE `alternativa` (
  `id` int(11) NOT NULL,
  `domanda_multipla_id` int(8) NOT NULL,
  `testo` varchar(100) CHARACTER SET latin1 NOT NULL,
  `percentuale_scelta` float NOT NULL DEFAULT '0',
  `corretta` enum('Si','No') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `alternativa`
--

INSERT INTO `alternativa` (`id`, `domanda_multipla_id`, `testo`, `percentuale_scelta`, `corretta`) VALUES
(1, 3, 'A', 0, 'Si'),
(2, 3, 'NOT A', 0, 'No'),
(3, 4, 'A', 0, 'Si'),
(4, 4, 'NOT(A)', 0, 'No'),
(5, 5, 'Si', 0, 'Si'),
(6, 5, 'No', 0, 'No');

-- --------------------------------------------------------

--
-- Struttura della tabella `argomento`
--

CREATE TABLE `argomento` (
  `id` int(3) NOT NULL,
  `corso_id` int(8) NOT NULL,
  `nome` varchar(50) CHARACTER SET latin1 NOT NULL,
  `stato` enum('In uso','Obsoleto') NOT NULL DEFAULT 'In uso'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `argomento`
--

INSERT INTO `argomento` (`id`, `corso_id`, `nome`, `stato`) VALUES
(1, 18, 'MIPS', 'In uso'),
(2, 18, 'Algebra booleana', 'In uso'),
(3, 18, 'CPU', 'In uso'),
(4, 21, 'Ottica', 'In uso'),
(5, 19, 'Logica', 'In uso'),
(6, 19, 'Autovalori e autovettori', 'In uso'),
(7, 20, 'Fondamenti di c', 'In uso'),
(8, 20, 'Cicli', 'In uso'),
(9, 20, 'Input/ output', 'In uso'),
(10, 21, 'Meccanica', 'In uso'),
(11, 21, 'CVS', 'In uso'),
(12, 21, 'Dinamica', 'In uso');

-- --------------------------------------------------------

--
-- Struttura della tabella `cdl`
--

CREATE TABLE `cdl` (
  `matricola` varchar(10) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `tipologia` enum('Triennale','Magistrale','Ciclo Unico') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `cdl`
--

INSERT INTO `cdl` (`matricola`, `nome`, `tipologia`) VALUES
('051210', 'Informatica', 'Triennale'),
('051211', 'Matematica', 'Triennale'),
('051213', 'Fisica', 'Triennale'),
('051214', 'Lettere Moderne', 'Triennale');

-- --------------------------------------------------------

--
-- Struttura della tabella `compone_aperta`
--

CREATE TABLE `compone_aperta` (
  `domanda_aperta_id` int(8) NOT NULL,
  `test_id` int(8) NOT NULL,
  `punteggio_max_alternativo` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `compone_aperta`
--

INSERT INTO `compone_aperta` (`domanda_aperta_id`, `test_id`, `punteggio_max_alternativo`) VALUES
(4, 1, NULL),
(5, 1, NULL),
(6, 1, NULL);

-- --------------------------------------------------------

--
-- Struttura della tabella `compone_multipla`
--

CREATE TABLE `compone_multipla` (
  `domanda_multipla_id` int(8) NOT NULL,
  `test_id` int(8) NOT NULL,
  `punteggio_corretta_alternativo` float DEFAULT NULL,
  `punteggio_errata_alternativo` float DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `contatto`
--

CREATE TABLE `contatto` (
  `id` int(8) NOT NULL,
  `valore` varchar(20) CHARACTER SET latin1 NOT NULL,
  `tipologia` enum('Telefono','E-mail','Fax','Cellulare') CHARACTER SET latin1 NOT NULL,
  `utente_matricola` varchar(10) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `contatto`
--

INSERT INTO `contatto` (`id`, `valore`, `tipologia`, `utente_matricola`) VALUES
(1, '089000000000', 'Telefono', '0512109999'),
(2, '089000000000', 'Telefono', '0512109998'),
(3, '089222552255', 'Telefono', '0512109997'),
(4, '8225155522663', 'Telefono', '0512109996'),
(5, '524863214', 'Telefono', '0512109995'),
(6, '78541236', 'Telefono', '0512109994'),
(7, '741852963', 'Telefono', '0512109993'),
(8, '789456123', 'Telefono', '0512109992'),
(9, '000000000', 'Telefono', '0512109999');

-- --------------------------------------------------------

--
-- Struttura della tabella `corso`
--

CREATE TABLE `corso` (
  `id` int(8) NOT NULL,
  `matricola` varchar(10) CHARACTER SET latin1 NOT NULL,
  `nome` varchar(40) CHARACTER SET latin1 NOT NULL,
  `tipologia` enum('Semestrale','Annuale','','') CHARACTER SET latin1 NOT NULL,
  `cdl_matricola` varchar(10) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `corso`
--

INSERT INTO `corso` (`id`, `matricola`, `nome`, `tipologia`, `cdl_matricola`) VALUES
(18, '0512100001', 'Architettura degli elaboratori - CL3', 'Semestrale', '051210'),
(19, '0512100002', 'Matematica discreta e LM - CL3', 'Semestrale', '051210'),
(20, '0512100003', 'Programmazione 1 - CL3', 'Semestrale', '051210'),
(21, '0512100004', 'Fisica - CL3', 'Semestrale', '051210'),
(27, '0512100007', 'Matematica 1 - CL3', 'Semestrale', '051211'),
(28, '0512100008', 'Matematica 2 - CL3', 'Semestrale', '051211'),
(29, '0512100009', 'Fisica 1 - CL3', 'Semestrale', '051213'),
(52, '0512100000', 'Reti di calcolatori - CL3', 'Semestrale', '051210');

-- --------------------------------------------------------

--
-- Struttura della tabella `domanda_aperta`
--

CREATE TABLE `domanda_aperta` (
  `id` int(8) NOT NULL,
  `argomento_id` int(3) NOT NULL,
  `testo` varchar(500) NOT NULL,
  `punteggio_max` float NOT NULL DEFAULT '1',
  `percentuale_scelta` float NOT NULL DEFAULT '0',
  `stato` enum('In uso','Obsoleto') NOT NULL DEFAULT 'In uso'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `domanda_aperta`
--

INSERT INTO `domanda_aperta` (`id`, `argomento_id`, `testo`, `punteggio_max`, `percentuale_scelta`, `stato`) VALUES
(1, 7, 'Qual è la differenza tra exit(0) e return 0 utilizzati al termine del main?', 2, 0, 'In uso'),
(2, 9, 'Scrivere la sintassi dell''input', 1, 0, 'In uso'),
(3, 9, 'Scrivere la sintassi dell''output', 5, 0, 'In uso'),
(4, 1, 'Mips', 2, 0, 'In uso'),
(5, 2, 'Algebra di boole...', 2, 0, 'In uso'),
(6, 3, 'Parlami dell cpu', 5, 0, 'In uso'),
(10, 1, 'Domanda di prova', 15, 20, 'In uso'),
(11, 1, 'Domanda di prova', 15, 20, 'Obsoleto'),
(12, 1, 'Domanda di prova', 15, 20, 'Obsoleto');

-- --------------------------------------------------------

--
-- Struttura della tabella `domanda_multipla`
--

CREATE TABLE `domanda_multipla` (
  `id` int(8) NOT NULL,
  `argomento_id` int(3) NOT NULL,
  `testo` varchar(500) CHARACTER SET latin1 NOT NULL,
  `punteggio_corretta` float NOT NULL DEFAULT '1',
  `punteggio_errata` float NOT NULL DEFAULT '0',
  `percentuale_scelta` float NOT NULL DEFAULT '0',
  `percentuale_risposta_corretta` float NOT NULL DEFAULT '0',
  `stato` enum('In uso','Obsoleto') NOT NULL DEFAULT 'In uso'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `domanda_multipla`
--

INSERT INTO `domanda_multipla` (`id`, `argomento_id`, `testo`, `punteggio_corretta`, `punteggio_errata`, `percentuale_scelta`, `percentuale_risposta_corretta`, `stato`) VALUES
(1, 7, 'scrivi funzione C?', 10, -20, 69, 20, 'In uso'),
(2, 8, 'il WHILE?', 10, -20, 69, 20, 'In uso'),
(3, 5, 'A AND A = ?', 1, 0, 0, 0, 'In uso'),
(4, 5, 'NOT (NOT (A)) = ?', 1, 0, 0, 0, 'In uso'),
(5, 1, 'Conosci il MIPS?', 1, 0, 0, 0, 'In uso'),
(9, 1, 'Domanda di prova', 7, 0, 10, 10, 'In uso'),
(10, 1, 'Domanda di prova', 7, 0, 10, 10, 'Obsoleto'),
(11, 1, 'Domanda di prova', 7, 0, 10, 10, 'Obsoleto');

-- --------------------------------------------------------

--
-- Struttura della tabella `elaborato`
--

CREATE TABLE `elaborato` (
  `studente_matricola` varchar(10) CHARACTER SET latin1 NOT NULL,
  `sessione_id` int(10) NOT NULL,
  `esito_parziale` float DEFAULT NULL,
  `esito_finale` float DEFAULT NULL,
  `test_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `elaborato`
--

INSERT INTO `elaborato` (`studente_matricola`, `sessione_id`, `esito_parziale`, `esito_finale`, `test_id`) VALUES
('0512102390', 1, 27, 28, 1),
('0512102396', 2, 27, 27, 2),
('0512102552', 3, 23, 24, 3);

-- --------------------------------------------------------

--
-- Struttura della tabella `frequenta`
--

CREATE TABLE `frequenta` (
  `corso_id` int(8) NOT NULL,
  `studente_matricola` varchar(10) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `frequenta`
--

INSERT INTO `frequenta` (`corso_id`, `studente_matricola`) VALUES
(18, '0512102256'),
(18, '0512102390'),
(18, '0512102396'),
(18, '0512102552'),
(18, '0512102588'),
(19, '0512102256'),
(19, '0512102396'),
(19, '0512102552'),
(19, '0512102588'),
(20, '0512102256'),
(20, '0512102390'),
(20, '0512102396'),
(20, '0512102552'),
(20, '0512102588'),
(21, '0512102256'),
(21, '0512102390'),
(21, '0512102396'),
(21, '0512102552'),
(21, '0512102588');

-- --------------------------------------------------------

--
-- Struttura della tabella `insegnamento`
--

CREATE TABLE `insegnamento` (
  `corso_id` int(8) NOT NULL,
  `docente_matricola` varchar(10) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `insegnamento`
--

INSERT INTO `insegnamento` (`corso_id`, `docente_matricola`) VALUES
(18, '0512109998'),
(19, '0512109993'),
(19, '0512109995'),
(19, '0512109996'),
(20, '0512109997'),
(20, '0512109999'),
(21, '0512109994'),
(52, '0512109992');

-- --------------------------------------------------------

--
-- Struttura della tabella `log`
--

CREATE TABLE `log` (
  `id` int(10) NOT NULL,
  `level` enum('Debug','Info','Warning','Error') CHARACTER SET latin1 NOT NULL,
  `message` varchar(1024) CHARACTER SET latin1 NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `log`
--

INSERT INTO `log` (`id`, `level`, `message`, `date`) VALUES
(1, 'Debug', 'Metodo invocato', '2015-11-28 17:15:03'),
(2, 'Info', 'Cdl Aggiunto', '2015-11-28 17:15:03'),
(3, 'Warning', 'Problema risolvibile dal sistema-Attention', '2015-11-28 17:15:48'),
(4, 'Error', 'Stamm nguaiat', '2015-11-28 17:15:48');

-- --------------------------------------------------------

--
-- Struttura della tabella `risposta_aperta`
--

CREATE TABLE `risposta_aperta` (
  `id` int(10) NOT NULL,
  `elaborato_sessione_id` int(10) NOT NULL,
  `elaborato_studente_matricola` varchar(10) CHARACTER SET latin1 NOT NULL,
  `testo` varchar(500) CHARACTER SET latin1 DEFAULT NULL,
  `punteggio` float DEFAULT NULL,
  `domanda_aperta_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `risposta_multipla`
--

CREATE TABLE `risposta_multipla` (
  `id` int(10) NOT NULL,
  `elaborato_sessione_id` int(10) NOT NULL,
  `elaborato_studente_matricola` varchar(10) CHARACTER SET latin1 NOT NULL,
  `punteggio` float DEFAULT NULL,
  `alternativa_id` int(8) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Struttura della tabella `sessione`
--

CREATE TABLE `sessione` (
  `id` int(10) NOT NULL,
  `data_inizio` datetime NOT NULL,
  `data_fine` datetime NOT NULL,
  `soglia_ammissione` float NOT NULL,
  `stato` enum('Eseguita','Non eseguita') CHARACTER SET latin1 NOT NULL,
  `tipologia` enum('Esercitativa','Valutativa','','') NOT NULL,
  `corso_id` int(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `sessione`
--

INSERT INTO `sessione` (`id`, `data_inizio`, `data_fine`, `soglia_ammissione`, `stato`, `tipologia`, `corso_id`) VALUES
(1, '2014-07-29 05:05:00', '2015-12-31 15:00:00', 0, '', 'Valutativa', 18),
(2, '2015-10-01 00:00:00', '2015-12-23 00:00:00', 80, 'Non eseguita', 'Esercitativa', 18),
(3, '2016-01-11 00:00:00', '2016-01-11 00:00:00', 18, 'Non eseguita', 'Valutativa', 19),
(4, '2015-10-01 00:00:00', '2015-12-23 00:00:00', 18, 'Non eseguita', 'Esercitativa', 19),
(6, '2016-01-29 00:00:00', '2016-01-29 00:00:00', 18, 'Non eseguita', 'Valutativa', 20),
(8, '2016-01-13 00:00:00', '2016-01-13 00:00:00', 18, 'Non eseguita', 'Valutativa', 21),
(67, '2000-12-07 09:15:00', '2015-08-09 09:30:00', 0, '', 'Valutativa', 18),
(70, '2016-12-20 14:50:00', '2016-12-20 17:00:00', 0, '', 'Valutativa', 18),
(73, '1900-12-30 05:15:00', '2015-12-13 13:00:00', 0, '', 'Valutativa', 18),
(74, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 18, 'Non eseguita', 'Valutativa', 18),
(75, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 18, 'Non eseguita', 'Valutativa', 18),
(76, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 18, 'Non eseguita', 'Valutativa', 18),
(77, '0000-00-00 00:00:00', '0000-00-00 00:00:00', 18, 'Non eseguita', 'Valutativa', 18),
(79, '2015-12-15 10:50:05', '2015-12-07 14:35:05', 18, 'Non eseguita', 'Valutativa', 18),
(80, '2015-12-10 06:35:49', '2015-12-01 09:30:49', 18, 'Non eseguita', 'Valutativa', 18);

-- --------------------------------------------------------

--
-- Struttura della tabella `sessione_test`
--

CREATE TABLE `sessione_test` (
  `sessione_id` int(8) NOT NULL,
  `test_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `sessione_test`
--

INSERT INTO `sessione_test` (`sessione_id`, `test_id`) VALUES
(1, 1),
(3, 2),
(75, 1),
(77, 1),
(79, 1),
(80, 1);

-- --------------------------------------------------------

--
-- Struttura della tabella `test`
--

CREATE TABLE `test` (
  `id` int(8) NOT NULL,
  `descrizione` varchar(50) DEFAULT NULL,
  `punteggio_max` int(4) NOT NULL,
  `n_multiple` int(4) NOT NULL,
  `n_aperte` int(4) NOT NULL,
  `percentuale_scelto` float NOT NULL DEFAULT '0',
  `percentuale_successo` float NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dump dei dati per la tabella `test`
--

INSERT INTO `test` (`id`, `descrizione`, `punteggio_max`, `n_multiple`, `n_aperte`, `percentuale_scelto`, `percentuale_successo`) VALUES
(1, 'Architettura degli Elaboratori- appello gennaio', 30, 1, 2, 0, 0),
(2, 'Matematica Discreta - PIT', 30, 8, 2, 0, 0),
(3, 'Programmazione I - Appello Gennaio', 30, 8, 2, 0, 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `utente`
--

CREATE TABLE `utente` (
  `matricola` varchar(10) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(32) NOT NULL,
  `tipologia` enum('Studente','Docente','Admin') NOT NULL,
  `nome` varchar(30) DEFAULT NULL,
  `cognome` varchar(30) DEFAULT NULL,
  `cdl_matricola` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dump dei dati per la tabella `utente`
--

INSERT INTO `utente` (`matricola`, `username`, `password`, `tipologia`, `nome`, `cognome`, `cdl_matricola`) VALUES
('0512102256', 'a.korniychuk@studenti.unisa.it', 'alina', 'Studente', 'Alina', 'Korniychuk', '051210'),
('0512102390', 'f.pecorelli@studenti.unisa.it', 'fabiano', 'Studente', 'Fabiano', 'Pecorelli', '051210'),
('0512102396', 'e.zanin@studenti.unisa.it', 'elvis', 'Studente', 'Elvira', 'Zanin', '051210'),
('0512102552', 'd.castellano@studenti.unisa.it', 'dario', 'Studente', 'Dario', 'Castellano', '051210'),
('0512102588', 'g.tufano@studenti.unisa.it', 'giusy', 'Studente', 'Giusy', 'Tufano', '051210'),
('0512109992', 's.monsurro@unisa.it', 'sara', 'Docente', 'Sara', 'Monsurrò', NULL),
('0512109993', 'a.rescigno@unisa.it', 'adele', 'Docente', 'Adele', 'Rescigno', NULL),
('0512109994', 'r.deluca@unisa.it', 'roberto', 'Docente', 'Roberto', 'De Luca', NULL),
('0512109995', 'c.delizia@unisa.it', 'costantino', 'Docente', 'Costantino', 'Delizia', NULL),
('0512109996', 'm.tota@unisa.it', 'maria', 'Docente', 'Maria', 'Tota', NULL),
('0512109997', 'g.demarco@unisa.it', 'gianluca', 'Docente', 'Gianluca', 'De Marco', NULL),
('0512109998', 'a.marcella@unisa.it', 'marcella', 'Docente', 'Marcella', 'Anselmo', NULL),
('0512109999', 'zizzarosalba@unisa.it', 'rosalba', 'Docente', 'Rosalba', 'Zizza', NULL);

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
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `domanda_multipla_id` (`domanda_multipla_id`);

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
  ADD PRIMARY KEY (`domanda_aperta_id`,`test_id`) USING BTREE,
  ADD KEY `domanda_aperta_id` (`domanda_aperta_id`),
  ADD KEY `test_id` (`test_id`);

--
-- Indici per le tabelle `compone_multipla`
--
ALTER TABLE `compone_multipla`
  ADD PRIMARY KEY (`domanda_multipla_id`,`test_id`) USING BTREE,
  ADD KEY `domanda_multipla_id` (`domanda_multipla_id`),
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
  ADD KEY `cdl_matricola` (`cdl_matricola`),
  ADD KEY `cdl_matricola_2` (`cdl_matricola`);

--
-- Indici per le tabelle `domanda_aperta`
--
ALTER TABLE `domanda_aperta`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `argomento_id` (`argomento_id`);

--
-- Indici per le tabelle `domanda_multipla`
--
ALTER TABLE `domanda_multipla`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `argomento_id` (`argomento_id`);

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
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `elaborato_sessione_id` (`elaborato_sessione_id`),
  ADD KEY `elaborato_studente_matricola` (`elaborato_studente_matricola`),
  ADD KEY `domanda_aperta_id` (`domanda_aperta_id`);

--
-- Indici per le tabelle `risposta_multipla`
--
ALTER TABLE `risposta_multipla`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `alternativa_id` (`alternativa_id`),
  ADD KEY `elaborato_sessione_id` (`elaborato_sessione_id`),
  ADD KEY `elaborato_studente_matricola` (`elaborato_studente_matricola`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
--
-- AUTO_INCREMENT per la tabella `argomento`
--
ALTER TABLE `argomento`
  MODIFY `id` int(3) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
--
-- AUTO_INCREMENT per la tabella `contatto`
--
ALTER TABLE `contatto`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT per la tabella `corso`
--
ALTER TABLE `corso`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT per la tabella `domanda_aperta`
--
ALTER TABLE `domanda_aperta`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT per la tabella `domanda_multipla`
--
ALTER TABLE `domanda_multipla`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT per la tabella `log`
--
ALTER TABLE `log`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT per la tabella `sessione`
--
ALTER TABLE `sessione`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;
--
-- AUTO_INCREMENT per la tabella `test`
--
ALTER TABLE `test`
  MODIFY `id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `abilitazione`
--
ALTER TABLE `abilitazione`
  ADD CONSTRAINT `abilitazione_ibfk_1` FOREIGN KEY (`studente_matricola`) REFERENCES `utente` (`matricola`),
  ADD CONSTRAINT `abilitazione_ibfk_2` FOREIGN KEY (`sessione_id`) REFERENCES `sessione` (`id`);

--
-- Limiti per la tabella `alternativa`
--
ALTER TABLE `alternativa`
  ADD CONSTRAINT `alternativa_ibfk_3` FOREIGN KEY (`domanda_multipla_id`) REFERENCES `domanda_multipla` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `argomento`
--
ALTER TABLE `argomento`
  ADD CONSTRAINT `argomento_ibfk_1` FOREIGN KEY (`corso_id`) REFERENCES `corso` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `compone_aperta`
--
ALTER TABLE `compone_aperta`
  ADD CONSTRAINT `compone_aperta_ibfk_1` FOREIGN KEY (`domanda_aperta_id`) REFERENCES `domanda_aperta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compone_aperta_ibfk_4` FOREIGN KEY (`test_id`) REFERENCES `test` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `compone_multipla`
--
ALTER TABLE `compone_multipla`
  ADD CONSTRAINT `compone_multipla_ibfk_1` FOREIGN KEY (`domanda_multipla_id`) REFERENCES `domanda_multipla` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compone_multipla_ibfk_4` FOREIGN KEY (`test_id`) REFERENCES `test` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `domanda_aperta_ibfk_2` FOREIGN KEY (`argomento_id`) REFERENCES `argomento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `domanda_multipla`
--
ALTER TABLE `domanda_multipla`
  ADD CONSTRAINT `domanda_multipla_ibfk_2` FOREIGN KEY (`argomento_id`) REFERENCES `argomento` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `elaborato`
--
ALTER TABLE `elaborato`
  ADD CONSTRAINT `elaborato_ibfk_1` FOREIGN KEY (`studente_matricola`) REFERENCES `utente` (`matricola`),
  ADD CONSTRAINT `elaborato_ibfk_2` FOREIGN KEY (`sessione_id`) REFERENCES `sessione` (`id`),
  ADD CONSTRAINT `elaborato_ibfk_3` FOREIGN KEY (`test_id`) REFERENCES `test` (`id`);

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
  ADD CONSTRAINT `risposta_aperta_ibfk_1` FOREIGN KEY (`elaborato_sessione_id`) REFERENCES `elaborato` (`sessione_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `risposta_aperta_ibfk_2` FOREIGN KEY (`elaborato_studente_matricola`) REFERENCES `elaborato` (`studente_matricola`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `risposta_aperta_ibfk_3` FOREIGN KEY (`domanda_aperta_id`) REFERENCES `domanda_aperta` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Limiti per la tabella `risposta_multipla`
--
ALTER TABLE `risposta_multipla`
  ADD CONSTRAINT `risposta_multipla_ibfk_1` FOREIGN KEY (`elaborato_sessione_id`) REFERENCES `elaborato` (`sessione_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `risposta_multipla_ibfk_2` FOREIGN KEY (`elaborato_studente_matricola`) REFERENCES `elaborato` (`studente_matricola`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `risposta_multipla_ibfk_3` FOREIGN KEY (`alternativa_id`) REFERENCES `alternativa` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

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
  ADD CONSTRAINT `utente_ibfk_1` FOREIGN KEY (`cdl_matricola`) REFERENCES `cdl` (`matricola`) ON DELETE SET NULL ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
