<?php

/**
 * Created by PhpStorm.
 * User: Giuseppina
 * Date: 23/11/15
 * Time: 11:20
 */
include_once MODEL_DIR . "Model.php";
include_once BEAN_DIR . "Sessione.php";
//include_once BEAN_DIR . "Sessione_test.php"; non esiste questa classe
//include_once BEAN_DIR . "Abilitazione.php"; non esiste questa classe

class SessioneModel extends Model {
    private static $CREATE_SESSIONE = "INSERT INTO `sessione` (data_inizio, data_fine, soglia_ammissione, tipologia, corso_id) VALUES ('%s','%s','%f','%s','%d)";
    private static $UPDATE_SESSIONE = "UPDATE `sessione` SET data_inizio = '%s', data_fine = '%s', soglia_ammissione= '%f', tipologia= '%s', corso_id='%d' WHERE id = '%d'";
    private static $DELETE_SESSIONE = "DELETE FROM `sessione` WHERE id = '%d'";
    private static $READ_SESSIONE = "SELECT * FROM `sessione` WHERE id = '%d'";
    private static $GET_ALL_SESSIONI = "SELECT * FROM `sessione`";
    private static $GET_ALL_SESSIONI_STUDENTE = "SELECT s.* FROM `abilitazione` as a, `sessione` as s WHERE a.studente_matricola = '%s' AND a.sessione_id = s.id"; 
    
    /**
     * Inserisce una nuova sessione nel database
     * @param Sessione $sessione La sessione da inserire nel database
     * @throws ApplicationException
     */
    public function createSessione($sessione) {
        $query = sprintf(self::$CREATE_SESSIONE, $sessione->getDataInizio(), $sessione->getDataFine(), $sessione->getSogliaAmmissione(), 
                $sessione->getTipologia(), $sessione->getCorsoId());
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == 1) {
            throw new ApplicationException(Error::$INSERIMENTO_FALLITO);
        }
    }

    /**
     * Modifica una sessione nel database
     * @param int $id L'id della sessione da modificare
     * @param Sessione $updatedSessione La sessione modificata da aggiornare nel db
     * @throws ApplicationException
     */
    public function updateSessione($id, $updatedSessione) {
        $query = sprintf(self::$UPDATE_SESSIONE, $updatedSessione->getDataInizio(), $updatedSessione->getDataFine(), $updatedSessione->getSogliaAmmissione(), 
                $updatedSessione->getTipologia(), $updatedSessione->getCorsoId(),  $id);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == 1) {
            throw new ApplicationException(Error::$AGGIORNAMENTO_FALLITO);
        }
    }

    /**
     * Cancella una sessione nel database
     * @param int $id L'id della sessione da eliminare
     * @throws ApplicationException
     */
    public function deleteSessione($id) {
        $query = sprintf(self::$DELETE_SESSIONE, $id);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == 1) {
            throw new ApplicationException(Error::$CANCELLAZIONE_FALLITA);
        }
    }

    /**
     * Cerca una sessione nel database
     * @param int $id L'id della sessione da cercare
     * @throws ApplicationException
     */
    public function readSessione($id) {
        $query = sprintf(self::$READ_SESSIONE, $id);
        $res = Model::getDB()->query($query);
        if ($obj = $res->fetch_assoc()) {
            $sessione = new Sessione($obj['id'], $obj['data_inizio'], $obj['data_fine'],  $obj['soglia_ammissione'],  $obj()['tipologia'],  $obj()['corso_id']);
            return $sessione;
        }
        else{
            throw new ApplicationException(Error::$SESSIONE_NON_TROVATA);
        }
    }

    /**
     * Restituisce tutte le sessioni del database
     * @return Sessione[] Tutte le sessioni del database
     */
    public function getAllSessioni() {
        $res = Model::getDB()->query(self::$GET_ALL_SESSIONI);
        $sessioni = array();
        if($res){
            while ($obj = $res->fetch_assoc()) {
                $sessioni[] = new Sessione($obj['id'], $obj['data_inizio'], $obj['data_fine'], $obj['soglia_ammissione'], $obj['tipologia'], $obj['corso_id']);
            }
        }
        return $sessioni;
    }
      
    
    /**
     * Restituisce tutte le sessioni per le quali uno studente è abilitato
     * @param string $matricola La matricola dello studente per il quale si vogliono conoscere le sessioni a cui è abilitato
     * @return Sessione[] Tutte le sessioni a cui è abilitato lo studente
     */
     public function getAllSessioniByStudente($matricola) {
        $query = sprintf(self::$GET_ALL_SESSIONI_STUDENTE, $matricola);
        $res = Model::getDB()->query($query);
        $sessioni = array();
        if($res){
            while ($obj = $res->fetch_assoc()) {
                $sessioni[] = new Sessione($obj['id'], $obj['dataInizio'], $obj['data_fine'], $obj['soglia_ammissione'], $obj['tipologia'], $obj['corso_id']);
            }
        }
        return $sessioni;   
    } 
}