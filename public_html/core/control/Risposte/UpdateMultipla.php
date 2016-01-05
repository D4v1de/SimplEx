<?php

/**
 * Controller per il salvataggio di una risposta multipla
 *
 * @author Fabiano Pecorelli
 * @version 1.0
 * @since 03/12/15
 */
include_once MODEL_DIR . "RispostaMultiplaModel.php";
include_once MODEL_DIR . "ElaboratoModel.php";
include_once MODEL_DIR . "SessioneModel.php";

$rmMod = new RispostaMultiplaModel();
$elMod = new ElaboratoModel();
$sessMod = new SessioneModel();
$flag = 0;
$elaboratoSessioneId = $_REQUEST["sessId"];
if (!is_numeric($elaboratoSessioneId)) {
    $flag = 1;
}
$elaboratoStudenteMatricola = $_SESSION['user']->getMatricola();
$domandaMultiplaId = $_REQUEST["domId"];
if (!is_numeric($domandaMultiplaId)) {
    $flag = 1;
}
if ($flag == 0) {
    $elaborato = $elMod->readElaborato($elaboratoStudenteMatricola, $elaboratoSessioneId);

    $sessione = $sessMod->readSessione($elaboratoSessioneId);
    $now = date("Y-m-d H:i:s");
    $end = $sessione->getDataFine();
    $start = $sessione->getDataInizio();
    if ($now >= $start && $now <= $end && $elaborato->getStato() == "Non corretto") {
        $updatedRisposta = $rmMod->readRispostaMultipla($elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaMultiplaId);
        $altId = $_REQUEST["altId"];
        $updatedRisposta->setAlternativaId($altId);
        $rmMod->updateRispostaMultipla($updatedRisposta, $elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaMultiplaId);
    }
}