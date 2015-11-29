<?php

/**
 * User: Dario
 * Date: 27/11/15
 * Time: 16:00
 */

include_once MODEL_DIR . "Model.php";
include_once BEAN_DIR . "Elaborato.php";
include_once BEAN_DIR . "RispostaAperta.php";
include_once BEAN_DIR . "RispostaMultipla.php";

class ElaboratoModel extends Model {
    public static $CREATE_ELABORATO = "INSERT INTO `elaborato` (studente_matricola, sessione_id, esito_finale, esito_parziale, test_id) VALUES ('%s',%d','%f','%f','%d')";
    public static $READ_ELABORATO = "SELECT * FROM `elaborato` WHERE studente_matricola = '%s' AND sessione_id = '%d'";
    public static $UPDATE_ELABORATO ="UPDATE `elaborato` SET test_id = '%d', esito_parziale = '%f', esito_finale = '%f' WHERE studente_matricola = '%s' AND sessione_id = '%d'";
    public static $DELETE_ELABORATO ="DELETE FROM `elaborato` WHERE studente_matricola = '%s' AND sessione_id = '%d'";
    public static $GET_ALL_ELABORATO = "SELECT * FROM `elaborato`";
    public static $GET_ELABORATI_STUDENTE = "SELECT * FROM `elaborato` WHERE `studente_matricola` = '%s'";
    
    public static $CREATE_RISPOSTA_APERTA = "INSERT INTO `risposta_aperta` (elaborato_sessione_id, elaborato_studente_matricola, testo, punteggio, domanda_aperta_id, "
            . "domanda_aperta_argomento_id, domanda_aperta_argomento_corso_id) VALUES ('%d', '%s', '%s', '%f', '%d', '%d', '%d')";
    public static $READ_RISPOSTA_APERTA = "SELECT * FROM `risposta_aperta` WHERE id = '%d' AND elaborato_sessione_id = '%d' AND elaborato_studente_matricola = '%s'";
    public static $UPDATE_RISPOSTA_APERTA = "UPDATE `risposta_aperta` SET testo = '%s', punteggio = '%f', domanda_aperta_id = '%d', domanda_aperta_argomento_id = '%d',"
            . "domanda_aperta_argomento_corso_id = '%d' WHERE id = '%d' AND elaborato_sessione_id = '%d' AND elaborato_studente_matricola = '%s'";
    public static $DELETE_RISPOSTA_APERTA = "DELETE FROM `risposta_aperta` WHERE id = '%d' AND elaborato_sessione_id = '%d' AND elaborato_studente_matricola = '%s'";
    public static $GET_ALL_RISPOSTA_APERTA_ELABORATO = "SELECT * FROM `risposta_aperta` WHERE 'elaborato_sessione_id' = '%d' AND 'elaborato_studente_matricola' = '%s'";
    
    public static $CREATE_RISPOSTA_MULTIPLA = "INSERT INTO `risposta_multipla` (elaborato_sessione_id, elaborato_studente_matricola, punteggio, alternativa_id, "
            . "alternativa_domanda_multipla_id, alternativa_domanda_multipla_argomento_id, alternativa_domanda_multipla_argomento_corso_id) "
            . "VALUES (%d', '%s', '%f', '%d', '%d', '%d', '%d')";
    public static $READ_RISPOSTA_MULTIPLA = "SELECT * FROM `risposta_multipla` WHERE id = '%d' AND elaborato_sessione_id='%d' AND elaborato_studente_matricola = '%s'";
    public static $UPDATE_RISPOSTA_MULTIPLA = "UPDATE `risposta_multipla` SET punteggio = '%f', alternativa_id = '%d', alternativa_domanda_multipla_id = '%d', "
            . "alternativa_domanda_multipla_argomento_id = '%d', alternativa_domanda_multipla_argomento_corso_id = '%d "
            . "WHERE id = '%d' AND elaborato_sessione_id = '%d' AND elaborato_studente_matricola = '%s'";
    public static $DELETE_RISPOSTA_MULTIPLA = "DELETE FROM `risposta_multipla` WHERE id = '%d' AND elaborato_sessione_id = '%d' AND elaborato_studente_matricola = '%s'";
    public static $GET_ALL_RISPOSTA_MULTIPLA_ELABORATO = "SELECT * FROM `risposta_multipla` WHERE elaborato_sessione_id = '%d' AND elaborato_studente_matricola = '%s'";

    /**
     * Inserisce il nuovo elaborato nel database
     * @param Elaborato $elaborato Il nuovo elaborato da inserire nel database
     */
    public function createElaborato($elaborato) {
        $query = sprintf(self::$CREATE_ELABORATO,$elaborato->getStudenteMatricola(),$elaborato->getSessioneId(), $elaborato->getEsitoParziale(), $elaborato->getEsitoFinale(), $elaborato->getTestId());
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
            $elaborato = new Elaborato($obj['studente_matricola'], $obj['sessione_id'], $obj['esito_parziale'], $obj['esito_finale'], $obj['test_id']);
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
        $query = sprintf(self::$UPDATE_ELABORATO,$updatedElaborato->getStudenteMatricola(),$updatedElaborato->getSessioneId(), $updatedElaborato->getEsitoParziale(), $updatedElaborato->getEsitoFinale(), $updatedElaborato->getTestId(),$studenteMatricola,$sessioneId);
        Model::getDB()->query($query);
        if(Model::getDB()->affected_rows==-1) {
            throw new ApplicationException(Error::$AGGIORNAMENTO_FALLITO);
        }
    }
    
    /**
     * Elimina un elaborato dal databse
     * @param string $studenteMatricola La matricola dello studente di cui si vuole eliminare l'elaborato
     * @param int $sessioneId L'id della sessione di cui si vuole eliminare l'elaborato
     */
    public function deleteElaborato($studenteMatricola, $sessioneId){
        $query = sprintf(self::$DELETE_ELABORATO,$studenteMatricola,$sessioneId);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows==-1) {
            throw new ApplicationException(Error::$CANCELLAZIONE_FALLITA);
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
                $elaborati[] = new Elaborato($obj['studente_matricola'], $obj['sessione_id'], $obj['esito_parziale'], $obj['esito_finale'], $obj['test_id']);
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
                $elaborati[] = new Elaborato($obj['studente_matricola'], $obj['sessione_id'], $obj['esito_parziale'], $obj['esito_finale'], $obj['test_id']);
            }   
        }
        return $elaborati;
    }
    
    /**
     * Inserisce una risposta aperta nel database
     * @param RispostaAperta $risposta La nuova risposta da inserire nel database
     */
    public function createRispostaAperta($risposta) {
        $query = sprintf(self::$CREATE_RISPOSTA_APERTA, $risposta->getElaboratoSessioneId(), $risposta->getElaboratoStudenteMatricola(), $risposta->getTesto(),$risposta->getPunteggio(), $risposta->getDomandaApertaId(), $risposta->getDomandaApertaArgomentoId(),$risposta->getDomandaApertaArgomentoCorsoId());
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows==-1) {
            throw new ApplicationException(Error::$INSERIMENTO_FALLITO);
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
            $risposta = new RispostaAperta($obj['id'],$obj['elaborato_sessione_id'],$obj['elaborato_studente_matricola'],$obj['testo'],
                    $obj['punteggio'],$obj['domanda_aperta_id'],$obj['domanda_aperta_argomento_id'],$obj['domanda_aperta_argomento_corso_id']);
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
                $risposte[] = new RispostaAperta($obj['id'],$obj['elaborato_sessione_id'],$obj['elaborato_studente_matricola'],$obj['testo'],
                    $obj['punteggio'],$obj['domanda_aperta_id'],$obj['domanda_aperta_argomento_id'],$obj['domanda_aperta_argomento_corso_id']);
            }  
        }
        return $risposte;
    }
    
    /**
     * Inserisce una risposta multipla nel database
     * @param RispostaMultipla $risposta La nuova risposta da inserire nel database
     */
    public function createRispostaMultipla($risposta) {
        $query = sprintf(self::$CREATE_RISPOSTA_MULTIPLA, $risposta->getElaboratoSessioneId(), $risposta->getElaboratoStudenteMatricola(), $risposta->getPunteggio(), 
                $risposta->getAlternativaId(),$risposta->getAlternativaDomandaMultiplaId(), $risposta->getAlternativaDomandaMultiplaArgomentoId(), $risposta->getAlternativaDomandaMultiplaArgomentoCorsoId());
        Model::getDB()->query($query);
        if(Model::getDB()->affected_rows==-1) {
            throw new ApplicationException(Error::$INSERIMENTO_FALLITO);
        }
    }
    
    /**
     * Cerca una risposta multipla, se è presente, nel database e la restituisce
     * @param int $id L'id della risposta multipla da cercare
     * @param int $elaboratoSessioneId L'id della sessione a cui appartiene l'elaborato di cui fa parte la risposta multipla
     * @param string $elaboratoStudenteMatricola La matricola dello studente a cui appartiene l'elaborato di cui fa parte la risposta multipla
     * @return RispostaAperta $risposta La risposta multipla presente nel database
     */
    public function readRispostaMultipla($id, $elaboratoSessioneId, $elaboratoStudenteMatricola) {
        $query = sprintf(self::$READ_RISPOSTA_APERTA, $id, $elaboratoSessioneId, $elaboratoStudenteMatricola);
        $res = Model::getDB()->query($query);
        if($obj = $res->fetch_assoc()) {
            $risposta = new RispostaMultipla($obj['id'], $obj['elaborato_sessione_id'],$obj['elaborato_studente_matricola'], $obj['punteggio'], $obj['alternativa_id'],
                    $obj['alternativa_domanda_multipla_id'],$obj['alternativa_domanda_multipla_argomento_id'],$obj['alternativa_domanda_multipla_argomento_corso_id']);
            return $risposta;
        }
        else{
            throw new ApplicationException(Error::$RISPOSTA_NON_TROVATA);
        }
    }
    
    /**
     * Aggiorna una risposta multipla presente nel database
     * @param RipostaAperta $updatedRisposta La risposta multipla modificata da aggiornare nel db
     * @param int $id L'id della risposta multipla da aggiornare nel db
     * @param int $elaboratoSessioneId L'id della sessione a cui appartiene l'elaborato relativo
     * @param string $elaboratoStudenteMatricola La matricola dello studente a cui appartiene l'elaborato relativo
     **/
    public function updateRispostaMultipla($updatedRisposta,$id,$elaboratoSessioneId, $elaboratoStudenteMatricola){
        $query = sprintf(self::$UPDATE_RISPOSTA_MULTIPLA, $updatedRisposta->getPunteggio(), $updatedRisposta->getAlternativaId(), $updatedRisposta->getAlternativaDomandaMultiplaId(), 
                $updatedRisposta->getAlternativaDomandaMultiplaArgomentoId(), $updatedRisposta->getAlternativaDomandaMultiplaArgomentoCorsoId(), $id, $elaboratoSessioneId, 
                $elaboratoStudenteMatricola);
        Model::getDB()->query($query);
        if(Model::getDB()->affected_rows==-1) {
            throw new ApplicationException(Error::$AGGIORNAMENTO_FALLITO);
        }
    }
    
    /**
     * Elimina una risposta multipla dal database
     * @param int $id L'id della risposta multipla da cercare
     * @param int $elaboratoSessioneId L'id della sessione a cui appartiene l'elaborato di cui fa parte la risposta multipla
     * @param string $elaboratoStudenteMatricola La matricola dello studente a cui appartiene l'elaborato di cui fa parte la risposta multipla
     */
    public function deleteRispostaMultipla ($id,$elaboratoSessioneId, $elaboratoStudenteMatricola) {
        $query = sprintf(self::$DELETE_RISPOSTA_MULTIPLA, $id, $elaboratoSessioneId, $elaboratoStudenteMatricola);
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
        $query = sprintf(self::$GET_ELABORATO_MULTIPLE, $elaborato->getSessioneId(), $elaborato->getStudenteMatricola());
        $res = Model::getDB()->query($query);
        $risposte = array();
        if($res){
            while($obj=$res->fetch_assoc()) {
                $risposte[] = new RispostaMultipla($obj['id'], $obj['elaborato_sessione_id'],$obj['elaborato_studente_matricola'], $obj['punteggio'], $obj['alternativa_id'],
                    $obj['alternativa_domanda_multipla_id'],$obj['alternativa_domanda_multipla_argomento_id'],$obj['alternativa_domanda_multipla_argomento_corso_id']);
            }     
        }
        return $risposte;
    }
}
?>