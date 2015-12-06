<?php

/**
 * Created by PhpStorm.
 * User: Antonio Luca
 * Date: 29/11/2015
 * Time: 15:58
 */

include_once CONTROL_DIR . "Controller.php";
include_once MODEL_DIR . "ElaboratoModel.php";


class ElaboratoController extends Controller {   //UTLIZZARE ALTRO CONTROLLER..NON ALTRO MODEL


    private $elaboratoModel;

    public function __construct() {
        $this->elaboratoModel = new ElaboratoModel();
    }
    
    public function createElaborato($elaborato){
        return $this->elaboratoModel->createElaborato($elaborato);
    }

    public function readElaborato($studenteMatricola,$sessioneId) {
        return $this->elaboratoModel->readElaborato($studenteMatricola,$sessioneId);
    }
    
}