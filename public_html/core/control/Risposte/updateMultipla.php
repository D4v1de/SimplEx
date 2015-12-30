<?php
/**
 * Created by NetBeans.
 * User: Fabiano
 * Date: 03/12/15
 * Time: 16:00
 */
include_once MODEL_DIR . "RispostaMultiplaModel.php";
include_once MODEL_DIR . "ElaboratoModel.php";
include_once MODEL_DIR . "SessioneModel.php";
       
    $rmMod = new RispostaMultiplaModel();
    $elMod = new ElaboratoModel();
    $sessMod = new SessioneModel();
        
    $elaboratoSessioneId = $_REQUEST["sessId"];
    $elaboratoStudenteMatricola = $_SESSION['user']->getMatricola();
    $domandaMultiplaId = $_REQUEST["domId"];
    $elaborato = $elMod->readElaborato($elaboratoStudenteMatricola,$elaboratoSessioneId);

    $sessione = $sessMod->readSessione($elaboratoSessioneId);
    $now = date("Y-m-d H:i:s");
    $end = $sessione->getDataFine();
    $start = $sessione->getDataInizio();
    if ($now >= $start && $now <= $end && $elaborato->getStato() == "Non corretto"){
        $updatedRisposta = $rmMod->readRispostaMultipla($elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaMultiplaId);
        $altId = $_REQUEST["altId"];
        $updatedRisposta->setAlternativaId($altId);
        $rmMod->updateRispostaMultipla($updatedRisposta, $elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaMultiplaId);
    }
    
    