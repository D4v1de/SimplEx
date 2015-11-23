<?php

/**
 * Created by PhpStorm.
 * User: Giuseppina
 * Date: 23/11/15
 * Time: 11:20
 */
include_once MODEL_DIR . "Model.php";
include_once BEAN_DIR . "Sessione.php";

class SessioneModel extends Model {
    private static $CREATE_SESSIONE = "INSERT INTO `sessione` (id, data_inizio, data_fine, soglia_ammissione, tipologia, insegnamento_id, insegnamento_corso_matricola) VALUES ('%d','%s','%s','%f','%s','%d','%s')";
    private static $UPDATE_SESSIONE = "UPDATE `sessione` SET data_inizio = '%s', data_fine = '%s', soglia_ammissione= '%f', tipologia= '%s', insegnamento_id='%d', insegnamento_corso_matricola='%s' WHERE id = '%d'";
    private static $DELETE_SESSIONE = "DELETE FROM `sessione` WHERE id = '%d'";
    private static $READ_SESSIONE = "SELECT * FROM `sessione` WHERE id = '%d'";
    private static $GET_ALL_SESSIONI = "SELECT * FROM `sessione`";
    private static $GET_ALL_TEST_SESSIONE = "SELECT * FROM `sessione_test` WHERE sessione_id='%s'";
    private static $GET_ALL_STUDENTI_SESSIONE = "SELECT * FROM `abilitazione` WHERE sessione_id='%s'";
    /**
     * Inserisce una nuova sessione nel database
     * @param Sessione sessione la sessione da inserire nel database
     */
    public function createSessione($sessione) {
        $query = sprintf(self::$CREATE_SESSIONE, $sessione->getId, $sessione->getDataInizio, $sessione->getDataFine, $sessione->getSogliaAmmissione, $sessione->getTipologia, $sessione->getInsegnamentoId, $sessione->getInsegnamentoCorsoMatricola);
        $res = Model::getDB()->query($query);
    }

    /**
     * Modifica una sessione nel database
     * @param integer id L'id della sessione da modificare
     * @param Sessione updatedSessione La sessione modificata da aggiornare nel db
     */
    public function updateSessione($id, $updatedSessione) {
        $query = sprintf(self::$UPDATE_SESSIONE, $updatedSessione->getDataInizio, $updatedSessione->getDataFine, $updatedSessione->getSogliaAmmissione, $updatedSessione->getTipologia, $updatedSessione->getInsegnamentoId, $updatedSessione->getInsegnamentoCorsoMatricola,  $id);
        $res = Model::getDB()->query($query);
    }

    /**
     * Cancella una sessione nel database
     * @param integer id L'id della sessione da eliminare
     */
    public function deleteSessione($id) {
        $query = sprintf(self::$DELETE_SESSIONE, $id);
        $res = Model::getDB()->query($query);
    }

    /**
     * Cerca un corso di laurea nel database
     * @param string matricola La matricola del corso di laurea da cercare
     */
    public function readSessione($id) {
        $query = sprintf(self::$READ_SESSIONE, $id);
        $res = Model::getDB()->query($query);
        if ($res) {
            $sessione = new Sessione($res->fetch_assoc()['id'], $res->fetch_assoc()['dataInizio'], $res->fetch_assoc()['dataFine'],  $res->fetch_assoc()['sogliaAmmissione'],  $res->fetch_assoc()['tipologia'],  $res->fetch_assoc()['insegnamentoId'],  $res->fetch_assoc()['insegnamentoCorsoMatricola']);
            return $sessione;
        }
    }

    /**
     * Restituisce tutte le sessioni del database
     * @return Sessione[] sessioni Tutte le sessioni del database
     */
    public function getAllSessioni() {
        $res = Model::getDB()->query(self::$GET_ALL_SESSIONI);
        $sessioni = array();
        while ($obj = $res->fetch_assoc()) {
            $sessioni[] = new Sessione($obj['id'], $obj['dataInizio'], $obj['dataFine'], $obj['sogliaAmmissione'], $obj['tipologia'], $obj['insegnamentoId'], $obj['insegnamentoCorsoMatricola']);
        }
        return $sessioni;
    }
    
    /**
     * Restituisce tutte le sessioni del database
     * @return Sessione[] sessioni Tutte le sessioni del database
     */
    public function getAllTestSessione() {
        $res = Model::getDB()->query(self::$GET_ALL_TEST_SESSIONE);
        $sessione = array();
        while ($obj = $res->fetch_assoc()) {
            $sessioni[] = new Sessione($obj['id'], $obj['dataInizio'], $obj['dataFine'], $obj['sogliaAmmissione'], $obj['tipologia'], $obj['insegnamentoId'], $obj['insegnamentoCorsoMatricola']);
        }
        return $sessioni;
    }
}