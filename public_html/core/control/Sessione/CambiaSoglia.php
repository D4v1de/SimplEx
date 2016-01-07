<?php
/**
 * Questo Control permette di modificare la soglia di ammissione di una sessione.
 * @author Antonio Luca D'Avanzo
 * @version 1
 * @since  02/01/2016 16:07
 */

include_once MODEL_DIR . "SessioneModel.php";
include_once BEAN_DIR . "Sessione.php";
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

$sessioneModel = new SessioneModel();;

$sessioneByUrl=$sessioneModel->readSessione($idSessione);
$soglia=$_URL[6];
$sessioneAggiornata = new Sessione($sessioneByUrl->getDataInizio(),$sessioneByUrl->getDataFine(), $soglia , $sessioneByUrl->getStato(), $sessioneByUrl->getTipologia(), $idCorso);
$sessioneModel->updateSessione($idSessione, $sessioneAggiornata);

$tornaACasa = "Location: "."/docente/corso/".$idCorso."/sessione"."/".$idSessione."/"."esiti/show";
header($tornaACasa);
