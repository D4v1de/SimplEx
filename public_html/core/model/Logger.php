<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 27/11/15
 * Time: 10:08
 *
 */

/**
 * Class Logger
 *
 *
 * Ci sono 4 livelli possibili di un evento da loggare e vanno in ordine di importanza crescente:
 * debug, info, warning, error
 *
 * Dal Config.php deve essere possibile indicare il livello di logging, ad esempio se il livello
 * è settato a info, nel log devono comparire tutti i messaggi da info è su (quindi info, warning, error);
 * se è settato a warning, nel db devono andare solo warning e error, ovviamente, se è settato debug - tutti gli eventi
 * devono essere registrati
 *
 * Al messaggio di evento, devono essere concatenati i seguenti dati: data e ora, file da dove è stato invocato il
 * logger e la riga.
 *
 * Esempio, supponiamo nel CorsoModel.php scrivo (alla riga 12):
 * Logger::info("Creato nuovo cdl=informatica matricola=121212");
 * Nel db si dovresti scrivere la stringa:
 * "[2015/11/27 10:08:22] Info CorsoModel.php 12 - Creato nuovo cdl=informatica matricola=121212"
 * quindi sarebbe
 * "<data e ora> <Livello> <File> <Riga> - <messaggio passato come parametro>
 *
 * P.S.
 * Vedi qui come prendere il file e la riga che ha invocato un metodo del logger: http://us3.php.net/manual/en/function.debug-backtrace.php
 * P.S.S. FORSE, la data, conviene metterla in una colonna separata, ma per ora va bene cosi
 *
 */
final class Logger extends Model {
    public static $INSERT_QUERY = "INSERT INTO `log`(id,level,message)";
    public static $DEBUG = "Debug"; //rappresentazione nel db
    public static $INFO = "Info";
    public static $WARN = "Warning";
    public static $ERROR = "Error";

    // ... ecc

    public static function debug($value = '', $tag = self::DEFAULT_TAG) {
        // verifico se nel config il livello da error in su
        // chiamo self::write($DEBUG, $message);
        self::write('Debug', $value, $tag);
    }
    

    public static function info($value = '', $tag = self::DEFAULT_TAG) {
        //stessa cose di debug
        self::write('Info', $value, $tag);
    }

    public static function warning($value = '', $tag = self::DEFAULT_TAG) {
        //stessa cose di debug
        self::write('Warning', $value, $tag);
    }

    public static function error($value = '', $tag = self::DEFAULT_TAG) {
        //stessa cose di debug
        self::write('Error', $value, $tag);
    
    }

    private static function write($errorlevel = 'Info', $value = '', $tag) {
        //qui prendo la riga ed il file, genero la data e butto tutto ciò nel db
    $datetime = @date("Y-m-d H:i:s");
		if (!file_exists($this->LOGFILENAME)) {
			$headers = $this->HEADERS . "\n";
		}
		$fd = fopen($this->LOGFILENAME, "a");
		if (@$headers) {
			fwrite($fd, $headers);
		}
		$debugBacktrace = debug_backtrace();
		$line = $debugBacktrace[1]['line'];
		$file = $debugBacktrace[1]['file'];
		$value = preg_replace('/\s+/', ' ', trim($value));
		$entry = array($datetime,$errorlevel,$tag,$value,$line,$file);
		fputcsv($fd, $entry, $this->SEPARATOR);
		fclose($fd);
        
    }
}