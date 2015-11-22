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
     * @param Argomento da inserire nel database
     */
    public function createArgomento($Argomento){
        $query = sprintf(self::$CREATE_ARGOMENTO, $Argomento->id, $Argomento->nome, $Argomento->insegnamentoId, $Argomento->insegnamentoCorsoMatricola);
        $res = Model::getDB()->query($query);
    }
    
   /**
    * Modifica un Argomento nel database
    * @param int $id
    * @param Argomento $updatedArgomento
    */
    public function updateArgomento($id,$updatedArgomento){
        $query = sprintf(self::$UPDATE_ARGOMENTO, $updatedArgomento->id, $updatedArgomento->nome, $updatedArgomento->insegnamentoId, $id);
        $res = Model::getDB()->query($query);
    }
    
    /**
     * Cancella un Argomento nel database
     * @param int $id
     */
    public function deleteArgomento($id){
        $query = sprintf(self::$DELETE_ARGOMENTO, $id);
        $res = Model::getDB()->query($query);
    }
    
    /**
     * Cerca un Argomento nel database
     * @param int $id
     * @return \Argomento
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
    * @return \Argomento
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
     * @param DomandaAperta da inserire nel database
     */
    public function createDomandaAperta($DomandaAperta){
        $query = sprintf(self::$CREATE_DOMANDA_APERTA, $DomandaAperta->testo, $DomandaAperta->punteggioMax, $DomandaAperta->percentualeScelta, $DomandaAperta->argomentoId, $DomandaAperta->argomentoInsegnamentoId,$DomandaAperta->argomentoInsegnamentoCorsoMatricola );
        $res = Model::getDB()->query($query);
    }
    
   /**
    * Modifica una DomandaAperta nel database
    * @param int $id
    * @param DomandaAperta $updatedDomandaAperta
    */
    public function updateDomandaAperta($id,$updatedDomandaAperta){
        $query = sprintf(self::$UPDATE_DOMANDA_APERTA, $updatedDomandaAperta->id, $updatedDomandaAperta->testo, $updatedDomandaAperta->punteggioMax,$updatedDomandaAperta->percentualeScelta,$updatedDomandaAperta->argomentoId, $updatedDomandaAperta->argomentoInsegnamentoId,$updatedDomandaAperta->argomentoInsegnamentoCorsoMatricola, $id);
        $res = Model::getDB()->query($query);
    }
    
    /**
     * Cancella una DomandaAperta nel database
     * @param int $id
     */
    public function deleteDomandaAperta($id){
        $query = sprintf(self::$DELETE_DOMANDA_APERTA, $id);
        $res = Model::getDB()->query($query);
    }
    
    /**
     * Cerca una domandaAperta nel database
     * @param int $id
     * @return \DomandaAperta
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
    * @return \DomandaAperta
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
     * @param DomandaMultipla da inserire nel database
     */
    public function createDomandaMultipla($DomandaMultipla){
        $query = sprintf(self::$CREATE_DOMANDA_MULTIPLA, $DomandaMultipla->testo, $DomandaMultipla->punteggioCorretta, $DomandaMultipla->punteggioErrata,$DomandaMultipla->percentualeScelta, $DomandaMultipla->percentualeRispostaCorretta,$DomandaMultipla->alternativaCorretta,
                $DomandaMultipla->argomentoId, $DomandaMultipla->argomentoInsegnamentoId,$DomandaMultipla->argomentoInsegnamentoCorsoMatricola);
        $res = Model::getDB()->query($query);
    }
    
   /**
    * Modifica una DomandaMultipla nel database
    * @param int $id
    * @param DomandaMultipla $updatedDomandaMultipla
    */
    public function updateDomandaMultipla($id,$updatedDomandaMultipla){
        $query = sprintf(self::$UPDATE_DOMANDA_APERTA, $updatedDomandaMultipla->id, $updatedDomandaMultipla->testo, $updatedDomandaMultipla->punteggioCorretta, $updatedDomandaMultipla->punteggioErrata,$updatedDomandaMultipla->percentualeScelta, $updatedDomandaMultipla->percentualeRispostaCorretta,
                $updatedDomandaMultipla->alternativaCorretta,$updatedDomandaMultipla->argomentoId, $updatedDomandaMultipla->argomentoInsegnamentoId,$updatedDomandaMultipla->argomentoInsegnamentoCorsoMatricola, $id);
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
        $query = sprintf(self::$CREATE_ALTERNATIVA, $Alternativa->testo,$Alternativa->percentualeScelta,$Alternativa->domandaMultiplaId, $Alternativa->domandaMultiplaArgomentoId, $Alternativa->domandaMultiplaArgomentoInsegnamentoId, $Alternativa->domandaMultiplaArgomentoInsegnamentoCorsoMatricola);
        $res = Model::getDB()->query($query);
    }
    
   /**
    * Modifica una Alternativa nel database
    * @param int $id
    * @param Alternativa $updatedAlternativa
    */
    public function updateAlternativa($id,$updatedAlternativa){
        $query = sprintf(self::$UPDATE_ALTERNATIVA, $updatedAlternativa->id,$updatedAlternativa->testo,$updatedAlternativa->percentualeScelta,$updatedAlternativa->domandaMultiplaId, $updatedAlternativa->domandaMultiplaArgomentoId, $updatedAlternativa->domandaMultiplaArgomentoInsegnamentoId, $updatedAlternativa->domandaMultiplaArgomentoInsegnamentoCorsoMatricola, $id);
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
    
    
}