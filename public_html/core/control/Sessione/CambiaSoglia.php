<?php
/**
 * Questo Control permette di modificare la soglia di ammissione di una sessione.
 * @author Antonio Luca D'Avanzo
 * @version 1
 * @since  02/01/2016 16:07
 */

include_once MODEL_DIR . "SessioneModel.php";
include_once BEAN_DIR . "Sessione.php";
$idCorso = $_URL[2];
$idSessione=$_URL[4];
$sessioneModel = new SessioneModel();;

$sessioneByUrl=$sessioneModel->readSessione($idSessione);
$soglia=$_POST['soglia'];
$sessioneAggiornata = new Sessione($sessioneByUrl->getDataInizio(),$sessioneByUrl->getDataFine(), $soglia , $sessioneByUrl->getStato(), $sessioneByUrl->getTipologia(), $idCorso);
$sessioneModel->updateSessione($idSessione, $sessioneAggiornata);

$tornaACasa = "Location: "."/docente/corso/".$idCorso."/sessione"."/".$idSessione."/"."esiti/show";
header($tornaACasa);
