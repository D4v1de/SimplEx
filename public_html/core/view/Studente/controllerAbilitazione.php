<?php
/**
 * Created by NetBeans.
 * User: Fabiano
 * Date: 03/12/15
 * Time: 16:00
 */
include_once CONTROL_DIR . "ElaboratoController.php";
include_once BEAN_DIR . "Elaborato.php";
       
    $elCon = new ElaboratoController();
    $sessioneId = $_REQUEST["sessId"];
    $studenteMatricola = $_REQUEST["mat"];
    $elaborato = $elCon->readElaborato($studenteMatricola,$sessioneId);
    
    echo $elaborato->getStato();
            
    