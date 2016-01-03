<?php
/**
 * Questo Control permette al docente di rimuovere una sessione.
 * @author Antonio Luca D'Avanzo
 * @version 1
 * @since  30/12/2015 11:26
 */
include_once MODEL_DIR . "SessioneModel.php";
include_once BEAN_DIR . "Sessione.php";

$sessioneModel = new SessioneModel();
$idCorso ="";
$idCorso = $_URL[2];
if (!is_numeric($idCorso)) {
    echo "<script type='text/javascript'>alert('errore nella url!!!');</script>";
}
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
    if(isset($_URL[4])) {
        $idSes = $_URL[4];
        try {
            $sessioneModel->deleteSessione($idSes);
            $tornaACasa = "Location: " . "/docente/corso/" . $idCorso . "/successelimina";
            header($tornaACasa);
        } catch (ApplicationException $ex) {
            echo "Errore nella Rimozione" . $ex;
        }
    }
    else
        echo "<script type='text/javascript'>alert('URL[4] non settato');</script>";
}