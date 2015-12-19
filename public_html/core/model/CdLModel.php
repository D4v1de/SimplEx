<?php

/**
 * La classe costuituisce il model che effettua tutte le query riguardanti le funzionalità dei corsi di laurea, interfacciandosi al db al quale è connesso
 *
 * @author Elvira Zanin
 * @version 1.0
 * @since 25/11/15
 */

include_once MODEL_DIR . "Model.php";
include_once BEAN_DIR . "CdL.php";

class CdLModel extends Model {
    private static $CREATE_CDL = "INSERT INTO `cdl` (matricola, nome, tipologia) VALUES ('%s','%s','%s')";
    private static $UPDATE_CDL = "UPDATE `cdl` SET nome = '%s', tipologia = '%s' WHERE matricola = '%s'";
    private static $DELETE_CDL = "DELETE FROM `cdl` WHERE matricola = '%s'";
    private static $READ_CDL = "SELECT * FROM `cdl` WHERE matricola = '%s'";
    private static $GET_ALL_CDLS = "SELECT * FROM `cdl` ORDER BY nome";

    /**
     * Inserisce un nuovo corso di laurea nel database
     * @param CdL $cdl Il corso di laurea da inserire nel database
     * @throws ApplicationException
     */
    public function createCdL($cdl) {
        $query = sprintf(self::$CREATE_CDL, $cdl->getMatricola(), $cdl->getNome(), $cdl->getTipologia());
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$INSERIMENTO_FALLITO);
        }
    }

    /**
     * Modifica un corso di laurea nel database
     * @param string $matricola La matricola del corso di laurea da modificare
     * @param CdL $updatedCdl Il corso di laurea modificato da aggiornare nel db
     * @throws ApplicationException
     */
    public function updateCdL($matricola, $updatedCdl) {
        $query = sprintf(self::$UPDATE_CDL, $updatedCdl->getNome(), $updatedCdl->getTipologia(), $matricola);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows==-1) {
            throw new ApplicationException(Error::$AGGIORNAMENTO_FALLITO);
        }
    }

    /**
     * Cancella un corso di laurea nel database
     * @param string $matricola La matricola del corso di laurea da eliminare
     * @throws ApplicationException
     */
    public function deleteCdL($matricola) {
        $query = sprintf(self::$DELETE_CDL, $matricola);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows==-1) {
            throw new ApplicationException(Error::$CANCELLAZIONE_FALLITA);
        }
    }

    /**
     * Cerca un corso di laurea nel database
     * @param string $matricola La matricola del corso di laurea da cercare
     * @throws ApplicationException
     */
    public function readCdL($matricola) {
        $query = sprintf(self::$READ_CDL, $matricola);
        $res = Model::getDB()->query($query);
        if ($obj = $res->fetch_assoc()) {
            $cdl = new CdL($obj['matricola'], $obj['nome'], $obj['tipologia']);
            return $cdl;
        }
        else{
             throw new ApplicationException(Error::$CDL_NON_TROVATO);
        }
    }

    /**
     * Restituisce tutti i corsi di laurea del database
     * @return CdL[] Tutti i corsi di laurea del database
     */
    public function getAllCdL() {
        $res = Model::getDB()->query(self::$GET_ALL_CDLS);
        $cdls = array();
        if($res){
            while ($obj = $res->fetch_assoc()) {
                $cdls[] = new CdL($obj['matricola'], $obj['nome'], $obj['tipologia']);
            }
        }
        return $cdls;
    }
}