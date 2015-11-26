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

class ArgomentoController extends Controller {

    
    public function getArgomenti() {
        $argomentoModel = new ArgomentoModel();
        return $argomentoModel->getAllArgomento();
    }
    

    
}