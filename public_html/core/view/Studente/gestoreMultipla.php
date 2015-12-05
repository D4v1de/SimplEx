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
    $alternativaId = $_REQUEST["altId"];
    $alternativaDomandaMultiplaId = $_REQUEST["domId"];
    $alternativaDomandaMultiplaArgomentoCorsoId = $_REQUEST["corsoId"];
    $alternativaDomandaMultiplaArgomentoId = 1; //STUB
    //$punteggio = calcolaPunteggio($alternativaId, $alternativaDomandaMultiplaId, $alternativaDomandaMultiplaArgomentoId, $alternativaDomandaMultiplaArgomentoCorsoId);
    $punteggio = null;
    creaRisposta($elaboratoSessioneId, $elaboratoStudenteMatricola, $punteggio, $alternativaId, $alternativaDomandaMultiplaId, 
            $alternativaDomandaMultiplaArgomentoId, $alternativaDomandaMultiplaArgomentoCorsoId);
    
    //$response = "Sessione:".$elaboratoSessioneId."Matricola:".$elaboratoStudenteMatricola."Domanda:".$alternativaDomandaMultiplaId."Risposta:".$alternativaId."Corso:".$alternativaDomandaMultiplaArgomentoCorsoId;
    $response = $punteggio;
    echo $response;
    /*
    function calcolaPunteggio($id, $domandaMultiplaId, $domandaMultiplaArgomentoId, $domandaMultiplaArgomentoCorsoId){
        $altCon = new AlternativaController();
        $alt = $altCon->readAlternativa($id, $domandaMultiplaId, $domandaMultiplaArgomentoId, $domandaMultiplaArgomentoCorsoId);
        return $corr = $alt->getCorretta();
    }*/
    
    function creaRisposta($elaboratoSessioneId, $elaboratoStudenteMatricola, $punteggio, $alternativaId, $alternativaDomandaMultiplaId, 
            $alternativaDomandaMultiplaArgomentoId, $alternativaDomandaMultiplaArgomentoCorsoId){
        $rmCon = new RispostaMultiplaController();
        
        $risp = new RispostaMultipla($elaboratoSessioneId, $elaboratoStudenteMatricola, $punteggio, $alternativaId, $alternativaDomandaMultiplaId, 
            $alternativaDomandaMultiplaArgomentoId, $alternativaDomandaMultiplaArgomentoCorsoId);
        $rmCon->createRispostaMultipla($risp);
    }