<?php
include_once MODEL_DIR . "Model.php";
include_once BEAN_DIR . "Corso.php";
include_once BEAN_DIR . "Insegnamento.php";
include_once BEAN_DIR . "Test.php";
/**
 * Created by PhpStorm.
 * User: Elvira
 * Date: 21/11/15
 * Time: 15:42
 */
class CorsoModel extends Model {
    private static $CREATE_CORSO = "INSERT INTO 'corso' (matricola, nome, tipologia, cdl_matricola) VALUES ('%s','%s','%s','%s')";
    private static $UPDATE_CORSO = "UPDATE 'corso' SET matricola = '%s', nome = '%s', tipologia = '%s' , cdl_matricola = '%s' WHERE matricola = '%s'";
    private static $DELETE_CORSO = "DELETE FROM 'corso' WHERE matricola = '%s'";
    private static $READ_CORSO = "SELECT * FROM 'corso' WHERE matricola = '%s'";
    private static $GET_ALL_CORSI = "SELECT * FROM 'corso'";
    private static $CREATE_INSEGNAMENTO = "INSERT INTO 'insegnamento' (corso_matricola) VALUES ('%s')";
    private static $UPDATE_INSEGNAMENTO = "UPDATE 'insegnamento' SET corso_matricola = '%s'";
    private static $DELETE_INSEGNAMENTO = "DELETE FROM 'insegnamento' WHERE id = '%d'";
    private static $READ_INSEGNAMENTO = "SELECT * FROM 'insegnamento' id = '%d'";
    private static $GET_ALL_INSEGNAMENTI = "SELECT * FROM 'insegnamento'";
    private static $GET_ALL_TEST_INSEGNAMENTO = ""; //da completare
    
    /**
     * Inserisce un nuovo corso nel database
     * @param Corso $corso Il corso da inserire nel database
     */
    public function createCorso($corso){
        $query = sprintf(self::$CREATE_CORSO, $corso->getMatricola(), $corso->getNome(), $corso->getTipologia(), $corso->getCdlMatricola());
        $res = Model::getDB()->query($query);
        if ($res) {
            //messaggio ok
        }
        else{
            //messaggio errore  
        }
    }
    
    /**
     * Modifica un corso nel database
     * @param string $matricola La matricola del corso da modificare
     * @param Corso $updatedCorso Il corso modificato da aggiornare nel database
     */
    public function updateCorso($matricola,$updatedCorso){
        $query = sprintf(self::$UPDATE_CORSO, $updatedCorso->getMatricola(), $updatedCorso->getNome(), $updatedCorso->getTipologia(), $updatedCorso->getCdlMatricola(), $matricola);
        $res = Model::getDB()->query($query);
        if ($res) {
            //messaggio ok
        }
        else{
            //messaggio errore  
        }
    }
    
    /**
     * Cancella un corso nel database
     * @param string $matricola La matricola del corso da eliminare
     */
    public function deleteCorso($matricola){
        $query = sprintf(self::$DELETE_CORSO, $matricola);
        $res = Model::getDB()->query($query);
        if ($res) {
            //messaggio ok
        }
        else{
            //messaggio errore  
        }
    }
    
    /**
     * Cerca un corso nel database
     * @param string $matricola la matricola del corso da cercare
     */
    public function readCorso($matricola){
        $query = sprintf(self::$READ_CORSO, $matricola);
        $res = Model::getDB()->query($query);
        if($obj = $res->fetch_assoc()) {
            $corso = new Corso($obj['matricola'], $obj['nome'], $obj['tipologia'], $obj['cdl_matricola']);
            return $corso;
        }
        else{
            //messaggio corso non trovato 
        }
    }
    
    /**
     * Restituisce tutti il corsi del database
     * @return Corso[] Tutti i corsi del database
     */
    public function getAllCorsi() {
        $res = Model::getDB()->query(self::$GET_ALL_CORSI);
        $corsi = array();
        if($res){
            while ($obj = $res->fetch_assoc()) {
                $corsi[] = new Corso($obj['matricola'],$obj['nome'],$obj['tipologia'],$obj['cdl_matricola']);
            }
            return $corsi;
        }
        else{
            //messaggio nessun corso trovato
        }
    } 
    
    /**
     * Inserisce un nuovo insegnamento nel database
     * @param Insegnamento $insegnamento L'insegnamento da inserire nel database
     */
    public function createInsegnamento($insegnamento){
        $query = sprintf(self::$CREATE_INSEGNAMENTO, $insegnamento->getCorsoMatricola());
        $res = Model::getDB()->query($query);
        if ($res) {
            //messaggio ok
        }
        else{
            //messaggio errore  
        }
    }
    
    /**
     * Modifica un insegnamento nel database
     * @param int $id L'id dell'insegnamento da modificare
     * @param Insegnamento $updatedInsegnamento L'insegnamento modificato da aggiornare nel database
     */
    public function updateInsegnamento($id,$updatedInsegnamento){
        $query = sprintf(self::$UPDATE_INSEGNAMENTO, $updatedInsegnamento->getCorsoMatricola());
        $res = Model::getDB()->query($query);
        if ($res) {
            //messaggio ok
        }
        else{
            //messaggio errore  
        }
    }
    
    /**
     * Cancella un insegnamento nel database
     * @param int $id L'id dell'insegnamento da eliminare
     */
    public function deleteInsegnamento($id){
        $query = sprintf(self::$DELETE_INSEGNAMENTO, $id);
        $res = Model::getDB()->query($query);
        if ($res) {
            //messaggio ok
        }
        else{
            //messaggio errore  
        }
    }
    
    /**
     * Cerca un insegnamento nel database
     * @param int $id l'id dell'insegnamento da cercare
     */
    public function readInsegnamento($id){
        $query = sprintf(self::$READ_INSEGNAMENTO, $id);
        $res = Model::getDB()->query($query);
        if($obj = $res->fetch_assoc()) {
            $insegnamento = new Insegnamento($obj['id'], $obj['corso_matricola']);
            return $insegnamento;
        }
        else{
            //messaggio insegnamento non trovato 
        }
    }
    
    /**
     * Restituisce tutti gli insegnamenti del database
     * @return Insegnamento[] Tutti gli insegnamenti del database
     */
    public function getAllInsegnamenti() {
        $res = Model::getDB()->query(self::$GET_ALL_INSEGNAMENTI);
        $insegnamenti = array();
        if($res){
            while ($obj = $res->fetch_assoc()) {
                $insegnamenti[] = new Insegnamento($obj['id'],$obj['corso_matricola']);
            }
            return $insegnamenti;
        }
        else{
            //messaggio nessun insegnamento trovato
        }
    } 
}