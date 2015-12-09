<?php
/**
 * Created by NetBeans.
 * User: Fabiano
 * Date: 03/12/15
 * Time: 16:00
 */
include_once CONTROL_DIR . "RispostaMultiplaController.php";
include_once BEAN_DIR . "RispostaMultipla.php";
       
    $rmCon = new RispostaMultiplaController();
        
    $elaboratoSessioneId = $_REQUEST["sessId"];
    $elaboratoStudenteMatricola = $_REQUEST["mat"];
    $domandaMultiplaId = $_REQUEST["domId"];
    $updatedRisposta = $rmCon->readRispostaMultipla($elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaMultiplaId);
    $altId = $_REQUEST["altId"];
    $updatedRisposta->setAlternativaId($altId);
    
    $rmCon->updateRispostaMultipla($updatedRisposta, $elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaMultiplaId);
    
    
    