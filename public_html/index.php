<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 18/11/15
 * Time: 08:58
 */
define('ROOT_DIR', dirname(__FILE__)); //costante root dir
define('CORE_DIR', ROOT_DIR . DIRECTORY_SEPARATOR . 'core' . DIRECTORY_SEPARATOR); //costante core directory
define('VIEW_DIR', CORE_DIR . "view" . DIRECTORY_SEPARATOR); //ecc
define('EXCEPTION_DIR', CORE_DIR . "exception" . DIRECTORY_SEPARATOR);
define('MODEL_DIR', CORE_DIR . "model" . DIRECTORY_SEPARATOR);
define('CONTROL_DIR', CORE_DIR . "control" . DIRECTORY_SEPARATOR);
define('BEAN_DIR', CORE_DIR . "bean" . DIRECTORY_SEPARATOR);
define('UTILS_DIR', CORE_DIR . "utils" . DIRECTORY_SEPARATOR);

/*
 * URL Parsing, in pratica qualsiasi richiesta al sito arriva a questo file,
 * e quindi possiamo ricavare la richiesta da $_SERVER['SCRIPT_NAME']
 *
 * Successivamente rimuovo tutto ciò che non dovrebbe stare nella richiesta e faccio split
 *
 */
$_URL = preg_replace("/^(.*?)index.php$/", "$1", $_SERVER['SCRIPT_NAME']);
$_URL = preg_replace("/^" . preg_quote($_URL, "/") . "/", "", urldecode($_SERVER['REQUEST_URI']));
$_URL = preg_replace("/(\/?)(\?.*)?$/", "", $_URL);
$_URL = explode("/", $_URL);
if (preg_match("/^index.(?:html|php)$/i", $_URL[count($_URL) - 1]))
    unset($_URL[count($_URL) - 1]);


//TODO gestione modalità di funzionamento DEBUG-PRODUZIONE
//TODO logging
//TODO catch degli errori globale
// definisco costante IP contenente l'ip del client
if (isset($_SERVER['HTTP_X_REAL_IP'])) {
    define('IP', $_SERVER['HTTP_X_REAL_IP']);
} else {
    define('IP', $_SERVER['REMOTE_ADDR']);
}

include_once BEAN_DIR . "Utente.php"; //è necessario per mantenere l'utente nella sessione
session_start(); //facciamo partire la sessione

include_once UTILS_DIR . "Patterns.php";
include_once UTILS_DIR . "Error.php";
include_once EXCEPTION_DIR . "ApplicationException.php";
include_once MODEL_DIR . "Logger.php";
if (!defined("TESTING")) {
    switch (isset($_URL[0]) ? $_URL[0] : '') {
        case '':
            include_once VIEW_DIR . "VisualizzaHome.php";
            break;
        case 'auth': {
            switch (@$_URL[1]) {
                case '':
                    include_once VIEW_DIR . "Auth/VisualizzaLogReg.php";
                    break;
                case 'register':
                    include_once VIEW_DIR . "Auth/Register.php";
                    break;
                case 'login':
                    include_once VIEW_DIR . "Auth/Login.php";
                    break;
                case 'logout':
                    include_once VIEW_DIR . "Auth/Logout.php";
                    break;
            }
        }
            break;
        case 'adm': {
            switch (isset($_URL[1]) ? $_URL[1] : '') {
                case 'utenti':
                    switch (isset($_URL[2]) ? $_URL[2] : '') {
                        case 'view':
                            include_once VIEW_DIR . "Admin/visualizzaUtente.php";
                            break;
                        case 'groups':
                            include_once VIEW_DIR . "Admin/Groups.php";
                            break;
                        default:
                            include_once VIEW_DIR . "Admin/home.php";
                    }
                case 'cdl':
                    switch (isset($_URL[2]) ? $_URL[2] : '') {
                        case 'crea':
                            include_once VIEW_DIR . "Admin/creaCdL.php";
                            break;
                        //non mi fa modificare la matricolaCDL (prima si)
                        case 'modifica':
                            include_once VIEW_DIR . "Admin/modificaCdL.php";
                            break;
                        case 'view':
                            include_once VIEW_DIR . "Admin/gestioneCdL.php";
                            break;
                        default:
                            include_once VIEW_DIR . "Admin/home.php";
                    }
                case 'corsi':
                    switch (isset($_URL[2]) ? $_URL[2] : '') {
                        case 'crea':
                            include_once VIEW_DIR . "Admin/creaCorso.php";
                            break;
                        case 'modifica':
                            include_once VIEW_DIR . "Admin/modificaCorso.php";
                            break;
                        case 'view':
                            include_once VIEW_DIR . "Admin/gestioneCorsi.php";
                            break;
                        //non mi funziona la query associazione doc-corso (prima si)
                        case 'gestione':
                            include_once VIEW_DIR . "Admin/gestioneCorso.php";
                            break;
                        default:
                            include_once VIEW_DIR . "Admin/home.php";
                    }
            }
        }
            break;
        case 'usr': {
            switch (isset($_URL[1]) ? $_URL[1] : '') {
                case 'docente':
                    switch (isset($_URL[2]) ? $_URL[2] : '') {
                        case 'corso':
                            switch (isset($_URL[3]) ? $_URL[3] : '') {
                                case 'home':
                                    include_once VIEW_DIR . "Docente/HomeCorso2.php";
                                    break;
                                case 'argomento':
                                    switch (isset($_URL[4]) ? $_URL[4] : '') {
                                        case 'inserisci':
                                            include_once VIEW_DIR . "Docente/InserisciArgomento.php";
                                            break;
                                        case 'modifica':
                                            include_once VIEW_DIR . "Docente/ModificaArgomento.php";
                                            break;
                                        case 'domande':
                                            include_once VIEW_DIR . "Docente/VisualizzaListaDomande2.php";
                                            break;
                                    }
                            }
                    }
                case 'studente':
                    switch (isset($_URL[2]) ? $_URL[2] : '') {
                        case 'cdl':
                            include_once VIEW_DIR . "Studente/visualizzaCdL.php";
                            break;
                        case 'corsi':
                            include_once VIEW_DIR . "Studente/visualizzaCorsi.php";
                            break;
                        case 'corso':
                            include_once VIEW_DIR . "Studente/visualizzaCorso.php";
                            break;
                        default:
                            include_once VIEW_DIR . "Studente/visualizzaCdL.php";
                    }

            }
        }
            break;
        case 'esempio':
            include_once VIEW_DIR . "VisualizzaEsempio.php";
            break;
        case 'graficacomune':
            include_once VIEW_DIR . "GraficaComune.php";
            break;
        case 'provatable':
            include_once VIEW_DIR . "/Admin/provatable.php";
            break;
        case 'visualizzatestdocente':
            include_once VIEW_DIR . "/Docente/VisualizzaTest.php";
            break;
        case 'selezionadomandetest':
            include_once VIEW_DIR . "/Docente/SelezionaDomande.php";
            break;
        case 'aggiungistudentetest':
            include_once VIEW_DIR . "/Docente/AggiungiStudenteTest2.php";
            break;
        case 'eseguitest':
            include_once VIEW_DIR . "/Studente/EseguiTest.php";
            break;
        case 'visualizzateststudente':
            include_once VIEW_DIR . "/Studente/VisualizzaTest.php";
            break;
        case 'homecorsostudente':
            include_once VIEW_DIR . "/Studente/HomeCorso.php";
            break;
        case 'visualizzaesitisessione':
            include_once VIEW_DIR . "/Docente/VisualizzaEsitiSessione.php";
            break;
        case 'sessioneincorso':
            include_once VIEW_DIR . "/Docente/SessioneInCorso.php";
            break;
        case 'creamodificasessione':
            include_once VIEW_DIR . "/Docente/CreaModificaSessione.php";
            break;
        case 'visualizzasessione':
            include_once VIEW_DIR . "/Docente/VisualizzaSessione.php";
            break;
        case 'createst':
            include_once VIEW_DIR . "/Docente/CreaTest.php";
            break;
        case 't':
            include_once CONTROL_DIR . "TestController.php";
            break;
        case 'inseriscidomandaaperta':
            include_once VIEW_DIR . "/Docente/InserisciDomandaAperta.php";
            break;
        case 'modificadomandaaperta':
            include_once VIEW_DIR . "/Docente/ModificaDomandaAperta.php";
            break;
        case 'inseriscidomandamultipla':
            include_once VIEW_DIR . "/Docente/InserisciDomandaMultipla.php";
            break;
        case 'modificadomandamultipla':
            include_once VIEW_DIR . "/Docente/ModificaDomandaMultipla.php";
            break;
        case 'selezionestudenti':
            include_once VIEW_DIR . "/Docente/SelezioneStudenti.php";
            break;
        case 'correggitest':
            include_once VIEW_DIR . "/Docente/CorreggiTest.php";
            break;
        case 'provaargomenti':
            include_once VIEW_DIR . "/Docente/ProvaArgomenti.php";
            break;
        default:
            echo "Route inesistente";
    }
}
