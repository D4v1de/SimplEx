<?php

/**
 * Controller per il salvataggio di una risposta aperta
 *
 * @author Fabiano Pecorelli
 * @version 1.0
 * @since 03/12/15
 */
include_once MODEL_DIR . "RispostaApertaModel.php";
include_once MODEL_DIR . "ElaboratoModel.php";
include_once MODEL_DIR . "SessioneModel.php";

$raMod = new RispostaApertaModel();
$elMod = new ElaboratoModel();
$sessMod = new SessioneModel();
$flag = 0;
$elaboratoSessioneId = $_REQUEST["sessId"];
if (!is_numeric($elaboratoSessioneId)) {
    $flag = 1;
}
$elaboratoStudenteMatricola = $_SESSION['user']->getMatricola();
$domandaApertaId = $_REQUEST["domId"];
if (!is_numeric($domandaApertaId)) {
    $flag = 1;
}
if ($flag == 0) {
    $elaborato = $elMod->readElaborato($elaboratoStudenteMatricola, $elaboratoSessioneId);

    $sessione = $sessMod->readSessione($elaboratoSessioneId);
    $now = date("Y-m-d H:i:s");
    $end = $sessione->getDataFine();
    $start = $sessione->getDataInizio();
    if ($now >= $start && $now <= $end && $elaborato->getStato() == "Non corretto") {
        $updatedRisposta = $raMod->readRispostaAperta($elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaApertaId);
        $testo = base64_encode($_REQUEST["testo"]);
        $updatedRisposta->setTesto($testo);

        $raMod->updateRispostaAperta($updatedRisposta, $elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaApertaId);
    }
}
    