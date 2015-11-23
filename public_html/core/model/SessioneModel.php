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
    private static $GET_ALL_TEST_SESSIONE = "SELECT * FROM `sessione_test` as s, `test` as t WHERE"
            . "s.sessione_id='%d' AND s.test_id= t.id";
    private static $GET_ALL_STUDENTI_SESSIONE = "SELECT * FROM `abilitazione` as a, `utente` as u WHERE "
            . "a.sessione_id='%s' AND a.studente_matricola=u.matricola";
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
     * Restituisce tutti i test di una sessione
     * @param int $id L'id di tutti i test di una sessione
     * @return TestSessione[] Tutti i test della sessione
     */
    public function getAllTestSessione($id) {
        $query = sprintf(self::$GET_ALL_TEST_SESSIONE, $id);
        $res = Model::getDB()->query($query);
        $sessione = array();
        while ($obj = $res->fetch_assoc()) {
            $TestSessione = new TestSessione(); //da completare
            $sessione[]= TestSessione;
        }
        return $sessione;
    }
      /**
     * Restituisce tutti gli studenti che hanno partecipato ad una sessione
     * @param int $id L'id della sessione
     * @return StudentiSessione[] Tutti gli studenti che hanno partecipato alla sessione
     */
     public function getAllStudentiSessione($id) {
        $query = sprintf(self::$GET_ALL_STUDENTI_SESSIONE, $id);
        $res = Model::getDB()->query($query);
        $sessione = array();
        while ($obj = $res->fetch_assoc()) {
            $StudentiSessione = new StudentiSessione(); //da completare
            $sessione[]= StudentiSessione;
        }
        return $sessione;
    }
}