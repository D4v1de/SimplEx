<?php
/**
 * Created by NetBeans.
 * User: Fabiano
 * Date: 03/12/15
 * Time: 16:00
 */
include_once CONTROL_DIR . "SessioneController.php";
include_once BEAN_DIR . "Sessione.php";
       
    $sessCont = new SessioneController();
    
    $sessioneId = $_REQUEST["sessId"];
    $sessione = $sessCont->readSessione($sessioneId);
    $response = $sessione->getDataFine()."|".date("Y-m-d H:i:s");
    echo $response;
    