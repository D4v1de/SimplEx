<?php

/**
 * La classe costituisce il model che effettua tutte le query riguardanti le funzionalità legate ai contatti di un utente, interfacciandosi al db al quale è connesso
 *
 * @author Elvira Zanin
 * @version 1.0
 * @since 02/12/15
 */

include_once MODEL_DIR . "Model.php";
include_once BEAN_DIR . "Contatto.php";

class ContattoModel extends Model {
    private static $CREATE_CONTATTO = "INSERT INTO `contatto` (valore, tipologia, utente_matricola) VALUES ('%s','%s','%s')";
    private static $UPDATE_CONTATTO = "UPDATE `contatto` SET valore = '%s', tipologia = '%s' , utente_matricola = '%s' WHERE id = '%d'";
    private static $DELETE_CONTATTO = "DELETE FROM `contatto` WHERE id = '%d'";
    private static $READ_CONTATTO = "SELECT * FROM `contatto` WHERE id = '%d'";
    private static $GET_ALL_CONTATTI = "SELECT * FROM `contatto`";
    private static $GET_ALL_CONTATTI_UTENTE = "SELECT * FROM `contatto` WHERE utente_matricola = '%s'";
    
    /**
     * Inserisce un nuovo contatto nel database
     * @param Contatto $contatto Il contatto da inserire nel database
     * @throws ApplicationException
     */
    public function createContatto($contatto){
        $query = sprintf(self::$CREATE_CONTATTO, $contatto->getValore(), $contatto->getTipologia(), $contatto->getUtenteMatricola());
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows==-1) {
            throw new ApplicationException(Error::$INSERIMENTO_FALLITO);
        }else{
            return Model::getDB()->insert_id;
        }
    }
    
    /**
     * Modifica un contatto nel database
     * @param int $id L'id del contatto da modificare
     * @param Contatto $updatedContatto Il contatto modificato da aggiornare nel database
     * @throws ApplicationException
     */
    public function updateContatto($id,$updatedContatto){
        $query = sprintf(self::$UPDATE_CONTATTO, $updatedContatto->getValore(), $updatedContatto->getTipologia(), $updatedContatto->getUtenteMatricola(), $id);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows==-1) {
            throw new ApplicationException(Error::$AGGIORNAMENTO_FALLITO);
        }
    }
    
    /**
     * Cancella un contatto nel database
     * @param int $id L'id del contatto da eliminare
     * @throws ApplicationException
     */
    public function deleteContatto($id){
        $query = sprintf(self::$DELETE_CONTATTO, $id);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows==-1) {
            throw new ApplicationException(Error::$CANCELLAZIONE_FALLITA);
        }
    }
    
    /**
     * Cerca un contatto nel database
     * @param int $id L'id del contatto da cercare
     * @return Il contatto trovato
     * @throws ApplicationException
     */
    public function readContatto($id){
        $query = sprintf(self::$READ_CONTATTO, $id);
        $res = Model::getDB()->query($query);
        if($obj = $res->fetch_assoc()) {
            $contatto = new Contatto( $obj['valore'], $obj['tipologia'], $obj['utente_matricola']);
            $contatto->setId($obj['id']);
            return $contatto;
        }
        else{
            throw new ApplicationException(Error::$CONTATTO_NON_TROVATO); 
        }
    }
    
    /**
     * Restituisce tutti i contatti del database
     * @return Contatto[] Tutti i contatti del database
     */
    public function getAllContatti() {
        $res = Model::getDB()->query(self::$GET_ALL_CONTATTI);
        $contatti = array();
        if($res){
            while ($obj = $res->fetch_assoc()) {
                $contatto = new Contatto($obj['valore'], $obj['tipologia'], $obj['utente_matricola']);
                $contatto->setId($obj['id']);
                $contatti[] = $contatto;
            }
        }
        return $contatti;
    } 
    
    /**
     * Restituisce tutti i contatti di un utente del database
     * @param string $utente_matricola La matricola dell'utente di cui si vogliono conoscere i contatti
     * @return Contatto[] Tutti i contatti di un utente del database
     */
    public function getAllContattiByUtente($utente_matricola) {
        $query = sprintf(self::$GET_ALL_CONTATTI_UTENTE, $utente_matricola);
        $res = Model::getDB()->query($query);
        $contatti = array();
        if($res){
            while ($obj = $res->fetch_assoc()) {
                $contatto = new Contatto($obj['valore'], $obj['tipologia'], $obj['utente_matricola']);
                $contatto->setId($obj['id']);
                $contatti[] = $contatto;
            }
        }
        return $contatti;
    }
}
