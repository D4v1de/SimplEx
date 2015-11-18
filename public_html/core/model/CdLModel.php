<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 18/11/15
 * Time: 11:14
 */
include_once MODEL_DIR . "Model.php";
include_once BEAN_DIR . "CdL.php";

class CdLModel extends Model {
    public static $GET_ALL_CDLS = "SELECT 'codice','nome' from corsi_laurea";

    public function getAllCdL() {
        //$res = Model::getDB()->query(self::$GET_ALL_CDLS);

        //TODO completare


        //STUB
        $corsi[] = new CdL("04042", "Informatica");
        $corsi[] = new CdL("3232", "Ingegneria");
        return $corsi;
    }
}