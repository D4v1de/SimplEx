<?php
/**
 * Created by NetBeans.
 * User: Fabiano
 * Date: 03/12/15
 * Time: 16:00
 */
include_once CONTROL_DIR . "ElaboratoController.php";
include_once CONTROL_DIR . "TestController.php";
include_once BEAN_DIR . "Elaborato.php";
       
$matricolaStudente = $_REQUEST["mat"];
$sessioneId = $_REQUEST["sessId"];

$elaboratoController = new ElaboratoController();
$testController = new TestController();

$tests = $testController->getAllTestBySessione($sessioneId);
$n = rand(0,count($tests)-1);
$testId = $tests[$n]->getId();

$elaborato = new Elaborato($matricolaStudente, $sessioneId, null, null, $testId, "Non corretto"); //STUB
$elaboratoController->createElaborato($elaborato);