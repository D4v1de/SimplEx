<?php

include_once MODEL_DIR . "UtenteModel.php";

function controllo(){

    $accountModel = new UtenteModel();
    $idcorso = $_SESSION['idcorso'];
    $utenteLoggato = $_SESSION['user'];
    $correttezzaLogin = false;

    /**
     * RICEVE LA MATRICOLA DEL DOCENTE LOGGATO
     */
    try {
        $matricolaLoggato = $utenteLoggato->getMatricola();
    } catch (ApplicationException $exception) {
        echo "ERRORE IN GET MATRICOLA" . $exception;
    }

    /**
     * RICEVE I DOCENTE ASSOCIATI AL CORSO NEL QUALE CI SI TROVA
     */
    try {
        $docentiAssociati = $accountModel->getAllDocentiByCorso($idcorso);
    } catch (ApplicationException $exception) {
        echo "ERRORE IN GET DOCENTE ASSOCIATI" . $exception;
    }

    /**
     * CONTROLLA SE NEI DOCENTI ASSOCIATI E' PRESENTE IL DOCENTE LOGGATO
     */
    foreach ($docentiAssociati as $docente) {
        if ($docente->getMatricola() == $matricolaLoggato) {
            $correttezzaLogin = true;
        }
    }

    /**
     * CONTROLLA IL CORRETTO LOGIN DEL DOCENTE AL CORSO DA LUI INSEGNATO
     */
    if ($correttezzaLogin == false) {
        header('Location: /docente');
    }
}
