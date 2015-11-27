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
    private static $CREATE_ARGOMENTO = "INSERT INTO `argomento` (id, corso_id, nome) VALUES ('%d','%d','%s')";
    private static $UPDATE_ARGOMENTO = "UPDATE `argomento` SET corso_id = '%d', nome = '%s' WHERE id = '%d'";
    private static $DELETE_ARGOMENTO = "DELETE FROM `argomento` WHERE id = '%d'";
    private static $READ_ARGOMENTO = "SELECT * FROM `argomento` WHERE id = '%d'";
    private static $GET_ALL_ARGOMENTO = "SELECT * FROM `argomento`";
    private static $CREATE_DOMANDA_APERTA = "INSERT INTO `domanda_aperta` (id, argomento_id, argomento_corso_id, testo, punteggio_max, percentuale_scelta)"
    . " VALUES (NULL,'%d','%d','%s','%f','%f')";
    private static $UPDATE_DOMANDA_APERTA = "UPDATE `domanda_aperta` SET argomento_id = '%d', argomento_corso_id = '%d', testo = '%s', punteggio_max = '%f', "
    . " percentuale_scelta = '%f' WHERE id = '%d'";
    private static $DELETE_DOMANDA_APERTA = "DELETE FROM `domanda_aperta` WHERE id = '%d'";
    private static $READ_DOMANDA_APERTA = "SELECT * FROM `domanda_aperta` WHERE id = '%d'";
    private static $GET_ALL_DOMANDA_APERTA = "SELECT * FROM `domanda_aperta`";
    private static $GET_ALL_DOMANDA_APERTA_BY_ARGOMENTO = "SELECT * FROM `domanda_aperta` WHERE argomento_id = '%d'";
    private static $CREATE_DOMANDA_MULTIPLA = "INSERT INTO `domanda_multipla` (id, argomento_id, argomento_corso_id, testo, punteggio_corretta, punteggio_errata, "
    ."percentuale_scelta, percentuale_risposta_corretta) VALUES (NULL,'%d','%d','%s', %f','%f','%f','%f')";
    private static $UPDATE_DOMANDA_MULTIPLA = "UPDATE `domanda_multipla` SET  argomento_id = '%d', argomento_corso_id = '%d', testo = '%s', punteggio_corretta = '%f', "
    ."punteggio_errata = '%f', percentuale_scelta = '%f', percentuale_risposta_corretta = '%f' WHERE id = '%d'";
    private static $DELETE_DOMANDA_MULTIPLA = "DELETE FROM `domanda_multipla` WHERE id = '%d'";
    private static $READ_DOMANDA_MULTIPLA = "SELECT * FROM `domanda_multipla` WHERE id = '%d'";
    private static $GET_ALL_DOMANDA_MULTIPLA = "SELECT * FROM `domanda_multipla`";
    private static $GET_ALL_DOMANDA_MULTIPLA_BY_ARGOMENTO = "SELECT * FROM `domanda_multipla` WHERE argomento_id = '%d'";
    private static $CREATE_ALTERNATIVA = "INSERT INTO `alternativa` (id, domanda_multipla_id, domanda_multipla_argomento_id, domanda_multipla_argomento_corso_id, testo, "
    ."percentuale_scelta, corretta) VALUES (NULL,'%d','%d','%d','%s','%f','%s')";
    private static $UPDATE_ALTERNATIVA = "UPDATE `alternativa` SET domanda_multipla_id = '%d', domanda_multipla_argomento_id = '%d', domanda_multipla_argomento_corso_id = '%d', "
    ."testo = '%s', percentuale_scelta = '%f', corretta = '%s' WHERE id = '%d'";
    private static $DELETE_ALTERNATIVA = "DELETE FROM `alternativa` WHERE id = '%d'";
    private static $READ_ALTERNATIVA = "SELECT * FROM `alternativa` WHERE id = '%d'";
    private static $GET_ALL_ALTERNATIVA = "SELECT * FROM `alternativa`";
    private static $GET_ALL_ALTERNATIVA_BY_DOMANDA = "SELECT * FROM `alternativa` WHERE domanda_multipla_id = '%d'";
    private static $GET_ALTERNATIVA_CORRETTA_BY_DOMANDA = "SELECT a.* FROM `alternativa` a, `domanda_multipla` d WHERE d.id = '%d' and a.domanda_multipla_id = d.id a.corretta = \"Si\"";

    /**
     *Inserisce un nuovo argomento nel database
     * @param Argomento L'argomento da inserire nel database
     * @throws ApplicationException
     */
    public function createArgomento($argomento) {
        $query = sprintf(self::$CREATE_ARGOMENTO,$argomento->getId(),$argomento->getCorsoId(), $argomento->getNome());
        Model::getDB()->query($query);
        if(Model::getDB()->affected_rows==-1){
            throw new ApplicationException(Error::$INSERIMENTO_FALLITO);
        }
    }
    /**
     * Modifica un argomento nel database
     * @param int $id L'id dell'argomento da aggiornare
     * @param Argomento $updatedArgomento L'argomento modificato da aggiornare nel database
     * @throws ApplicationException
     */
    public function updateArgomento($id, $updatedArgomento) {
        $query = sprintf(self::$UPDATE_ARGOMENTO, $updatedArgomento->getCorsoId(),$updatedArgomento->getNome(),  $id);
        Model::getDB()->query($query);
        if(Model::getDB()->affected_rows==-1){
            throw new ApplicationException(Error::$AGGIORNAMENTO_FALLITO);
        }
    }

    /**
     * Cancella un argomento nel database
     * @param int $id L'id dell'argomento da cancellare
     * @throws ApplicationException
     */
    public function deleteArgomento($id) {
        $query = sprintf(self::$DELETE_ARGOMENTO, $id);
        Model::getDB()->query($query);
        if(Model::getDB()->affected_rows==-1){
            throw new ApplicationException(Error::$CANCELLAZIONE_FALLITA);
        }
    }

    /**
     * Cerca un argomento nel database
     * @param int $id L'id dell'argomento da cercare
     * @return Argomento L'argomento da cercare
     * @throws ApplicationException
     */
    public function readArgomento($id) {
        $query = sprintf(self::$READ_ARGOMENTO, $id);
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
     * @param int $id della domanda aperta da modificare
     * @param DomandaAperta $updatedDomandaAperta domanda aperta aggiornata da modificare nel database
     * @throws ApplicationException
     */
    public function updateDomandaAperta($id, $updatedDomandaAperta) {
       $query = sprintf(self::$UPDATE_DOMANDA_APERTA, $updatedDomandaAperta->getArgomentoId(), $updatedDomandaAperta->getArgomentoCorsoId(), 
               $updatedDomandaAperta->getTesto(), $updatedDomandaAperta->getPunteggioMax(), $updatedDomandaAperta->getPercentualeScelta(), $id);
       Model::getDB()->query($query);
       if(Model::getDB()->affected_rows==-1){
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
        if(Model::getDB()->affected_rows==-1){
            throw new ApplicationException(Error::$CANCELLAZIONE_FALLITA);
        }
    }

    /**
     * Cerca una domanda aperta nel database
     * @param int $id L'id della domanda aperta da cercare
     * @return DomandaAperta La domanda aperta cercata nel database
     * @throws ApplicationException
     */
    public function readDomandaAperta($id) {
        $query = sprintf(self::$READ_DOMANDA_APERTA, $id);
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
     * @param int $idArg L'id dell'argomento di cui si vogliono conoscere le domande aperte
     * @return DomandaAperta[] Tutte le domande aperte dell'argomento
     * @throws ApplicationException
     */
    public function getAllDomandaApertaByArgomento($idArg) {
        $query = sprintf(self::$GET_ALL_DOMANDA_APERTA_BY_ARGOMENTO, $idArg);
        $res = Model::getDB()->query($query);
        $domandeAperte = array();
        if ($res) {
            while ($obj = $res->fetch_assoc()) {
                $domandeAperte[] = new DomandaAperta($obj['id'],$obj['argomento_id'], $obj['argomento_corso_id'], $obj['testo'], $obj['punteggio_max'], $obj['percentule_scelta']);
            }
        }
        return $domandeAperte;
    }

    /**
     * Inserisce una nuova domanda multipla nel database
     * @param DomandaMultipla $domandaMultipla La domanda aperta da inserire nel database
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
     * @param int $id L'id della domanda multipla da aggiornare
     * @param DomandaMultipla $updatedDomandaMultipla La domanda multipla aggiornata da modificare nel database
     * @throws ApplicationException
     */
    public function updateDomandaMultipla($id, $updatedDomandaMultipla) {
        $query = sprintf(self::$UPDATE_DOMANDA_MULTIPLA, $updatedDomandaMultipla->getArgomentoId(), $updatedDomandaMultipla->getArgomentoInsegnamentoId(),$updatedDomandaMultipla->getTesto(), 
                $updatedDomandaMultipla->getPunteggioCorretta(), $updatedDomandaMultipla->getPunteggioErrata(), $updatedDomandaMultipla->getPercentualeScelta(), 
                $updatedDomandaMultipla->getPercentualeRispostaCorretta(), $id);
        Model::getDB()->query($query);
        if(Model::getDB()->affected_rows==-1){
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
        if(Model::getDB()->affected_rows==-1){
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
     * @param int $idArg L'id dell'argomento di cui si vogliono conoscere le domande multiple
     * @return DomandaMultipla[] Tutte le domande multiple di un argomento
     * @throws ApplicationException
     */
    public function getAllDomandaMultiplaByArgomento($idArg) {
        $query = sprintf(self::$GET_ALL_DOMANDA_MULTIPLA_BY_ARGOMENTO, $idArg);
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
      $query = sprintf(self::$CREATE_ALTERNATIVA, $alternativa->getDomandaMultiplaId(), $alternativa->getDomandaMultiplaArgomentoId(), $alternativa->getDomandaMultiplaArgomentoInsegnamentoId(),
              $alternativa->getTesto(), $alternativa->getPercentualeScelta(), $alternativa->getCorretta());
      Model::getDB()->query($query);
      if(Model::getDB()->affected_rows==-1){
            throw new ApplicationException(Error::$INSERIMENTO_FALLITO);
       }
    }

    /**
     * Modifica un'alternativa nel database
     * @param int $id L'id dell'alternativa da modificare
     * @param Alternativa $updatedAlternativa L'alternativa modificata da aggiornare nel database
     * @throws ApplicationException
     */
    public function updateAlternativa($id, $updatedAlternativa) {
        $query = sprintf(self::$UPDATE_ALTERNATIVA, $updatedAlternativa->getDomandaMultiplaId(), $updatedAlternativa->getDomandaMultiplaArgomentoId(), $updatedAlternativa->getDomandaMultiplaArgomentoCorsoId(),
                $updatedAlternativa->getTesto(), $updatedAlternativa->getPercentualeScelta(), $updatedAlternativa->getCorretta(), $id);
        Model::getDB()->query($query);
        if(Model::getDB()->affected_rows==-1){
            throw new ApplicationException(Error::$AGGIORNAMENTO_FALLITO);
        }
    }

    /**
     * Cancella un'alternativa nel database
     * @param int $id L'id dell'alternativa da cancellare
     * @throws ApplicationException
     */
    public function deleteAlternativa($id) {
        $query = sprintf(self::$DELETE_ALTERNATIVA, $id);
        Model::getDB()->query($query);
        if(Model::getDB()->affected_rows==-1){
            throw new ApplicationException(Error::$CANCELLAZIONE_FALLITA);
        }
    }

    /**
     * Cerca una domanda aperta nel database
     * @param int $id L'id della domanda aperta da cercare
     * @return Alternativa L'alternativa trovata
     * @throws ApplicationException
     */
    public function readAlternativa($id) {
        $query = sprintf(self::$READ_ALTERNATIVA, $id);
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
     * @param int $idDom L'id della domanda di cui si vogliono conoscere le alternative
     * @return Altenativa[] Tutte le alternative di una domanda multipla
     * @throws ApplicationException
     */
    public function getAllAlternativaByDomanda($idDom) {
        $res = Model::getDB()->query(self::$GET_ALL_ALTERNATIVA_BY_DOMANDA, $idDom);
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
     * @param int $id Id della domanda multipla di cui si vuoel conoscere l'alternativa corretta
     * @return string $res L'alternativa corretta 
     * @throws ApplicationException
     */
    public function getAlternativaCorrettaByDomanda($id) {
        $query = sprintf(self::$GET_ALTERNATIVA_CORRETTA_BY_DOMANDA, $id);
        $res = Model::getDB()->query($query);
        if ($obj = $res->fetch_assoc()) {
            $alternativa = new Alternativa($obj['id'], $obj['domanda_multipla_id'], $obj['domanda_multipla_argomento_id'], $obj['domanda_multipla_argomento_corso_id'], $obj['testo'], 
                    $obj['percentuale_scelta'], $obj['corretta']);
            return $alternativa;
        }else{
            throw new ApplicationException(Error::$ALTERNATIVA_NON_TROVATA);
        }
    }
}