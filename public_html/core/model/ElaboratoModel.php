<?php


/**
 * La classe descrive un elaborato.
 *
 * @author Elvira Zanin
 * @version 1.0
 * @since 27/11/15
 */

include_once MODEL_DIR . "Model.php";
include_once BEAN_DIR . "Elaborato.php";

class ElaboratoModel extends Model {
    
    public static $CREATE_ELABORATO = "INSERT INTO `elaborato` (studente_matricola, sessione_id, esito_parziale, esito_finale, test_id, stato) VALUES ('%s','%d','%f','%f','%d', '%s')";
    public static $READ_ELABORATO = "SELECT * FROM `elaborato` WHERE studente_matricola = '%s' AND sessione_id = '%d'";
    public static $UPDATE_ELABORATO ="UPDATE `elaborato` SET test_id = '%d', esito_parziale = '%f', esito_finale = '%f', stato = '%s' WHERE studente_matricola = '%s' AND sessione_id = '%d'";
    public static $GET_ALL_ELABORATO = "SELECT * FROM `elaborato`";
    public static $GET_ELABORATI_STUDENTE = "SELECT * FROM `elaborato` WHERE `studente_matricola` = '%s'";
    public static $GET_ELABORATI_TEST = "SELECT * FROM `elaborato` WHERE `test_id` = '%d'";

    /**
     * Inserisce il nuovo elaborato nel database
     * @param Elaborato $elaborato Il nuovo elaborato da inserire nel database
     */
    public function createElaborato($elaborato) {
        $query = sprintf(self::$CREATE_ELABORATO,$elaborato->getStudenteMatricola(),$elaborato->getSessioneId(), $elaborato->getEsitoParziale(), $elaborato->getEsitoFinale(), $elaborato->getTestId(), $elaborato->getStato());
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows==-1) {
            throw new ApplicationException(Error::$INSERIMENTO_FALLITO);
        }
    }
    
    /**
     * Cerca nel databse un elaborato e lo restituisce, se esiste
     * @param string $studenteMatricola La matricola dello studente di cui si vuole l'elaborato 
     * @param int $sessioneId L'id della sessione di cui si vuole l'elaborato
     * @return Elaborato $elaborato L'elaborato presente nel database
     */
    public function readElaborato($studenteMatricola,$sessioneId){
        $query = sprintf(self::$READ_ELABORATO,$studenteMatricola,$sessioneId);
        $res = Model::getDB()->query($query);
        if ($obj = $res->fetch_assoc()) {
            $elaborato = new Elaborato($obj['studente_matricola'], $obj['sessione_id'], $obj['esito_parziale'], $obj['esito_finale'], $obj['test_id'], $obj['stato']);
            return $elaborato;
        }
        else{
            throw new ApplicationException(Error::$ELABORATO_NON_TROVATO);
        }
    }
    
    /**
     * Modifica un elaborato nel database
     * @param string $studenteMatricola La matricola dello studente di cui si vuole modificare l'elaborato
     * @param int $sessioneId L'id della sessione di cui si vuole modificare l'elaborato
     * @param Elaborato $updatedElaborato L'elaborato modificato da aggiornare nel database
     */
    public function updateElaborato($studenteMatricola,$sessioneId,$updatedElaborato) {
        $query = sprintf(self::$UPDATE_ELABORATO, $updatedElaborato->getTestId(), $updatedElaborato->getEsitoParziale(), $updatedElaborato->getEsitoFinale(), $updatedElaborato->getStato(), $studenteMatricola, $sessioneId);
        Model::getDB()->query($query);
        if(Model::getDB()->affected_rows==-1) {
            throw new ApplicationException(Error::$AGGIORNAMENTO_FALLITO);
        }
    }
    
    /**
     * Restituisce tutti gli elaborati salvati nel database
     * @return Elaborato[] $elaborati Elenco degli elaborati presenti nel database
     */
    public function getAllElaborato() {
        $res = Model::getDB()->query(self::$GET_ALL_ELABORATO);
        $elaborati = array();
        if($res) {
            while($obj = $res->fetch_assoc()) {
                $elaborati[] = new Elaborato($obj['studente_matricola'], $obj['sessione_id'], $obj['esito_parziale'], $obj['esito_finale'], $obj['test_id'], $obj['stato']);
            } 
        }
        return $elaborati;
    }
    
    /**
     * Cerca e restituisce tutti gli elaborati di uno studente
     * @param Utente $studente Lo studente di cui cercare gli elaborati
     * @return Elaborato[] $elaborati Elenco degli elaborati dello studente
     */
    public function getElaboratiStudente($studente) {
        $query = sprintf(self::$GET_ELABORATI_STUDENTE, $studente->getMatricola());
        $res = Model::getDB()->query($query);
        $elaborati = array();
        if($res){
            while($obj=$res->fetch_assoc()) {
                $elaborati[] = new Elaborato($obj['studente_matricola'], $obj['sessione_id'], $obj['esito_parziale'], $obj['esito_finale'], $obj['test_id'], $obj['stato']);
            }   
        }
        return $elaborati;
    }

    /**
     * Restituisce tutti gli elaborati di un test
     * @param int $test L'id del test per il quale cercare tutti gli elaborati
     * @return Elaborato[] $elaborati Elenco degli elaborati di un test
     */
    public function getAllElaboratiTest($test) {
        $query = sprintf(self::$GET_ELABORATI_TEST, $test);
        $res = Model::getDB()->query($query);
        $elaborati = array();
        if($res) {
            while($obj = $res->fetch_assoc()) {
                $elaborati[] = new Elaborato($obj['studente_matricola'], $obj['sessione_id'], $obj['esito_parziale'], $obj['esito_finale'], $obj['test_id'], $obj['stato']);
            }
        }
        return $elaborati;
    }
}
?>