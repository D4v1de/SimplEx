<?php
include_once MODEL_DIR . "Model.php";
include_once BEAN_DIR . "Corso.php";
include_once BEAN_DIR . "Insegnamento.php";

/**
 * Created by PhpStorm.
 * User: Elvira
 * Date: 25/11/15
 * Time: 15:42
 */
class CorsoModel extends Model {
    private static $CREATE_CORSO = "INSERT INTO `corso` (matricola, nome, tipologia, cdl_matricola) VALUES ('%s','%s','%s','%s')";
    private static $UPDATE_CORSO = "UPDATE `corso` SET matricola = '%s', nome = '%s', tipologia = '%s' , cdl_matricola = '%s' WHERE matricola = '%s'";
    private static $DELETE_CORSO = "DELETE FROM `corso` WHERE matricola = '%s'";
    private static $READ_CORSO = "SELECT * FROM `corso` WHERE matricola = '%s'";
    private static $GET_ALL_CORSI = "SELECT * FROM `corso`";
    private static $GET_ALL_CORSI_CDL = "SELECT * FROM `corso` WHERE cdl_matricola = '%s'";
    private static $CREATE_INSEGNAMENTO = "INSERT INTO `insegnamento` (corso_matricola) VALUES ('%s')";
    private static $UPDATE_INSEGNAMENTO = "UPDATE `insegnamento` SET corso_matricola = '%s' WHERE id = '%d'";
    private static $DELETE_INSEGNAMENTO = "DELETE FROM `insegnamento` WHERE id = '%d' AND corso_matricola = '%s'";
    private static $READ_INSEGNAMENTO = "SELECT * FROM `insegnamento` id = '%d'";
    private static $GET_ALL_INSEGNAMENTI = "SELECT * FROM `insegnamento`";
    private static $GET_ALL_INSEGNAMENTI_DOCENTE = "SELECT i.* FROM `insegnamento` as i,`insegnamento_docente` id WHERE id.docente_matricola = '%s'" 
            ." AND id.insegnamento_id = i.id AND id.insegnamento_corso_matricola = i.corso_matricola";
    
    /**
     * Inserisce un nuovo corso nel database
     * @param Corso $corso Il corso da inserire nel database
     * @throws ApplicationException
     */
    public function createCorso($corso){
        $query = sprintf(self::$CREATE_CORSO, $corso->getMatricola(), $corso->getNome(), $corso->getTipologia(), $corso->getCdlMatricola());
        $res = Model::getDB()->query($query);
        if ($res->affected_rows==-1) {
            throw new ApplicationException(Error::$INSERIMENTO_FALLITO);
        }
    }
    
    /**
     * Modifica un corso nel database
     * @param string $matricola La matricola del corso da modificare
     * @param Corso $updatedCorso Il corso modificato da aggiornare nel database
     * @throws ApplicationException
     */
    public function updateCorso($matricola,$updatedCorso){
        $query = sprintf(self::$UPDATE_CORSO, $updatedCorso->getMatricola(), $updatedCorso->getNome(), $updatedCorso->getTipologia(), $updatedCorso->getCdlMatricola(), $matricola);
        $res = Model::getDB()->query($query);
        if ($res->affected_rows==-1) {
            throw new ApplicationException(Error::$AGGIORNAMENTO_FALLITO);
        }
    }
    
    /**
     * Cancella un corso nel database
     * @param string $matricola La matricola del corso da eliminare
     * @throws ApplicationException
     */
    public function deleteCorso($matricola){
        $query = sprintf(self::$DELETE_CORSO, $matricola);
        $res = Model::getDB()->query($query);
        if ($res->affected_rows==-1) {
            throw new ApplicationException(Error::$CANCELLAZIONE_FALLITA);
        }
    }
    
    /**
     * Cerca un corso nel database
     * @param string $matricola la matricola del corso da cercare
     * @throws ApplicationException
     */
    public function readCorso($matricola){
        $query = sprintf(self::$READ_CORSO, $matricola);
        $res = Model::getDB()->query($query);
        if($obj = $res->fetch_assoc()) {
            $corso = new Corso($obj['matricola'], $obj['nome'], $obj['tipologia'], $obj['cdl_matricola']);
            return $corso;
        }
        else{
            throw new ApplicationException(Error::$CORSO_NON_TROVATO); 
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
            throw new ApplicationException(Error::$CORSO_NON_TROVATO);
        }
    } 
    
    /**
     * Restituisce tutti i corsi di un cdl del database
     * @return Corsi[] Tutti i corsi di un cdl del database
     * @throws ApplicationException
     */
    public function getAllCorsiCdl($cdl_matricola) {
        $query = sprintf(self::$GET_ALL_CORSI_CDL, $cdl_matricola);
        $res = Model::getDB()->query($query);
        $corsi = array();
        if($res){
            while ($obj = $res->fetch_assoc()) {
                $corsi[] = new Corso($obj['matricola'], $obj['nome'], $obj['tipologia'], $obj['cdl_matricola']);
            }
            return $corsi;
        }
        else{
            throw new ApplicationException(Error::$CORSO_NON_TROVATO);
        }
    }
    
    /**
     * Inserisce un nuovo insegnamento nel database
     * @param Insegnamento $insegnamento L'insegnamento da inserire nel database
     * @throws ApplicationException
     */
    public function createInsegnamento($insegnamento){
        $query = sprintf(self::$CREATE_INSEGNAMENTO, $insegnamento->getCorsoMatricola());
        $res = Model::getDB()->query($query);
        if ($res->affected_rows==-1) {
            throw new ApplicationException(Error::$INSERIMENTO_FALLITO);
        }
        
    }
    
    /**
     * Modifica un insegnamento nel database
     * @param int $id L'id dell'insegnamento da modificare
     * @param Insegnamento $updatedInsegnamento L'insegnamento modificato da aggiornare nel database
     * @throws ApplicationException
     */
    public function updateInsegnamento($id, $updatedInsegnamento){
        $query = sprintf(self::$UPDATE_INSEGNAMENTO,$updatedInsegnamento->getCorsoMatricola(), $id);
        $res = Model::getDB()->query($query);
        if ($res->affected_rows==-1) {
            throw new ApplicationException(Error::$AGGIORNAMENTO_FALLITO);
        }
    }
    
    /**
     * Cancella un insegnamento nel database
     * @param int $id L'id dell'insegnamento da eliminare
     * @param string $corso_matricola La matricola del corso a cui appartiene l'insegnamento da eliminare
     * @throws ApplicationException
     */
    public function deleteInsegnamento($id, $corso_matricola){
        $query = sprintf(self::$DELETE_INSEGNAMENTO, $id, $corso_matricola);
        $res = Model::getDB()->query($query);
        if ($res->affected_rows==-1) {
            throw new ApplicationException(Error::$CANCELLAZIONE_FALLITA);
        }
    }
    
    /**
     * Cerca un insegnamento nel database
     * @param int $id l'id dell'insegnamento da cercare
     * @throws ApplicationException
     */
    public function readInsegnamento($id){
        $query = sprintf(self::$READ_INSEGNAMENTO, $id);
        $res = Model::getDB()->query($query);
        if($obj = $res->fetch_assoc()) {
            $insegnamento = new Insegnamento($obj['id'], $obj['corso_matricola']);
            return $insegnamento;
        }
        else{
            throw new ApplicationException(Error::$INSEGNAMENTO_NON_TROVATO);
        }
    }
    
    /**
     * Restituisce tutti gli insegnamenti del database
     * @return Insegnamento[] Tutti gli insegnamenti del database
     * @throws ApplicationException
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
            throw new ApplicationException(Error::$INSEGNAMENTO_NON_TROVATO);
        }
    } 
    
    /**
     * Restituisce tutti gli insegnamenti di un docente del database
     * @param string $docente_matricola La matricola del docente per il quale si vogliono conoscere gli insegnamenti
     * @return Insegnamento[] Tutti gli insegnamenti di un docente del database
     * @throws ApplicationException
     */
    public function getAllInsegnamentiDocente($docente_matricola) {
        $query = sprintf(self::$GET_ALL_INSEGNAMENTI_DOCENTE, $docente_matricola);
        $res = Model::getDB()->query($query);
        $insegnamenti = array();
        if($res){
            while ($obj = $res->fetch_assoc()) {
                $insegnamenti[] = new Insegnamento($obj['id'],$obj['corso_matricola']);
            }
            return $insegnamenti;
        }
        else{
            throw new ApplicationException(Error::$INSEGNAMENTO_NON_TROVATO);
        }
    } 
}