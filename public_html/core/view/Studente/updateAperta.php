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
        
    $id = 0; //STUB
    $elaboratoSessioneId = $_REQUEST["sessId"];
    $elaboratoStudenteMatricola = $_REQUEST["mat"];
    $updatedRisposta = $raCon->readRispostaAperta($id, $elaboratoSessioneId, $elaboratoStudenteMatricola);
    $testo = $_REQUEST["testo"];
    
    $raCon->updateRispostaAperta($updatedRisposta, $id, $elaboratoSessioneId, $elaboratoStudenteMatricola);
    