<?php

/**
 * Controller per la consegna di un test da parte di uno studente
 *
 * @author Fabiano Pecorelli
 * @version 1.0
 * @since 03/12/15
 */
include_once MODEL_DIR . "ElaboratoModel.php";
include_once MODEL_DIR . "DomandaModel.php";
include_once MODEL_DIR . "AlternativaModel.php";
include_once MODEL_DIR . "RispostaMultiplaModel.php";
include_once MODEL_DIR . "SessioneModel.php";

$elMod = new ElaboratoModel();
$domMod = new DomandaModel();
$rmMod = new RispostaMultiplaModel();
$altMod = new AlternativaModel();
$sessMod = new SessioneModel();
$flag = 0;
$sessioneId = $_REQUEST["sessId"];
if (!is_numeric($sessioneId)) {
    $flag = 1;
}
$corsoId = $_REQUEST["corsoId"];
if (!is_numeric($corsoId)) {
    $flag = 1;
}
$sessione = $sessMod->readSessione($sessioneId);
$tipologia = $sessione->getTipologia();
$studenteMatricola = $_SESSION['user']->getMatricola();
try {
    $elaborato = $elMod->readElaborato($studenteMatricola, $sessioneId);
} catch (ApplicationException $ex) {
    $flag = 1;
}

if ($flag == 0 && $elaborato->getStato() == "Non corretto") {
    $rispMul = $rmMod->getMultipleByElaborato($elaborato);
    $punteggio = 0;
    foreach ($rispMul as $rm) {
        $multId = $rm->getDomandaMultiplaId();
        $dom = $domMod->readDomandaMultipla($multId);
        $puntCorrAlt = $domMod->readPunteggioCorrettaAlternativo($multId, $elaborato->getTestId());
        $puntErrAlt = $domMod->readPunteggioErrataAlternativo($multId, $elaborato->getTestId());
        $puntCor = ($puntCorrAlt != null) ? $puntCorrAlt : $dom->getPunteggioCorretta();
        $puntErr = ($puntErrAlt != null) ? $puntErrAlt : $dom->getPunteggioErrata();
        $altCor = $altMod->getAlternativaCorrettaByDomanda($multId);
        $altId = $rm->getAlternativaId();
        if ($altId != 0) {
            if ($altCor->getId() == $rm->getAlternativaId()) {
                $punteggio = $punteggio + $puntCor;
                $rm->setPunteggio($puntCor);

                $updatedDom = $domMod->readDomandaMultipla($multId);
                if ($tipologia == "Valutativa") {
                    $percDom = $updatedDom->getPercentualeRispostaCorrettaVal() + 1;
                    $updatedDom->setPercentualeRispostaCorrettaVal($percDom);
                } else {
                    $percDom = $updatedDom->getPercentualeRispostaCorrettaEse() + 1;
                    $updatedDom->setPercentualeRispostaCorrettaEse($percDom);
                }
                $domMod->updateDomandaMultipla($multId, $updatedDom);
            } else {
                $punteggio = $punteggio + $puntErr;
                $rm->setPunteggio($puntErr);
            }
            $updated = $altMod->readAlternativa($altId);
            $perc = $updated->getPercentualeScelta() + 1;
            $updated->setPercentualeScelta($perc);
            $altMod->updateAlternativa($altId, $updated);
        }
        $rmMod->updateRispostaMultipla($rm, $sessioneId, $studenteMatricola, $rm->getDomandaMultiplaId());
    }
    $elaborato->setEsitoParziale($punteggio);
    $elaborato->setStato("Parzialmente corretto");
    $elMod->updateElaborato($studenteMatricola, $sessioneId, $elaborato);
}
    