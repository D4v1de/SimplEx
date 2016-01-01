<?php
/**
 * Created by PhpStorm.
 * User: Antonio Luca
 * Date: 30/12/2015
 * Time: 22:53
 */
include_once MODEL_DIR . "SessioneModel.php";
$modelSessione = new SessioneModel();
include_once BEAN_DIR . "Sessione.php";

$idSessione=$_URL[4];
$identificativoCorso = $_URL[2];

$sessione=$modelSessione->readSessione($idSessione);
$dataFrom=$sessione->getDataInizio();
$soglia=$sessione->getSogliaAmmissione();
$tipoSessione=$sessione->getTipologia();
$dataNow=date('Y/m/d/ h:i:s ', time());
$newSessione = new Sessione($dataFrom, $dataNow, $soglia, "Eseguita", $tipoSessione, $identificativoCorso);
$modelSessione->updateSessione($idSessione,$newSessione);
$vaiVisuEsiti= "Location: "."/docente/corso/".$identificativoCorso."/sessione"."/".$idSessione."/"."esiti/show";
header($vaiVisuEsiti);
