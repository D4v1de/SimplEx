<?php

/**
 * Created by PhpStorm.
 * User: Fabio
 * Date: 22/11/15
 * Time: 19:17
 */
include_once MODEL_DIR . "TestModel.php";
include_once MODEL_DIR . "AlternativaModel.php";
include_once MODEL_DIR . "UtenteModel.php";

class TestController {
    
    private $testModel;

    public function __construct() {
        $this->testModel = new TestModel();
    }
    
    public function creaTest($test) {        
        return $this->testModel->createTest($test);
    }  
    
    //Restituisce tutti i test
    public function getAllTest() {
        return $this->testModel->getAllTest();
    }
    
    //ricerca un test attraverso l'a matricola'id
    public function readTest($id){
        return $this->testModel->readTest($id);
    }
    
    public function updateTest($id,$idnuovotest){
        return $this->testModel->updateTest($id,$idnuovotest);
    }
    
    //ricerca i test relativi ad un corso
    public function getAllTestbyCorso($id) {
        return $this->testModel->getAllTestByCorso($id);
    }
    
    //ricerca i test relativi ad un corso
    public function getAllTestBySessione($id) {
        return $this->testModel->getAllTestBySessione($id);
    }
    
    //rimuovi test
    public function deleteTest($id){
        return $this->testModel->deleteTest($id);
    }
    
}
