<?php
/**
 * Questo Control permette di aggiornare lo stato di una sessione in relazione alla data attuale.
 * @author Antonio Luca D'Avanzo
 * @version 1
 * @since  30/12/2015 11:49
 */
include_once MODEL_DIR . "SessioneModel.php";
include_once MODEL_DIR . "UtenteModel.php";
include_once MODEL_DIR . "TestModel.php";
include_once BEAN_DIR . "Sessione.php";
$sessioneModel = new SessioneModel();
$utenteModel = new UtenteModel();
$testModel = new TestModel();
$idCorso = $_URL[2];
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
header('Location: /docente/corso/'.$idCorso.'/success');