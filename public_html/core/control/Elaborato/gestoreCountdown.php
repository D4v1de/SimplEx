<?php
/**
 * Created by NetBeans.
 * User: Fabiano
 * Date: 03/12/15
 * Time: 16:00
 */
include_once MODEL_DIR . "SessioneModel.php";
   
    $sessMod = new SessioneModel();
    
    $sessioneId = $_REQUEST["sessId"];
    $sessione = $sessMod->readSessione($sessioneId);
    $response = $sessione->getDataFine()."|".date("Y-m-d H:i:s");
    echo $response;
    