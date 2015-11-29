<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 29/11/15
 * Time: 19:56
 */
include_once CONTROL_DIR . "AuthController.php";
if (!isset($_SESSION['loggedin']) && !isset($_COOKIE[AuthController::PERMA_COOKIE])) {
    header('Location: /');
}
$ctr = new AuthController();
$ctr->logOut();
header('Location: /');
