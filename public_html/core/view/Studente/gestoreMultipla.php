<?php
/**
 * Created by NetBeans.
 * User: Fabiano
 * Date: 03/12/15
 * Time: 16:00
 */
include_once CONTROL_DIR . "AlternativaController.php";
include_once CONTROL_DIR . "RispostaMultiplaController.php";
include_once BEAN_DIR . "RispostaMultipla.php";
       

    $elaboratoSessioneId = $_REQUEST["sessId"];
    $elaboratoStudenteMatricola = $_REQUEST["mat"];
    $domandaMultiplaId = $_REQUEST["domId"];
    $punteggio = null;
    $alternativaId = null;
    //$punteggio = calcolaPunteggio($alternativaId, $alternativaDomandaMultiplaId, $alternativaDomandaMultiplaArgomentoId, $alternativaDomandaMultiplaArgomentoCorsoId);
    creaRisposta($elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaMultiplaId, $punteggio, $alternativaId);
    
    //$response = "Sessione:".$elaboratoSessioneId."Matricola:".$elaboratoStudenteMatricola."Domanda:".$alternativaDomandaMultiplaId."Risposta:".$alternativaId."Corso:".$alternativaDomandaMultiplaArgomentoCorsoId;
    $response = $punteggio;
    echo $response;
    function calcolaPunteggio($id, $domandaMultiplaId, $domandaMultiplaArgomentoId, $domandaMultiplaArgomentoCorsoId){
        $altCon = new AlternativaController();
        $alt = $altCon->readAlternativa($id, $domandaMultiplaId, $domandaMultiplaArgomentoId, $domandaMultiplaArgomentoCorsoId);
        return $corr = $alt->getCorretta();
    }