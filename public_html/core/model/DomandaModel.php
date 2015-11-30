<?php
/**
 * Created by PhpStorm.
 * User: Alina
 * Date: 29/11/2015
 * Time: 11:19
 */


include_once MODEL_DIR . "Model.php";
include_once BEAN_DIR . "DomandaAperta.php";
include_once BEAN_DIR . "DomandaMultipla.php";

class DomandaModel extends Model {
    
    private static $CREATE_DOMANDA_APERTA = "INSERT INTO `domanda_aperta` (id, argomento_id, argomento_corso_id, testo, punteggio_max, percentuale_scelta) VALUES (NULL,'%d','%d','%s','%f','%f')";
    private static $UPDATE_DOMANDA_APERTA = "UPDATE `domanda_aperta` SET testo = '%s', punteggio_max = '%f', percentuale_scelta = '%f' WHERE id = '%d' AND argomento_id = '%d' AND argomento_corso_id = '%d'";
    private static $DELETE_DOMANDA_APERTA = "DELETE FROM `domanda_aperta` WHERE id = '%d' AND argomento_id = '%d' AND argomento_corso_id = '%d'";
    private static $READ_DOMANDA_APERTA = "SELECT * FROM `domanda_aperta` WHERE id = '%d' AND argomento_id = '%d' AND argomento_corso_id = '%d'";
    private static $GET_ALL_DOMANDA_APERTA = "SELECT * FROM `domanda_aperta`";
    private static $GET_ALL_DOMANDA_APERTA_BY_ARGOMENTO = "SELECT * FROM `domanda_aperta` WHERE argomento_id = '%d' AND argomento_corso_id = '%d'";
    private static $GET_ALL_DOMANDE_APERTE_TEST = "SELECT d.* FROM `domanda_aperta` as d,`compone_aperta` as c WHERE c.test_id = '%s' AND c.domanda_aperta_id = d.id AND c.domanda_aperta_argomento_id = d.argomento_id AND c.domanda_aperta_argomento_corso_id = d.argomento_corso_id";
    private static $CREATE_DOMANDA_MULTIPLA = "INSERT INTO `domanda_multipla` (argomento_id, argomento_corso_id, testo, punteggio_corretta, punteggio_errata, percentuale_scelta, percentuale_risposta_corretta) VALUES ('%d','%d','%s', '%f','%f','%f','%f')";
    private static $UPDATE_DOMANDA_MULTIPLA = "UPDATE `domanda_multipla` SET testo = '%s', punteggio_corretta = '%f', punteggio_errata = '%f', percentuale_scelta = '%f', percentuale_risposta_corretta = '%f' WHERE id = '%d' AND argomento_id = '%d' AND argomento_corso_id = '%d'";
    private static $DELETE_DOMANDA_MULTIPLA = "DELETE FROM `domanda_multipla` WHERE id = '%d' AND argomento_id = '%d' AND argomento_corso_id = '%d'";
    private static $READ_DOMANDA_MULTIPLA = "SELECT * FROM `domanda_multipla` WHERE id = '%d' AND argomento_id = '%d' AND argomento_corso_id = '%d'";
    private static $GET_ALL_DOMANDA_MULTIPLA = "SELECT * FROM `domanda_multipla`";
    private static $GET_ALL_DOMANDA_MULTIPLA_BY_ARGOMENTO = "SELECT * FROM `domanda_multipla` WHERE argomento_id = '%d' AND argomento_corso_id = '%d'";
    private static $GET_ALL_DOMANDE_MULTIPLE_TEST = "SELECT d.* FROM `domanda_multipla` as d,`compone_multipla` as c WHERE c.test_id = '%s' AND c.domanda_multipla_id = d.id AND c.domanda_multipla_argomento_id = d.argomento_id AND c.domanda_multipla_argomento_corso_id = d.argomento_corso_id";

    /**
     * Inserisce una nuova DomandaAperta nel database
     * @param DomandaAperta $domandaAperta La domanda aperta da inserire nel database
     * @throws ApplicationException
     */
    public function createDomandaAperta($domandaAperta) {
        $query = sprintf(self::$CREATE_DOMANDA_APERTA, $domandaAperta->getArgomentoId(), $domandaAperta->getArgomentoCorsoId(), $domandaAperta->getTesto(), $domandaAperta->getPunteggioMax(), $domandaAperta->getPercentualeScelta());
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$INSERIMENTO_FALLITO);
        }else{
            return Model::getDB()->insert_id;
        }
    }

    /**
     * Modifica una DomandaAperta nel database
     * @param int $id L'id della domanda aperta da modificare
     * @param int $argomentoId L'id dell'argomento a cui appartiene la domanda
     * @param int $argomentoCorsoId L'id del corso a cui appartiene l'argomento relativo
     * @param DomandaAperta $updatedDomandaAperta La domanda aperta aggiornata da modificare nel database
     * @throws ApplicationException
     */
    public function updateDomandaAperta($id, $argomentoId, $argomentoCorsoId, $updatedDomandaAperta) {
        $query = sprintf(self::$UPDATE_DOMANDA_APERTA, $updatedDomandaAperta->getTesto(), $updatedDomandaAperta->getPunteggioMax(), $updatedDomandaAperta->getPercentualeScelta(),
            $id, $argomentoId, $argomentoCorsoId);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$AGGIORNAMENTO_FALLITO);
        }
    }

    /**
     * Cancella una domanda aperta nel database
     * @param int $id L'id della domanda aperta da cancellare
     * @param int $argomentoId L'id dell'argomento a cui appartiene la domanda
     * @param int $argomentoCorsoId L'id del corso a cui appartiene l'argomento relativo
     * @throws ApplicationException
     */
    public function deleteDomandaAperta($id, $argomentoId, $argomentoCorsoId) {
        $query = sprintf(self::$DELETE_DOMANDA_APERTA, $id, $argomentoId, $argomentoCorsoId);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$CANCELLAZIONE_FALLITA);
        }
    }

    /**
     * Cerca una domanda aperta nel database
     * @param int $id della domanda aperta da cercare
     * @param int $argomentoId L'id dell'argomento a cui appartiene la domanda
     * @param int $argomentoCorsoId L'id del corso a cui appartiene l'argomento relativo
     * @return DomandaAperta La domanda aperta cercata nel database
     * @throws ApplicationException
     */
    public function readDomandaAperta($id, $argomentoId, $argomentoCorsoId) {
        $query = sprintf(self::$READ_DOMANDA_APERTA, $id, $argomentoId, $argomentoCorsoId);
        $res = Model::getDB()->query($query);
        if ($obj = $res->fetch_assoc()) {
            $domandaAperta = new DomandaAperta($obj['id'], $obj['argomento_id'], $obj['argomento_corso_id'], $obj['testo'], $obj['punteggio_max'], $obj['percentuale_scelta']);
            return $domandaAperta;
        } else {
            throw new ApplicationException(Error::$DOMANDA_APERTA_NON_TROVATA);
        }
    }

    /**
     * Restituisce tutte le domande aperte del database
     * @return DomandaAperta[] Tutte le domande aperte del database
     * @throws ApplicationException
     */
    public function getAllDomandaAperta() {
        $res = Model::getDB()->query(self::$GET_ALL_DOMANDA_APERTA);
        $domandeAperte[] = array();
        if ($res) {
            while ($obj = $res->fetch_assoc()) {
                $domandeAperte[] = new DomandaAperta($obj['id'], $obj['argomento_id'], $obj['argomento_corso_id'], $obj['testo'], $obj['punteggio_max'], $obj['percentuale_scelta']);
            }
        }
        return $domandeAperte;
    }

    /**
     * Restituisce tutte le domande aperte di un argomento
     * @param int $argomentoId L'id dell'argomento a cui appartiene la domanda
     * @param int $argomentoCorsoId L'id del corso a cui appartiene l'argomento relativo
     * @return DomandaAperta[] Tutte le domande aperte dell'argomento
     * @throws ApplicationException
     */
    public function getAllDomandaApertaByArgomento($argomentoId, $argomentoCorsoId) {
        $query = sprintf(self::$GET_ALL_DOMANDA_APERTA_BY_ARGOMENTO, $argomentoId, $argomentoCorsoId);
        $res = Model::getDB()->query($query);
        $domandeAperte = array();
        if ($res) {
            while ($obj = $res->fetch_assoc()) {
                $domandeAperte[] = new DomandaAperta($obj['id'], $obj['argomento_id'], $obj['argomento_corso_id'], $obj['testo'], $obj['punteggio_max'],$obj['percentuale_scelta']);
            }
        }
        return $domandeAperte;
    }

    /**
     * Inserisce una nuova domanda multipla nel database
     * @param DomandaMultipla $domandaMultipla La domanda multipla da inserire nel database
     * @throws ApplicationException
     */

    public function createDomandaMultipla($domandaMultipla) {
        $query = sprintf(self::$CREATE_DOMANDA_MULTIPLA, $domandaMultipla->getArgomentoId(), $domandaMultipla->getArgomentoCorsoId(), $domandaMultipla->getTesto(),
            $domandaMultipla->getPunteggioCorretta(), $domandaMultipla->getPunteggioErrata(), $domandaMultipla->getPercentualeScelta(), $domandaMultipla->getPercentualeRispostaCorretta());
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$INSERIMENTO_FALLITO);
        }else{
            return Model::getDB()->insert_id;
        }
    }

    /**
     * Modifica una domanda multipla nel database
     * @param int $id L'id della domanda multipla da modificare
     * @param int $argomentoId L'id dell'argomento a cui appartiene la domanda
     * @param int $argomentoCorsoId L'id del corso a cui appartiene l'argomento relativo
     * @param DomandaMultipla $updatedDomandaMultipla La domanda multipla aggiornata da modificare nel database
     * @throws ApplicationException
     */
    public function updateDomandaMultipla($id, $argomentoId, $argomentoCorsoId, $updatedDomandaMultipla) {
        $query = sprintf(self::$UPDATE_DOMANDA_MULTIPLA, $updatedDomandaMultipla->getTesto(),
            $updatedDomandaMultipla->getPunteggioCorretta(), $updatedDomandaMultipla->getPunteggioErrata(), $updatedDomandaMultipla->getPercentualeScelta(),
            $updatedDomandaMultipla->getPercentualeRispostaCorretta(), $id, $argomentoId, $argomentoCorsoId);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$AGGIORNAMENTO_FALLITO);
        }
    }

    /**
     * Cancella una domanda multipla nel database
     * @param int $id L'id della domanda multipla da cancellare
     * @param int $argomentoId L'id dell'argomento a cui appartiene la domanda
     * @param int $argomentoCorsoId L'id del corso a cui appartiene l'argomento relativo
     * @throws ApplicationException
     */
    public function deleteDomandaMultipla($id, $argomentoId, $argomentoCorsoId) {
        $query = sprintf(self::$DELETE_DOMANDA_MULTIPLA, $id, $argomentoId, $argomentoCorsoId);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$CANCELLAZIONE_FALLITA);
        }
    }

    /**
     * Cerca una domandaMultipla nel database
     * @param int $id L'id della domanda multipla da cercare
     * @param int $argomentoId L'id dell'argomento a cui appartiene la domanda
     * @param int $argomentoCorsoId L'id del corso a cui appartiene l'argomento relativo
     * @return DomandaMultipla La domanda multipla trovata
     * @throws ApplicationException
     */
    public function readDomandaMultipla($id, $argomentoId, $argomentoCorsoId) {
        $query = sprintf(self::$READ_DOMANDA_MULTIPLA, $id, $argomentoId, $argomentoCorsoId);
        $res = Model::getDB()->query($query);
        if ($obj = $res->fetch_assoc()) {
            $domandaMultipla = new DomandaMultipla($obj['id'], $obj['argomento_id'], $obj['argomento_corso_id'], $obj['testo'], $obj['punteggio_corretta'],
                $obj['punteggio_errata'], $obj['percentuale_scelta'], $obj['percentuale_risposta_corretta']);
            return $domandaMultipla;
        } else {
            throw new ApplicationException(Error::$DOMANDA_MULTIPLA_NON_TROVATA);
        }
    }

    /**
     * Restituisce tutte le domande multiple del database
     * @return DomandaMultipla[] Tutte le domande multiple del database
     * @throws ApplicationException
     */
    public function getAllDomandaMultipla() {
        $res = Model::getDB()->query(self::$GET_ALL_DOMANDA_MULTIPLA);
        $domandeMultiple = array();
        if ($res) {
            while ($obj = $res->fetch_assoc()) {
                $domandeMultiple[] = new DomandaMultipla($obj['id'], $obj['argomento_id'], $obj['argomento_corso_id'], $obj['testo'], $obj['punteggio_corretta'],
                    $obj['punteggio_errata'], $obj['percentuale_scelta'], $obj['percentuale_risposta_corretta']);
            }
        }
        return $domandeMultiple;
    }

    /**
     * Restituisce un array con tutte le domande multiple di un argomento
     * @param int $argomentoId L'id dell'argomento a cui appartiene la domanda
     * @param int $argomentoCorsoId L'id del corso a cui appartiene l'argomento relativo
     * @return DomandaMultipla[] Tutte le domande multiple di un argomento
     * @throws ApplicationException
     */

    public function getAllDomandaMultiplaByArgomento($argomentoId, $argomentoCorsoId) {
        $query = sprintf(self::$GET_ALL_DOMANDA_MULTIPLA_BY_ARGOMENTO, $argomentoId, $argomentoCorsoId);
        $res = Model::getDB()->query($query);
        $domandeMultiple = array();
        if ($res) {
            while ($obj = $res->fetch_assoc()) {
                $domandeMultiple[] = new DomandaMultipla($obj['id'], $obj['argomento_id'], $obj['argomento_corso_id'], $obj['testo'], $obj['punteggio_corretta'],
                    $obj['punteggio_errata'], $obj['percentuale_scelta'], $obj['percentuale_risposta_corretta']);
            }
        }
        return $domandeMultiple;
    }
    
    /**
     * Restituisce tutte le domande aperte che costituiscono un test
     * @param int $id L'id del test per il quale si vogliono conoscere tutte le domande aperte che lo compongono
     * @return DomandaAperta[] Tutte le domande aperte che costituiscono il test
     */
    public function getAllDomandeAperteByTest($id) {
        $query = sprintf(self::$GET_ALL_DOMANDE_APERTE_TEST, $id);
        $res = Model::getDB()->query($query);
        $domande = array();
        if($res){
            while ($obj = $res->fetch_assoc()) {
                $domande[] = new DomandaAperta($obj['id'],$obj['argomento_id'], $obj['argomento_corso_id'], $obj['testo'], $obj['punteggio_max'], 
                        $obj['percentule_scelta']);
            }  
        }
        return $domande;
    }
    
    /**
     * Restituisce tutte le domande multiple che costituiscono un test
     * @param int $id L'id del test per il quale si vogliono conoscere tutte le domande multiple che lo compongono
     * @return Test[] Tutte le domande multiple che costituiscono un test
     */
    public function getAllDomandeMultipleByTest($id) {
        $query = sprintf(self::$GET_ALL_DOMANDE_MULTIPLE_TEST, $id, $id);
        $res = Model::getDB()->query($query);
        $domande = array();
        if($res){
            while ($obj = $res->fetch_assoc()) {
                $domande[]= new DomandaMultipla($obj['id'], $obj['argomento_id'], $obj['argomento_corso_id'], $obj['testo'], $obj['punteggio_corretta'], 
                    $obj['punteggio_errata'], $obj['percentuale_scelta'], $obj['percentuale_risposta_corretta']);
            }  
        }
        return $domande;
    }
}