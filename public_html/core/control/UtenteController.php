<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 30/11/15
 * Time: 20:59
 */
include_once BEAN_DIR . "Utente.php";
include_once MODEL_DIR . "AccountModel.php";
include_once CONTROL_DIR."Controller.php";

class UtenteController extends Controller {

    public function getUtenteByMatricola($matricola) {
        //Prendo dal model l'utente oppure lancio eccezzione ApplicationException
        return new Utente("343343", "pippo@pippo.com", "sksdaksmdkasmd", "Studente", "Pippo", "Mastronzo", "051210");
    }
    
     /**
     * Restituisce tutti gli Utenti
     * @return array con tutti gli Utenti 
     */
    public function getUtenti() {
        $accountModel = new AccountModel();
        return $accountModel->getAllUtenti();
    }
}