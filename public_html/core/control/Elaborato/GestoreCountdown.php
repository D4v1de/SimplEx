<?php

/**
 * Controller per il countdown nella pagina di esecuzione del test
 *
 * @author Fabiano Pecorelli
 * @version 1.0
 * @since 03/12/15
 */
include_once MODEL_DIR . "SessioneModel.php";

$sessMod = new SessioneModel();
$flag = 0;
$sessioneId = $_REQUEST["sessId"];
if (!is_numeric($sessioneId)) {
    $flag = 1;
}
if ($flag == 0) {
    $sessione = $sessMod->readSessione($sessioneId);
    $response = $sessione->getDataFine() . "|" . date("Y-m-d H:i:s");
    echo $response;
}