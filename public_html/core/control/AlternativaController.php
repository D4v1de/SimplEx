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