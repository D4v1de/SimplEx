<?php
include_once MODEL_DIR . "Model.php";
include_once BEAN_DIR . "Corso.php";
/**
 * Created by PhpStorm.
 * User: Elvira
 * Date: 21/11/15
 * Time: 15:42
 */
class CorsoModel extends Model {
    private static $CREATE_CORSO = "INSERT INTO 'corso' (matricola, nome, tipologia, cdl_matricola) VALUES ('%s','%s','%s','%s')";
    private static $UPDATE_CORSO = "UPDATE 'corso' SET matricola = '%s', nome = '%s', tipologia = '%s' , cdl_matricola = '%s' WHERE matricola = '%s'";
    private static $DELETE_CORSO = "DELETE FROM 'corso' where matricola = '%s'";
    private static $READ_CORSO = "SELECT * FROM 'corso' where matricola = '%s'";
    private static $GET_ALL_CORSI = "SELECT * FROM 'corso'";
    
    /**
     * Inserisce un nuovo corso nel database
     * @param corso Corso Il corso da inserire nel database
     */
    public function createCorso($corso){
        $query = sprintf(self::$CREATE_CORSO, $corso->matricola, $corso->nome, $corso->tipologia, $corso->cdlMatricola);
        $res = Model::getDB()->query($query);
    }
    
    /**
     * Modifica un corso nel database
     * @param string matricola La matricola del corso da modificare
     * @param Corso updatedCorso Il corso modificato da aggiornare nel database
     */
    public function updateCorso($matricola,$updatedCorso){
        $query = sprintf(self::$UPDATE_CORSO, $updatedCorso->matricola, $updatedCorso->nome, $updatedCorso->tipologia, $updatedCorso->cdlMatricola, $matricola);
        $res = Model::getDB()->query($query);
    }
    
    /**
     * Cancella un corso nel database
     * @param string matricola La matricola del corso da eliminare
     */
    public function deleteCorso($matricola){
        $query = sprintf(self::$DELETE_CORSO, $matricola);
        $res = Model::getDB()->query($query);
    }
    
    /**
     * Cerca un corso nel database
     * @param string matricola la matricola del corso da cercare
     */
    public function readCorso($matricola){
        $query = sprintf(self::$READ_CORSO, $matricola);
        $res = Model::getDB()->query($query);
        if($res) {
            $corso = new Corso($res->fetch_assoc()['matricola'],$res->fetch_assoc()['nome'],$res->fetch_assoc()['tipologia'],$res->fetch_assoc()['cdl_matricola']);
            return $corso;
        }
    }
    
    /**
     * Restituisce tutti il corsi del database
     * @return Corso[] corsi Tutti i corsi del database
     */
    public function getAllCorsi() {
        $res = Model::getDB()->query(self::$GET_ALL_CORSI);
        if($res) {
            for($i = 0; $i < $res->num_rows; ++$i){
                $corsi[] = new CdL($res->fetch_assoc()['matricola'],$res->fetch_assoc()['nome'],$res->fetch_assoc()['tipologia'],$res->fetch_assoc()['cdl_matricola']);
            }
            return $corsi;
        }
    } 
}