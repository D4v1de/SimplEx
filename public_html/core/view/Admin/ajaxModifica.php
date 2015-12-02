<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 02/12/15
 * Time: 12:30
 */
include_once CONTROL_DIR . "UtenteController.php";

$fieldName = $_POST['name'];
$value = $_POST['value'];
$matricola = $_POST['pk'];
try {
    $ctr = new UtenteController();
    $ctr->modificaUtente($matricola, $fieldName, $value);

} catch (ApplicationException $ex) {
    header('HTTP/1.0 400 Bad Request', true, 400);
    echo $ex->getMessage();
}