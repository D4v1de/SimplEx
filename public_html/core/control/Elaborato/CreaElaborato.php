<?php

/**
 * Controller per la creazione di un elaborato
 *
 * @author Fabiano Pecorelli
 * @version 1.0
 * @since 03/12/15
 */
include_once MODEL_DIR . "ElaboratoModel.php";
include_once MODEL_DIR . "TestModel.php";
include_once MODEL_DIR . "SessioneModel.php";

$matricolaStudente = $_SESSION['user']->getMatricola();
$flag = 0;
$sessioneId = $_REQUEST["sessId"];
if (!is_numeric($sessioneId)) {
    $flag = 1;
}

$elaboratoModel = new ElaboratoModel();
$testModel = new TestModel();
$sessioneModel = new SessioneModel();
if ($flag == 0) {
    $sessione = $sessioneModel->readSessione($sessioneId);
    $tipologia = $sessione->getTipologia();
    $tests = $testModel->getAllTestBySessione($sessioneId);
    $n = rand(0, count($tests) - 1);
    $testId = $tests[$n]->getId();
    $elaborato = new Elaborato($matricolaStudente, $sessioneId, null, null, $testId, "Non corretto");
    $elaboratoModel->createElaborato($elaborato);
    if ($tipologia == "Valutativa") {
        $num = $tests[$n]->getNumeroSceltaValutativa() + 1;
        $tests[$n]->setNumeroSceltaValutativa($num);
    } else {
        $num = $tests[$n]->getNumeroSceltaEsercitativa() + 1;
        $tests[$n]->setNumeroSceltaEsercitativa($num);
    }
    $testModel->updateTest($testId, $tests[$n]);
}