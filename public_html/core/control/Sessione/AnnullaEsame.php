<?php
/**
 * Questo Control permette di annullare ad uno studente l'esame durante una sessione in corso.
 * @author Antonio Luca D'Avanzo
 * @version 1
 * @since  30/12/2015 22:53
 */
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

include_once MODEL_DIR . "ElaboratoModel.php";
$modelElaborato = new ElaboratoModel();

$matricola=$_URL[6];
$elaborato=$modelElaborato->readElaborato($matricola,$idSessione);
$nuovoElaborato= new Elaborato($matricola,$elaborato->getSessioneId(),"0","0",$elaborato->getTestId(), "Corretto");
$modelElaborato->updateElaborato($matricola,$idSessione,$nuovoElaborato);
header("location: " ."/docente/corso/".$idCorso."/sessione/".$idSessione."/sessioneincorso/show");
