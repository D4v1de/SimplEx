<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 18/11/15
 * Time: 09:09
 */

/**
 * Classe contiene tutte configurazioni necessari per il funzionamento del sistema
 */
class Config {

    public static $DB_URL = "5.9.123.184";
    public static $DB_NAME = "simplex";
    public static $DB_USER = "simlex-user";
    public static $DB_PASS = "qHt9vLTW";

    /**
     *  Vari configurazioni
     */
    public static $MIN_PASSWORD_LEN = 6;    //minima lunghezza della password
    public static $TIPI_UTENTE = array('Studente', 'Docente', 'Admin');
    public static $LOG_LEVEL = 0; //0 Debug, 1 Info, 2 Warning, 3 Error
}