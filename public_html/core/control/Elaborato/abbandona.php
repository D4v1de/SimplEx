<?php
/**
 * Created by NetBeans.
 * User: Fabiano
 * Date: 03/12/15
 * Time: 16:00
 */

include_once MODEL_DIR . "ElaboratoModel.php";
    $elaboratoModel = new ElaboratoModel();
    $sessId = $_REQUEST["sessId"];
    $matricola = $_SESSION['user']->getMatricola();
    try{
        $elaborato = $elaboratoModel->readElaborato($matricola,$sessId);
    }
    catch(ApplicationException $ex){
        $elaborato = null;
    }

    if ($elaborato != null && $elaborato->getStato() == "Non corretto"){
        $elaborato->setEsitoParziale(0);
        $elaborato->setEsitoFinale(0);
        $elaborato->setStato("Corretto");
        $elaboratoModel->updateElaborato($matricola,$sessId,$elaborato);   
    }