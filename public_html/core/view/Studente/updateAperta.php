<?php
/**
 * Created by NetBeans.
 * User: Fabiano
 * Date: 03/12/15
 * Time: 16:00
 */
include_once CONTROL_DIR . "RispostaApertaController.php";
include_once BEAN_DIR . "RispostaAperta.php";
       
    $raCon = new RispostaApertaController();
        
    $elaboratoSessioneId = $_REQUEST["sessId"];
    $elaboratoStudenteMatricola = $_REQUEST["mat"];
    $updatedRisposta = $raCon->readRispostaApertareadRispostaAperta($elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaApertaId);
    $testo = $_REQUEST["testo"];
    
    $raCon->updateRispostaAperta($updatedRisposta, $elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaApertaId);
    
    
    