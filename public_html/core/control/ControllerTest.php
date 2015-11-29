<?php

/**
 * Created by NetBeans.
 * User: Fabio
 * Date: 25/11/15
 * Time: 22:26
 */
include_once CONTROL_DIR . "Controller.php";
include_once BEAN_DIR . "Argomento.php";
include_once BEAN_DIR . "Test.php";
include_once BEAN_DIR . "Sessione.php";
include_once BEAN_DIR . "Utente.php";
include_once MODEL_DIR . "AccountModel.php";
include_once MODEL_DIR . "ArgomentoModel.php";
include_once MODEL_DIR . "SessioneModel.php";
include_once MODEL_DIR . "TestModel.php";

class ControllerTest extends Controller {
    
    //Restituisce tutti i test
    public function getTest() {
        $testModel = new TestModel();
        return $testModel->getAllTest();
    }
    
    //Restituisce tutti gli studenti
    public function getStudenti() {
        $accountModel = new AccountModel();
        return $accountModel->getAllUtenti();
    }
    
    //Restituisce tutti gli argomenti
    public function getArgomenti() {
        $argomentoModel = new ArgomentoModel();
        return $argomentoModel->getAllArgomento();
    }
    
    //Restituisce tutte le sessioni
    public function getSessioni() {
        $sessioneModel = new SessioneModel();
        return $sessioneModel->getAllSessioni();
    }
    
    //restituisce le domande multiple di uno specifico test
    public function getMultTest($id) {
        $testModel = new TestModel();
        return $testModel->getAllDomandeMultipleTest($id);
    }
    
    //restituisce le domande aperte di uno specifico test
    public function getAperteTest($id) {
        $testModel = new TestModel();
        return $testModel->getAllDomandeAperteTest($id);
    }
    
    //restituisce le risposte multiple di una specifica domanda
    public function getRispMult($id) {
        $argomentoModel = new ArgomentoModel();
        return $argomentoModel->getAllAlternativaByDomanda($id);
    }
    
}