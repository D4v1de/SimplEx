<?php
include_once MODEL_DIR . "Model.php";
include_once BEAN_DIR . "Corso.php";

/**
 * Created by PhpStorm.
 * User: Elvira
 * Date: 25/11/15
 * Time: 15:42
 */
class CorsoModel extends Model {
    private static $CREATE_CORSO = "INSERT INTO `corso` (matricola, nome, tipologia, cdl_matricola) VALUES ('%s','%s','%s','%s')";
    private static $UPDATE_CORSO = "UPDATE `corso` SET matricola = '%s', nome = '%s', tipologia = '%s' , cdl_matricola = '%s' WHERE id = '%d'";
    private static $DELETE_CORSO = "DELETE FROM `corso` WHERE id = '%d'";
    private static $READ_CORSO = "SELECT * FROM `corso` WHERE id = '%d'";
    private static $GET_ALL_CORSI = "SELECT * FROM `corso` ORDER BY nome";
    private static $GET_ALL_CORSI_CDL = "SELECT * FROM `corso` WHERE cdl_matricola = '%s' ORDER BY nome";
    private static $CREATE_INSEGNAMENTO = "INSERT INTO `insegnamento` (corso_id, docente_matricola) VALUES ('%d','%s')";
    private static $DELETE_INSEGNAMENTO = "DELETE FROM `insegnamento` WHERE corso_id = '%d' AND docente_matricola = '%s'";
    private static $GET_ALL_CORSI_DOCENTE = "SELECT c.* FROM `insegnamento` as i,`corso` as c WHERE i.corso_id = c.id AND i.docente_matricola = '%s' ORDER BY c.nome";
    private static $GET_ALL_CORSI_STUDENTE = "SELECT c.* FROM `frequenta` as f,`corso` as c WHERE f.corso_id = c.id AND f.studente_matricola = '%s' ORDER BY c.nome";
    
    /**
     * Inserisce un nuovo corso nel database
     * @param Corso $corso Il corso da inserire nel database
     * @throws ApplicationException
     */
    public function createCorso($corso){
        $query = sprintf(self::$CREATE_CORSO, $corso->getMatricola(), $corso->getNome(), $corso->getTipologia(), $corso->getCdlMatricola());
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows==-1) {
            throw new ApplicationException(Error::$INSERIMENTO_FALLITO);
        }else{
            return Model::getDB()->insert_id;
        }
    }
    
    /**
     * Modifica un corso nel database
     * @param int $id L'id del corso da modificare
     * @param Corso $updatedCorso Il corso modificato da aggiornare nel database
     * @throws ApplicationException
     */
    public function updateCorso($id,$updatedCorso){
        $query = sprintf(self::$UPDATE_CORSO, $updatedCorso->getMatricola(), $updatedCorso->getNome(), $updatedCorso->getTipologia(), $updatedCorso->getCdlMatricola(), $id);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows==-1) {
            throw new ApplicationException(Error::$AGGIORNAMENTO_FALLITO);
        }
    }
    
    /**
     * Cancella un corso nel database
     * @param int $id L'id del corso da eliminare
     * @throws ApplicationException
     */
    public function deleteCorso($id){
        $query = sprintf(self::$DELETE_CORSO, $id);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows==-1) {
            throw new ApplicationException(Error::$CANCELLAZIONE_FALLITA);
        }
    }
    
    /**
     * Cerca un corso nel database
     * @param int $id L'id del corso da cercare
     * @throws ApplicationException
     */
    public function readCorso($id){
        $query = sprintf(self::$READ_CORSO, $id);
        $res = Model::getDB()->query($query);
        if($obj = $res->fetch_assoc()) {
            $corso = new Corso( $obj['matricola'], $obj['nome'], $obj['tipologia'], $obj['cdl_matricola']);
            $corso->setId($obj['id']);
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
                $corso = new Corso($obj['matricola'],$obj['nome'],$obj['tipologia'],$obj['cdl_matricola']);
                $corso->setId($obj['id']);
                $corsi[] = $corso;
            }
        }
        return $corsi;
    } 
    
    /**
     * Restituisce tutti i corsi di un cdl del database
     * @param string $cdl_matricola La matricola del Cdl di cui si vogliono conoscere i corsi
     * @return Corsi[] Tutti i corsi di un cdl del database
     */
    public function getAllCorsiByCdl($cdl_matricola) {
        $query = sprintf(self::$GET_ALL_CORSI_CDL, $cdl_matricola);
        $res = Model::getDB()->query($query);
        $corsi = array();
        if($res){
            while ($obj = $res->fetch_assoc()) {
                $corso = new Corso($obj['matricola'],$obj['nome'],$obj['tipologia'],$obj['cdl_matricola']);
                $corso->setId($obj['id']);
                $corsi[] = $corso;            }
        }
        return $corsi;
    }
    
    /**
     * Inserisce un nuovo insegnamento nel database
     * @param int $corso_id L'id del corso
     * @param string $docente_matricola La matricola del docente
     * @throws ApplicationException
     */
    public function createInsegnamento($corso_id, $docente_matricola){
        $query = sprintf(self::$CREATE_INSEGNAMENTO, $corso_id, $docente_matricola);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows==-1) {
            throw new ApplicationException(Error::$INSERIMENTO_FALLITO);
        }
        
    }
    
    /**
     * Cancella un insegnamento nel database
     * @param int $corso_id L'id del corso
     * @param string $docente_matricola La matricola del docente
     * @throws ApplicationException
     */
    public function deleteInsegnamento($corso_id, $docente_matricola){
        $query = sprintf(self::$DELETE_INSEGNAMENTO, $corso_id, $docente_matricola);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows==-1) {
            throw new ApplicationException(Error::$CANCELLAZIONE_FALLITA);
        }
    }
    
    /**
     * Restituisce tutti corsi di un docente del database
     * @param string $docente_matricola La matricola del docente per il quale si vogliono conoscere i corsi
     * @return Corso[] Tutti i corsi di un docente del database
     */
    public function getAllCorsiByDocente($docente_matricola) {
        $query = sprintf(self::$GET_ALL_CORSI_DOCENTE, $docente_matricola);
        $res = Model::getDB()->query($query);
        $corsi = array();
        if($res){
            while ($obj = $res->fetch_assoc()) {
                $corso = new Corso($obj['matricola'], $obj['nome'], $obj['tipologia'], $obj['cdl_matricola']);
                $corso->setId($obj['id']);
                $corsi[] = $corso;
            }
        }
        return $corsi;
    }
    
    /**
     * Restituisce tutti corsi di uno studente del database
     * @param string $studente_matricola La matricola dello studente per il quale si vogliono conoscere i corsi
     * @return Corso[] Tutti i corsi di uno studente del database
     */
    public function getAllCorsiByStudente($studente_matricola) {
        $query = sprintf(self::$GET_ALL_CORSI_STUDENTE, $studente_matricola);
        $res = Model::getDB()->query($query);
        $corsi = array();
        if($res){
            while ($obj = $res->fetch_assoc()) {
                $corso = new Corso($obj['matricola'], $obj['nome'], $obj['tipologia'], $obj['cdl_matricola']);
                $corso->setId($obj['id']);
                $corsi[] = $corso;
            }
        }
        return $corsi;
    }
}
