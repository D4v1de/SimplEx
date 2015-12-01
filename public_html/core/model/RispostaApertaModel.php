<?php

/**
 * User: Dario
 * Date: 27/11/15
 * Time: 16:00
 */

include_once MODEL_DIR . "Model.php";
include_once BEAN_DIR . "RispostaAperta.php";

class RispostaApertaModel extends Model {
    
    public static $CREATE_RISPOSTA_APERTA = "INSERT INTO `risposta_aperta` (elaborato_sessione_id, elaborato_studente_matricola, testo, punteggio, domanda_aperta_id, domanda_aperta_argomento_id, domanda_aperta_argomento_corso_id) VALUES ('%d', '%s', '%s', '%f', '%d', '%d', '%d')";
    public static $READ_RISPOSTA_APERTA = "SELECT * FROM `risposta_aperta` WHERE id = '%d' AND elaborato_sessione_id = '%d' AND elaborato_studente_matricola = '%s'";
    public static $UPDATE_RISPOSTA_APERTA = "UPDATE `risposta_aperta` SET testo = '%s', punteggio = '%f', domanda_aperta_id = '%d', domanda_aperta_argomento_id = '%d', domanda_aperta_argomento_corso_id = '%d' WHERE id = '%d' AND elaborato_sessione_id = '%d' AND elaborato_studente_matricola = '%s'";
    public static $DELETE_RISPOSTA_APERTA = "DELETE FROM `risposta_aperta` WHERE id = '%d' AND elaborato_sessione_id = '%d' AND elaborato_studente_matricola = '%s'";
    public static $GET_ALL_RISPOSTA_APERTA_ELABORATO = "SELECT * FROM `risposta_aperta` WHERE elaborato_sessione_id = '%d' AND elaborato_studente_matricola = '%s'";
    
    /**
     * Inserisce una risposta aperta nel database
     * @param RispostaAperta $risposta La nuova risposta da inserire nel database
     */
    public function createRispostaAperta($risposta) {
        $query = sprintf(self::$CREATE_RISPOSTA_APERTA, $risposta->getElaboratoSessioneId(), $risposta->getElaboratoStudenteMatricola(), $risposta->getTesto(),$risposta->getPunteggio(), $risposta->getDomandaApertaId(), $risposta->getDomandaApertaArgomentoId(),$risposta->getDomandaApertaArgomentoCorsoId());
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows==-1) {
            throw new ApplicationException(Error::$INSERIMENTO_FALLITO);
        }else{
            return Model::getDB()->insert_id;
        }
    }
    
    /**
     * Ricerca una risposta aperta nel database
     * @param int $id L'id della domanda aperta da cercare
     * @param int $elaboratoSessioneId L'id della sessione a cui appartiene un elaborato del quale cercare una risposta aperta
     * @param string $elaboratoStudenteMatricola La matricola dello studente del cui elaborato si vuole cercare la risposta aperta
     * @return RispostaAperta $risposta La risposta aperta restituita se presente nel database
     * @throws ApplicationException Eccezione lanciata se non viene trovata alcuna risposta
     */
    public function readRispostaAperta($id, $elaboratoSessioneId, $elaboratoStudenteMatricola) {
        $query = sprintf(self::$READ_RISPOSTA_APERTA, $id, $$elaboratoSessioneId, $elaboratoStudenteMatricola);
        $res = Model::getDB()->query($query);
        if($obj = $res->fetch_assoc()) {
            $risposta = new RispostaAperta($obj['elaborato_sessione_id'],$obj['elaborato_studente_matricola'],$obj['testo'],$obj['punteggio'],$obj['domanda_aperta_id'],$obj['domanda_aperta_argomento_id'],$obj['domanda_aperta_argomento_corso_id']);
            $risposta->setId($obj['id']);
            return $risposta;
        }
        else{
            throw new ApplicationException(Error::$RISPOSTA_NON_TROVATA);
        }
    }
    
    /**
     * Aggiorna una risposta aperta presente nel database
     * @param RipostaAperta $updatedRisposta La risposta aperta modificata da aggiornare nel db
     * @param int $id L'id della risposta aperta da aggiornare nel db
     * @param int $elaboratoSessioneId L'id della sessione a cui appartiene l'elaborato relativo
     * @param string $elaboratoStudenteMatricola La matricola dello studente a cui appartiene l'elaborato relativo
     **/
    public function updateRispostaAperta($updatedRisposta, $id, $elaboratoSessioneId, $elaboratoStudenteMatricola){
        $query = sprintf(self::$UPDATE_RISPOSTA_APERTA, $updatedRisposta->getTesto(),$updatedRisposta->getPunteggio(), $updatedRisposta->getDomandaApertaId(),
                $updatedRisposta->getDomandaApertaArgomentoId(),$updatedRisposta->getDomandaApertaArgomentoCorsoId(), $id, $elaboratoSessioneId, $elaboratoStudenteMatricola);
        Model::getDB()->query($query);
        if(Model::getDB()->affected_rows==-1) {
            throw new ApplicationException(Error::$AGGIORNAMENTO_FALLITO);
        }
    }
    
    /**
     * Elimina una risposta aperta dal database
     * @param int $id L'id della risposta aperta da cercare
     * @param int $elaboratoSessioneId L'id della sessione a cui appartiene l'elaborato di cui fa parte la risposta aperta
     * @param string $elaboratoStudenteMatricola La matricola dello studente a cui appartiene l'elaborato di cui fa parte la risposta aperta
     */
    public function deleteRispostaAperta ($id, $elaboratoSessioneId, $elaboratoStudenteMatricola) {
        $query = sprintf(self::$DELETE_RISPOSTA_APERTA, $id, $elaboratoSessioneId, $elaboratoStudenteMatricola);
        Model::getDB()->query($query);
        if(Model::getDB()->affected_rows==-1) {
            throw new ApplicationException(Error::$CANCELLAZIONE_FALLITA);
        }
    }
    
    /**
     * Ricerca tutte le risposte aperte di un elborato
     * @param Elaborato $elaborato L'elaborato di cui cercare le risposte aperte
     * @return RispostaMultipla[] $risposte Elenco delle risposte aperte dell'elaborato
     */
    public function getAperteByElaborato($elaborato) {
        $query = sprintf(self::$GET_ELABORATO_APERTE, $elaborato->getSessioneId(), $elaborato->getStudenteMatricola());
        $res = Model::getDB()->query($query);
        $risposte = array();
        if($res){
            while($obj=$res->fetch_assoc()) {
                $risposta = new RispostaAperta($obj['elaborato_sessione_id'],$obj['elaborato_studente_matricola'],$obj['testo'],$obj['punteggio'],$obj['domanda_aperta_id'],$obj['domanda_aperta_argomento_id'],$obj['domanda_aperta_argomento_corso_id']);
                $risposta->setId($obj['id']);
                $risposte[] = $risposta;
            }  
        }
        return $risposte;
    }
}
?>