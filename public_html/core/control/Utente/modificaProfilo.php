<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 28/12/15
 * Time: 19:07
 */

if (isset($_POST['nome'])) {
    $victim = $_SESSION['user'];
    $tipologia = $victim->getTipologia();
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $email = $_POST['email'];
    $cdlMatricola = $victim->getCdlMatricola();


    $pass = $_POST['pass'];
    $pass2 = $_POST['pass2'];

    try {
        if ($pass != $pass2) throw new IllegalArgumentException("Password non coincidono");
        $uCtrl->modificaUtente($matricola, $nome, $cognome, $cdlMatricola, $email, $pass, $tipologia);
        header('location: /me?success=Utente modificato');
        exit;
    } catch (ApplicationException $ex) {
        $_SESSION['error'] = "<h5>Errore nella modifica del profilo: " . $ex->getMessage() . "</h5>";
    } catch (IllegalArgumentException $ex) {
        $_SESSION['error'] = "<h5>Errore nella modifica del profilo: " . $ex->getMessage() . "</h5>";
    }
} else {
    $_SESSION['error'] = "Post non settato";
}