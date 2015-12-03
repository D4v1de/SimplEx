<?php
/**.
 * User: Carlo
 * Date: 30/11/15
 * Time: 20:00
 */

include_once CONTROL_DIR . "Controller.php";
include_once MODEL_DIR . "Model.php";
include_once BEAN_DIR . "Argomento.php";
include_once BEAN_DIR . "DomandaAperta.php";
include_once BEAN_DIR . "DomandaMultipla.php";
include_once BEAN_DIR . "Alternativa.php";
include_once MODEL_DIR . "AlternativaModel.php";


class AlternativaController extends Controller
{


    public function creaAlternativa($alternativa){
        $alternativaModel = new AlternativaModel();
        $alternativaModel->createAlternativa($alternativa);
    }

    public function modificaAlternativa($id, $domandaMultiplaId, $domandaMultiplaArgomentoId, $domandaMultiplaArgomentoCorsoId, $updatedAlternativa) {
        $alternativaModel = new AlternativaModel();
        $alternativaModel->updateAlternativa($id, $domandaMultiplaId, $domandaMultiplaArgomentoId, $domandaMultiplaArgomentoCorsoId, $updatedAlternativa);
    }

    public function cancellaAllAlternativa($domandaMultiplaId, $domandaMultiplaArgomentoId, $domandaMultiplaArgomentoCorsoId){
        $alternativaModel = new AlternativaModel();
        $alternativaModel->getAllAlternativaByDomanda($domandaMultiplaId, $domandaMultiplaArgomentoId, $domandaMultiplaArgomentoCorsoId);
    }

    public function getArgomenti()
    {
        $argomentoModel = new ArgomentoModel();
        return $argomentoModel->getAllArgomento();
    }

    public function getAllAlternativa($domandaMultiplaId, $domandaMultiplaArgomentoId, $domandaMultiplaArgomentoCorsoId)
    {
        $alternativaModel = new AlternativaModel();
        return $alternativaModel->getAllAlternativaByDomanda($domandaMultiplaId, $domandaMultiplaArgomentoId, $domandaMultiplaArgomentoCorsoId);
    }

}