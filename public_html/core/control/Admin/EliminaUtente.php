<?php
/**
 * Control della eliminaizione utente
 *
 * @author Sergio Shevchenko
 * @version 1.1
 * @since 29/12/15
 */

include_once MODEL_DIR . "UtenteModel.php";
$ctr = new UtenteModel();
if (@$_POST['action'] == "elimina" && isset($_POST['matricola']) && $_POST['matricola'] == $_URL[3]) {
    $ctr->eliminaUtenteByMatricola($_POST['matricola']);
    header('Location: /admin/utenti?success=Eliminato con successo');
    exit;
}