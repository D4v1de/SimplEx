<?php
/**
 * Created by PhpStorm.
 * User: Antonio Luca
 * Date: 30/12/2015
 * Time: 22:53
 */
$idCorso = $_URL[2];
$idSessione = $_URL[4];

include_once MODEL_DIR . "ElaboratoModel.php";
$modelElaborato = new ElaboratoModel();

$matricola=$_URL[6];
$elaborato=$modelElaborato->readElaborato($matricola,$idSessione);
$nuovoElaborato= new Elaborato($matricola,$elaborato->getSessioneId(),"0","0",$elaborato->getTestId(), "Corretto");
$modelElaborato->updateElaborato($matricola,$idSessione,$nuovoElaborato);
header("location: " ."/docente/corso/".$idCorso."/sessione/".$idSessione."/sessioneincorso/show");

