<?php
/**
 * Questo Control permette di annullare ad uno studente l'esame durante una sessione in corso.
 * @author Antonio Luca D'Avanzo
 * @version 1
 * @since  30/12/2015 22:53
 */
include_once MODEL_DIR . "ElaboratoModel.php";
$modelElaborato = new ElaboratoModel();
include_once MODEL_DIR . "RispostaMultiplaModel.php";
$rmMod = new RispostaMultiplaModel();
include_once MODEL_DIR . "RispostaApertaModel.php";
$raMod = new RispostaApertaModel();

$idSessione="";
$idSessione= $_URL[4];
if (!is_numeric($idSessione)) {
    echo "<script type='text/javascript'>alert('errore nella url!!!');</script>";
}
$idCorso ="";
$idCorso = $_URL[2];
if (!is_numeric($idCorso)) {
    echo "<script type='text/javascript'>alert('errore nella url!!!');</script>";
}

$matricola="";
$matricola = $_URL[6];
if (!is_numeric($matricola)) {
    echo "<script type='text/javascript'>alert('errore nella url!!!');</script>";
}
$elaborato=$modelElaborato->readElaborato($matricola,$idSessione);
$rispMul = $rmMod->getMultipleByElaborato($elaborato);
$rispAp = $raMod->getAperteByElaborato($elaborato);
$nuovoElaborato= new Elaborato($matricola,$elaborato->getSessioneId(),"0","0",$elaborato->getTestId(), "Corretto");
$modelElaborato->updateElaborato($matricola,$idSessione,$nuovoElaborato);
foreach ($rispMul as $rm){
    $rm->setAlternativaId(0);
    $rmMod->updateRispostaMultipla($rm, $idSessione, $matricola, $rm->getDomandaMultiplaId());
}
foreach ($rispAp as $ra){
    $ra->setTesto(null);
    $raMod->updateRispostaAperta($ra, $idSessione, $matricola, $ra->getDomandaApertaId());
}
header("location: " ."/docente/corso/".$idCorso."/sessione/".$idSessione."/sessioneincorso/show");
