<?php

/**
 * La classe costituisce il model che effettua tutte le query riguardanti le funzionalità legate alle risposte aperte, interfacciandosi al db al quale è connesso
 *
 * @author Giuseppina Tufano
 * @version 1.0
 * @since 27/11/15
 */

include_once MODEL_DIR . "Model.php";
include_once BEAN_DIR . "RispostaMultipla.php";

class RispostaMultiplaModel extends Model {
    
    public static $CREATE_RISPOSTA_MULTIPLA = "INSERT INTO `risposta_multipla` (elaborato_sessione_id, elaborato_studente_matricola, domanda_multipla_id, punteggio, alternativa_id) VALUES ('%d', '%s', '%d', '%f', '%d')";
    public static $READ_RISPOSTA_MULTIPLA = "SELECT * FROM `risposta_multipla` WHERE elaborato_sessione_id = '%d' AND  elaborato_studente_matricola = '%s' AND domanda_multipla_id = '%d'";
    public static $UPDATE_RISPOSTA_MULTIPLA = "UPDATE `risposta_multipla` SET punteggio = '%f', alternativa_id = '%d' WHERE elaborato_sessione_id = '%d' AND elaborato_studente_matricola = '%s' AND domanda_multipla_id = '%d'";
    public static $DELETE_RISPOSTA_MULTIPLA = "DELETE FROM `risposta_multipla` WHERE elaborato_sessione_id = '%d' AND elaborato_studente_matricola = '%s' AND domanda_multipla_id = '%d'";
    public static $GET_ALL_RISPOSTA_MULTIPLA_ELABORATO = "SELECT * FROM `risposta_multipla` WHERE elaborato_sessione_id = '%d' AND elaborato_studente_matricola = '%s'";
    public static $GET_ALL_RISPOSTA_MULTIPLA_DOMANDA = "SELECT * FROM `risposta_multipla` WHERE domanda_multipla_id = '%d'";


    /**
     * Inserisce una risposta multipla nel database
     * @param RispostaMultipla $risposta La nuova risposta da inserire nel database
     */
    public function createRispostaMultipla($risposta) {
        $query = sprintf(self::$CREATE_RISPOSTA_MULTIPLA, $risposta->getElaboratoSessioneId(), $risposta->getElaboratoStudenteMatricola(), $risposta->getDomandaMultiplaId(), $risposta->getPunteggio(), $risposta->getAlternativaId());
        Model::getDB()->query($query);
        if(Model::getDB()->affected_rows==-1) {
            throw new ApplicationException(Error::$INSERIMENTO_FALLITO);
        }
    }
    
    /**
     * Cerca una risposta multipla, se è presente, nel database e la restituisce
     * @param int $elaboratoSessioneId L'id della sessione a cui appartiene l'elaborato relativo
     * @param string $elaboratoStudenteMatricola La matricola dello studente a cui appartiene l'elaborato relativo
     * @param int $domandaMultiplaId L'id della domanda multipla relativa
     * @return RispostaMultipla $risposta La risposta multipla presente nel database
     */
    public function readRispostaMultipla($elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaMultiplaId) {
        $query = sprintf(self::$READ_RISPOSTA_MULTIPLA, $elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaMultiplaId);
        $res = Model::getDB()->query($query);
        if($obj = $res->fetch_assoc()) {
            $risposta = new RispostaMultipla( $obj['elaborato_sessione_id'], $obj['elaborato_studente_matricola'], $obj['domanda_multipla_id'],$obj['punteggio'], $obj['alternativa_id']);
            return $risposta;
        }
        else{
            throw new ApplicationException(Error::$RISPOSTA_NON_TROVATA);
        }
    }
    
    /**
     * Aggiorna una risposta multipla presente nel database
     * @param RispostaMultipla $updatedRisposta La risposta multipla modificata da aggiornare nel db
     * @param int $elaboratoSessioneId L'id della sessione a cui appartiene l'elaborato relativo
     * @param string $elaboratoStudenteMatricola La matricola dello studente a cui appartiene l'elaborato relativo
     * @param int $domandaMultiplaId L'id della domanda multipla relativa
     **/
    public function updateRispostaMultipla($updatedRisposta, $elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaMultiplaId){
        $query = sprintf(self::$UPDATE_RISPOSTA_MULTIPLA, $updatedRisposta->getPunteggio(), $updatedRisposta->getAlternativaId(), $elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaMultiplaId);
        Model::getDB()->query($query);
        if(Model::getDB()->affected_rows==-1) {
            throw new ApplicationException(Error::$AGGIORNAMENTO_FALLITO);
        }
    }
    
    /**
     * Elimina una risposta multipla dal database
     * @param int $elaboratoSessioneId L'id della sessione a cui appartiene l'elaborato relativo
     * @param string $elaboratoStudenteMatricola La matricola dello studente a cui appartiene l'elaborato relativo
     * @param int $domandaMultiplaId L'id della domanda multipla relativa
     */
    public function deleteRispostaMultipla ($elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaMultiplaId) {
        $query = sprintf(self::$DELETE_RISPOSTA_MULTIPLA, $elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaMultiplaId);
        Model::getDB()->query($query);
        if(Model::getDB()->affected_rows==-1) {
            throw new ApplicationException(Error::$CANCELLAZIONE_FALLITA);
        }
    }
    
    /**
     * Ricerca tutte le risposte multiple di un elborato
     * @param Elaborato $elaborato L'elaborato di cui cercare le risposte multiple
     * @return RispostaMultipla[] $risposte Elenco delle risposte multiple dell'elaborato
     */
    public function getMultipleByElaborato($elaborato) {
        $query = sprintf(self::$GET_ALL_RISPOSTA_MULTIPLA_ELABORATO , $elaborato->getSessioneId(), $elaborato->getStudenteMatricola());
        $res = Model::getDB()->query($query);
        $risposte = array();
        if($res){
            while($obj=$res->fetch_assoc()) {
                $risposta = new RispostaMultipla($obj['elaborato_sessione_id'], $obj['elaborato_studente_matricola'], $obj['domanda_multipla_id'],$obj['punteggio'], $obj['alternativa_id']);
                $risposte[] = $risposta;
            }
        }
        return $risposte;
    }

    /**
     * Ricerca tutte le risposte multiple di una domanda
     * @param int $domanda La domanda per la quale si vogliono cercare tutte le risposte multiple
     * @return RispostaMultipla[] $risposte Elenco di tutte le risposte multiple di una domanda
     */
    public function getAllRisposteMultipleByDomanda($domanda) {
        $query = sprintf(self::$GET_ALL_RISPOSTA_MULTIPLA_DOMANDA, $domanda);
        $res = Model::getDB()->query($query);
        $risposte = array();
        if($res){
            while($obj=$res->fetch_assoc()) {
                $risposta = new RispostaMultipla($obj['elaborato_sessione_id'], $obj['elaborato_studente_matricola'], $obj['domanda_multipla_id'],$obj['punteggio'], $obj['alternativa_id']);
                $risposte[] = $risposta;
            }
        }
        return $risposte;
    }
}
?>