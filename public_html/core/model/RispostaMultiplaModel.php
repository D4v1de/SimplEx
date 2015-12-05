<?php

/**
 * User: Dario
 * Date: 27/11/15
 * Time: 16:00
 */

include_once MODEL_DIR . "Model.php";
include_once BEAN_DIR . "RispostaMultipla.php";

class RispostaMultiplaModel extends Model {
    
    public static $CREATE_RISPOSTA_MULTIPLA = "INSERT INTO `risposta_multipla` (elaborato_sessione_id, elaborato_studente_matricola, punteggio, alternativa_id) VALUES ('%d', '%s', '%f', '%d')";
    public static $READ_RISPOSTA_MULTIPLA = "SELECT * FROM `risposta_multipla` WHERE id = '%d'";
    public static $UPDATE_RISPOSTA_MULTIPLA = "UPDATE `risposta_multipla` SET punteggio = '%f', alternativa_id = '%d', elaborato_sessione_id = '%d', elaborato_studente_matricola = '%s' WHERE id = '%d'";
    public static $DELETE_RISPOSTA_MULTIPLA = "DELETE FROM `risposta_multipla` WHERE id = '%d'";
    public static $GET_ALL_RISPOSTA_MULTIPLA_ELABORATO = "SELECT * FROM `risposta_multipla` WHERE elaborato_sessione_id = '%d' AND elaborato_studente_matricola = '%s'";
    
    /**
     * Inserisce una risposta multipla nel database
     * @param RispostaMultipla $risposta La nuova risposta da inserire nel database
     */
    public function createRispostaMultipla($risposta) {
        $query = sprintf(self::$CREATE_RISPOSTA_MULTIPLA, $risposta->getElaboratoSessioneId(), $risposta->getElaboratoStudenteMatricola(), $risposta->getPunteggio(), $risposta->getAlternativaId());
        Model::getDB()->query($query);
        if(Model::getDB()->affected_rows==-1) {
            throw new ApplicationException(Error::$INSERIMENTO_FALLITO);
        }else{
            return Model::getDB()->insert_id;
        }
    }
    
    /**
     * Cerca una risposta multipla, se è presente, nel database e la restituisce
     * @param int $id L'id della risposta multipla da cercare
     * @return RispostaMultipla $risposta La risposta multipla presente nel database
     */
    public function readRispostaMultipla($id) {
        $query = sprintf(self::$READ_RISPOSTA_MULTIPLA, $id);
        $res = Model::getDB()->query($query);
        if($obj = $res->fetch_assoc()) {
            $risposta = new RispostaMultipla( $obj['elaborato_sessione_id'],$obj['elaborato_studente_matricola'], $obj['punteggio'], $obj['alternativa_id']);
            $risposta->setId($obj['id']);
            return $risposta;
        }
        else{
            throw new ApplicationException(Error::$RISPOSTA_NON_TROVATA);
        }
    }
    
    /**
     * Aggiorna una risposta multipla presente nel database
     * @param RispostaMultipla $updatedRisposta La risposta multipla modificata da aggiornare nel db
     * @param int $id L'id della risposta multipla da aggiornare nel db
     **/
    public function updateRispostaMultipla($updatedRisposta,$id){
        $query = sprintf(self::$UPDATE_RISPOSTA_MULTIPLA, $updatedRisposta->getPunteggio(), $updatedRisposta->getAlternativaId(), $updatedRisposta->getElaboratoSessioneId(), $updatedRisposta->getElaboratoStudenteMatricola(), $id);
        Model::getDB()->query($query);
        if(Model::getDB()->affected_rows==-1) {
            throw new ApplicationException(Error::$AGGIORNAMENTO_FALLITO);
        }
    }
    
    /**
     * Elimina una risposta multipla dal database
     * @param int $id L'id della risposta multipla da cercare
     */
    public function deleteRispostaMultipla ($id) {
        $query = sprintf(self::$DELETE_RISPOSTA_MULTIPLA, $id);
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
                $risposta = new RispostaMultipla($obj['elaborato_sessione_id'],$obj['elaborato_studente_matricola'], $obj['punteggio'], $obj['alternativa_id']);
                $risposta->setId($obj['id']);
                $risposte[] = $risposta;
            }
        }
        return $risposte;
    }
}
?>