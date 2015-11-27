<?php

/**
 * User: Alina
 * Date: 27/11/15
 * Time: 14:47
 */
include_once MODEL_DIR . "Model.php";
include_once BEAN_DIR . "Argomento.php";
include_once BEAN_DIR . "DomandaAperta.php";
include_once BEAN_DIR . "DomandaMultipla.php";
include_once BEAN_DIR . "Alternativa.php";

class ArgomentoModel extends Model {
    private static $CREATE_ARGOMENTO = "INSERT INTO `argomento` (corso_id, nome) VALUES ('%d','%s')";
    private static $UPDATE_ARGOMENTO = "UPDATE `argomento` SET nome = '%s' WHERE id = '%d' AND corso_id = '%d'";
    private static $DELETE_ARGOMENTO = "DELETE FROM `argomento` WHERE id = '%d' AND corso_id = '%d'";
    private static $READ_ARGOMENTO = "SELECT * FROM `argomento` WHERE id = '%d' AND corso_id = '%d'";
    private static $GET_ALL_ARGOMENTO = "SELECT * FROM `argomento`";
    private static $CREATE_DOMANDA_APERTA = "INSERT INTO `domanda_aperta` (argomento_id, argomento_corso_id, testo, punteggio_max, percentuale_scelta)"
            . " VALUES (NULL,'%d','%d','%s','%f','%f')";
    private static $UPDATE_DOMANDA_APERTA = "UPDATE `domanda_aperta` SET testo = '%s', punteggio_max = '%f', percentuale_scelta = '%f' "
            ." WHERE id = '%d' AND argomento_id = '%d' AND argomento_corso_id = '%d'";
    private static $DELETE_DOMANDA_APERTA = "DELETE FROM `domanda_aperta` WHERE id = '%d' AND argomento_id = '%d' AND argomento_corso_id = '%d'";
    private static $READ_DOMANDA_APERTA = "SELECT * FROM `domanda_aperta` WHERE id = '%d' AND argomento_id = '%d' AND argomento_corso_id = '%d'";
    private static $GET_ALL_DOMANDA_APERTA = "SELECT * FROM `domanda_aperta`";
    private static $GET_ALL_DOMANDA_APERTA_BY_ARGOMENTO = "SELECT * FROM `domanda_aperta` WHERE argomento_id = '%d' AND argomento_corso_id = '%d'";
    private static $CREATE_DOMANDA_MULTIPLA = "INSERT INTO `domanda_multipla` (argomento_id, argomento_corso_id, testo, punteggio_corretta, punteggio_errata, "
            ."percentuale_scelta, percentuale_risposta_corretta) VALUES ('%d','%d','%s', %f','%f','%f','%f')";
    private static $UPDATE_DOMANDA_MULTIPLA = "UPDATE `domanda_multipla` SET testo = '%s', punteggio_corretta = '%f', "
            ."punteggio_errata = '%f', percentuale_scelta = '%f', percentuale_risposta_corretta = '%f' WHERE id = '%d' AND argomento_id = '%d' AND argomento_corso_id = '%d'";
    private static $DELETE_DOMANDA_MULTIPLA = "DELETE FROM `domanda_multipla` WHERE id = '%d' AND argomento_id = '%d' AND argomento_corso_id = '%d'";
    private static $READ_DOMANDA_MULTIPLA = "SELECT * FROM `domanda_multipla` WHERE id = '%d' AND argomento_id = '%d' AND argomento_corso_id = '%d'";
    private static $GET_ALL_DOMANDA_MULTIPLA = "SELECT * FROM `domanda_multipla`";
    private static $GET_ALL_DOMANDA_MULTIPLA_BY_ARGOMENTO = "SELECT * FROM `domanda_multipla` WHERE argomento_id = '%d' AND argomento_corso_id = '%d'";
 
    private static $CREATE_ALTERNATIVA = "INSERT INTO `alternativa` (domanda_multipla_id, domanda_multipla_argomento_id, domanda_multipla_argomento_corso_id, testo, "
            ."percentuale_scelta, corretta) VALUES ('%d','%d','%d','%s','%f','%s')";
    private static $UPDATE_ALTERNATIVA = "UPDATE `alternativa` SET testo = '%s', percentuale_scelta = '%f', corretta = '%s' WHERE id = '%d' AND "
            . "domanda_multipla_id = '%d' AND domanda_multipla_argomento_id = '%d' AND domanda_multipla_argomento_corso_id = '%d'";
    private static $DELETE_ALTERNATIVA = "DELETE FROM `alternativa` WHERE id = '%d' AND domanda_multipla_id = '%d' AND domanda_multipla_argomento_id = '%d' "
            . "AND domanda_multipla_argomento_corso_id = '%d'";
    private static $READ_ALTERNATIVA = "SELECT * FROM `alternativa` WHERE id = '%d' AND domanda_multipla_id = '%d' AND domanda_multipla_argomento_id = '%d' "
            . "AND domanda_multipla_argomento_corso_id = '%d'";
    private static $GET_ALL_ALTERNATIVA = "SELECT * FROM `alternativa`";
    private static $GET_ALL_ALTERNATIVA_BY_DOMANDA = "SELECT * FROM `alternativa` WHERE domanda_multipla_id = '%d' AND domanda_multipla_argomento_id = '%d' "
            . "AND domanda_multipla_argomento_corso_id = '%d'";
    private static $GET_ALTERNATIVA_CORRETTA_BY_DOMANDA = "SELECT * FROM `alternativa` WHERE domanda_multipla_id = '%d' AND domanda_multipla_argomento_id = '%d' "
            . "AND domanda_multipla_argomento_corso_id = '%d' AND a.corretta = \"Si\"";

    /**
     *Inserisce un nuovo argomento nel database
     * @param Argomento L'argomento da inserire nel database
     * @throws ApplicationException
     */
    public function createArgomento($argomento) {
        $query = sprintf(self::$CREATE_ARGOMENTO,$argomento->getCorsoId(), $argomento->getNome());
        Model::getDB()->query($query);
        if(Model::getDB()->affected_rows==-1){
            throw new ApplicationException(Error::$INSERIMENTO_FALLITO);
        }
    }
    /**
     * Modifica un argomento nel database
     * @param int $id L'id dell'argomento da aggiornare
     * @param int $corsoId L'id del corso a cui appartiene l'argomento
     * @param Argomento $updatedArgomento L'argomento modificato da aggiornare nel database
     * @throws ApplicationException
     */
    public function updateArgomento($id, $corsoId, $updatedArgomento) {
        $query = sprintf(self::$UPDATE_ARGOMENTO, $updatedArgomento->getNome(), $id, $corsoId);
        Model::getDB()->query($query);
        if(Model::getDB()->affected_rows==-1){
            throw new ApplicationException(Error::$AGGIORNAMENTO_FALLITO);
        }
    }

    /**
     * Cancella un argomento nel database
     * @param int $id L'id dell'argomento da cancellare
     * @param int $corsoId L'id del corso a cui appartiene l'argomento
     * @throws ApplicationException
     */
    public function deleteArgomento($id, $corsoId) {
        $query = sprintf(self::$DELETE_ARGOMENTO, $id, $corsoId);
        Model::getDB()->query($query);
        if(Model::getDB()->affected_rows==-1){
            throw new ApplicationException(Error::$CANCELLAZIONE_FALLITA);
        }
    }

    /**
     * Cerca un argomento nel database
     * @param int $id L'id dell'argomento da cercare
     * @param int $corsoId L'id del corso a cui appartiene l'argomento
     * @return Argomento L'argomento da cercare
     * @throws ApplicationException
     */
    public function readArgomento($id, $corsoId) {
        $query = sprintf(self::$READ_ARGOMENTO, $id, $corsoId);
        $res = Model::getDB()->query($query);
        if ($obj = $res->fetch_assoc()) {
            $argomento = new Argomento($obj['id'],$obj['corso_id'], $obj['nome']);
            return $argomento;
        }else{
            throw new ApplicationException(Error::$ARGOMENTO_NON_TROVATO);
        }
    }

    /**
     * Restituisce tutti gli Argomenti del database
     * @return Argomento[] Tutti gli argomenti del database
     * @throws ApplicationException
     */
    public function getAllArgomento() {
        $res = Model::getDB()->query(self::$GET_ALL_ARGOMENTO);
        $argomento = array();
        if ($res) {
            while ($obj = $res->fetch_assoc()) {
                $argomento[] = new Argomento($obj['id'],$obj['corso_id'], $obj['nome']);
            } 
        }
        return $argomento;
    }

    /**
     * Inserisce una nuova DomandaAperta nel database
     * @param DomandaAperta $domandaAperta La domanda aperta da inserire nel database
     * @throws ApplicationException
     */
    public function createDomandaAperta($domandaAperta) {
        $query = sprintf(self::$CREATE_DOMANDA_APERTA, $domandaAperta->getArgomentoId(), $domandaAperta->getArgomentoCorsoId(), $domandaAperta->getTesto(), 
                $domandaAperta->getPunteggioMax(), $domandaAperta->getPercentualeScelta());
        Model::getDB()->query($query);
        if(Model::getDB()->affected_rows==-1){
            throw new ApplicationException(Error::$INSERIMENTO_FALLITO);
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
       if(Model::getDB()->affected_rows==-1){
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
        if(Model::getDB()->affected_rows==-1){
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
            $domandaAperta = new DomandaAperta($obj['id'],$obj['argomento_id'], $obj['argomento_corso_id'], $obj['testo'], $obj['punteggio_max'], $obj['percentule_scelta']);
            return $domandaAperta;
        }else{
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
                $domandeAperte[] = new DomandaAperta($obj['id'],$obj['argomento_id'], $obj['argomento_corso_id'], $obj['testo'], $obj['punteggio_max'], $obj['percentule_scelta']);
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
                $domandeAperte[] = new DomandaAperta($obj['id'],$obj['argomento_id'], $obj['argomento_corso_id'], $obj['testo'], $obj['punteggio_max'], 
                        $obj['percentule_scelta']);
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
        $query = sprintf(self::$CREATE_DOMANDA_MULTIPLA,$domandaMultipla->getArgomentoId(),$domandaMultipla->getArgomentoCorsoId(), $domandaMultipla->getTesto(),
                $domandaMultipla->getPunteggioCorretta(), $domandaMultipla->getPunteggioErrata(), $domandaMultipla->getPercentualeScelta(), $domandaMultipla->getPercentualeRispostaCorretta());
        Model::getDB()->query($query);
        if(Model::getDB()->affected_rows==-1){
            throw new ApplicationException(Error::$INSERIMENTO_FALLITO);
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
        if(Model::getDB()->affected_rows==-1){
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
        if(Model::getDB()->affected_rows==-1){
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
        }else{
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
     * Inserisce una nuova alternativa nel database
     * @param Alternativa $alternativa L'alternativa da inserire nel database
     * @throws ApplicationException
     */
    public function createAlternativa($alternativa) {
      $query = sprintf(self::$CREATE_ALTERNATIVA, $alternativa->getDomandaMultiplaId(), $alternativa->getDomandaMultiplaArgomentoId(), $alternativa->getDomandaMultiplaArgomentoCorsoId(),
              $alternativa->getTesto(), $alternativa->getPercentualeScelta(), $alternativa->getCorretta());
      Model::getDB()->query($query);
      if(Model::getDB()->affected_rows==-1){
            throw new ApplicationException(Error::$INSERIMENTO_FALLITO);
       }
    }

    /**
     * Modifica un'alternativa nel database
     * @param int $id L'id dell'alternativa da modificare
     * @param int $domandaMultiplaId L'id della domanda multipla a cui appartiene
     * @param int $domandaMultiplaArgomentoId L'id dell'argomento a cui appartiene la domanda relativa
     * @param int $domandaMultiplaArgomentoCorsoId L'id del corso a cui appartiene l'argomento relativo alla domanda
     * @param Alternativa $updatedAlternativa L'alternativa modificata da aggiornare nel database
     * @throws ApplicationException
     */
    public function updateAlternativa($id, $domandaMultiplaId, $domandaMultiplaArgomentoId, $domandaMultiplaArgomentoCorsoId, $updatedAlternativa) {
        $query = sprintf(self::$UPDATE_ALTERNATIVA, $updatedAlternativa->getDomandaMultiplaId(), $updatedAlternativa->getDomandaMultiplaArgomentoId(), 
                $updatedAlternativa->getDomandaMultiplaArgomentoCorsoId(), $updatedAlternativa->getTesto(), $updatedAlternativa->getPercentualeScelta(), $updatedAlternativa->getCorretta(),
                $id, $domandaMultiplaId, $domandaMultiplaArgomentoId, $domandaMultiplaArgomentoCorsoId);
        Model::getDB()->query($query);
        if(Model::getDB()->affected_rows==-1){
            throw new ApplicationException(Error::$AGGIORNAMENTO_FALLITO);
        }
    }

    /**
     * Cancella un'alternativa nel database
     * @param int $id L'id dell'alternativa da cancellare
     * @param int $domandaMultiplaId L'id della domanda multipla a cui appartiene
     * @param int $domandaMultiplaArgomentoId L'argomento a cui appartiene la domanda relativa
     * @param int $domandaMultiplaArgomentoCorsoId L'id del corso a cui appartiene l'argomento relativo alla domanda
     * @throws ApplicationException
     */
    public function deleteAlternativa($id, $domandaMultiplaId, $domandaMultiplaArgomentoId, $domandaMultiplaArgomentoCorsoId) {
        $query = sprintf(self::$DELETE_ALTERNATIVA, $id, $domandaMultiplaId, $domandaMultiplaArgomentoId, $domandaMultiplaArgomentoCorsoId);
        Model::getDB()->query($query);
        if(Model::getDB()->affected_rows==-1){
            throw new ApplicationException(Error::$CANCELLAZIONE_FALLITA);
        }
    }

    /**
     * Cerca una domanda aperta nel database
     * @param int $id dell'alternativa da cercare
     * @param int $domandaMultiplaId L'id della domanda multipla a cui appartiene
     * @param int $domandaMultiplaArgomentoId L'argomento a cui appartiene la domanda relativa
     * @param int $domandaMultiplaArgomentoCorsoId L'id del corso a cui appartiene l'argomento relativo alla domanda
     * @return Alternativa L'alternativa trovata
     * @throws ApplicationException
     */
    public function readAlternativa($id, $domandaMultiplaId, $domandaMultiplaArgomentoId, $domandaMultiplaArgomentoCorsoId) {
        $query = sprintf(self::$READ_ALTERNATIVA, $id, $domandaMultiplaId, $domandaMultiplaArgomentoId, $domandaMultiplaArgomentoCorsoId);
        $res = Model::getDB()->query($query);
        if ($obj = $res->fetch_assoc()) {
            $alternativa = new Alternativa($obj['id'], $obj['domanda_multipla_id'], $obj['domanda_multipla_argomento_id'], $obj['domanda_multipla_argomento_corso_id'], $obj['testo'], 
                    $obj['percentuale_scelta'], $obj['corretta']);
            return $alternativa;
        }else{
            throw new ApplicationException(Error::$ALTERNATIVA_NON_TROVATA);
        }
    }

    /**
     * Restituisce tutte le alternative del database
     * @return Alternativa[] Tutte le alternative del database
     * @throws ApplicationException
     */
    public function getAllAlternativa() {
        $res = Model::getDB()->query(self::$GET_ALL_ALTERNATIVA);
        $alternative = array();
        if ($res) {
            while ($obj = $res->fetch_assoc()) {
                $alternative[] = new Alternativa($obj['id'], $obj['domanda_multipla_id'], $obj['domanda_multipla_argomento_id'], $obj['domanda_multipla_argomento_corso_id'], $obj['testo'], 
                    $obj['percentuale_scelta'], $obj['corretta']);
            }
        }
        return $alternative;
    }  

    /**
     * Restituisce tutte le alternative di una domanda multipla
     * @param int $domandaMultiplaId L'id della domanda multipla di cui si voglione conoscere le alternative
     * @param int $domandaMultiplaArgomentoId L'argomento a cui appartiene la domanda relativa
     * @param int $domandaMultiplaArgomentoCorsoId L'id del corso a cui appartiene l'argomento relativo alla domanda
     * @return Altenativa[] Tutte le alternative di una domanda multipla
     * @throws ApplicationException
     */
    public function getAllAlternativaByDomanda($domandaMultiplaId, $domandaMultiplaArgomentoId, $domandaMultiplaArgomentoCorsoId) {
        $res = Model::getDB()->query(self::$GET_ALL_ALTERNATIVA_BY_DOMANDA, $domandaMultiplaId, $domandaMultiplaArgomentoId, $domandaMultiplaArgomentoCorsoId);
        if ($res) {
            while ($obj = $res->fetch_assoc()) {
                $alternative[] = new Alternativa($obj['id'], $obj['domanda_multipla_id'], $obj['domanda_multipla_argomento_id'], $obj['domanda_multipla_argomento_corso_id'], $obj['testo'], 
                    $obj['percentuale_scelta'], $obj['corretta']);
            }
        }
        return $alternative;
    }
    
    /**
     * Restituisce l'alternativa corretta di una domanda multipla
     * @param int $domandaMultiplaId L'id della domanda multipla di cui si vuole conoscere l'alternativa corretta
     * @param int $domandaMultiplaArgomentoId L'argomento a cui appartiene la domanda relativa
     * @param int $domandaMultiplaArgomentoCorsoId L'id del corso a cui appartiene l'argomento relativo alla domanda
     * @return Alternativa $alternativa L'alternativa corretta 
     * @throws ApplicationException
     */
    public function getAlternativaCorrettaByDomanda($domandaMultiplaId, $domandaMultiplaArgomentoId, $domandaMultiplaArgomentoCorsoId) {
        $query = sprintf(self::$GET_ALTERNATIVA_CORRETTA_BY_DOMANDA, $domandaMultiplaId, $domandaMultiplaArgomentoId, $domandaMultiplaArgomentoCorsoId);
        $alternativa = Model::getDB()->query($query);
        if ($obj = $res->fetch_assoc()) {
            $alternativa = new Alternativa($obj['id'], $obj['domanda_multipla_id'], $obj['domanda_multipla_argomento_id'], $obj['domanda_multipla_argomento_corso_id'], $obj['testo'], 
                    $obj['percentuale_scelta'], $obj['corretta']);
            return $alternativa;
        }else{
            throw new ApplicationException(Error::$ALTERNATIVA_NON_TROVATA);
        }
    }
}