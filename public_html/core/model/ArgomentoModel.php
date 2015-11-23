<?php

/**
 * User: Alina
 * Date: 21/11/15
 * Time: 18:00
 */
include_once MODEL_DIR . "Model.php";
include_once BEAN_DIR . "Argomento.php";
include_once BEAN_DIR . "DomandaAperta.php";
include_once BEAN_DIR . "DomandaMultipla.php";
include_once BEAN_DIR . "Alternativa.php";

class ArgomentoModel extends Model {
    private static $CREATE_ARGOMENTO = "INSERT INTO 'argomento' (id, nome, insegnamento_id, insegnamento_corso_matricola) VALUES ('%d','%s','%d','%s')";
    private static $UPDATE_ARGOMENTO = "UPDATE 'argomento' SET id = '%d', nome = '%s', insegnamento_id = '%d', insegnamento_corso_matricola = '%s' WHERE id = '%d'";
    private static $DELETE_ARGOMENTO = "DELETE FROM 'argomento' where id = '%d'";
    private static $READ_ARGOMENTO = "SELECT * FROM 'argomento' where id = '%d'";
    private static $GET_ALL_ARGOMENTO = "SELECT * FROM 'argomento'";
    private static $CREATE_DOMANDA_APERTA = "INSERT INTO 'domanda_aperta' (id, testo, punteggio_max, percentuale_scelta, argomento_id, argomento_insegnamento_id, argomento_insegnamento_corso_matricola)"
            . " VALUES (NULL,'%s','%f','%f','%d','%d','%s')";
    private static $UPDATE_DOMANDA_APERTA = "UPDATE 'domanda_aperta' SET id = '%d', testo = '%s', punteggio_max = '%f', percentuale_scelta = '%f', "
            . "argomento_id = '%d', argomento_insegnamento_id = '%d', argomento_insegnamento_corso_matricola = '%s' WHERE id = '%d'";
    private static $DELETE_DOMANDA_APERTA = "DELETE FROM 'domanda_aperta' where id = '%d'";
    private static $READ_DOMANDA_APERTA = "SELECT * FROM 'domanda_aperta' where id = '%d'";
    private static $GET_ALL_DOMANDA_APERTA = "SELECT * FROM 'domanda_aperta'";
    private static $CREATE_DOMANDA_MULTIPLA = "INSERT INTO 'domanda_multipla' (id, testo, punteggio_corretta, punteggio_errata, percentuale_scelta, percentuale_risposta_corretta,alternativa_corretta, argomento_id, argomento_insegnamento_id,argomento_insegnamento_corso_matricola) "
            . "VALUES (NULL,'%s','%f','%f','%f','%f','%d','%d','%d','%s')";
    private static $UPDATE_DOMANDA_MULTIPLA = "UPDATE 'domanda_multipla' SET id = '%d', testo = '%s', punteggio_corretta = '%f', punteggio_errata = '%f', percentuale_scelta = '%f', percentuale_risposta_corretta = '%f',alternativa_corretta = '%d', argomento_id = '%d',"
            . " argomento_insegnamento_id = '%d',argomento_insegnamento_corso_matricola = '%s' WHERE id = '%d'";
    private static $DELETE_DOMANDA_MULTIPLA = "DELETE FROM 'domanda_multipla' where id = '%d'";
    private static $READ_DOMANDA_MULTIPLA = "SELECT * FROM 'domanda_multipla' where id = '%d'";
    private static $GET_ALL_DOMANDA_MULTIPLA = "SELECT * FROM 'domanda_multipla'";
    private static $CREATE_ALTERNATIVA = "INSERT INTO 'alternativa' (id, testo, percentuale_scelta, domanda_multipla_id, domanda_multipla_argomento_id, domanda_multipla_argomento_insegnamento_id,domanda_multipla_argomento_insegnamento_corso_matricola)"
            . " VALUES (NULL,'%s','%f','%d','%d','%d','%s')";
    private static $UPDATE_ALTERNATIVA = "UPDATE 'alternativa' SET id = '%d', testo = '%s', percentuale_scelta = '%f', domanda_multipla_id = '%d', domanda_multipla_argomento_id = '%d', domanda_multipla_argomento_insegnamento_id = '%d',domanda_multipla_argomento_insegnamento_corso_matricola = '%d'"
            . " WHERE id = '%d'";
    private static $DELETE_ALTERNATIVA = "DELETE FROM 'alternativa' where id = '%d'";
    private static $READ_ALTERNATIVA = "SELECT * FROM 'alternativa' where id = '%d'";
    private static $GET_ALL_ALTERNATIVA = "SELECT * FROM 'alternativa'";
    
    //Da RIVEDERE
    private static $GET_ALL_DOMANDA_APERTA_BY_ARGOMENTO = "SELECT * FROM 'domanda_aperta' WHERE argomento_id = '%d'";
    private static $GET_ALL_DOMANDA_MULTIPLA_BY_ARGOMENTO = "SELECT * FROM 'domanda_multipla' WHERE argomento_id = '%d'";
    private static $GET_ALL_ALTERNATIVA_BY_DOMANDA = "SELECT * FROM 'alternativa' WHERE domanda_multipla_id = '%d'";
    
    /**
     * Inserisce un nuovo Argomento nel database
     * @param Argomento Argomento da inserire nel database
     */
    public function createArgomento($Argomento){
        $query = sprintf(self::$CREATE_ARGOMENTO, $Argomento->getId(), $Argomento->getNome(), $Argomento->getInsegnamentoId(), $Argomento->getInsegnamentoCorsoMatricola());
        $res = Model::getDB()->query($query);
    }
    
   /**
    * Modifica un Argomento nel database
    * @param int $id id dell' argomento da aggiornare
    * @param Argomento $updatedArgomento Argomento modificato da aggiornare nel database
    */
    public function updateArgomento($id,$updatedArgomento){
        $query = sprintf(self::$UPDATE_ARGOMENTO, $updatedArgomento->getId(), $updatedArgomento->getNome(), $updatedArgomento->getInsegnamentoId(), $id);
        $res = Model::getDB()->query($query);
    }
    
    /**
     * Cancella un Argomento nel database
     * @param int $id Id dell'argomento da cancellare
     */
    public function deleteArgomento($id){
        $query = sprintf(self::$DELETE_ARGOMENTO, $id);
        $res = Model::getDB()->query($query);
    }
    
    /**
     * Cerca un Argomento nel database
     * @param int $id Id dell'argomento da cercare
     * @return \Argomento Argomento da cercare
     */
    public function readArgomento($id){
        $query = sprintf(self::$READ_ARGOMENTO, $id);
        $res = Model::getDB()->query($query);
        if($res) {
            $argomento = new Argomento($res->fetch_assoc()['id'],$res->fetch_assoc()['nome'],$res->fetch_assoc()['insegnamento_id'],$res->fetch_assoc()['insegnamento_corso_matricola']);
            return $argomento;
        }
    }
    
   /**
    * Restituisce tutti gli Argomenti del database
    * @return \Argomento Array di tutti argomenti del database
    */
    public function getAllArgomento() {
        $res = Model::getDB()->query(self::$GET_ALL_ARGOMENTO);
        if($res) {
            for($i = 0; $i < $res->num_rows; ++$i){
                $argomento[] = new Argomento($res->fetch_assoc()['id'],$res->fetch_assoc()['nome'],$res->fetch_assoc()['insegnamento_id'],$res->fetch_assoc()['insegnamento_corso_matricola']);
            }
            return $argomento[];
        }
    } 
    
    /**
     * Inserisce una nuova DomandaAperta nel database
     * @param DomandaAperta Domanda aperta da inserire nel database
     */
    public function createDomandaAperta($DomandaAperta){
        $query = sprintf(self::$CREATE_DOMANDA_APERTA, $DomandaAperta->getTesto(), $DomandaAperta->getPunteggioMax(), $DomandaAperta->getPercentualeScelta(), $DomandaAperta->getArgomentoId(), $DomandaAperta->getArgomentoInsegnamentoId(),$DomandaAperta->getArgomentoInsegnamentoCorsoMatricola());
        $res = Model::getDB()->query($query);
    }
    
   /**
    * Modifica una DomandaAperta nel database
    * @param int $id della domanda aperta da modificare
    * @param DomandaAperta $updatedDomandaAperta domanda aperta aggiornata da modificare nel database
    */
    public function updateDomandaAperta($id,$updatedDomandaAperta){
        $query = sprintf(self::$UPDATE_DOMANDA_APERTA, $updatedDomandaAperta->getId(), $updatedDomandaAperta->getTesto(), $updatedDomandaAperta->getPunteggioMax(),$updatedDomandaAperta->getPercentualeScelta(),$updatedDomandaAperta->getArgomentoId(), $updatedDomandaAperta->getArgomentoInsegnamentoId(),$updatedDomandaAperta->getArgomentoInsegnamentoCorsoMatricola(), $id);
        $res = Model::getDB()->query($query);
    }
    
    /**
     * Cancella una DomandaAperta nel database
     * @param int $id Id della domanda aperta da cancellare
     */
    public function deleteDomandaAperta($id){
        $query = sprintf(self::$DELETE_DOMANDA_APERTA, $id);
        $res = Model::getDB()->query($query);
    }
    
    /**
     * Cerca una domandaAperta nel database
     * @param int $id Id della domanda aperta da cercare
     * @return \DomandaAperta Domanda aperta cercata nel database
     */
    public function readDomandaAperta($id){
        $query = sprintf(self::$READ_DOMANDA_APERTA, $id);
        $res = Model::getDB()->query($query);
        if($res) {
            $domandaAperta = new DomandaAperta($res->fetch_assoc()['id'],$res->fetch_assoc()['testo'],$res->fetch_assoc()['punteggio_max'],$res->fetch_assoc()['percentule_scelta'],$res->fetch_assoc()['argomento_id'],$res->fetch_assoc()['argomento_insegnamento_id'],$res->fetch_assoc()['argomento_insegnamento_corso_matricola']);
            return $domandaAperta;
        }
    }
    
   /**
    * Restituisce tutte le domande aperte del database
    * @return \DomandaAperta Array di tutte le domande aperte del database
    */
    public function getAllDomandaAperta() {
        $res = Model::getDB()->query(self::$GET_ALL_DOMANDA_APERTA);
        if($res) {
            for($i = 0; $i < $res->num_rows; ++$i){
                $domandaAperta[] = new DomandaAperta($res->fetch_assoc()['id'],$res->fetch_assoc()['testo'],$res->fetch_assoc()['punteggio_max'],$res->fetch_assoc()['percentule_scelta'],$res->fetch_assoc()['argomento_id'],$res->fetch_assoc()['argomento_insegnamento_id'],$res->fetch_assoc()['argomento_insegnamento_corso_matricola']);
            }
            return $domandaAperta[];
        }
    } 
    
    /**
     * Inserisce una nuova DomandaMultipla nel database
     * @param DomandaMultipla Domanda Multipla da inserire nel database
     */
    public function createDomandaMultipla($DomandaMultipla){
        $query = sprintf(self::$CREATE_DOMANDA_MULTIPLA, $DomandaMultipla->getTesto(), $DomandaMultipla->getPunteggioCorretta(), $DomandaMultipla->getPunteggioErrata(),$DomandaMultipla->getPercentualeScelta(), $DomandaMultipla->getPercentualeRispostaCorretta(),$DomandaMultipla->getAlternativaCorretta(),
                $DomandaMultipla->getArgomentoId(), $DomandaMultipla->getArgomentoInsegnamentoId(),$DomandaMultipla->getArgomentoInsegnamentoCorsoMatricola());
        $res = Model::getDB()->query($query);
    }
    
   /**
    * Modifica una DomandaMultipla nel database
    * @param int $id Id della domanda multipla da aggiornare
    * @param DomandaMultipla $updatedDomandaMultipla Domanda multipla aggiornata da modificare nel database
    */
    public function updateDomandaMultipla($id,$updatedDomandaMultipla){
        $query = sprintf(self::$UPDATE_DOMANDA_APERTA, $updatedDomandaMultipla->getId(), $updatedDomandaMultipla->getTesto(), $updatedDomandaMultipla->getPunteggioCorretta(), $updatedDomandaMultipla->getPunteggioErrata(),$updatedDomandaMultipla->getPercentualeScelta(), $updatedDomandaMultipla->getPercentualeRispostaCorretta(),
                $updatedDomandaMultipla->getAlternativaCorretta(),$updatedDomandaMultipla->getArgomentoId(), $updatedDomandaMultipla->getArgomentoInsegnamentoId(),$updatedDomandaMultipla->getArgomentoInsegnamentoCorsoMatricola(), $id);
        $res = Model::getDB()->query($query);
    }
    
    /**
     * Cancella una DomandaMultipla nel database
     * @param int $id
     */
    public function deleteDomandaMultipla($id){
        $query = sprintf(self::$DELETE_DOMANDA_MULTIPLA, $id);
        $res = Model::getDB()->query($query);
    }
    
    /**
     * Cerca una domandaMultipla nel database
     * @param int $id
     * @return \DomandaMultipla
     */
    public function readDomandaMultipla($id){
        $query = sprintf(self::$READ_DOMANDA_MULTIPLA, $id);
        $res = Model::getDB()->query($query);
        if($res) {
            $domandaMultipla = new DomandaMultipla($res->fetch_assoc()['id'],$res->fetch_assoc()['testo'],$res->fetch_assoc()['punteggio_corretta'],$res->fetch_assoc()['punteggio_errata'],$res->fetch_assoc()['percentuale_scelta'],
                    $res->fetch_assoc()['percentuale_risposta_corretta'],$res->fetch_assoc()['alternativa_corretta'],$res->fetch_assoc()['argomento_id'],$res->fetch_assoc()['argomento_insegnamento_id'],$res->fetch_assoc()['argomento_insegnamento_corso_matricola']);
            return $domandaMultipla;
        }
    }
    
   /**
    * Restituisce tutte le domande multiple del database
    * @return \DomandaMultipla
    */
    public function getAllDomandaMultipla() {
        $res = Model::getDB()->query(self::$GET_ALL_DOMANDA_MULTIPLA);
        if($res) {
            for($i = 0; $i < $res->num_rows; ++$i){
                $domandaMultipla[] = new DomandaMultipla($res->fetch_assoc()['id'],$res->fetch_assoc()['testo'],$res->fetch_assoc()['punteggio_corretta'],$res->fetch_assoc()['punteggio_errata'],$res->fetch_assoc()['percentuale_scelta'],
                    $res->fetch_assoc()['percentuale_risposta_corretta'],$res->fetch_assoc()['alternativa_corretta'],$res->fetch_assoc()['argomento_id'],$res->fetch_assoc()['argomento_insegnamento_id'],$res->fetch_assoc()['argomento_insegnamento_corso_matricola']);
            }
            return $domandaMultipla[];
        }
    } 
    
    /**
     * Inserisce una nuova alternativa nel database
     * @param Alternativa $Alternativa
     */
    public function createAlternativa($Alternativa){
        $query = sprintf(self::$CREATE_ALTERNATIVA, $Alternativa->getTesto(),$Alternativa->getPercentualeScelta(),$Alternativa->getDomandaMultiplaId(), $Alternativa->getDomandaMultiplaArgomentoId(), $Alternativa->getDomandaMultiplaArgomentoInsegnamentoId(), $Alternativa->getDomandaMultiplaArgomentoInsegnamentoCorsoMatricola());
        $res = Model::getDB()->query($query);
    }
    
   /**
    * Modifica una Alternativa nel database
    * @param int $id
    * @param Alternativa $updatedAlternativa
    */
    public function updateAlternativa($id,$updatedAlternativa){
        $query = sprintf(self::$UPDATE_ALTERNATIVA, $updatedAlternativa->getId(),$updatedAlternativa->getTesto(),$updatedAlternativa->getPercentualeScelta(),$updatedAlternativa->getDomandaMultiplaId(), $updatedAlternativa->getDomandaMultiplaArgomentoId(), $updatedAlternativa->getDomandaMultiplaArgomentoInsegnamentoId(), $updatedAlternativa->getDomandaMultiplaArgomentoInsegnamentoCorsoMatricola(), $id);
        $res = Model::getDB()->query($query);
    }
    
    /**
     * Cancella una Alternativa nel database
     * @param int $id
     */
    public function deleteAlternativa($id){
        $query = sprintf(self::$DELETE_ALTERNATIVA, $id);
        $res = Model::getDB()->query($query);
    }
    
    /**
     * Cerca una domandaAperta nel database
     * @param int $id
     * @return \Alternativa
     */
    public function readAlternativa($id){
        $query = sprintf(self::$READ_ALTERNATIVA, $id);
        $res = Model::getDB()->query($query);
        if($res) {
            $alternativa = new Alternativa($res->fetch_assoc()['id'],$res->fetch_assoc()['testo'],$res->fetch_assoc()['percentuale_scelta'],$res->fetch_assoc()['domanda_multipla_id'],$res->fetch_assoc()['domanda_multipla_argomento_id'],$res->fetch_assoc()['domanda_multipla_argomento_insegnamento_id'],$res->fetch_assoc()['domanda_multipla_argomento_insegnamento_corso_matricola']);
            return $alternativa;
        }
    }
    
  /**
   * Restituisce tutte le alternative del database
   * @return \Alternativa
   */
    public function getAllAlternativa() {
        $res = Model::getDB()->query(self::$GET_ALL_ALTERNATIVA);
        if($res) {
            for($i = 0; $i < $res->num_rows; ++$i){
                $alternativa[] = new Altenativa($res->fetch_assoc()['id'],$res->fetch_assoc()['testo'],$res->fetch_assoc()['percentuale_scelta'],$res->fetch_assoc()['domanda_multipla_id'],$res->fetch_assoc()['domanda_multipla_argomento_id'],$res->fetch_assoc()['domanda_multipla_argomento_insegnamento_id'],$res->fetch_assoc()['domanda_multipla_argomento_insegnamento_corso_matricola']);
            }
            return $alternativa[];
        }
    } 
    
    /**
     * Restituisce un array con tutte le domande aperte di un argomento
     * @param int $id
     * @return \DomandaAperta 
     */
    
     public function getAllDomandaApertaByArgomento($idArg){
        $query = sprintf(self::$GET_ALL_DOMANDA_APERTA_BY_ARGOMENTO, $idArg);
        $res = Model::getDB()->query($query);
        if($res) {
            for($i = 0; $i < $res->num_rows; ++$i){
                $domandaApertaArg[] = new DomandaAperta($res->fetch_assoc()['id'],$res->fetch_assoc()['testo'],$res->fetch_assoc()['punteggio_max'],$res->fetch_assoc()['percentule_scelta'],$res->fetch_assoc()['argomento_id'],$res->fetch_assoc()['argomento_insegnamento_id'],$res->fetch_assoc()['argomento_insegnamento_corso_matricola']);
            }
            return $domandaApertaArg[];
        }
    }
    
    /**
     * Restituisce un array con tutte le domande multiple di un argomento
     * @param int $idArg
     * @return \DomandaMultipla
     */
    
    public function getAllDomandaMultiplaByArgomento($idArg){
        $query = sprintf(self::$GET_ALL_DOMANDA_MULTIPLA_BY_ARGOMENTO, $idArg);
        $res = Model::getDB()->query($query);
         if($res) {
            for($i = 0; $i < $res->num_rows; ++$i){
                $domandaMultipla[] = new DomandaMultipla($res->fetch_assoc()['id'],$res->fetch_assoc()['testo'],$res->fetch_assoc()['punteggio_corretta'],$res->fetch_assoc()['punteggio_errata'],$res->fetch_assoc()['percentuale_scelta'],
                    $res->fetch_assoc()['percentuale_risposta_corretta'],$res->fetch_assoc()['alternativa_corretta'],$res->fetch_assoc()['argomento_id'],$res->fetch_assoc()['argomento_insegnamento_id'],$res->fetch_assoc()['argomento_insegnamento_corso_matricola']);
            }
            return $domandaMultipla[];
        }
    }

    /**
     * Restituisce tutte le alternative di una domanda multipla
     * @param int $idDom
     * @return \Altenativa
     */
    
    public function getAllAlternativaByDomanda($idDom) {
        $res = Model::getDB()->query(self::$GET_ALL_ALTERNATIVA_BY_DOMANDA, $idDom);
        if($res) {
            for($i = 0; $i < $res->num_rows; ++$i){
                $alternativa[] = new Altenativa($res->fetch_assoc()['id'],$res->fetch_assoc()['testo'],$res->fetch_assoc()['percentuale_scelta'],$res->fetch_assoc()['domanda_multipla_id'],$res->fetch_assoc()['domanda_multipla_argomento_id'],$res->fetch_assoc()['domanda_multipla_argomento_insegnamento_id'],$res->fetch_assoc()['domanda_multipla_argomento_insegnamento_corso_matricola']);
            }
            return $alternativa[];
        }
    }
    
    
}