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

print_r($am->register("13332132", "shevchenk2ser@gmail.com", "password", "studente", "nome", "cognome", "00100000"));
//$am->getUtente("shevchenkser@gmail.com", "aspirespi");