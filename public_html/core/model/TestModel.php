<?php

/**
 * Created by PhpStorm.
 * User: Elvira
 * Date: 23/11/15
 * Time: 11:50
 */
include_once MODEL_DIR . "Model.php";
include_once BEAN_DIR . "Test.php";

class TestModel extends Model {
    private static $CREATE_TEST = "INSERT INTO `test` (descrizione, punteggio_max, n_multiple, n_aperte, percentuale_scelto, percentuale_successo) VALUES ('%s',%f','%d','%d','%f','%f')";
    private static $UPDATE_TEST = "UPDATE `test` SET descrizione = '%s', punteggio_max = '%f', n_multiple = '%d', n_aperte = '%d', percentuale_scelto = '%f', percentuale_successo = '%f' WHERE id = '%d'";
    private static $DELETE_TEST = "DELETE FROM `test` WHERE id = '%d'";
    private static $READ_TEST = "SELECT * FROM `test` WHERE id = '%d'";
    private static $GET_ALL_TESTS = "SELECT * FROM `test`";
    private static $GET_ALL_TEST_CORSO = "SELECT * FROM `test` WHERE id IN (SELECT DISTINCT test_id FROM `compone_aperta` WHERE domanda_aperta_compone_argomento_corso_id = '%d') OR id IN (SELECT DISTINCT test_id FROM `compone_multipla` WHERE domanda_multipla_compone_argomento_corso_id = '%d') ";
    private static $GET_ALL_TEST_SESSIONE = "SELECT t.* FROM `sessione_test` as s, `test` as t WHERE s.sessione_id = '%d' AND s.test_id = t.id";
    private static $GET_TEST_ELABORATO = "SELECT t.* FROM `test` as t, `elaborato` as e where e.test_id = t.id AND e.studente_matricola = '%s' AND e.sessione_id = '%d'";
    
    /**
     * Inserisce un nuovo test nel database
     * @param Test $test Il test da inserire nel database
     * @throws ApplicationException
     */
    public function createTest($test) {
        $query = sprintf(self::$CREATE_TEST, $test->getDescrizione(), $test->getPunteggioMax(), $test->getNumeroMultiple(), $test->getNumeroAperte(), $test->getPercentualeScelto(), $test->getPercentualeSuccesso());
        $res = Model::getDB()->query($query);
        if ($res->affected_rows==-1) {
            throw new ApplicationException(Error::$INSERIMENTO_FALLITO);
        }
    }

    /**
     * Modifica un test nel database
     * @param int $id L'id del test da modificare
     * @param Test $updatedTest Il test da aggiornare nel db
     * @throws ApplicationException
     */
    public function updateTest($id, $updatedTest) {
        $query = sprintf(self::$UPDATE_TEST, $updatedTest->getDescrizione(), $updatedTest->getPunteggioMax(), $updatedTest->getNumeroMultiple(), $updatedTest->getNumeroAperte(), $updatedTest->getPercentualeScelto(), $updatedTest->getPercentualeSuccesso(), $id);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows==-1) {
            throw new ApplicationException(Error::$AGGIORNAMENTO_FALLITO);
        }
    }

    /**
     * Cancella un test nel database
     * @param int $id L'id del test da eliminare
     * @throws ApplicationException
     */
    public function deleteTest($id) {
        $query = sprintf(self::$DELETE_TEST, $id);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows==-1) {
            throw new ApplicationException(Error::$CANCELLAZIONE_FALLITA);
        }
    }

    /**
     * Cerca un test nel database
     * @param int $id L'id del test da cercare
     * @throws ApplicationException
     */
    public function readTest($id) {
        $query = sprintf(self::$READ_TEST, $id);
        $res = Model::getDB()->query($query);
        if ($obj = $res->fetch_assoc()) {
            $test = new Test($obj['id'], $obj['descrizione'], $obj['punteggio_max'], $obj['n_multiple'], $obj['n_aperte'], $obj['percentuale_scelto'], $obj['percentuale_successo']);
            return $test;
        }
        else{
            throw new ApplicationException(Error::$TEST_NON_TROVATO);
        }
    }

    /**
     * Restituisce tutti i test del database
     * @return Test[] Tutti i test del database
     */
    public function getAllTest() {
        $res = Model::getDB()->query(self::$GET_ALL_TESTS);
        $tests = array();
        if($res){
            while ($obj = $res->fetch_assoc()) {
                $tests[]= new Test($obj['id'], $obj['descrizione'], $obj['punteggio_max'], $obj['numero_multiple'], $obj['numero_aperte'], $obj['percentuale_scelto'], $obj['percentuale_successo']);
            }  
        }
        return $tests;
    }
    
    /**
     * Restituisce tutti i test di un insegnamento del database
     * @param int $id L'id del corso per il quale si vogliono conoscere i test
     * @return Test[] Tutti i test del database
     * @throws ApplicationException
     */
    public function getAllTestByCorso($id) {
        $query = sprintf(self::$GET_ALL_TEST_CORSO, $id);
        $res = Model::getDB()->query($query);
        $tests = array();
        if($res){
            while ($obj = $res->fetch_assoc()) {
                $tests[]= new Test($obj['id'], $obj['descrizione'], $obj['punteggio_max'], $obj['n_multiple'], $obj['n_aperte'], $obj['percentuale_scelto'], $obj['percentuale_successo'] );
            }
        }
        return $tests;
    }
    
    /**
     * Restituisce tutti i test di una sessione del database
     * @param int $id L'id della sessione per la quale si vogliono consocere i test associati
     * @return Test[] Tutti i test di una sessione del database del database
     */
    public function getAllTestBySessione($id) {
        $query = sprintf(self::$GET_ALL_TEST_SESSIONE, $id);
        $res = Model::getDB()->query($query);
        $tests = array();
        if($res){
            while ($obj = $res->fetch_assoc()) {
                $tests[]= new Test($obj['id'], $obj['descrizione'], $obj['punteggio_max'], $obj['numero_multiple'], $obj['numero_aperte'], $obj['percentuale_scelto'], $obj['percentuale_successo'] );
            }
        }
        return $tests;
    }
    
    /**
     * Restituisce il test associato ad un elaborato del database
     * @param string $studenteMatricola La matricola dello studente a cui appartiene l'elaborato
     * @param int $sessioneId l'id della sessione a cui appartiene l'elaborato
     * @return Test Il test associato all'elaborato
     */
    public function getTestByElaborato($studenteMatricola, $sessioneId) {
        $query = sprintf(self::$GET_TEST_ELABORATO, $studenteMatricola, $sessioneId);
        $res = Model::getDB()->query($query);
        if ($obj = $res->fetch_assoc()) {
            $test = new Test($obj['id'], $obj['descrizione'], $obj['punteggio_max'], $obj['n_multiple'], $obj['n_aperte'], $obj['percentuale_scelto'], $obj['percentuale_successo'] );
            return $test;
        }
        else{
            throw new ApplicationException(Error::$TEST_NON_TROVATO);
        }
    }
}