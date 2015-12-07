<?php
/**
 * Created by NetBeans.
 * User: Fabiano
 * Date: 03/12/15
 * Time: 16:00
 */
include_once CONTROL_DIR . "RispostaApertaController.php";
include_once BEAN_DIR . "RispostaAperta.php";
       

   $elaboratoSessioneId = $_REQUEST["sessId"];
    $elaboratoStudenteMatricola = $_REQUEST["mat"];
    $domandaMultiplaId = $_REQUEST["domId"];
    $alternativaId = $_REQUEST["altId"];
    //$punteggio = calcolaPunteggio($alternativaId, $alternativaDomandaMultiplaId, $alternativaDomandaMultiplaArgomentoId, $alternativaDomandaMultiplaArgomentoCorsoId);
    $punteggio = null;
    creaRisposta($elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaMultiplaId, $punteggio, $alternativaId);
    
    //$response = "Sessione:".$elaboratoSessioneId."Matricola:".$elaboratoStudenteMatricola."Domanda:".$alternativaDomandaMultiplaId."Risposta:".$alternativaId."Corso:".$alternativaDomandaMultiplaArgomentoCorsoId;
    $response = $punteggio;
    echo $response;
    
    function creaRisposta($elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaMultiplaId, $punteggio, $alternativaId){
        $rmCon = new RispostaMultiplaController();
        $risp = new RispostaMultipla($elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaMultiplaId, $punteggio, $alternativaId);
        $rmCon->createRispostaMultipla($risp);
    }