<?php

/**
 * La classe costituisce il model che effettua tutte le query riguardanti le funzionalità legate alle Sessione, interfacciandosi al db al quale è connesso
 *
 * @author Giuseppina Tufano
 * @version 1.0
 * @since 27/11/15
 */

include_once MODEL_DIR . "Model.php";
include_once BEAN_DIR . "Sessione.php";

class SessioneModel extends Model {
    private static $CREATE_SESSIONE = "INSERT INTO `sessione` (data_inizio, data_fine, soglia_ammissione, stato, tipologia, corso_id) VALUES ('%s','%s','%f','%s','%s','%d')";
    private static $UPDATE_SESSIONE = "UPDATE `sessione` SET data_inizio = '%s', data_fine = '%s', soglia_ammissione = '%f', stato = '%s', tipologia = '%s', corso_id = '%d' WHERE id = '%d'";
    private static $DELETE_SESSIONE = "DELETE FROM `sessione` WHERE id = '%d'";
    private static $READ_SESSIONE = "SELECT * FROM `sessione` WHERE id = '%d'";
    private static $GET_ALL_SESSIONI = "SELECT * FROM `sessione`";
    private static $GET_ALL_SESSIONI_STUDENTE = "SELECT s.* FROM `abilitazione` as a, `sessione` as s WHERE a.studente_matricola = '%s' AND a.sessione_id = s.id"; 
    private static $GET_ALL_SESSIONI_CORSO = "SELECT * FROM `sessione` WHERE corso_id = '%d'";

    private static $ASSOCIA_TEST_SESSIONE = "INSERT INTO `sessione_test` (sessione_id, test_id) VALUES ('%d','%d')";
    private static $DISSOCIA_TEST_SESSIONE = "DELETE FROM `sessione_test` where sessione_id = '%d' AND test_id = '%d'";
    private static $DELETE_ALL_TEST_FROM_SESSIONE = "DELETE FROM `sessione_test` where sessione_id = '%d'";

    private static $ABILITA_MOSTRA_ESITO = "UPDATE `sessione` SET mostra_esiti = 'Si' WHERE id = '%d'";
    private static $DISABILITA_MOSTRA_ESITO = "UPDATE `sessione` SET mostra_esiti = 'No' WHERE id = '%d'";
    private static $ABILITA_MOSTRA_RISPOSTE_CORRETTE = "UPDATE `sessione` SET mostra_risposte_corrette = 'Si' WHERE id = '%d'";
    private static $DISABILITA_MOSTRA_RISPOSTE_CORRETTE = "UPDATE `sessione` SET mostra_risposte_corrette = 'No' WHERE id = '%d'";

    /**
     * Inserisce una nuova sessione nel database
     * @param Sessione $sessione La sessione da inserire nel database
     * @throws ApplicationException
     * @return int Id della sessione
     */
    public function createSessione($sessione) {
        $query = sprintf(self::$CREATE_SESSIONE, $sessione->getDataInizio(), $sessione->getDataFine(), $sessione->getSogliaAmmissione(), 
                $sessione->getStato(), $sessione->getTipologia(), $sessione->getCorsoId());
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$INSERIMENTO_FALLITO);
        }else{
            $id = Model::getDB()->insert_id;
            return $id;
        }
    }

    /**
     * Modifica una sessione nel database
     * @param int $id L'id della sessione da modificare
     * @param Sessione $updatedSessione La sessione modificata da aggiornare nel db
     * @throws ApplicationException
     */
    public function updateSessione($id, $updatedSessione) {
        $query = sprintf(self::$UPDATE_SESSIONE, $updatedSessione->getDataInizio(), $updatedSessione->getDataFine(), $updatedSessione->getSogliaAmmissione(), 
                $updatedSessione->getStato(), $updatedSessione->getTipologia(), $updatedSessione->getCorsoId(),  $id);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$AGGIORNAMENTO_FALLITO);
        }
    }


    /**
     * Cancella una sessione nel database
     * @param int $id L'id della sessione da eliminare
     * @throws ApplicationException
     */
    public function deleteSessione($id) {
        $query = sprintf(self::$DELETE_SESSIONE, $id);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$CANCELLAZIONE_FALLITA);
        }
    }

    /**
     * Cerca una sessione nel database
     * @param int $id L'id della sessione da cercare
     * @throws ApplicationException
     * @return Sessione
     */
    public function readSessione($id) {
        $query = sprintf(self::$READ_SESSIONE, $id);
        $res = Model::getDB()->query($query);
        if ($obj = $res->fetch_assoc()) {
            $sessione = new Sessione($obj['data_inizio'], $obj['data_fine'],  $obj['soglia_ammissione'], $obj['stato'], $obj['tipologia'],$obj['corso_id']);
            $sessione->setId($obj['id']);
            return $sessione;
        }
        else{
            throw new ApplicationException(Error::$SESSIONE_NON_TROVATA);
        }
    }

    /**
     * Restituisce tutte le sessioni del database
     * @return Sessione[] Tutte le sessioni del database
     */
    public function getAllSessioni() {
        $res = Model::getDB()->query(self::$GET_ALL_SESSIONI);
        $sessioni = array();
        if($res){
            while ($obj = $res->fetch_assoc()) {
                $sessione = new Sessione( $obj['data_inizio'], $obj['data_fine'], $obj['soglia_ammissione'], $obj['stato'], $obj['tipologia'], $obj['corso_id']);
                $sessione->setId($obj['id']);
                $sessioni[]=$sessione;

            }
        }
        return $sessioni;
    }
      
    
    /**
     * Restituisce tutte le sessioni per le quali uno studente è abilitato
     * @param string $matricola La matricola dello studente per il quale si vogliono conoscere le sessioni a cui è abilitato
     * @return Sessione[] Tutte le sessioni a cui è abilitato lo studente
     */
     public function getAllSessioniByStudente($matricola) {
        $query = sprintf(self::$GET_ALL_SESSIONI_STUDENTE, $matricola);
        $res = Model::getDB()->query($query);
        $sessioni = array();
        if($res){
            while ($obj = $res->fetch_assoc()) {
                $sessione = new Sessione($obj['data_inizio'], $obj['data_fine'], $obj['soglia_ammissione'], $obj['stato'], $obj['tipologia'], $obj['corso_id']);
                $sessione->setId($obj['id']);
                $sessioni[]=$sessione;
            }
        }
        return $sessioni;   
    } 
    
    /**
     * Restituisce tutte le sessioni di un corso
     * @param int $idCorso L'id del corso per il quale si vogliono conoscere le sessioni a cui è abilitato
     * @return Sessione[] Tutte le sessioni di un corso
     */
     public function getAllSessioniByCorso($idCorso) {
        $query = sprintf(self::$GET_ALL_SESSIONI_CORSO, $idCorso);
        $res = Model::getDB()->query($query);
        $sessioni = array();
        if($res){
            while ($obj = $res->fetch_assoc()) {
                $sessione = new Sessione($obj['data_inizio'], $obj['data_fine'], $obj['soglia_ammissione'], $obj['stato'], $obj['tipologia'], $obj['corso_id']);
                $sessione->setId($obj['id']);
                $sessioni[]=$sessione;
            }
        }
        return $sessioni;   
    } 
    
    /**
     * Associa un test ad una sessione del database
     * @param int $idSessione L'id della sessione per la quale si vuole associare il test
     * @param int $idTest L'id del test da associare alla sessione
     * @throws ApplicationException
     */

    public function associaTestSessione($idSessione, $idTest) {
        $query = sprintf(self::$ASSOCIA_TEST_SESSIONE, $idSessione, $idTest);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$INSERIMENTO_FALLITO);
        }
    }

    /**
     * Rimuove un test da una sessione del database
     * @param int $idSessione L'id della sessione
     * @param int $idTest L'id del test
     * @throws ApplicationException
     */
    public function dissociaTestSessione($idSessione, $idTest) {
        $query = sprintf(self::$DISSOCIA_TEST_SESSIONE, $idSessione, $idTest);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$CANCELLAZIONE_FALLITA);
        }
    }
    
    /**
     * Rimuove tutti i test da una sessione del database
     * @param int $id L'id della sessione
     * @throws ApplicationException
     */
    public function deleteAllTestFromSessione($id) {
        $query = sprintf(self::$DELETE_ALL_TEST_FROM_SESSIONE, $id);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$CANCELLAZIONE_FALLITA);
        }
    }

    /**
     * Abilita la mostra degli esiti per una sessione nel database
     * @param int $id L'id della sessione da modificare
     * @throws ApplicationException
     */
    public function abilitaMostraEsito($id) {
        $query = sprintf(self::$ABILITA_MOSTRA_ESITO, $id);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$AGGIORNAMENTO_FALLITO);
        }
    }

    /**
     * Disabilita la mostra degli esiti per una sessione nel database
     * @param int $id L'id della sessione da modificare
     * @throws ApplicationException
     */
    public function disabilitaMostraEsito($id) {
        $query = sprintf(self::$DISABILITA_MOSTRA_ESITO, $id);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$AGGIORNAMENTO_FALLITO);
        }
    }

    /**
     * Cerca una sessione nel database e restituisce l'opzione mostra esito
     * @param int $id L'id della sessione da cercare
     * @throws ApplicationException
     * @return string
     */
    public function readMostraEsitoSessione($id) {
        $query = sprintf(self::$READ_SESSIONE, $id);
        $res = Model::getDB()->query($query);
        if ($obj = $res->fetch_assoc()) {
            return $obj['mostra_esiti'];
        }
        else{
            throw new ApplicationException(Error::$SESSIONE_NON_TROVATA);
        }
    }

    /**
     * Abilita la mostra delle risposte corrette per una sessione nel database
     * @param int $id L'id della sessione da modificare
     * @throws ApplicationException
     */
    public function abilitaMostraRisposteCorrette($id) {
        $query = sprintf(self::$ABILITA_MOSTRA_RISPOSTE_CORRETTE, $id);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$AGGIORNAMENTO_FALLITO);
        }
    }

    /**
     * Disabilita la mostra delle risposte corrette per una sessione nel database
     * @param int $id L'id della sessione da modificare
     * @throws ApplicationException
     */
    public function disabilitaMostraRisposteCorrette($id) {
        $query = sprintf(self::$DISABILITA_MOSTRA_RISPOSTE_CORRETTE, $id);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$AGGIORNAMENTO_FALLITO);
        }
    }

    /**
     * Cerca una sessione nel database e restituisce l'opzione mostra risposte corrette
     * @param int $id L'id della sessione da cercare
     * @throws ApplicationException
     * @return string
     */
    public function readMostraRisposteCorretteSessione($id) {
        $query = sprintf(self::$READ_SESSIONE, $id);
        $res = Model::getDB()->query($query);
        if ($obj = $res->fetch_assoc()) {
            return $obj['mostra_risposte_corrette'];
        }
        else{
            throw new ApplicationException(Error::$SESSIONE_NON_TROVATA);
        }
    }
}
