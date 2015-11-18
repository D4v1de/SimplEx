<?php
include_once MODEL_DIR . "Model.php";
include_once EXCEPTION_DIR."UserNotFoundException.php";

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 18/11/15
 * Time: 09:34
 */
class AccountModel extends Model {
    private static $SELECT_UTENTE = "SELECT * from 'Utenti' WHERE 'username'='%s' AND 'password'='%s' LIMIT 1";

    /**
     * @param $username
     * @param $password
     * @return Utente
     * @throws ConnectionException
     * @throws UserNotFoundException
     */
    public function doLogin($username, $password) {
        $query = sprintf(self::$SELECT_UTENTE, $username, $password);
        //$res = Model::getDB()->query($query);
        //todo parsing del risultato
        //oppure lancia eccezzione
        throw new UserNotFoundException("Utente non trovato");


        return new Studente("0512102323", "Andrea", "Parente", "a.parente@unisa.it"); //STUB
    }

}