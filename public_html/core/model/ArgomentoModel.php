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
            . " VALUES ('%d','%s','%f','%f','%d','%d','%s')";
    private static $UPDATE_DOMANDA_APERTA = "UPDATE 'domanda_aperta' SET id = '%d', testo = '%s', punteggio_max = '%f', percentuale_scelta = '%f', "
            . "argomento_id = '%d', argomento_insegnamento_id = '%d', argomento_insegnamento_corso_matricola = '%s' WHERE id = '%d'";
    private static $DELETE_DOMANDA_APERTA = "DELETE FROM 'domanda_aperta' where id = '%d'";
    private static $READ_DOMANDA_APERTA = "SELECT * FROM 'domanda_aperta' where id = '%d'";
    private static $GET_ALL_DOMANDA_APERTA = "SELECT * FROM 'domanda_aperta'";
    private static $CREATE_DOMANDA_MULTIPLA = "INSERT INTO 'domanda_multipla' (id, testo, punteggio_corretta, punteggio_errata, percentuale_scelta, percentuale_risposta_corretta,alternativa_corretta, argomento_id, argomento_insegnamento_id,argomento_insegnamento_corso_matricola) "
            . "VALUES ('%d','%s','%f','%f','%f','%f','%d','%d','%d','%s')";
    private static $UPDATE_DOMANDA_MULTIPLA = "UPDATE 'domanda_multipla' SET id = '%d', testo = '%s', punteggio_corretta = '%f', punteggio_errata = '%f', percentuale_scelta = '%f', percentuale_risposta_corretta = '%f',alternativa_corretta = '%d', argomento_id = '%d',"
            . " argomento_insegnamento_id = '%d',argomento_insegnamento_corso_matricola = '%s' WHERE id = '%d'";
    private static $DELETE_DOMANDA_MULTIPLA = "DELETE FROM 'domanda_multipla' where id = '%d'";
    private static $READ_DOMANDA_MULTIPLA = "SELECT * FROM 'domanda_multipla' where id = '%d'";
    private static $GET_ALL_DOMANDA_MULTIPLA = "SELECT * FROM 'domanda_multipla'";
    private static $CREATE_ALTERNATIVA = "INSERT INTO 'alternativa' (id, testo, percentuale_scelta, domanda_multipla_id, domanda_multipla_argomento_id, domanda_multipla_argomento_insegnamento_id,domanda_multipla_argomento_insegnamento_corso_matricola)"
            . " VALUES ('%d','%s','%f','%d','%d','%d','%s')";
    private static $UPDATE_ALTERNATIVA = "UPDATE 'alternativa' SET id = '%d', testo = '%s', percentuale_scelta = '%f', domanda_multipla_id = '%d', domanda_multipla_argomento_id = '%d', domanda_multipla_argomento_insegnamento_id = '%d',domanda_multipla_argomento_insegnamento_corso_matricola = '%d'"
            . " WHERE id = '%d'";
    private static $DELETE_ALTERNATIVA = "DELETE FROM 'alternativa' where id = '%d'";
    private static $READ_ALTERNATIVA = "SELECT * FROM 'alternativa' where id = '%d'";
    private static $GET_ALL_ALTERNATIVA = "SELECT * FROM 'alternativa'";
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
     */
    public function readArgomento($id){
        $query = sprintf(self::$READ_ARGOMENTO, $id);
        $res = Model::getDB()->query($query);
        if($res) {
            $argomento = new Argomento($res->fetch_assoc()['id'],$res->fetch_assoc()['nome'],$res->fetch_assoc()['insegnamentoId'],$res->fetch_assoc()['insegnamentoCorsoMatricola']);
            return $argomento;
        }
    }
    
    /**
     * Restituisce tutti il CdL del database
     * @return CdL[] cdls Tutti i CdL del database
     */
    public function getAllArgomento() {
        $res = Model::getDB()->query(self::$GET_ALL_ARGOMENTO);
        if($res) {
            for($i = 0; $i < $res->num_rows; ++$i){
                $argomento[] = new Argomento($res->fetch_assoc()['id'],$res->fetch_assoc()['nome'],$res->fetch_assoc()['insegnamentoId'],$res->fetch_assoc()['insegnamentoCorsoMatricola']);
            }
            return $argomento[];
        }
    } 
}