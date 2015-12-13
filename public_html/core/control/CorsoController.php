<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 13/12/15
 * Time: 16:57
 */
include_once CONTROL_DIR . "Controller.php";
include_once BEAN_DIR . "CdL.php";
include_once BEAN_DIR . "Corso.php";
include_once MODEL_DIR . "CorsoModel.php";
include_once MODEL_DIR . "AccountModel.php";
include_once BEAN_DIR . "Utente.php";

class CorsoController extends Controller {
    public function getMyCourses() {
        /** @var Utente $utente */
        $utente = $_SESSION['user'];
        $model = new CorsoModel();
        return ($utente->getTipologia() == "Studente" ? $model->getAllCorsiByStudente($utente->getMatricola()) : $model->getAllCorsiByDocente($utente->getMatricola()));
    }

    /**
     * @param $matricola
     * @return array|Corso[]
     */
    public function getCoursesByMatricola($matricola) {
        $aModel = new AccountModel();
        $utente = $aModel->getUtenteByMatricola($matricola);
        $model = new CorsoModel();
        if ($utente->getTipologia() == "Studente") {
            return $model->getAllCorsiByStudente($utente->getMatricola());
        } elseif ($utente->getTipologia() == "Docente") {
            return $model->getAllCorsiByDocente($utente->getMatricola());
        } else {
            return Array();
        }
    }
}