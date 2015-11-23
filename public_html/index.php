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
 * */
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

session_start(); //facciamo partire la sessione

include_once UTILS_DIR . "Patterns.php";

switch (isset($_URL[0]) ? $_URL[0] : '') {
    case '':
        include_once VIEW_DIR . "VisualizzaHome.php";
        break;
    case 'auth':
        include_once VIEW_DIR . "VisualizzaLogReg.php";
        break;
    case 'esempio':
        include_once VIEW_DIR . "VisualizzaEsempio.php";
        break;
    case 'graficacomune':
        include_once VIEW_DIR . "GraficaComune.php";
        break;
    case 'visualizzatestdocente':
        include_once VIEW_DIR . "/Docente/VisualizzaTest.php";
        break;
    case 'selezionadomandetest':
        include_once VIEW_DIR . "/Docente/SelezionaDomande.php";
        break;
    case 'aggiungistudentetest':
        include_once VIEW_DIR . "/Docente/AggiungiStudenteTest.php";
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
    case 'homecorsodocente':
        include_once VIEW_DIR . "/Docente/HomeCorso.php";
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
    case 'createst':
        include_once VIEW_DIR . "/Docente/CreaTest.php";
        break;
    case 't':
        include_once CONTROL_DIR . "TestController.php";
        break;
    case 'visualizzalistadomande':
        include_once VIEW_DIR . "/Docente/VisualizzaListaDomande.php";
        break;
    case 'inseriscidomandaaperta':
        include_once VIEW_DIR . "/Docente/InserisciDomandaAperta.php";
        break;
    case 'inseriscidomandamultipla':
        include_once VIEW_DIR . "/Docente/InserisciDomandaMultipla.php";
        break;
    case 'inserisciargomento':
        include_once VIEW_DIR . "/Docente/InserisciArgomento.php";
        break;
    case 'creacdl':
        include_once VIEW_DIR . "/Admin/creaCdL.php";
        break;
    case 'creacorso':
        include_once VIEW_DIR . "/Admin/creaCorso.php";
        break;
    case 'gestionecdl':
        include_once VIEW_DIR . "/Admin/gestioneCdL.php";
        break;
    case 'gestionecorsi':
        include_once VIEW_DIR . "/Admin/gestioneCorsi.php";
        break;
    case 'modificacdl':
        include_once VIEW_DIR . "/Admin/modificaCdL.php";
        break;
    case 'modificacorso':
        include_once VIEW_DIR . "/Admin/modificaCorso.php";
        break;
    case 'visualizzacorso':
        include_once VIEW_DIR . "/Admin/visualizzaCorso.php";
        break;
    case 'visualizzacorsi':
        include_once VIEW_DIR . "/Studente/visualizzaCorsi.php";
    case 'creacdl':
        include_once VIEW_DIR."/Admin/creaCdL.php";
        break;
    case 'creacorso':
        include_once VIEW_DIR."/Admin/creaCorso.php";
        break;
    case 'gestionecdl':
        include_once VIEW_DIR."/Admin/gestioneCdL.php";
        break;
    case 'gestionecorsi':
        include_once VIEW_DIR."/Admin/gestioneCorsi.php";
        break;
    case 'modificacdl':
        include_once VIEW_DIR."/Admin/modificaCdL.php";
        break;
    case 'modificacorso':
        include_once VIEW_DIR."/Admin/modificaCorso.php";
        break;
    case 'visualizzacorso':
        include_once VIEW_DIR."/Admin/visualizzaCorso.php";
        break;
    case 'visualizzacorsi':
        include_once VIEW_DIR."/Studente/visualizzaCorsi.php";
        break;
    case 'selezionestudenti':
        include_once VIEW_DIR."/Docente/SelezioneStudenti.php";
        break;
    default:
        echo "Route inesistente";
}
