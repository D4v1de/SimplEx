<?php

/**
 * Created by PhpStorm.
 * User: Fabio
 * Date: 22/11/15
 * Time: 19:17
 */
include_once MODEL_DIR . "TestModel.php";
include_once MODEL_DIR . "AlternativaModel.php";
include_once MODEL_DIR . "AccountModel.php";

class TestController extends Controller {
    
    private $testModel;

    public function __construct() {
        $this->testModel = new TestModel();
    }
    
    //Restituisce tutti i test
    public function getAllTest() {
        return $this->testModel->getAllTest();
    }
    
    //ricerca un test attraverso l'a matricola'id
    public function readTest($id){
        return $this->testModel->readTest($id);
    }
    
    //ricerca i test relativi ad un corso
    public function getAllTestbyCorso($id) {
        $testModel = new TestModel();
        return $testModel->getAllTestByCorso($id);
    }


    
    
    
    //SPOSTARE!!!

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
}