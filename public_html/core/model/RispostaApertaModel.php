<?php

/**
 * La classe costituisce il model che effettua tutte le query riguardanti le funzionalità legate alle risposte multiple, interfacciandosi al db al quale è connesso
 *
 * @author Giuseppina Tufano
 * @version 1.0
 * @since 27/11/15
 */

include_once MODEL_DIR . "Model.php";
include_once BEAN_DIR . "RispostaAperta.php";

class RispostaApertaModel extends Model {
    
    public static $CREATE_RISPOSTA_APERTA = "INSERT INTO `risposta_aperta` (elaborato_sessione_id, elaborato_studente_matricola, domanda_aperta_id, testo, punteggio ) VALUES ('%d', '%s', '%d', '%s', '%f')";
    public static $READ_RISPOSTA_APERTA = "SELECT * FROM `risposta_aperta` WHERE elaborato_sessione_id = '%d' AND elaborato_studente_matricola = '%s' AND domanda_aperta_id = '%d'";
    public static $UPDATE_RISPOSTA_APERTA = "UPDATE `risposta_aperta` SET testo = '%s', punteggio = '%f' WHERE elaborato_sessione_id = '%d' AND elaborato_studente_matricola = '%s' AND domanda_aperta_id = '%d'";
    public static $GET_ALL_RISPOSTA_APERTA_ELABORATO = "SELECT * FROM `risposta_aperta` WHERE elaborato_sessione_id = '%d' AND elaborato_studente_matricola = '%s'";

    /**
     * Inserisce una risposta aperta nel database
     * @param RispostaAperta $risposta La nuova risposta da inserire nel database
     * @return int L'id della risposta inserita
     * @throws ApplicationException
     */
    public function createRispostaAperta($risposta) {
        $query = sprintf(self::$CREATE_RISPOSTA_APERTA, $risposta->getElaboratoSessioneId(), $risposta->getElaboratoStudenteMatricola(), $risposta->getDomandaApertaId(), $risposta->getTesto(),$risposta->getPunteggio());
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows==-1) {
            throw new ApplicationException(Error::$INSERIMENTO_FALLITO);
        }else{
            return Model::getDB()->insert_id;
        }
    }
    
    /**
     * Ricerca una risposta aperta nel database
     * @param int $elaboratoSessioneId L'id della sessione a cui appartiene l'elaborato relativo
     * @param string $elaboratoStudenteMatricola La matricola dello studente a cui appartiene l'elaborato relativo
     * @param int $domandaApertaId L'id della domanda aperta relativa
     * @return RispostaAperta $risposta La risposta aperta restituita se presente nel database
     * @throws ApplicationException Eccezione lanciata se non viene trovata alcuna risposta
     */
    public function readRispostaAperta($elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaApertaId) {
        $query = sprintf(self::$READ_RISPOSTA_APERTA, $elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaApertaId);
        $res = Model::getDB()->query($query);
        if($obj = $res->fetch_assoc()) {
            $risposta = new RispostaAperta($obj['elaborato_sessione_id'],$obj['elaborato_studente_matricola'], $obj['domanda_aperta_id'], $obj['testo'],$obj['punteggio']);
            return $risposta;
        }
        else{
            throw new ApplicationException(Error::$RISPOSTA_NON_TROVATA);
        }
    }
    
    /**
     * Aggiorna una risposta aperta presente nel database
     * @param RispostaAperta $updatedRisposta La risposta aperta modificata da aggiornare nel db
     * @param int $elaboratoSessioneId L'id della sessione a cui appartiene l'elaborato relativo
     * @param string $elaboratoStudenteMatricola La matricola dello studente a cui appartiene l'elaborato relativo
     * @param int $domandaApertaId L'id della domanda aperta relativa
     * @throws ApplicationException
     */
    public function updateRispostaAperta($updatedRisposta, $elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaApertaId){
        $query = sprintf(self::$UPDATE_RISPOSTA_APERTA, $updatedRisposta->getTesto(),$updatedRisposta->getPunteggio(), $elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaApertaId);
        Model::getDB()->query($query);
        if(Model::getDB()->affected_rows==-1) {
            throw new ApplicationException(Error::$AGGIORNAMENTO_FALLITO);
        }
    }

    /**
     * Ricerca tutte le risposte aperte di un elborato
     * @param Elaborato $elaborato L'elaborato di cui cercare le risposte aperte
     * @return RispostaMultipla[] $risposte Elenco delle risposte aperte dell'elaborato
     * @throws ApplicationException
     */
    public function getAperteByElaborato($elaborato) {
        $query = sprintf(self::$GET_ALL_RISPOSTA_APERTA_ELABORATO, $elaborato->getSessioneId(), $elaborato->getStudenteMatricola());
        $res = Model::getDB()->query($query);
        $risposte = array();
        if($res){
            while($obj=$res->fetch_assoc()) {
                $risposta = new RispostaAperta($obj['elaborato_sessione_id'],$obj['elaborato_studente_matricola'], $obj['domanda_aperta_id'], $obj['testo'],$obj['punteggio']);
                $risposta->setId($obj['id']);
                $risposte[] = $risposta;
            }  
        }
        return $risposte;
    }
}
?>