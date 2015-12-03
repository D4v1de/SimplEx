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
                            include_once VIEW_DIR . "Admin/VisualizzaUtente.php";
                            break;
                        case '':
                            include_once VIEW_DIR . "Admin/GestioneUtente.php";
                            break;
                        case 'groups':
                            include_once VIEW_DIR . "Admin/ajaxGroups.php";
                            break;
                        case 'cdls':
                            include_once VIEW_DIR . "Admin/ajaxCdls.php";
                            break;
                        case 'edit':
                            include_once VIEW_DIR . "Admin/ajaxModifica.php";
                            break;
                        default:
                            include_once VIEW_DIR . "Admin/Home.php";
                    }
                    break;
                case 'cdl':
                    switch (isset($_URL[2]) ? $_URL[2] : '') {
                        case 'crea':
                            include_once VIEW_DIR . "Admin/creaCdL.php";
                            break;
                        case 'modifica':
                            include_once VIEW_DIR . "Admin/modificaCdL.php";
                            break;
                        case 'view':
                            include_once VIEW_DIR . "Admin/gestioneCdL.php";
                            break;
                        default:
                            include_once VIEW_DIR . "Admin/gestioneCdL.php";
                    }
                    break;
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
                        case 'gestione':
                            include_once VIEW_DIR . "Admin/gestioneCorso.php";
                            break;
                        default:
                            include_once VIEW_DIR . "Admin/gestioneCorsi.php";
                    }
                    break;
                default:
                    include_once VIEW_DIR . "Admin/Home.php";
            }
        }
            break;
        case 'usr': {
            switch (isset($_URL[1]) ? $_URL[1] : '') {
                case 'docente':
                    switch (isset($_URL[2]) ? $_URL[2] : '') {
                        case 'cdl':
                            include_once VIEW_DIR . "Docente/visualizzaCorsi.php";
                            break;
                        case 'corso':
                            switch (isset($_URL[4]) ? $_URL[4] : '') {
                                case 'argomento':
                                    switch (isset($_URL[5]) ? $_URL[5] : '') {
                                        case 'inserisci':
                                            include_once VIEW_DIR . "Docente/InserisciArgomento.php";
                                            break;
                                        case 'modifica':
                                            include_once VIEW_DIR . "Docente/ModificaArgomento.php";
                                            break;
                                        case 'domande':
                                            switch (isset($_URL[6]) ? $_URL[6] : '') {
                                                case 'inserisciaperta':
                                                    include_once VIEW_DIR . "Docente/InserisciDomandaAperta.php";
                                                    break;
                                                case 'modificaaperta':
                                                    include_once VIEW_DIR . "Docente/ModificaDomandaAperta.php";
                                                    break;
                                                case 'inseriscimultipla':
                                                    include_once VIEW_DIR . "Docente/InserisciDomandaMultipla.php";
                                                    break;
                                                case 'modificamultipla':
                                                    include_once VIEW_DIR . "Docente/ModificaDomandaMultipla.php";
                                                    break;
                                                default:
                                                    include_once VIEW_DIR . "Docente/VisualizzaListaDomande2.php";
                                            }
                                            break;
                                        default:
                                            include_once VIEW_DIR . "Docente/HomeCorso2.php";
                                    }
                                    break;
                                case 'test':
                                    switch (isset($_URL[5]) ? $_URL[5] : '') {
                                        case 'crea':
                                            include_once VIEW_DIR . "Docente/CreaTest.php";
                                            break;
                                        case 'correggi':
                                            include_once VIEW_DIR . "Docente/CorreggiTest.php";
                                            break;
                                        default:
                                            include_once VIEW_DIR . "Docente/VisualizzaTest.php";
                                    }
                                    break;
                                case 'sessione':
                                    switch (isset($_URL[5]) ? $_URL[5] : '') {
                                        case 'aggiungistudenti':
                                            include_once VIEW_DIR . "Docente/AggiungiStudenteTest2.php";
                                            break;
                                        case 'esiti':
                                            include_once VIEW_DIR . "Docente/VisualizzaEsitiSessione.php";
                                            break;
                                        case 'creamodificasessione':
                                            include_once VIEW_DIR . "Docente/CreaModificaSessione.php";
                                            break;
                                        default:
                                            include_once VIEW_DIR . "Docente/VisualizzaSessione.php";
                                    }
                                    break;
                                default:
                                    include_once VIEW_DIR . "Docente/HomeCorso2.php";
                            }
                            break;
                        default:
                            include_once VIEW_DIR . "Docente/visualizzaCdL.php";
                    }
                    break;
                case 'studente':
                    switch (isset($_URL[2]) ? $_URL[2] : '') {
                        case 'cdl':
                            include_once VIEW_DIR . "Studente/visualizzaCorsi.php";
                            break;
                        case 'corso':
                            switch (isset($_URL[4]) ? $_URL[4] : '') {
                                case 'test':
                                    switch (isset($_URL[5]) ? $_URL[5] : '') {
                                        case 'esegui':
                                            include_once VIEW_DIR . "Studente/EseguiTest.php";
                                            break;
                                        default:
                                            include_once VIEW_DIR . "Studente/VisualizzaTest.php";
                                    }
                                    break;
                                default:
                                    include_once VIEW_DIR . "Studente/visualizzaCorso.php";
                            }
                            break;
                        default:
                            include_once VIEW_DIR . "Studente/visualizzaCdL.php";
                    }
                    break;

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
            include_once VIEW_DIR . "Admin/provatable.php";
            break;
        //inglobare fabiano
        case 'sessioneincorso':
            include_once VIEW_DIR . "Docente/SessioneInCorso.php";
            break;
        //inglobare fabiano
        case 'provaargomenti':
            include_once VIEW_DIR . "Docente/ProvaArgomenti.php";
            break;
        //eliminare fabiano
        case 'selezionadomandetest':
            include_once VIEW_DIR . "Docente/SelezionaDomande.php";
            break;
        case 't':
            include_once CONTROL_DIR . "TestController.php";
            break;
        //eliminare fabiano
        case 'selezionestudenti':
            include_once VIEW_DIR . "Docente/SelezioneStudenti.php";
            break;
        default:
            echo "Route inesistente";
    }
}
