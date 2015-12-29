<?php
/**
 * Created by NetBeans.
 * User: Fabiano
 * Date: 03/12/15
 * Time: 16:00
 */
include_once MODEL_DIR . "ElaboratoModel.php";
       
    $elMod = new ElaboratoModel();
    $sessioneId = $_REQUEST["sessId"];
    $studenteMatricola = $_SESSION['user']->getMatricola();
    try{
        $elaborato = $elMod->readElaborato($studenteMatricola,$sessioneId);
    }
    catch(ApplicationException $ex){
        $elaborato = null;
    }
    if ($elaborato != null)
        echo $elaborato->getStato();
    else
        echo "Corretto";
            
    