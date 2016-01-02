<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 18/11/15
 * Time: 09:09
 */

/**
 * Classe contiene tutte configurazioni necessarie per il funzionamento del sistema
 */
class Config {

    public static $DB_URL = "5.9.123.184";
    public static $DB_NAME = "simplex";
    public static $DB_USER = "simlex-user";
    public static $DB_PASS = "qHt9vLTW";

    public static $PERMA_COOKIE = "permaCookie";
WtC7kllj
    /**
     *  Varie configurazioni
     */
    public static $MIN_PASSWORD_LEN = 8;    //minima lunghezza della password
    public static $TIPI_UTENTE = array('Studente', 'Docente', 'Admin');
    public static $TIPI_CONTATTO = array('Telefono', 'E-mail', 'Cellulare', 'Fax');
    public static $TIPI_CDL = array('Triennale', 'Magistrale', 'Ciclo Unico');
    public static $TIPI_CORSO = array('Semestrale', 'Annuale');
    public static $TIPI_SESSIONE = array('Valutativa', 'Esercitativa');
    public static $STATI_SESSIONE = array('Eseguita', 'In esecuzione', 'Non eseguita');
    public static $STATI_ELABORATO = array('Corretto', 'Non corretto', 'Parzialmente corretto');
    public static $LOG_LEVEL = 0; //0 Debug, 1 Info, 2 Warning, 3 Error
}