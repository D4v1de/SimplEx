<?php
/**.
 * User: Carlo
 * Date: 30/11/15
 * Time: 20:00
 */

include_once CONTROL_DIR . "Controller.php";
include_once MODEL_DIR . "RispostaApertaModel.php";


class RispostaApertaController extends Controller
{

     public function __construct() {
         $this->rispApertaModel = new RispostaApertaModel();
     }

    public function createRispostaAperta($risposta){
        return $this->rispApertaModel->createRispostaAperta($risposta);
    }
    
     public function updateRispostaAperta($updatedRisposta, $id, $elaboratoSessioneId, $elaboratoStudenteMatricola){
        return $this->rispApertaModel->updateRispostaAperta($updatedRisposta, $id, $elaboratoSessioneId, $elaboratoStudenteMatricola);
     }
    
     public function readRispostaAperta($id, $elaboratoSessioneId, $elaboratoStudenteMatricola){
         return $this->rispApertaModel->readRispostaAperta($id, $elaboratoSessioneId, $elaboratoStudenteMatricola);
     }

}