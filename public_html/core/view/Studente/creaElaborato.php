<?php
/**
 * Created by NetBeans.
 * User: Fabiano
 * Date: 03/12/15
 * Time: 16:00
 */
include_once MODEL_DIR . "ElaboratoModel.php";
include_once MODEL_DIR . "TestModel.php";
       
$matricolaStudente = $_SESSION['user']->getMatricola();
$sessioneId = $_REQUEST["sessId"];

$elaboratoModel = new ElaboratoModel();
$testModel = new TestModel();

$tests = $testModel->getAllTestBySessione($sessioneId);
$n = rand(0,count($tests)-1);
$testId = $tests[$n]->getId();

$elaborato = new Elaborato($matricolaStudente, $sessioneId, null, null, $testId, "Non corretto"); //STUB
$elaboratoModel->createElaborato($elaborato);