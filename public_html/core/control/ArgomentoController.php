<?php
/**.
 * User: Alina
 * Date: 25/11/15
 * Time: 22:00
 */

include_once CONTROL_DIR . "Controller.php";
include_once MODEL_DIR . "Model.php";
include_once BEAN_DIR . "Argomento.php";
include_once BEAN_DIR . "DomandaAperta.php";
include_once BEAN_DIR . "DomandaMultipla.php";
include_once BEAN_DIR . "Alternativa.php";
include_once MODEL_DIR . "ArgomentoModel.php";
include_once MODEL_DIR . "DomandaModel.php";


class ArgomentoController extends Controller {


    public function getArgomenti() {
        $argomentoModel = new ArgomentoModel();
        return $argomentoModel->getAllArgomento();
    }

    public function getAllDomandeAperte() {
        $argomentoModel = new ArgomentoModel();
        return $argomentoModel->getAllDomandaAperta();
    }

    public function getAllDomandeMultiple() {
        $argomentoModel = new ArgomentoModel();
        return $argomentoModel->getAllDomandaMultipla();
    }

    public function getNumArgomenti(){
        //  $argomentoModel = new ArgomentoModel();
        return 16; //$argomentoModel->getNumArgomenti();
    }

    public function getAllDomandaMultipla($id,$corso_id){
        $domandaModel = new DomandaModel();
        return $domandaModel->getAllDomandaMultiplaByArgomento($id,$corso_id);
    }

    public function getAllDomandaAperta($id,$corso_id){
        $argomentoModel = new ArgomentoModel();
        return $argomentoModel->getAllDomandaApertaByArgomento($id,$corso_id);
    }

}