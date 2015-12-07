<?php

/**
 * User: Dario
 * Date: 27/11/15
 * Time: 16:00
 */

include_once MODEL_DIR . "Model.php";
include_once BEAN_DIR . "RispostaMultipla.php";

class RispostaMultiplaModel extends Model {
    
    public static $CREATE_RISPOSTA_MULTIPLA = "INSERT INTO `risposta_multipla` (elaborato_sessione_id, elaborato_studente_matricola, domanda_multipla_id, punteggio, alternativa_id) VALUES ('%d', '%s', '%d', '%f', '%d')";
    public static $READ_RISPOSTA_MULTIPLA = "SELECT * FROM `risposta_multipla` WHERE elaborato_sessione_id = '%d' AND  elaborato_studente_matricola = '%s' AND domanda_multipla_id = '%d'";
    public static $UPDATE_RISPOSTA_MULTIPLA = "UPDATE `risposta_multipla` SET punteggio = '%f', alternativa_id = '%d' WHERE elaborato_sessione_id = '%d' AND elaborato_studente_matricola = '%s' AND domanda_multipla_id = '%d'";
    public static $DELETE_RISPOSTA_MULTIPLA = "DELETE FROM `risposta_multipla` WHERE elaborato_sessione_id = '%d' AND elaborato_studente_matricola = '%s' AND domanda_multipla_id = '%d'";
    public static $GET_ALL_RISPOSTA_MULTIPLA_ELABORATO = "SELECT * FROM `risposta_multipla` WHERE elaborato_sessione_id = '%d' AND elaborato_studente_matricola = '%s'";
    
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
}
?>