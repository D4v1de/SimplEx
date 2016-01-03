<?php
/**
 * Questo Control permette al docente di rimuovere una sessione.
 * @author Antonio Luca D'Avanzo
 * @version 1
 * @since  30/12/2015 11:26
 */

include_once MODEL_DIR . "SessioneModel.php";
include_once MODEL_DIR . "UtenteModel.php";
include_once MODEL_DIR . "TestModel.php";
include_once BEAN_DIR . "Sessione.php";

$sessioneModel = new SessioneModel();
$utenteModel = new UtenteModel();
$testModel = new TestModel();
$idCorso = $_URL[2];

if(isset($_POST['IdSes'])) {
    $idSes = $_POST['IdSes'];
    try {
        $sessioneModel->deleteSessione($idSes);
        header("location: " . "/docente/corso/" . $idCorso . "/successelimina");
    } catch (ApplicationException $ex) {
        echo "ERRORE" . $ex;
    }
}

else {
    $idSes = $_URL[4];
    try {
        $sessioneModel->deleteSessione($idSes);
        $tornaACasa= "Location: "."/docente/corso/".$idCorso."/successelimina";
        header($tornaACasa);
    }
    catch(ApplicationException $ex) {
        echo "Errore nella Rimozione".$ex;
    }
}