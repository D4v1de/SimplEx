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
include_once MODEL_DIR . "AlternativaModel.php";
include_once MODEL_DIR . "DomandaModel.php";

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
        $domandaModel = new DomandaModel();
        return $domandaModel->getAllDomandeMultipleByTest($id);
    }
    
    //restituisce le domande aperte di uno specifico test
    public function getAperteTest($id) {
        $domandaModel = new DomandaModel();
        return $domandaModel->getAllDomandeAperteByTest($id);
    }
    
    //restituisce le risposte multiple di una specifica domanda
    public function getRispMult($id, $argomentoId, $argomentoCorsoId) {
        $alternativaModel = new AlternativaModel();
        return $alternativaModel->getAllAlternativaByDomanda($id, $argomentoId, $argomentoCorsoId);
    }
    
    //ricerca un utente attraverso la matricola
    public function getUtentebyMatricola($matricola) {
        $accountModel = new AccountModel();
        return $accountModel->getUtenteByMatricola($matricola);
    }
    
    //ricerca un test attraverso l'a matricola'id
    public function getTestbyId($id) {
        $testModel = new TestModel();
        return $testModel->readTest($i);
    }
    
    //ricerca i test relativi ad un corso
    public function getTestbyCorso($id) {
        $testModel = new TestModel();
        return $testModel->getAllTestByCorso($id);
    }
}