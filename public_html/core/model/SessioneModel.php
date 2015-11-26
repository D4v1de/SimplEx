<?php

/**
 * Created by PhpStorm.
 * User: Giuseppina
 * Date: 23/11/15
 * Time: 11:20
 */
include_once MODEL_DIR . "Model.php";
include_once BEAN_DIR . "Sessione.php";
include_once BEAN_DIR . "Sessione_test.php";
include_once BEAN_DIR . "Abilitazione.php";

class SessioneModel extends Model {
    private static $CREATE_SESSIONE = "INSERT INTO `sessione` (id, data_inizio, data_fine, soglia_ammissione, tipologia, insegnamento_id, insegnamento_corso_matricola) VALUES ('%d','%s','%s','%f','%s','%d','%s')";
    private static $UPDATE_SESSIONE = "UPDATE `sessione` SET data_inizio = '%s', data_fine = '%s', soglia_ammissione= '%f', tipologia= '%s', insegnamento_id='%d', insegnamento_corso_matricola='%s' WHERE id = '%d'";
    private static $DELETE_SESSIONE = "DELETE FROM `sessione` WHERE id = '%d'";
    private static $READ_SESSIONE = "SELECT * FROM `sessione` WHERE id = '%d'";
    private static $GET_ALL_SESSIONI = "SELECT * FROM `sessione`";
    private static $GET_ALL_STUDENTI_SESSIONE = "SELECT u.* FROM `abilitazione` as a, `utente` as u WHERE "
            . "a.sessione_id='%s' AND a.studente_matricola=u.matricola"; //probabilmente va spostato in utenti By Elvira
    
    /**
     * Inserisce una nuova sessione nel database
     * @param Sessione $sessione La sessione da inserire nel database
     * @throws ApplicationException
     */
    public function createSessione($sessione) {
        $query = sprintf(self::$CREATE_SESSIONE, $sessione->getId, $sessione->getDataInizio, $sessione->getDataFine, $sessione->getSogliaAmmissione, $sessione->getTipologia, $sessione->getInsegnamentoId, $sessione->getInsegnamentoCorsoMatricola);
        $res = Model::getDB()->query($query);
        if ($res->affected_rows==-1) {
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
        $query = sprintf(self::$UPDATE_SESSIONE, $updatedSessione->getDataInizio, $updatedSessione->getDataFine, $updatedSessione->getSogliaAmmissione, $updatedSessione->getTipologia, $updatedSessione->getInsegnamentoId, $updatedSessione->getInsegnamentoCorsoMatricola,  $id);
        $res = Model::getDB()->query($query);
        if ($res->affected_rows==-1) {
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
        $res = Model::getDB()->query($query);
        if ($res->affected_rows==-1) {
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
            $sessione = new Sessione($obj['id'], $obj['data_inizio'], $obj['data_fine'],  $obj['soglia_ammissione'],  $obj()['tipologia'],  $obj()['insegnamento_id'],  $obj['insegnamento_corso_matricola']);
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
                $sessioni[] = new Sessione($obj['id'], $obj['dataInizio'], $obj['data_fine'], $obj['soglia_ammissione'], $obj['tipologia'], $obj['insegnamento_id'], $obj['insegnamento_corso_matricola']);
            }
        }
        return $sessioni;
    }
      
    //probabilmente va spostato in AccountModel perchè riguarda lo studente
    /**
     * Restituisce tutti gli studenti che hanno partecipato ad una sessione
     * @param int $id L'id della sessione per la quale si vogliono conoscere gli studenti abilitati
     * @return Studente[] Tutti gli studenti che sono abilitati alla sessione
     */
     public function getAllStudentiSessione($id) {
        $query = sprintf(self::$GET_ALL_STUDENTI_SESSIONE, $id);
        $res = Model::getDB()->query($query);
        $studenti = array();
        if($res){
            while ($obj = $res->fetch_assoc()) {
                $studentiSessione = new Utente($obj['username'], $obj['password'],$obj['matricola'], $obj['nome'],$obj['cognome'],$obj['tipologia'],$obj['cdl_matricola']);
                $studenti[]= $studentiSessione;
            }
        }
        return $studenti;   
    } 
}