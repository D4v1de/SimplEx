<?php
/**
 * Questo Control permette al docente di modificare la data di termine di una sessione in corso.
 * @author Antonio Luca D'Avanzo
 * @version 1
 * @since  02/01/2016 15:43
 */
include_once MODEL_DIR . "SessioneModel.php";
include_once BEAN_DIR . "Sessione.php";

$sessioneModel = new SessioneModel();
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
$allungA=null;
if(isset($_URL[6]))
    $allungA=$_URL[6];

$ses = $sessioneModel->readSessione($idSessione);
$dataFineNow=$allungA;
$newSessione = new Sessione($ses->getDataInizio(), $dataFineNow, $ses->getSogliaAmmissione(), "In esecuzione", $ses->getTipologia(), $idCorso);
$sessioneModel->updateSessione($idSessione,$newSessione);
$vaiASesInCorso = "Location: " . "/docente/corso/" . $idCorso . "/sessione" . "/" . $idSessione . "/" . "sessioneincorso/show/successmodifica";
header($vaiASesInCorso);

