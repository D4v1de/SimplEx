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
    $testo = null;
    $domandaApertaId = $_REQUEST["domId"];
    $domandaApertaArgomentoId = 1; //STUB
    $domandaApertaArgomentoCorsoId = $_REQUEST["corsoId"];
    //$punteggio = calcolaPunteggio($alternativaId, $alternativaDomandaMultiplaId, $alternativaDomandaMultiplaArgomentoId, $alternativaDomandaMultiplaArgomentoCorsoId);
    $punteggio = null;
    creaRisposta($elaboratoSessioneId, $elaboratoStudenteMatricola, $testo, $punteggio, $domandaApertaId, 
            $domandaApertaArgomentoId,$domandaApertaArgomentoCorsoId);
    
    //$response = "Sessione:".$elaboratoSessioneId."Matricola:".$elaboratoStudenteMatricola."Domanda:".$alternativaDomandaMultiplaId."Risposta:".$alternativaId."Corso:".$alternativaDomandaMultiplaArgomentoCorsoId;
    $response = $punteggio;
    echo $response;
    
    function creaRisposta($elaboratoSessioneId, $elaboratoStudenteMatricola, $testo, $punteggio, $domandaApertaId, 
            $domandaApertaArgomentoId,$domandaApertaArgomentoCorsoId){
        $raCon = new RispostaApertaController();
        $risp = new RispostaAperta($elaboratoSessioneId, $elaboratoStudenteMatricola, $testo, $punteggio, $domandaApertaId, 
            $domandaApertaArgomentoId,$domandaApertaArgomentoCorsoId);
        $raCon->createRispostaAperta($risp);
    }