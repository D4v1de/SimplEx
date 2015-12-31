<?php
/**
 * Crea utente
 *
 * @author Sergio Shevchenko
 * @version 1.0
 * @since 29/12/15
 */

include_once MODEL_DIR . "CdLModel.php";
include_once MODEL_DIR . "UtenteModel.php";
$uCtrl = new UtenteModel();

if (isset($_POST['tipologia'])) {
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $email = $_POST['email'];
    $tipologia = $_POST['tipologia'];
    $matricola = $_POST['matricola'];
    if ($tipologia != "Studente") {
        $cdlMatricola = null;
    } else {
        $cdlMatricola = $_POST['cdl_matricola'];
    }

    $pass = $_POST['pass'];

    try {
        $uCtrl->register($matricola, $email, $pass, $tipologia, $nome, $cognome, $cdlMatricola);
        header('location: /admin/utenti?success=Utente registrato nel sistema');
        exit;
    } catch (ApplicationException $ex) {
        $error = "<h5>Creazione utente FALLITO: " . $ex->getMessage() . "</h5>";
    } catch (IllegalArgumentException $ex) {
        $error = "<h5>Creazione utente FALLITO: " . $ex->getMessage() . "</h5>";
    }
} else {
    $error = "Nessuna richiesta POST";
}
$_SESSION['error'] = $error;
header('Location: ' . $_SERVER['HTTP_REFERER']);
