<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 29/11/15
 * Time: 19:56
 */
include_once CONTROL_DIR . "UtenteController.php";
if (!isset($_SESSION['loggedin']) && !isset($_COOKIE[UtenteController::PERMA_COOKIE])) {
    header('Location: /');
}
$ctr = new UtenteController();
$ctr->logOut();
header('Location: /');
