<?php

/**
 * Created by PhpStorm.
 * User: Elvira
 * Date: 21/11/15
 * Time: 15:00
 */
include_once MODEL_DIR . "Model.php";
include_once BEAN_DIR . "CdL.php";

class CdLModel extends Model {
    private static $CREATE_CDL = "INSERT INTO 'cdl' (matricola, nome, tipologia) VALUES ('%s',%s,%s)";
    private static $UPDATE_CDL = "UPDATE 'cdl' SET matricola = '%s', nome = '%s', tipologia = '%s' WHERE matricola = '%s'";
    private static $DELETE_CDL = "DELETE FROM 'cdl' where matricola = '%s'";
    private static $READ_CDL = "SELECT * FROM 'cdl' where matricola = '%s'";
    private static $GET_ALL_CDLS = "SELECT * FROM 'cdl'";
    
    /**
     * Inserisce un nuovo CdL nel database
     * @param cdl CdL il cDl da inserire nel database
     */
    public function createCdL($CdL){
        $query = sprintf(self::$CREATE_CDL, $CdL->matricola, $CdL->nome, $CdL->tipologia);
        $res = Model::getDB()->query($query);
    }
    
    /**
     * Modifica un CdL nel database
     * @param string matricola La matricola del CdL da modificare
     * @param cdl CdL il cDl da modificare
     */
    public function updateCdL($matricola,$updatedCdL){
        $query = sprintf(self::$UPDATE_CDL, $updatedCdL->matricola, $updatedCdL->nome, $updatedCdL->tipologia, $matricola);
        $res = Model::getDB()->query($query);
    }
    
    /**
     * Cancella un CdL nel database
     * @param string matricola La matricola del CdL da eliminare
     */
    public function deleteCdL($matricola){
        $query = sprintf(self::$DELETE_CDL, $matricola);
        $res = Model::getDB()->query($query);
    }
    
    /**
     * Cerca un CdL nel database
     * @param string matricola la matricola del CdL da cercare
     */
    public function readCdL($matricola){
        $query = sprintf(self::$READ_CDL, $matricola);
        $res = Model::getDB()->query($query);
        if($res) {
            $cdl = new CdL($res->fetch_assoc()['matricola'],$res->fetch_assoc()['nome'],$res->fetch_assoc()['tipologia']);
            return $cdl;
        }
    }
    
    /**
     * Restituisce tutti il CdL del database
     * @return CdL[] cdls Tutti i CdL del database
     */
    public function getAllCdL() {
        $res = Model::getDB()->query(self::$GET_ALL_CDLS);
        if($res) {
            for($i = 0; $i < $res->num_rows; ++$i){
                $cdls[] = new CdL($res->fetch_assoc()['matricola'],$res->fetch_assoc()['nome'],$res->fetch_assoc()['tipologia']);
            }
            return $cdls;
        }
    } 
}