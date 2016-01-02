<?php
/**
 * La classe costituisce il model che effettua tutte le query riguardanti le funzionalità legate alle domande, interfacciandosi al db al quale è connesso
 *
 * @author Alina Korniychuk
 * @version 1.0
 * @since 27/11/15
 */


include_once MODEL_DIR . "Model.php";
include_once BEAN_DIR . "DomandaAperta.php";
include_once BEAN_DIR . "DomandaMultipla.php";

class DomandaModel extends Model {
    
    private static $CREATE_DOMANDA_APERTA = "INSERT INTO `domanda_aperta` (argomento_id, testo, punteggio_max, percentuale_scelta_ese, percentuale_scelta_val) VALUES ('%d','%s','%f','%f','%f')";
    private static $UPDATE_DOMANDA_APERTA = "UPDATE `domanda_aperta` SET argomento_id = '%d', testo = '%s', punteggio_max = '%f', percentuale_scelta_ese = '%f', percentuale_scelta_val = '%f' WHERE id = '%d'";
    private static $DELETE_DOMANDA_APERTA = "UPDATE `domanda_aperta` SET stato = 'Obsoleto' WHERE id = '%d'";
    private static $READ_DOMANDA_APERTA = "SELECT * FROM `domanda_aperta` WHERE id = '%d'";
    private static $GET_ALL_DOMANDA_APERTA = "SELECT * FROM `domanda_aperta` WHERE stato = 'In uso' ORDER BY testo";
    private static $GET_ALL_DOMANDA_APERTA_BY_ARGOMENTO = "SELECT * FROM `domanda_aperta` WHERE argomento_id = '%d' AND stato = 'In uso' ORDER BY testo";
    private static $GET_ALL_DOMANDE_APERTE_TEST = "SELECT d.* FROM `domanda_aperta` as d,`compone_aperta` as c WHERE c.test_id = '%s' AND c.domanda_aperta_id = d.id ORDER BY d.testo";
    private static $CREATE_DOMANDA_MULTIPLA = "INSERT INTO `domanda_multipla` (argomento_id, testo, punteggio_corretta, punteggio_errata, percentuale_scelta_ese, percentuale_risposta_corretta_ese, percentuale_scelta_val, percentuale_risposta_corretta_val, numero_risposte_esercitative, numero_risposte_valutative) VALUES ('%d','%s','%f','%f','%f','%f','%f','%f','%d','%d')";
    private static $UPDATE_DOMANDA_MULTIPLA = "UPDATE `domanda_multipla` SET argomento_id = '%d', testo = '%s', punteggio_corretta = '%f', punteggio_errata = '%f', percentuale_scelta_ese = '%f', percentuale_risposta_corretta_ese = '%f', percentuale_scelta_val = '%f', percentuale_risposta_corretta_val = '%f', numero_risposte_esercitative='%d', numero_risposte_valutative='%d' WHERE id = '%d'";
    private static $DELETE_DOMANDA_MULTIPLA = "UPDATE `domanda_multipla` SET stato = 'Obsoleto' WHERE id = '%d'";
    private static $READ_DOMANDA_MULTIPLA = "SELECT * FROM `domanda_multipla` WHERE id = '%d'";
    private static $GET_ALL_DOMANDA_MULTIPLA = "SELECT * FROM `domanda_multipla` WHERE stato = 'In uso' ORDER BY testo";
    private static $GET_ALL_DOMANDA_MULTIPLA_BY_ARGOMENTO = "SELECT * FROM `domanda_multipla` WHERE argomento_id = '%d' AND stato = 'In uso' ORDER BY testo";
    private static $GET_ALL_DOMANDE_MULTIPLE_TEST = "SELECT d.* FROM `domanda_multipla` as d,`compone_multipla` as c WHERE c.test_id = '%s' AND c.domanda_multipla_id = d.id ORDER BY d.testo";
    private static $ASSOCIA_DOMANDA_APERTA_TEST = "INSERT INTO `compone_aperta` (domanda_aperta_id, test_id, punteggio_max_alternativo) VALUES ('%d','%d', '%f')";
    private static $MODIFICA_DOMANDA_APERTA_TEST = "UPDATE `compone_aperta` SET punteggio_max_alternativo = '%f' WHERE domanda_aperta_id = '%d' AND test_id= '%d'";
    private static $DISSOCIA_DOMANDA_APERTA_TEST = "DELETE FROM `compone_aperta` WHERE domanda_aperta_id = '%d' AND test_id= '%d'";
    private static $READ_PUNTEGGIO_MAX_ALTERNATIVO_DOMANDA_TEST = "SELECT punteggio_max_alternativo FROM `compone_aperta` WHERE domanda_aperta_id = '%d' AND test_id= '%d'";
    private static $ASSOCIA_DOMANDA_MULTIPLA_TEST = "INSERT INTO `compone_multipla` (domanda_multipla_id, test_id, punteggio_corretta_alternativo, punteggio_errata_alternativo) VALUES ('%d','%d', '%f', '%f')";
    private static $MODIFICA_DOMANDA_MULTIPLA_TEST = "UPDATE `compone_multipla` SET punteggio_corretta_alternativo = '%f', punteggio_errata_alternativo = '%f' WHERE domanda_multipla_id = '%d' AND test_id= '%d'";
    private static $DISSOCIA_DOMANDA_MULTIPLA_TEST = "DELETE FROM `compone_multipla` WHERE domanda_multipla_id = '%d' AND test_id= '%d'";
    private static $READ_PUNTEGGIO_CORRETTA_ALTERNATIVO_DOMANDA_MULTIPLA_TEST = "SELECT punteggio_corretta_alternativo FROM `compone_multipla` WHERE domanda_multipla_id = '%d' AND test_id= '%d'";
    private static $READ_PUNTEGGIO_ERRATA_ALTERNATIVO_DOMANDA_MULTIPLA_TEST = "SELECT punteggio_errata_alternativo FROM `compone_multipla` WHERE domanda_multipla_id = '%d' AND test_id= '%d'";

    /**
     * Inserisce una nuova DomandaAperta nel database
     * @param DomandaAperta $domandaAperta La domanda aperta da inserire nel database
     * @throws ApplicationException
     */
    public function createDomandaAperta($domandaAperta) {
        $query = sprintf(self::$CREATE_DOMANDA_APERTA, $domandaAperta->getArgomentoId(), $domandaAperta->getTesto(), $domandaAperta->getPunteggioMax(), $domandaAperta->getPercentualeSceltaEse(), $domandaAperta->getPercentualeSceltaVal());
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
     * @param DomandaAperta $updatedDomandaAperta La domanda aperta aggiornata da modificare nel database
     * @throws ApplicationException
     */
    public function updateDomandaAperta($id, $updatedDomandaAperta) {
        $query = sprintf(self::$UPDATE_DOMANDA_APERTA,  $updatedDomandaAperta->getArgomentoId(), $updatedDomandaAperta->getTesto(), $updatedDomandaAperta->getPunteggioMax(), $updatedDomandaAperta->getPercentualeSceltaEse(),$updatedDomandaAperta->getPercentualeSceltaVal(), $id);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$AGGIORNAMENTO_FALLITO);
        }
    }

    /**
     * Cancella una domanda aperta nel database
     * @param int $id L'id della domanda aperta da cancellare
     * @throws ApplicationException
     */
    public function deleteDomandaAperta($id) {
        $query = sprintf(self::$DELETE_DOMANDA_APERTA, $id);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$CANCELLAZIONE_FALLITA);
        }
    }

    /**
     * Cerca una domanda aperta nel database
     * @param int $id della domanda aperta da cercare
     * @return DomandaAperta La domanda aperta cercata nel database
     * @throws ApplicationException
     */
    public function readDomandaAperta($id) {
        $query = sprintf(self::$READ_DOMANDA_APERTA, $id);
        $res = Model::getDB()->query($query);
        if ($obj = $res->fetch_assoc()) {
            $domandaAperta = new DomandaAperta($obj['argomento_id'], $obj['testo'], $obj['punteggio_max'], $obj['percentuale_scelta_ese'], $obj['percentuale_scelta_val']);
            $domandaAperta->setId($obj['id']);
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
                $domandaAperta = new DomandaAperta($obj['argomento_id'], $obj['testo'], $obj['punteggio_max'], $obj['percentuale_scelta_ese'], $obj['percentuale_scelta_val']);
                $domandaAperta->setId($obj['id']);
                $domandeAperte[] = $domandaAperta;
            }
        }
        return $domandeAperte;
    }

    /**
     * Restituisce tutte le domande aperte di un argomento
     * @param int $argomentoId L'id dell'argomento a cui appartiene la domanda
     * @return DomandaAperta[] Tutte le domande aperte dell'argomento
     * @throws ApplicationException
     */
    public function getAllDomandaApertaByArgomento($argomentoId) {
        $query = sprintf(self::$GET_ALL_DOMANDA_APERTA_BY_ARGOMENTO, $argomentoId);
        $res = Model::getDB()->query($query);
        $domandeAperte = array();
        if ($res) {
            while ($obj = $res->fetch_assoc()) {
                $domandaAperta = new DomandaAperta($obj['argomento_id'], $obj['testo'], $obj['punteggio_max'], $obj['percentuale_scelta_ese'], $obj['percentuale_scelta_val']);
                $domandaAperta->setId($obj['id']);
                $domandeAperte[] = $domandaAperta;
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
        $query = sprintf(self::$CREATE_DOMANDA_MULTIPLA, $domandaMultipla->getArgomentoId(), $domandaMultipla->getTesto(), $domandaMultipla->getPunteggioCorretta(),
            $domandaMultipla->getPunteggioErrata(), $domandaMultipla->getPercentualeSceltaEse(), $domandaMultipla->getPercentualeRispostaCorrettaEse(),
            $domandaMultipla->getPercentualeSceltaVal(), $domandaMultipla->getPercentualeRispostaCorrettaVal(),$domandaMultipla->getNumeroRisposteEsercitative(), $domandaMultipla->getNumeroRisposteValutative());
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
     * @param DomandaMultipla $updatedDomandaMultipla La domanda multipla aggiornata da modificare nel database
     * @throws ApplicationException
     */
    public function updateDomandaMultipla($id, $updatedDomandaMultipla) {
        $query = sprintf(self::$UPDATE_DOMANDA_MULTIPLA, $updatedDomandaMultipla->getArgomentoId(), $updatedDomandaMultipla->getTesto(),
            $updatedDomandaMultipla->getPunteggioCorretta(), $updatedDomandaMultipla->getPunteggioErrata(), $updatedDomandaMultipla->getPercentualeSceltaEse(),
            $updatedDomandaMultipla->getPercentualeRispostaCorrettaEse(), $updatedDomandaMultipla->getPercentualeSceltaVal(), $updatedDomandaMultipla->getPercentualeRispostaCorrettaVal(),
            $updatedDomandaMultipla->getNumeroRisposteEsercitative(), $updatedDomandaMultipla->getNumeroRisposteValutative(), $id);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$AGGIORNAMENTO_FALLITO);
        }
    }

    /**
     * Cancella una domanda multipla nel database
     * @param int $id L'id della domanda multipla da cancellare
     * @throws ApplicationException
     */
    public function deleteDomandaMultipla($id) {
        $query = sprintf(self::$DELETE_DOMANDA_MULTIPLA, $id);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$CANCELLAZIONE_FALLITA);
        }
    }

    /**
     * Cerca una domandaMultipla nel database
     * @param int $id L'id della domanda multipla da cercare
     * @return DomandaMultipla La domanda multipla trovata
     * @throws ApplicationException
     */
    public function readDomandaMultipla($id) {
        $query = sprintf(self::$READ_DOMANDA_MULTIPLA, $id);
        $res = Model::getDB()->query($query);
        if ($obj = $res->fetch_assoc()) {
            $domandaMultipla = new DomandaMultipla($obj['argomento_id'], $obj['testo'], $obj['punteggio_corretta'],$obj['punteggio_errata'], $obj['percentuale_scelta_ese'], $obj['percentuale_risposta_corretta_ese'], $obj['percentuale_scelta_val'], $obj['percentuale_risposta_corretta_val'], $obj['numero_risposte_esercitative'], $obj['numero_risposte_valutative']);
            $domandaMultipla->setId($obj['id']);
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
                $domandaMultipla = new DomandaMultipla($obj['argomento_id'], $obj['testo'], $obj['punteggio_corretta'],$obj['punteggio_errata'], $obj['percentuale_scelta_ese'], $obj['percentuale_risposta_corretta_ese'], $obj['percentuale_scelta_val'], $obj['percentuale_risposta_corretta_val'], $obj['numero_risposte_esercitative'], $obj['numero_risposte_valutative']);
                $domandaMultipla->setId($obj['id']);
                $domandeMultiple[] = $domandaMultipla;
            }
        }
        return $domandeMultiple;
    }

    /**
     * Restituisce un array con tutte le domande multiple di un argomento
     * @param int $argomentoId L'id dell'argomento a cui appartiene la domanda
     * @return DomandaMultipla[] Tutte le domande multiple di un argomento
     * @throws ApplicationException
     */

    public function getAllDomandaMultiplaByArgomento($argomentoId) {
        $query = sprintf(self::$GET_ALL_DOMANDA_MULTIPLA_BY_ARGOMENTO, $argomentoId);
        $res = Model::getDB()->query($query);
        $domandeMultiple = array();
        if ($res) {
            while ($obj = $res->fetch_assoc()) {
                $domandaMultipla = new DomandaMultipla($obj['argomento_id'], $obj['testo'], $obj['punteggio_corretta'],$obj['punteggio_errata'], $obj['percentuale_scelta_ese'], $obj['percentuale_risposta_corretta_ese'], $obj['percentuale_scelta_val'], $obj['percentuale_risposta_corretta_val'], $obj['numero_risposte_esercitative'], $obj['numero_risposte_valutative']);
                $domandaMultipla->setId($obj['id']);
                $domandeMultiple[] = $domandaMultipla;
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
        $domandeAperte = array();
        if($res){
            while ($obj = $res->fetch_assoc()) {
                $domandaAperta = new DomandaAperta($obj['argomento_id'], $obj['testo'], $obj['punteggio_max'], $obj['percentuale_scelta_ese'], $obj['percentuale_scelta_val']);
                $domandaAperta->setId($obj['id']);
                $domandeAperte[] = $domandaAperta;
            }  
        }
        return $domandeAperte;
    }
    
    /**
     * Restituisce tutte le domande multiple che costituiscono un test
     * @param int $id L'id del test per il quale si vogliono conoscere tutte le domande multiple che lo compongono
     * @return Test[] Tutte le domande multiple che costituiscono un test
     */
    public function getAllDomandeMultipleByTest($id) {
        $query = sprintf(self::$GET_ALL_DOMANDE_MULTIPLE_TEST, $id);
        $res = Model::getDB()->query($query);
        $domandeMultiple = array();
        if($res){
            while ($obj = $res->fetch_assoc()) {
                $domandaMultipla = new DomandaMultipla($obj['argomento_id'], $obj['testo'], $obj['punteggio_corretta'],$obj['punteggio_errata'], $obj['percentuale_scelta_ese'], $obj['percentuale_risposta_corretta_ese'], $obj['percentuale_scelta_val'], $obj['percentuale_risposta_corretta_val'], $obj['numero_risposte_esercitative'], $obj['numero_risposte_valutative']);
                $domandaMultipla->setId($obj['id']);
                $domandeMultiple[] = $domandaMultipla;
            }  
        }
        return $domandeMultiple;
    }

    /**
     * Associa ad un test una domanda aperta
     * @param int $idDomanda L'id della domanda aperta da associare
     * @param int $idTest L'id del test a cui associare la domanda
     * @param float $punteggioMaxAlternativo Il punteggio alternativo massimo della domanda per il test
     * @throws ApplicationException
     */
    public function associaDomandaApertaTest($idDomanda, $idTest, $punteggioMaxAlternativo){
        $query = sprintf(self::$ASSOCIA_DOMANDA_APERTA_TEST, $idDomanda, $idTest, $punteggioMaxAlternativo);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$INSERIMENTO_FALLITO);
        }
    }

    /**
     * Modifica il punteggio alternativo max della domanda per il test
     * @param int $idDomanda L'id della domanda aperta
     * @param int $idTest L'id del test a cui associare la domanda
     * @param float $punteggioMaxAlternativo Il punteggio alternativo massimo della domanda per il test
     * @throws ApplicationException
     */
    public function modificaDomandaApertaTest($idDomanda, $idTest, $punteggioMaxAlternativo) {
        $query = sprintf(self::$MODIFICA_DOMANDA_APERTA_TEST, $punteggioMaxAlternativo, $idDomanda, $idTest);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$AGGIORNAMENTO_FALLITO);
        }
    }

    /**
     * Restituisce il punteggio max alternativo della domanda per il test
     * @param $idDomandaAperta L'id della domanda aperta
     * @param $idTest L'id del test
     * @return float Il punteggio punteggio max alternativo della domanda per il test
     * @throws ApplicationException
     */
    public function readPunteggioMaxAlternativo($idDomandaAperta, $idTest){
        $query = sprintf(self::$READ_PUNTEGGIO_MAX_ALTERNATIVO_DOMANDA_TEST, $idDomandaAperta, $idTest);
        $res = Model::getDB()->query($query);
        if ($obj = $res->fetch_assoc()) {
            return $obj['punteggio_max_alternativo'];
        } else {
            throw new ApplicationException(Error::$DOMANDA_APERTA_NON_TROVATA);
        }
    }

    /**
     * Dissocia una domanda aperta da un test
     * @param int $idDomanda L'id della domanda aperta
     * @param int $idTest L'id del test a cui dissociare la domanda
     * @throws ApplicationException
     */
    public function dissociaDomandaApertaTest($idDomanda, $idTest) {
        $query = sprintf(self::$DISSOCIA_DOMANDA_APERTA_TEST, $idDomanda, $idTest);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$CANCELLAZIONE_FALLITA);
        }
    }

    /**
     * Associa ad un test una domanda multipla
     * @param int $idDomanda L'id della domanda multipla da associare
     * @param int $idTest L'id del test a cui associare la domanda
     * @param float $punteggioCorrettaAlternativo Il punteggio alternativo in caso di risposta corretta della domanda per il test
     * @param float $punteggioErrataAlternativo Il punteggio alternativo in caso di risposta errata della domanda per il test
     * @throws ApplicationException
     */
    public function associaDomandaMultiplaTest($idDomanda, $idTest, $punteggioCorrettaAlternativo, $punteggioErrataAlternativo){
        $query = sprintf(self::$ASSOCIA_DOMANDA_MULTIPLA_TEST, $idDomanda, $idTest, $punteggioCorrettaAlternativo, $punteggioErrataAlternativo);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$INSERIMENTO_FALLITO);
        }
    }

    /**
     * Modifica il punteggio alternativo per risposta errata o corretta della domanda per il test
     * @param int $idDomanda L'id della domanda aperta
     * @param int $idTest L'id del test a cui associare la domanda
     * @param float $punteggioCorrettaAlternativo Il punteggio alternativo in caso di risposta corretta della domanda per il test
     * @param float $punteggioErrataAlternativo Il punteggio alternativo in caso di risposta errata della domanda per il test
     * @throws ApplicationException
     */
    public function modificaDomandaMultiplaTest($idDomanda, $idTest, $punteggioCorrettaAlternativo, $punteggioErrataAlternativo) {
        $query = sprintf(self::$MODIFICA_DOMANDA_MULTIPLA_TEST, $punteggioCorrettaAlternativo, $punteggioErrataAlternativo, $idDomanda, $idTest);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$AGGIORNAMENTO_FALLITO);
        }
    }

    /**
     * Restituisce il punteggio alternativo della domanda per il test in caso di riposta corretta
     * @param $idDomandaMultipla L'id della domanda multipla
     * @param $idTest L'id del test
     * @return float Il punteggio alternativo della domanda per il test in caso di riposta corretta
     * @throws ApplicationException
     */
    public function readPunteggioCorrettaAlternativo($idDomandaMultipla, $idTest){
        $query = sprintf(self::$READ_PUNTEGGIO_CORRETTA_ALTERNATIVO_DOMANDA_MULTIPLA_TEST, $idDomandaMultipla, $idTest);
        $res = Model::getDB()->query($query);
        if ($obj = $res->fetch_assoc()) {
            return $obj['punteggio_corretta_alternativo'];
        } else {
            throw new ApplicationException(Error::$DOMANDA_MULTIPLA_NON_TROVATA);
        }
    }

    /**
     * Restituisce il punteggio alternativo della domanda per il test in caso di riposta errata
     * @param $idDomandaMultipla L'id della domanda multipla
     * @param $idTest L'id del test
     * @return float Il punteggio alternativo della domanda per il test in caso di riposta errata
     * @throws ApplicationException
     */
    public function readPunteggioErrataAlternativo($idDomandaMultipla, $idTest){
        $query = sprintf(self::$READ_PUNTEGGIO_ERRATA_ALTERNATIVO_DOMANDA_MULTIPLA_TEST, $idDomandaMultipla, $idTest);
        $res = Model::getDB()->query($query);
        if ($obj = $res->fetch_assoc()) {
            return $obj['punteggio_errata_alternativo'];
        } else {
            throw new ApplicationException(Error::$DOMANDA_MULTIPLA_NON_TROVATA);
        }
    }

    /**
     * Dissocia una domanda multipla da un test
     * @param int $idDomanda L'id della domanda multipla
     * @param int $idTest L'id del test a cui dissociare la domanda
     * @throws ApplicationException
     */
    public function dissociaDomandaMultiplaTest($idDomanda, $idTest) {
        $query = sprintf(self::$DISSOCIA_DOMANDA_MULTIPLA_TEST, $idDomanda, $idTest);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$CANCELLAZIONE_FALLITA);
        }
    }
}