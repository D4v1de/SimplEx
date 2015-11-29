<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 25/11/15
 * Time: 20:42
 */

include_once CONTROL_DIR . "AuthController.php";
$controller = new AuthController();
try {
    Logger::info("Richiesta login [" . $_POST['email'] . " " . $_POST['password'] . " " . @$_POST['remember'] . "]");
    $user = $controller->login($_POST['email'], $_POST['password'], (@$_POST['remember'] == "1" ? true : false));
    Logger::info("Login effettuato " . $user->getUsername());
    echo json_encode(array('status' => true));
} catch (ApplicationException $ex) {
    Logger::warning("Errore nel login " . $ex);
    echo json_encode(array('status' => false, 'error' => $ex->getMessage()));
}