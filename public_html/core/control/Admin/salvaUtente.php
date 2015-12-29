<?php
/**
 * Salva utente
 *
 * @author Sergio Shevchenko
 * @version 1.0
 * @since 29/12/15
 */
include_once MODEL_DIR . "UtenteModel.php";
$uModel = new UtenteModel();
$matricola = $_URL[3];
$error = "";

if (isset($_POST['nome'])) {
    $tipologia = $_POST['tipologia'];
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $email = $_POST['email'];
    if ($tipologia != "Studente") {
        $cdlMatricola = null;
    } else {
        $cdlMatricola = $_POST['cdl'];
    }

    $pass = $_POST['pass'];

    try {
        $uModel->modificaUtente($matricola, $nome, $cognome, $cdlMatricola, $email, $pass, $tipologia);
        header('location: /admin/utenti?success=Utente modificato');
        exit;
    } catch (ApplicationException $ex) {
        $error = "<h5>Modifica utente FALLITO: " . $ex->getMessage() . "</h5>";
    } catch (IllegalArgumentException $ex) {
        $error = "<h5>Modifica utente FALLITO: " . $ex->getMessage() . "</h5>";
    }
} else {
    $error = "Nessuna richiesta POST rilevata";
}

$_SESSION['error'] = $error;
header('Location: ' . $_SERVER['HTTP_REFERER']);
