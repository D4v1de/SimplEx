<?php
/**
 * Created by NetBeans.
 * User: Fabiano
 * Date: 03/12/15
 * Time: 16:00
 */
include_once CONTROL_DIR . "ElaboratoController.php";
include_once CONTROL_DIR . "DomandaController.php";
include_once CONTROL_DIR . "AlternativaController.php";
include_once CONTROL_DIR . "RispostaMultiplaController.php";
include_once BEAN_DIR . "Elaborato.php";
       
    $elCon = new ElaboratoController();
    $domCon = new DomandaController();
    $rmCon = new RispostaMultiplaController();
    $altCon = new AlternativaController();
    
    $sessioneId = $_REQUEST["sessId"];
    $studenteMatricola = $_REQUEST["mat"];
    $elaborato = $elCon->readElaborato($studenteMatricola,$sessioneId);
    
    $rispMul = $rmCon->getMultipleByElaborato($elaborato);
    $punteggio = 0;
    foreach ($rispMul as $rm) {
        $multId = $rm->getDomandaMultiplaId();
        $dom = $domandaController->getDomandaMultipla($multId);
        $puntCorrAlt = $domCon->readPunteggioCorrettaAlternativo($multId, $elaborato->getTestId());
        $puntErrAlt = $domCon->readPunteggioErrataAlternativo($multId, $elaborato->getTestId());
        $puntCor = ($puntCorrAlt != null)? $puntCorrAlt:$dom->getPunteggioCorretta();
        $puntErr = ($puntErrAlt != null)? $puntErrAlt:$dom->getPunteggioErrata();
       // $puntCor = $dom->getPunteggioCorretta();
       // $puntErr = $dom->getPunteggioErrata();
        $altCor = $altCon->getAlternativaCorrettaByDomanda($multId);
        $altId = $rm->getAlternativaId();
        if ($altId != 0)
            if ($altCor->getId() == $rm->getAlternativaId()){
                $punteggio = $punteggio + $puntCor;
                $rm->setPunteggio($puntCor);
                
                $updated = $domCon->getDomandaMultipla($multId);
                $perc = $updated->getPercentualeRispostaCorretta() +1;
                $updated->setPercentualeRispostaCorretta($perc);
                $domCon->modificaDomandaMultipla($multId, $updated);
            }
            else{
                $punteggio = $punteggio + $puntErr;
                $rm->setPunteggio($puntErr);
            }
            $rmCon->updateRispostaMultipla($rm, $sessioneId, $studenteMatricola, $rm->getDomandaMultiplaId());
            
            $updated = $altCon->readAlternativa($altId);
            $perc = $updated->getPercentualeScelta() +1;
            $updated->setPercentualeScelta($perc);
            $altCon->modificaAlternativa($altId, $updated);
    }
    $elaborato->setEsitoParziale($punteggio);
    $elaborato->setStato("Parzialmente corretto");
    $elCon->updateElaborato($studenteMatricola,$sessioneId,$elaborato);
    