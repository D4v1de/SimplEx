<?php

/**
 * Created by PhpStorm.
 * User: Elvira
 * Date: 23/11/15
 * Time: 11:50
 */
include_once MODEL_DIR . "Model.php";
include_once BEAN_DIR . "Test.php";
include_once BEAN_DIR . "DomandaMultipla.php";
include_once BEAN_DIR . "DomandaAperta.php";

class TestModel extends Model {
    private static $CREATE_TEST = "INSERT INTO `test` (descrizione, punteggio_max, numero_multiple, numero_aperte, percentuale_scelto, percentuale_successo) VALUES ('%d','%s','%f','%d','%d','%f','%f')";
    private static $UPDATE_TEST = "UPDATE `test` SET descrizione = '%s', punteggio_max = '%f', numero_multiple = '%d', numero_aperte = '%d', percentuale_scelto = '%f', percentuale_successo = '%f' WHERE id = '%d'";
    private static $DELETE_TEST = "DELETE FROM `test` WHERE id = '%d'";
    private static $READ_TEST = "SELECT * FROM `test` WHERE id = '%d'";
    private static $GET_ALL_TESTS = "SELECT * FROM `test`";
    private static $GET_ALL_TEST_INSEGNAMENTO = "";//da completare la query
    private static $GET_ALL_TEST_SESSIONE = "SELECT t.* FROM `sessione_test` as s, `test` as t WHERE"
            . "s.sessione_id='%d' AND s.test_id= t.id";
    private static $GET_ALL_DOMANDE_APERTE_TEST = "SELECT d.* FROM `domanda_aperta` as d,`compone_aperta` as c WHERE "
            ."c.test_id = '%s' AND c.domanda_aperta_id = d.id AND c.domanda_aperta_argomento_id = d.argomento_id AND "
            ."c.domanda_aperta_argomento_insegnamento_id = d.argomento_insegnamento_id AND "
            ."c.domanda_aperta_argomento_insegnamento_corso_matricola = d.argomento_insegnamento_corso_matricola";
    private static $GET_ALL_DOMANDE_MULTIPLE_TEST = "SELECT d.* FROM `domanda_multipla` as d,`compone_multipla` as c WHERE "
            ."c.test_id = '%s' AND c.domanda_multipla_id = d.id AND c.domanda_multipla_argomento_id = d.argomento_id AND "
            ."c.domanda_multipla_argomento_insegnamento_id = d.argomento_insegnamento_id AND "
            ."c.domanda_multipla_argomento_insegnamento_corso_matricola = d.argomento_insegnamento_corso_matricola";
    
    /**
     * Inserisce un nuovo test nel database
     * @param Test $test Il test da inserire nel database
     * @throws ApplicationException
     */
    public function createTest($test) {
        $query = sprintf(self::$CREATE_TEST, $test->getDescrizione(), $test->getPunteggioMax(), $test->getNumeroMultiple(), $test->getNumeroAperte(), $test->getPercentualeScelto(), $test->getPercentualeSuccesso());
        $res = Model::getDB()->query($query);
        if(!$res){
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
        $res = Model::getDB()->query($query);
        if(!$res){
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
        $res = Model::getDB()->query($query);
        if(!$res){
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
            $test = new Test($obj['id'], $obj['descrizione'], $obj['punteggio_max'], $obj['numero_multiple'], $obj['numero_aperte'], $obj['pecentuale_scelto'], $obj['percentuale_successo'] );
            return $test;
        }
        else{
            throw new ApplicationException(Error::$TEST_NON_TROVATO);
        }
    }

    /**
     * Restituisce tutti i test del database
     * @return Test[] Tutti i test del database
     * @throws ApplicationException
     */
    public function getAllTest() {
        $res = Model::getDB()->query(self::$GET_ALL_TESTS);
        $tests = array();
        if($res){
            while ($obj = $res->fetch_assoc()) {
                $tests[]= new Test($obj['id'], $obj['descrizione'], $obj['punteggio_max'], $obj['numero_multiple'], $obj['numero_aperte'], $obj['pecentuale_scelto'], $obj['percentuale_successo'] );
            }
            return $tests;
        }
        else{
            throw new ApplicationException(Error::$TEST_NON_TROVATO);
        }
    }
    
    /**
     * Restituisce tutti i test di un insegnamento del database
     * @param int $id L'id dell'insegnamento per il quale si vogliono conoscere i test
     * @param string $corso_matricola La matricola del corso a cui appartiene l'insegnamento per il quale si vogliono conoscere i test
     * @return Test[] Tutti i test del database
     * @throws ApplicationException
     */
    public function getAllTestInsegnamento($id, $corso_matricola) {
        $query = sprintf(self::$GET_ALL_TEST_INSEGNAMENTO, $id, $corso_matricola);
        $res = Model::getDB()->query($query);
        $tests = array();
        if($res){
            while ($obj = $res->fetch_assoc()) {
                $tests[]= new Test($obj['id'], $obj['descrizione'], $obj['punteggio_max'], $obj['numero_multiple'], $obj['numero_aperte'], $obj['pecentuale_scelto'], $obj['percentuale_successo'] );
            }
            return $tests;
        }
        else{
            throw new ApplicationException(Error::$TEST_NON_TROVATO);
        }
    }
    
    /**
     * Restituisce tutti i test di una sessione del database
     * @param int $id L'id della sessione per la quale si vogliono consocere i test associati
     * @return Test[] Tutti i test di una sessione del database del database
     * @throws ApplicationException
     */
    public function getAllTestSessione($id) {
        $query = sprintf(self::$GET_ALL_TEST_SESSIONE, $id);
        $res = Model::getDB()->query($query);
        $tests = array();
        if($res){
            while ($obj = $res->fetch_assoc()) {
                $tests[]= new Test($obj['id'], $obj['descrizione'], $obj['punteggio_max'], $obj['numero_multiple'], $obj['numero_aperte'], $obj['pecentuale_scelto'], $obj['percentuale_successo'] );
            }
            return $tests;
        }
        else{
            throw new ApplicationException(Error::$TEST_NON_TROVATO);
        }
    }
    
    /**
     * Restituisce tutte le domande aperte che costituiscono un test
     * @param int $id L'id del test per il quale si vogliono conoscere tutte le domande aperte che lo compongono
     * @return DomandaAperta[] Tutte le domande aperte che costituiscono il test
     * @throws ApplicationException
     */
    public function getAllDomandeAperteTest($id) {
        $query = sprintf(self::$GET_ALL_DOMANDE_APERTE_TEST, $id);
        $res = Model::getDB()->query($query);
        $domande = array();
        if($res){
            while ($obj = $res->fetch_assoc()) {
                $domandaAperta = new DomandaAperta($obj['id'],$obj['testo'], $obj['punteggio_max'], $obj['percentuale_scelta'],$obj['argomento_id'],$obj['argomento_insegnamento_id'],$obj['argomento_insegnamento_corso_matricola']);
                $domande[]= domandaAperta;
            }
            return $domande;
        }
        else{
            throw new ApplicationException(Error::$DOMANDA_NON_TROVATA);
        }
    }
    
    /**
     * Restituisce tutte le domande multiple che costituiscono un test
     * @param int $id L'id del test per il quale si vogliono conoscere tutte le domande multiple che lo compongono
     * @return Test[] Tutte le domande multiple che costituiscono un test
     * @throws ApplicationException
     */
    public function getAllDomandeMultipleTest($id) {
        $query = sprintf(self::$GET_ALL_DOMANDE_MULTIPLE_TEST, $id);
        $res = Model::getDB()->query($query);
        $domande = array();
        if($res){
            while ($obj = $res->fetch_assoc()) {
                $domandaMultipla = new DomandaMultipla($obj['id'], $obj['testo'], $obj['punteggio_corretta'], $obj['punteggio_errata'], $obj['percentuale_scelta'], $obj['percentuale_risposta_corretta'], $obj['alternativa_corretta'], $obj['argomento_id'], $obj['argomento_insegnamento_id'], $obj['argomento_insegnamento_corso_matricola']);
                $domande[]= domandaMultipla;
            }
            return $domande;
        }
        else{
            throw new ApplicationException(Error::$DOMANDA_NON_TROVATA);
        }
    }
}