<?php
/**
 * Created by PhpStorm.
 * User: fede_dr
 * Date: 24/11/15
 * Time: 17:44
 */

include_once CONTROL_DIR . "Controller.php";
include_once BEAN_DIR . "CdL.php";
include_once BEAN_DIR . "Corso.php";
include_once MODEL_DIR . "CdLModel.php";
include_once MODEL_DIR . "CorsoModel.php";

class CdlController extends Controller {

    /**
     * Restituisco tutti i CdL
     * @return array CdL
     */
    public function getCdl() {
        $cdlModel = new CdLModel();
        return $cdlModel->getAllCdL();
    }

    /**
     * Restituisco tutti i Corsi
     * @return array Corso
     */
    public function getCorsi() {
        $corsoModel = new CorsoModel();
        return $corsoModel->getAllCorsi();
    }
}