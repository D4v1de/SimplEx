<?php

/**
 * User: Dario
 * Date: 22/11/15
 * Time: 18:55
 */

include_once MODEL_DIR . "Model.php";
include_once BEAN_DIR . "Elaborato.php";
include_once BEAN_DIR . "RispostaAperta.php";
include_once BEAN_DIR . "RispostaMultipla.php";

class ElaboratoModel extends Model {
    public static $CREATE_ELABORATO = "INSERT INTO 'elaborato' (studente_matricola, session_id, test_id, esito_finale, esito_parziale) VALUES ('%s',%s','%s','%s','%s')";
    public static $READ_ELABORATO = "SELECT * FROM 'elaborato' WHERE studente_matricola = '%s' AND session_id = '%d'";
    public static $UPDATE_ELABORATO ="UPDATE 'elaborato' SET studente_matricola = '%s', session_id = '%d', test_id = '%d', esito_parziale = '%f', esito_finale='%f' WHERE studente_matricola = '%s' AND session_id = '%d'";
    public static $DELETE_ELABORATO ="DELETE FROM 'elaborato' WHERE studente_matricola = '%s' AND session_id = '%d'";
    public static $GET_ALL_ELABORATO = "SELECT * FROM 'elaborato'";
    public static $CREATE_RISPOSTA_APERTA = "INSERT INTO 'risposta_aperta' (id, testo, punteggio, elaborato_sessione_id, elaborato_studente_matricola, domanda_aperta_id, domanda_aperta_argomento_id,domanda_aperta_argomento_insegnamento_id, domanda_aperta_argomento_insegnamento_corso_matricola) VALUES ('%d', '%s', '%f', %d', %s', '%d', '%d', '%d', '%s')";
    public static $READ_RISPOSTA_APERTA = "SELECT * FROM 'risposta_aperta' WHERE id='%d' AND elaborato_sessione_id='%d' AND elaborato_studente_matricola='%s'";
    public static $UPDATE_RISPOSTA_APERTA = "UPDATE 'risposta_aperta' SET id='%d', testo='%s', punteggio='%f', elaborato_sessione_id='%d', elaborato_studente_matricola='%s', domanda_aperta_id='%d', domanda_aperta_argomento_id='%d',domanda_aperta_argomento_insegnamento_id='%d', domanda_aperta_argomento_insegnamento_corso_matricola='%s' WHERE id='%d' AND elaborato_sessione_id='%d' AND elaborato_studente_matricola='%s'";
    public static $DELETE_RISPOSTA_APERTA = "DELETE FROM 'risposta_aperta' WHERE id='%d' AND elaborato_sessione_id='%d' AND elaborato_studente_matricola='%s'";
    public static $GET_ALL_RISPOSTA_APERTA = "SELECT * FROM 'risposta_aperta'";
    public static $CREATE_RISPOSTA_MULTIPLA = "INSERT INTO 'risposta_multipla' (id, elaborato_sessione_id, elaborato_studente_matricola, punteggio, alternativa_id, alternativa_domanda_multipla_id, alternativa_domanda_multipla_argomento_id, alternativa_domanda_multipla_argomento_insegnamento_id, alternativa_domanda_multipla_argomento_insegnamento_corso_mat) VALUES ('%d', '%d', '%s', %f', %d', '%d', '%d', '%d', '%s')";
    public static $READ_RISPOSTA_MULTIPLA = "SELECT * FROM 'risposta_multipla' WHERE id='%d' AND elaborato_sessione_id='%d' AND elaborato_studente_matricola='%s'";
    public static $UPDATE_RISPOSTA_MULTIPLA = "UPDATE 'risposta_multipla' SET id='%d', elaborato_sessione_id='%d', elaborato_studente_matricola='%s', punteggio='%f', alternativa_id='%d', alternativa_domanda_multipla_id='%d', alternativa_domanda_multipla_argomento_id='%d', alternativa_domanda_multipla_argomento_insegnamento_id='%d', alternativa_domanda_multipla_argomento_insegnamento_corso_mat='%s' WHERE id='%d' AND elaborato_sessione_id='%d' AND elaborato_studente_matricola='%s'";
    public static $DELETE_RISPOSTA_MULTIPLA = "DELETE FROM 'risposta_multipla' WHERE id='%d' AND elaborato_sessione_id='%d' AND elaborato_studente_matricola='%s'";
    public static $GET_ALL_RISPOSTA_MULTIPLA = "SELECT * FROM 'risposta_multipla'";



    /**
     * Inserisce il nuovo elaborato nel database
     * @param Elaborato $elaborato Il nuovo elaborato da inserire nel database
     */
    public function createElaborato($elaborato) {
        $query = sprintf(self::CREATE_ELABORATO,$elaborato->getStudenteMatricola(),$elaborato->getSessionId(), $elaborato->getTestId(),$elaborato->getEsitoFinale(), $elaborato->getEsitoParziale());
        $res = Model::getDB()->query($query);
    }
    
    /**
     * Cerca nel databse un elaborato e lo restituisce, se esiste
     * @param string $matrStudente La matricola dello studente di cui si vuole l'elaborato 
     * @param int $sessionID L'id della sessione di cui si vuole l'elaborato
     * @return Elaborato $elaborato L'elaborato presente nel database
     */
    public function readElaborato($matrStudente,$sessionID){
        $query = sprintf(self::READ_ELABORATO,$matrStudente,$sessionID);
        $res = Model::getDB()->query($query);
        if ($res) {
            $obj = $res->fetch_assoc();
            $elaborato = new Elaborato($obj['studente_matricola'], $obj['session_id'], $obj['test_id'], $obj['esito_parziale'], $obj['esito_finale']);
            return $elaborato;
        }
        else{
            //elaborato non trovato
        }
    }
    
    /**
     * Modifica un elaborato nel database
     * @param string $matrStudente La matricola dello studente di cui si vuole modificare l'elaborato
     * @param int $sessionID L'id della sessione di cui si vuole modificare l'elaborato
     * @param Elaborato $updatedElaborato L'elaborato modificato da aggiornare nel database
     */
    public function updateElaborato($matrStudente,$sessionID,$updatedElaborato) {
        $query = sprintf(self::UPDATE_ELABORATO,$updatedElaborato->getStudenteMatricola(),$updatedElaborato->getSessionId(), $updatedElaborato->getTestId(),$updatedElaborato->getEsitoFinale(), $updatedElaborato->getEsitoParziale(),$matrStudente,$sessionID);
        $res = Model::getDB()->query($query);
    }
    
    /**
     * Elimina un elaborato dal databse
     * @param string $matrStudente La matricola dello studente di cui si vuole eliminare l'elaborato
     * @param int $sessionID L'id della sessione di cui si vuole eliminare l'elaborato
     */
    public function deleteElaborato($matrStudente, $sessionID){
        $query = sprintf(self::DELETE_ELABORATO,$matrStudente,$sessionID);
        $res = Model::getDB()->query($query);
    }
    
    /**
     * Restituisce tutti gli elaborati salvati nel database
     * @return Elaborato[] $elaborati Elenco degli elaborati presenti nel database
     */
    public function getAllElaborato() {
        $res = Model::getDB()->query(self::GET_ALL_ELABORATO);
        if($res) {
            while($obj = $res->fetch_assoc()) {
                $elaborati[] = new Elaborato($obj['studente_matricola'], $obj['session_id'], $obj['test_id'], $obj['esito_parziale'], $obj['esito_finale']);
            }
            return $elaborati;
        }
        else {
            //nessun elaborato trovato
        }
    }
    
    /**
     * Inserisce una risposta apertaa nel database
     * @param RispostaAperta $risposta La nuova risposta da inserire nel database
     */
    public function createRispostaAperta($risposta) {
        $query = sprintf(self::CREATE_RISPOSTA_APERTA, $risposta->getId(), $risposta->getTesto(),$risposta->getPunteggio(), $risposta->getSessioneId(), $risposta->getElaboratoStudenteMatricola(), $risposta->getDomandaApertaId(), $risposta->getDomandaApertaArgomentoId(),$risposta->getDomandaApertaArgomentoInsegnamentoId(), $risposta->getDomandaApertaArgomentoInsegnamentoCorsoMatricola());
        $res = Model::getDB()->query($query);
    }
    
    /**
     * Cerca una risposta aperta, se è presente, nel database e la restituisce
     * @param int $id L'id della risposta aperta da cercare
     * @param int $elaboratoSessioneId L'id della sessione a cui appartiene l'elaborato di cui fa parte la risposta aperta
     * @param string $elaborato_studente_matricola La matricola dello studente a cui appartiene l'elaborato di cui fa parte la risposta aperta
     * @return RispostaAperta $risposta La risposta aperta presente nel database
     */
    public function readRispostaAperta($id,$elaboratoSessioneId, $elaborato_studente_matricola) {
        $query = sprintf(self::READ_RISPOSTA_APERTA, $id, $$elaboratoSessioneId, $elaborato_studente_matricola);
        $res = Model::getDB()->query($query);
        if($res) {
            $obj = $res->fetch_assoc();
            $risposta = new RispostaAperta($obj['id'],$obj['elaborato_sessione_id'],$obj['elaborato_studente_matricola'],$obj['testo'],$obj['punteggio'],$obj['domanda_aperta_id'],$obj['domanda_aperta_argomento_id'],$obj['domanda_aperta_argomento_insegnamento_id'],$obj['domanda_aperta_argomento_insegnamento_corso_matricola']);
            return $risposta;
        }
        else{
            //risposta non trovata
        }
    }
    
    /**
     * Aggiorna una risposta aperta presente nel database
     * */
    public function updateRispostaAperta($updatedRisposta,$id,$elaboratoSessioneId, $elaborato_studente_matricola){
        $query = sprintf(self::UPDATE_RISPOSTA_APERTA,$updatedRisposta->getId(), $updatedRisposta->getTesto(),$updatedRisposta->getPunteggio(), $updatedRisposta->getSessioneId(), $updatedRisposta->getElaboratoStudenteMatricola(), $updatedRisposta->getDomandaApertaId(), $updatedRisposta->getDomandaApertaArgomentoId(),$updatedRisposta->getDomandaApertaArgomentoInsegnamentoId(), $updatedRisposta->getDomandaApertaArgomentoInsegnamentoCorsoMatricola(),$id,$elaboratoSessioneId, $elaborato_studente_matricola);
        $res = Model::getDB()->query($query);
    }
    
    /**
     * Elimina una risposta aperta dal database
     * @param int $id L'id della risposta aperta da cercare
     * @param type $elaboratoSessioneId L'id della sessione a cui appartiene l'elaborato di cui fa parte la risposta aperta
     * @param type $elaborato_studente_matricola La matricola dello studente a cui appartiene l'elaborato di cui fa parte la risposta aperta
     */
    public function deleteRispostaAperta ($id,$elaboratoSessioneId, $elaborato_studente_matricola) {
        $query = sprintf(self::DELETE_RISPOSTA_APERTA, $id,$elaboratoSessioneId, $elaborato_studente_matricola);
        $res = Model::getDB()->query($query);
    }
    
    public function getAllRispostaAperta(){
        $res = Model::getDB()->query(self::GET_ALL_RISPOSTA_APERTA);
        if($res) {
            while($obj=$res->fetch_assoc()) {
                $risposte[] = new RispostaAperta($obj['id'],$obj['elaborato_sessione_id'],$obj['elaborato_studente_matricola'],$obj['testo'],$obj['punteggio'],$obj['domanda_aperta_id'],$obj['domanda_aperta_argomento_id'],$obj['domanda_aperta_argomento_insegnamento_id'],$obj['domanda_aperta_argomento_insegnamento_corso_matricola']);
            }
            return $risposte;
        }
        else{
            //nessuna risposta aperta trovata
        }
    }
}
?>