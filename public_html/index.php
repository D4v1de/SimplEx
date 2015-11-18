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

switch (isset($_URL[0]) ? $_URL[0] : '') {
    case '':
        include_once VIEW_DIR . "VisualizzaHome.php";
        break;
    case 'auth':
        include_once VIEW_DIR . "VisualizzaLogReg.php";
        break;
    case 'esempio':
        include_once VIEW_DIR."VisualizzaEsempio.php";
        break;
    default:
        echo "Route inesistente";
}
