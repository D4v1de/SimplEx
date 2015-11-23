<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 22/11/15
 * Time: 19:17
 */
include_once MODEL_DIR . "AccountModel.php";
include_once CONTROL_DIR . "AuthController.php";
$am = new AuthController();
$aModel = new AccountModel();

//$am->login("shevchenk2ser@gmail.com", "password", true);
//print_r($am->checkPermanentLogin());

//print_r($am->register("13332132", "shevchenk2ser@gmail.com", "password", "studente", "nome", "cognome", "001"));
//$r=$aModel->getUtente("shevchenk2ser@gmail.com", "password");
//print_r($r);
//$aModel->removeUtente("13332132");