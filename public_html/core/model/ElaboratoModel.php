<?php

/**
 * User: Dario
 * Date: 22/11/15
 * Time: 18:55
 */

include_once MODEL_DIR . "Model.php";
include_once UTIL_DIR . "Error.php";
include_once EXCEPTION_DIR . "ApplicationException";
include_once BEAN_DIR . "Elaborato.php";
include_once BEAN_DIR . "RispostaAperta.php";
include_once BEAN_DIR . "RispostaMultipla.php";

class ElaboratoModel extends Model {
    public static $CREATE_ELABORATO = "INSERT INTO 'elaborato' (studente_matricola, session_id, test_id, esito_finale, esito_parziale) VALUES ('%s',%s','%s','%s','%s')";
    public static $READ_ELABORATO = "SELECT * FROM 'elaborato' WHERE studente_matricola = '%s' AND session_id = '%d'";
    public static $UPDATE_ELABORATO ="UPDATE 'elaborato' SET studente_matricola = '%s', session_id = '%d', test_id = '%d', esito_parziale = '%f', esito_finale='%f' WHERE studente_matricola = '%s' AND session_id = '%d'";
    public static $DELETE_ELABORATO ="DELETE FROM 'elaborato' WHERE studente_matricola = '%s' AND session_id = '%d'";
    public static $GET_ALL_ELABORATO = "SELECT * FROM 'elaborato'";
    public static $GET_ELABORATI_STUDENTE = "SELECT * FROM 'elaborato' WHERE 'studente_matricola' = %s";
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
    public static $GET_ELABORATO_MULTIPLE = "SELECT * FROM 'risposta_multipla' WHERE 'elaborato_sessione_id' = '%d' AND 'elaborato_studente_matricola' = '%s'";
    public static $GET_ELABORATO_APERTE = "SELECT * FROM 'risposta_aperta' WHERE 'elaborato_sessione_id' = '%d' AND 'elaborato_studente_matricola' = '%s'";


    /**
     * Inserisce il nuovo elaborato nel database
     * @param Elaborato $elaborato Il nuovo elaborato da inserire nel database
     */
    public function createElaborato($elaborato) {
        try{
            $query = sprintf(self::$CREATE_ELABORATO,$elaborato->getStudenteMatricola(),$elaborato->getSessionId(), $elaborato->getTestId(),$elaborato->getEsitoFinale(), $elaborato->getEsitoParziale());
            $res = Model::getDB()->query($query);
        }
        catch(ConnentionException $e){
            throw new ApplicationException(Error::$INSERIMENTO_FALLITO, $e->getCode(), $e);
        }
    }
    
    /**
     * Cerca nel databse un elaborato e lo restituisce, se esiste
     * @param string $matrStudente La matricola dello studente di cui si vuole l'elaborato 
     * @param int $sessionID L'id della sessione di cui si vuole l'elaborato
     * @return Elaborato $elaborato L'elaborato presente nel database
     */
    public function readElaborato($matrStudente,$sessionID){
        $query = sprintf(self::$READ_ELABORATO,$matrStudente,$sessionID);
        $res = Model::getDB()->query($query);
        if ($res) {
            $obj = $res->fetch_assoc();
            $elaborato = new Elaborato($obj['studente_matricola'], $obj['session_id'], $obj['test_id'], $obj['esito_parziale'], $obj['esito_finale']);
            return $elaborato;
        }
        else{
            throw new ApplicationException(Error::$ELABORATO_NON_TROVATO);
        }
    }
    
    /**
     * Modifica un elaborato nel database
     * @param string $matrStudente La matricola dello studente di cui si vuole modificare l'elaborato
     * @param int $sessionID L'id della sessione di cui si vuole modificare l'elaborato
     * @param Elaborato $updatedElaborato L'elaborato modificato da aggiornare nel database
     */
    public function updateElaborato($matrStudente,$sessionID,$updatedElaborato) {
        $query = sprintf(self::$UPDATE_ELABORATO,$updatedElaborato->getStudenteMatricola(),$updatedElaborato->getSessionId(), $updatedElaborato->getTestId(),$updatedElaborato->getEsitoFinale(), $updatedElaborato->getEsitoParziale(),$matrStudente,$sessionID);
        $res = Model::getDB()->query($query);
    }
    
    /**
     * Elimina un elaborato dal databse
     * @param string $matrStudente La matricola dello studente di cui si vuole eliminare l'elaborato
     * @param int $sessionID L'id della sessione di cui si vuole eliminare l'elaborato
     */
    public function deleteElaborato($matrStudente, $sessionID){
        $query = sprintf(self::$DELETE_ELABORATO,$matrStudente,$sessionID);
        $res = Model::getDB()->query($query);
    }
    
    /**
     * Restituisce tutti gli elaborati salvati nel database
     * @return Elaborato[] $elaborati Elenco degli elaborati presenti nel database
     */
    public function getAllElaborato() {
        $res = Model::getDB()->query(self::$GET_ALL_ELABORATO);
        if($res) {
            while($obj = $res->fetch_assoc()) {
                $elaborati[] = new Elaborato($obj['studente_matricola'], $obj['session_id'], $obj['test_id'], $obj['esito_parziale'], $obj['esito_finale']);
            }
            return $elaborati;
        }
        else {
            throw new ApplicationException(Error::$ELABORATO_NON_TROVATO);
        }
    }
    
    /**
     * Inserisce una risposta apertaa nel database
     * @param RispostaAperta $risposta La nuova risposta da inserire nel database
     */
    public function createRispostaAperta($risposta) {
        try{
            $query = sprintf(self::$CREATE_RISPOSTA_APERTA, $risposta->getId(), $risposta->getTesto(),$risposta->getPunteggio(), $risposta->getElaboratoSessioneId(), $risposta->getElaboratoStudenteMatricola(), $risposta->getDomandaApertaId(), $risposta->getDomandaApertaArgomentoId(),$risposta->getDomandaApertaArgomentoInsegnamentoId(), $risposta->getDomandaApertaArgomentoInsegnamentoCorsoMatricola());
            $res = Model::getDB()->query($query);
        } catch (ConnectionException $e) {
            throw new ApplicationException(Error::$INSERIMENTO_FALLITO, $e->getCode(), $e);
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
    public function readRispostaAperta($id,$elaboratoSessioneId, $elaboratoStudenteMatricola) {
        $query = sprintf(self::$READ_RISPOSTA_APERTA, $id, $$elaboratoSessioneId, $elaboratoStudenteMatricola);
        $res = Model::getDB()->query($query);
        if($res) {
            $obj = $res->fetch_assoc();
            $risposta = new RispostaAperta($obj['id'],$obj['elaborato_sessione_id'],$obj['elaborato_studente_matricola'],$obj['testo'],$obj['punteggio'],$obj['domanda_aperta_id'],$obj['domanda_aperta_argomento_id'],$obj['domanda_aperta_argomento_insegnamento_id'],$obj['domanda_aperta_argomento_insegnamento_corso_matricola']);
            return $risposta;
        }
        else{
            throw new ApplicationException(Error::$RISPOSTA_NON_TROVATA);
        }
    }
    
    /**
     * Aggiorna una risposta aperta presente nel database
     * */
    public function updateRispostaAperta($updatedRisposta,$id,$elaboratoSessioneId, $elaboratoStudenteMatricola){
        $query = sprintf(self::$UPDATE_RISPOSTA_APERTA,$updatedRisposta->getId(), $updatedRisposta->getTesto(),$updatedRisposta->getPunteggio(), $updatedRisposta->getElaboratoSessioneId(), $updatedRisposta->getElaboratoStudenteMatricola(), $updatedRisposta->getDomandaApertaId(), $updatedRisposta->getDomandaApertaArgomentoId(),$updatedRisposta->getDomandaApertaArgomentoInsegnamentoId(), $updatedRisposta->getDomandaApertaArgomentoInsegnamentoCorsoMatricola(),$id,$elaboratoSessioneId, $elaboratoStudenteMatricola);
        $res = Model::getDB()->query($query);
    }
    
    /**
     * Elimina una risposta aperta dal database
     * @param int $id L'id della risposta aperta da cercare
     * @param int $elaboratoSessioneId L'id della sessione a cui appartiene l'elaborato di cui fa parte la risposta aperta
     * @param string $elaboratoStudenteMatricola La matricola dello studente a cui appartiene l'elaborato di cui fa parte la risposta aperta
     */
    public function deleteRispostaAperta ($id,$elaboratoSessioneId, $elaboratoStudenteMatricola) {
        $query = sprintf(self::$DELETE_RISPOSTA_APERTA, $id,$elaboratoSessioneId, $elaboratoStudenteMatricola);
        $res = Model::getDB()->query($query);
    }
    
    /**
     * Restituisce un elenco di tutte le risposte aperte presenti nel database
     * @return RispostaAperta $risposte Elenco delle risposte aperte nel database
     */
    public function getAllRispostaAperta(){
        $res = Model::getDB()->query(self::$GET_ALL_RISPOSTA_APERTA);
        if($res) {
            while($obj=$res->fetch_assoc()) {
                $risposte[] = new RispostaAperta($obj['id'],$obj['elaborato_sessione_id'],$obj['elaborato_studente_matricola'],$obj['testo'],$obj['punteggio'],$obj['domanda_aperta_id'],$obj['domanda_aperta_argomento_id'],$obj['domanda_aperta_argomento_insegnamento_id'],$obj['domanda_aperta_argomento_insegnamento_corso_matricola']);
            }
            return $risposte;
        }
        else{
            throw new ApplicationException(Error::$RISPOSTA_NON_TROVATA);
        }
    }
    
    /**
     * Inserisce una risposta multipla nel database
     * @param RispostaMultipla $risposta La nuova risposta da inserire nel database
     */
    public function createRispostaMultipla($risposta) {
        try{
            $query = sprintf(self::$CREATE_RISPOSTA_MULTIPLA, $risposta->getId(), $risposta->getElaboratoSessioneId(), $risposta->getElaboratoStudenteMatricola(), $risposta->getPunteggio(), $risposta->getAlternativaId(),$risposta->getAlternativaDomandaMultiplaId(), $risposta->getAlternativaDomandaMultiplaArgomentoId(), $risposta->getAlternativaDomandaMultiplaArgomentoInsegnamentoId(), $risposta->getAlternativaDomandaMultiplaArgomentoInsegnamentoCorsoMatricol());
            $res = Model::getDB()->query($query);
        }
        catch (ConnectionException $e){
            throw new ApplicationException(Error::$INSERIMENTO_FALLITO, $e->getCode(), $e);
        }
    }
    
    /**
     * Cerca una risposta multipla, se è presente, nel database e la restituisce
     * @param int $id L'id della risposta multipla da cercare
     * @param int $elaboratoSessioneId L'id della sessione a cui appartiene l'elaborato di cui fa parte la risposta multipla
     * @param string $elaboratoStudenteMatricola La matricola dello studente a cui appartiene l'elaborato di cui fa parte la risposta multipla
     * @return RispostaAperta $risposta La risposta multipla presente nel database
     */
    public function readRispostaMultipla($id,$elaboratoSessioneId, $elaboratoStudenteMatricola) {
        $query = sprintf(self::$READ_RISPOSTA_APERTA, $id, $$elaboratoSessioneId, $elaboratoStudenteMatricola);
        $res = Model::getDB()->query($query);
        if($res) {
            $obj = $res->fetch_assoc();
            $risposta = new RispostaMultipla($obj['id'],$obj['elaborato_sessione_id'],$obj['elaborato_studente_matricola'],$obj['punteggio'],$obj['alternativa_id'],$obj['alternatica_domanda_multipla_id'],$obj['alternativa_domanda_multipla_argomento_id'],$obj['alternativa_domanda_multipla_argomento_insegnamento_id'],$obj['alternativa_domanda_multipla_argomento_insegnamento_corso_mat']);
            return $risposta;
        }
        else{
            throw new ApplicationException(Error::$RISPOSTA_NON_TROVATA);
        }
    }
    
    /**
     * Aggiorna una risposta multipla presente nel database
     * */
    public function updateRispostaMultipla($updatedRisposta,$id,$elaboratoSessioneId, $elaboratoStudenteMatricola){
        $query = sprintf(self::$UPDATE_RISPOSTA_MULTIPLA,$updatedRisposta->getId(),$updatedRisposta->getElaboratoSessioneId(), $updatedRisposta->getElaboratoStudenteMatricola(), $updatedRisposta->getPunteggio(), $updatedRisposta->getAlternativaId(), $updatedRisposta->getAlternativaDomandaMultiplaId(), $updatedRisposta->getAlternativaDomandaMultiplaArgomentoId(),$updatedRisposta->getAlternativaDomandaMultiplaArgomentoInsegnamentoId(), $updatedRisposta->getAlternativaDomandaMultiplaArgomentoInsegnamentoCorsoMatricola(),$id,$elaboratoSessioneId, $elaboratoStudenteMatricola);
        $res = Model::getDB()->query($query);
    }
    
    /**
     * Elimina una risposta multipla dal database
     * @param int $id L'id della risposta multipla da cercare
     * @param int $elaboratoSessioneId L'id della sessione a cui appartiene l'elaborato di cui fa parte la risposta multipla
     * @param string $elaboratoStudenteMatricola La matricola dello studente a cui appartiene l'elaborato di cui fa parte la risposta multipla
     */
    public function deleteRispostaMultipla ($id,$elaboratoSessioneId, $elaboratoStudenteMatricola) {
        $query = sprintf(self::$DELETE_RISPOSTA_MULTIPLA, $id,$elaboratoSessioneId, $elaboratoStudenteMatricola);
        $res = Model::getDB()->query($query);
    }
    
    /**
     * Restituisce un elenco di tutte le risposte multiple presenti nel database
     * @return RispostaMultipla[] $risposte Elenco delle risposte multiple nel database
     */
    public function getAllRispostaMultipla(){
        $res = Model::getDB()->query(self::$GET_ALL_RISPOSTA_MULTIPLA);
        if($res) {
            while($obj=$res->fetch_assoc()) {
                $risposte[] = new RispostaMultipla($obj['id'],$obj['elaborato_sessione_id'],$obj['elaborato_studente_matricola'],$obj['punteggio'],$obj['alternativa_id'],$obj['alternatica_domanda_multipla_id'],$obj['alternativa_domanda_multipla_argomento_id'],$obj['alternativa_domanda_multipla_argomento_insegnamento_id'],$obj['alternativa_domanda_multipla_argomento_insegnamento_corso_mat']);
            }
            return $risposte;
        }
        else{
            throw new ApplicationException(Error::$RISPOSTA_NON_TROVATA);
        }
    }
    
    /**
     * Ricerca tutte le risposte multiple di un elborato
     * @param Elaborato $elaborato L'elaborato di cui cercare le risposte multiple
     * @return RispostaMultipla[] $risposte Elenco delle risposte multiple dell'elaborato
     */
    public function getMultipleFromElaborato($elaborato) {
        $query = sprintf(self::$GET_ELABORATO_MULTIPLE,$elaborato->getSessionId(),$elaborato->getStudenteMatricola());
        $res = Model::getDB()->query($query);
        if($res){
            while($obj=$res->fetch_assoc()) {
                $risposte[] = new RispostaMultipla($obj['id'],$obj['elaborato_sessione_id'],$obj['elaborato_studente_matricola'],$obj['punteggio'],$obj['alternativa_id'],$obj['alternatica_domanda_multipla_id'],$obj['alternativa_domanda_multipla_argomento_id'],$obj['alternativa_domanda_multipla_argomento_insegnamento_id'],$obj['alternativa_domanda_multipla_argomento_insegnamento_corso_mat']);
            }
            return $risposte;
        }
        else{
            //elaborato non ha multiple non può capitare
        }
    }
    
    /**
     * Ricerca tutte le risposte aperte di un elborato
     * @param Elaborato $elaborato L'elaborato di cui cercare le risposte aperte
     * @return RispostaMultipla[] $risposte Elenco delle risposte aperte dell'elaborato
     */
    public function getAperteFromElaborato($elaborato) {
        $query = sprintf(self::$GET_ELABORATO_APERTE,$elaborato->getSessionId(),$elaborato->getStudenteMatricola());
        $res = Model::getDB()->query($query);
        if($res){
            while($obj=$res->fetch_assoc()) {
                $risposte[] = new RispostaAperta($obj['id'],$obj['elaborato_sessione_id'],$obj['elaborato_studente_matricola'],$obj['testo'],$obj['punteggio'],$obj['domanda_aperta_id'],$obj['domanda_aperta_argomento_id'],$obj['domanda_aperta_argomento_insegnamento_id'],$obj['domanda_aperta_argomento_insegnamento_corso_matricola']);
            }
            return $risposte;
        }
        else{
            throw new ApplicationException(Error::$NO_APERTE);
        }
    }
    
    /**
     * Cerca e restituisce tutti gli elaborati di uno studente
     * @param Utente $studente Lo studente di cui cercare gli elaborati
     * @return Elaborato[] $elaborati Elenco degli elaborati dello studente
     */
    public function getElaboratiStudente($studente) {
        $query = sprintf(self::$GET_ELABORATI_STUDENTE, $studente->getMatricola());
        $res = Model::getDB()->query($query);
        if($res){
            while($obj=$res->fetch_assoc()) {
                $elaborati[] = new Elaborato($obj['studente_matricola'], $obj['session_id'], $obj['test_id'], $obj['esito_parziale'], $obj['esito_finale']);
            }
            return $elaborati;
        }
        else{
            throw new ApplicationException(Error::$ELABORATO_NON_TROVATO);
        }
    }
}
?>