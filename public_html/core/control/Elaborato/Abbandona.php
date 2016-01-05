<?php

/**
 * Controller per il ritiro di uno studente da una sessione
 *
 * @author Fabiano Pecorelli
 * @version 1.0
 * @since 03/12/15
 */
include_once MODEL_DIR . "ElaboratoModel.php";
$elaboratoModel = new ElaboratoModel();
include_once MODEL_DIR . "RispostaMultiplaModel.php";
$rmMod = new RispostaMultiplaModel();
include_once MODEL_DIR . "RispostaApertaModel.php";
$raMod = new RispostaApertaModel();
$flag = 0;

$sessId = $_REQUEST["sessId"];
if (!is_numeric($sessId)) {
    $flag = 1;
}
$corsoId = $_REQUEST["corsoId"];
if (!is_numeric($corsoId)) {
    $flag = 1;
}
$matricola = $_SESSION['user']->getMatricola();

if ($flag == 0){
   
    try {
        $elaborato = $elaboratoModel->readElaborato($matricola, $sessId);
    } catch (ApplicationException $ex) {
        $elaborato = null;
    }
 $rispMul = $rmMod->getMultipleByElaborato($elaborato);
    $rispAp = $raMod->getAperteByElaborato($elaborato);
    
    if ($elaborato != null && $elaborato->getStato() == "Non corretto") {
        $elaborato->setEsitoParziale(0);
        $elaborato->setEsitoFinale(0);
        $elaborato->setStato("Corretto");
        $elaboratoModel->updateElaborato($matricola, $sessId, $elaborato);
        foreach ($rispMul as $rm){
            $rm->setAlternativaId(0);
            $rmMod->updateRispostaMultipla($rm, $sessId, $matricola, $rm->getDomandaMultiplaId());
        }
        foreach ($rispAp as $ra){
            $ra->setTesto(null);
            $raMod->updateRispostaAperta($ra, $sessId, $matricola, $ra->getDomandaApertaId());
        }
    }

}