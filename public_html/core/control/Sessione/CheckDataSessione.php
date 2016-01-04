<?php
/**
 * Questo Control permette di aggiornare lo stato di una sessione in relazione alla data attuale.
 * @author Antonio Luca D'Avanzo
 * @version 1
 * @since  30/12/2015 11:49
 */
include_once MODEL_DIR . "SessioneModel.php";
include_once BEAN_DIR . "Sessione.php";
$sessioneModel = new SessioneModel();
$idCorso ="";
$idCorso = $_URL[2];
if (!is_numeric($idCorso)) {
    echo "<script type='text/javascript'>alert('errore nella url!!!');</script>";
}

$cond="";
if(isset($_URL[4]))
    $cond=$_URL[4];

try {
    $idsSessione= $sessioneModel->getAllSessioniByCorso($idCorso);
} catch (ApplicationException $ex) {
    echo "<h1>GETALLSESSIONIBYCORSO FALLITO!</h1>" . $ex;
}
$now = date("Y-m-d H:i:s");
foreach ($idsSessione as $c) {
    $end = $c->getDataFine();
    $start = $c->getDataInizio();
    if ($c->getStato() == "Non eseguita" && ($now >= $start && $now <= $end)) {
        $sessioneAggiornata = new Sessione($c->getDataInizio(), $c->getDataFine(), $c->getSogliaAmmissione(), "In esecuzione", $c->getTipologia(), $idCorso);
        $sessioneModel->updateSessione($c->getId(), $sessioneAggiornata);
    }
    else if ($c->getStato() == "Eseguita" && ($now >= $start && $now <= $end)) {
        $sessioneAggiornata = new Sessione($c->getDataInizio(), $c->getDataFine(), $c->getSogliaAmmissione(), "In esecuzione", $c->getTipologia(), $idCorso);
        $sessioneModel->updateSessione($c->getId(), $sessioneAggiornata);
    }else if ($c->getStato() == "Non eseguita" && ($now > $end)) {
        $sessioneAggiornata = new Sessione($c->getDataInizio(), $c->getDataFine(), $c->getSogliaAmmissione(), "Eseguita", $c->getTipologia(), $idCorso);
        $sessioneModel->updateSessione($c->getId(), $sessioneAggiornata);
    } else if ($c->getStato() == "In esecuzione" && ($now > $end)) {
        $sessioneAggiornata = new Sessione($c->getDataInizio(), $c->getDataFine(), $c->getSogliaAmmissione(), "Eseguita", $c->getTipologia(), $idCorso);
        $sessioneModel->updateSessione($c->getId(), $sessioneAggiornata);
    } else if ($c->getStato() == "In esecuzione" && ($now < $start)) {
        $sessioneAggiornata = new Sessione($c->getDataInizio(), $c->getDataFine(), $c->getSogliaAmmissione(), "Non eseguita", $c->getTipologia(), $idCorso);
        $sessioneModel->updateSessione($c->getId(), $sessioneAggiornata);
    } else if ($c->getStato() == "Eseguita" && ($now < $start)) {
        $sessioneAggiornata = new Sessione($c->getDataInizio(), $c->getDataFine(), $c->getSogliaAmmissione(), "Non eseguita", $c->getTipologia(), $idCorso);
        $sessioneModel->updateSessione($c->getId(), $sessioneAggiornata);
    } else
        ;
}

if($cond=="vuoto")
    $cond="";
header('Location: /docente/corso/'.$idCorso.'/success/'.$cond);