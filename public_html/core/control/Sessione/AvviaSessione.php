<?php
/**
 * Questo Control permette al docente di avviare una sessione manualmente.
 * @author Antonio Luca D'Avanzo
 * @version 1
 * @since  30/12/2015 20:03
 */
include_once MODEL_DIR . "SessioneModel.php";
include_once MODEL_DIR . "UtenteModel.php";
include_once MODEL_DIR . "ElaboratoModel.php";
include_once BEAN_DIR . "Sessione.php";

$sessioneModel = new SessioneModel();
$utenteModel = new UtenteModel();
$elaboratoModel = new ElaboratoModel();

$flag=1;
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
$almenoUnoCorretto=0;
$esaminandiSessione = Array();
$esaminandiSessione= $utenteModel->getEsaminandiSessione($idSessione);
if ($esaminandiSessione == null) {
}
else {
    foreach ($esaminandiSessione as $c) {
        $ela=$elaboratoModel->readElaborato($c->getMatricola(),$idSessione);
        if($ela->getStato()=="Corretto") {
            $almenoUnoCorretto++;
        }
    }
}
if($almenoUnoCorretto!=0) {
    $vaiEsiti = "Location: " . "/docente/corso/" . $idCorso . "/sessione" . "/" . $idSessione. "/" . "esiti/norestart";
    header($vaiEsiti);
}
else {
    $idSesToGo = $_URL[4];
    $sessione=$sessioneModel->readSessione($idSesToGo);
    $dataTo = $sessione->getDataFine();
    $tipoSessione = $sessione->getTipologia();
    $soglia=$sessione->getSogliaAmmissione();
    $dataNow = date('Y/m/d/ h:i:s ', time());
    $newSessione = new Sessione($dataNow, $dataTo, $soglia, "In Esecuzione", $tipoSessione, $idCorso);
    $sessioneModel->updateSessione($idSessione, $newSessione);
    $vaiASesInCorso = "Location: " . "/docente/corso/" . $idCorso . "/sessione" . "/" . $idSesToGo . "/" . "sessioneincorso/show";
    header($vaiASesInCorso);
}
