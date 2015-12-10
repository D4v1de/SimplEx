<?php
/**
 * Created by NetBeans.
 * User: Fabiano
 * Date: 03/12/15
 * Time: 16:00
 */
include_once CONTROL_DIR . "ElaboratoController.php";
include_once BEAN_DIR . "Elaborato.php";
       
$matricolaStudente = $_REQUEST["mat"];
$sessioneId = $_REQUEST["sessId"];

$elaboratoController = new ElaboratoController();

$elaborato = new Elaborato($matricolaStudente, $sessioneId, null, null, 1, "Non corretto"); //STUB
$elaboratoController->createElaborato($elaborato);