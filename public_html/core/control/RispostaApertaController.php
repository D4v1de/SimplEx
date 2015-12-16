<?php
/**.
 * User: Carlo
 * Date: 30/11/15
 * Time: 20:00
 */

include_once MODEL_DIR . "RispostaApertaModel.php";


class RispostaApertaController
{

     public function __construct() {
         $this->rispApertaModel = new RispostaApertaModel();
     }

    public function createRispostaAperta($risposta){
        return $this->rispApertaModel->createRispostaAperta($risposta);
    }
    
     public function updateRispostaAperta($updatedRisposta, $elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaApertaId){
        return $this->rispApertaModel->updateRispostaAperta($updatedRisposta, $elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaApertaId);
     }
    
     public function readRispostaAperta($elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaApertaId){
         return $this->rispApertaModel->readRispostaAperta($elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaApertaId);
     }
     
     public function getAperteByElaborato($elaborato){
         return $this->rispApertaModel->getAperteByElaborato($elaborato);
     }

     
     
}