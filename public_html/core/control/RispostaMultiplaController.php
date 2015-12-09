<?php
/**.
 * User: Carlo
 * Date: 30/11/15
 * Time: 20:00
 */

include_once CONTROL_DIR . "Controller.php";
include_once MODEL_DIR . "RispostaMultiplaModel.php";


class RispostaMultiplaController extends Controller
{

     public function __construct() {
         $this->rispMulModel = new RispostaMultiplaModel();
     }

    public function createRispostaMultipla($risposta){
        return $this->rispMulModel->createRispostaMultipla($risposta);
    }

    public function readRispostaMultipla($elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaMultiplaId){
        return $this->rispMulModel->readRispostaMultipla($elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaMultiplaId);
    }
    
    public function updateRispostaMultipla($updatedRisposta, $elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaMultiplaId){
        return $this->rispMulModel->updateRispostaMultipla($updatedRisposta, $elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaMultiplaId);
    }
    
     public function getMultipleByElaborato($elaborato){
        return $this->rispMulModel->getMultipleByElaborato($elaborato);
    }
    
}