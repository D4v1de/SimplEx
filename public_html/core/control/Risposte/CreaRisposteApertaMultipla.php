<?php

/**
 * Controller per la creazione delle risposte
 *
 * @author Fabiano Pecorelli
 * @version 1.0
 * @since 03/12/15
 */
include_once MODEL_DIR . "RispostaMultiplaModel.php";
include_once MODEL_DIR . "RispostaApertaModel.php";
include_once MODEL_DIR . "ElaboratoModel.php";
include_once MODEL_DIR . "DomandaModel.php";
include_once MODEL_DIR . "SessioneModel.php";

$rmMod = new RispostaMultiplaModel();
$raMod = new RispostaApertaModel();
$rmMod = new RispostaMultiplaModel();
$elMod = new ElaboratoModel();
$domandaModel = new DomandaModel();
$sessioneModel = new SessioneModel();
$flag = 0;
$elaboratoStudenteMatricola = $_SESSION['user']->getMatricola();
$sessId = $_REQUEST["sessId"];
if (!is_numeric($sessId)) {
    $flag = 1;
}
if ($flag == 0) {
    $sessione = $sessioneModel->readSessione($sessId);
    $elaborato = $elMod->readElaborato($elaboratoStudenteMatricola, $sessId);
    $testId = $elaborato->getTestId();
    $aperte = $domandaModel->getAllDomandeAperteByTest($testId);
    $multiple = $domandaModel->getAllDomandeMultipleByTest($testId);

    foreach ($aperte as $a) {
        $risp = new RispostaAperta($sessId, $elaboratoStudenteMatricola, $a->getId(), null, null);
        $raMod->createRispostaAperta($risp);
    }

    foreach ($multiple as $m) {
        $risp = new RispostaMultipla($sessId, $elaboratoStudenteMatricola, $m->getId(), null, null);
        $rmMod->createRispostaMultipla($risp);
        if ($sessione->getTipologia() == "Valutativa"){
            $n = $m->getNumeroRisposteValutative() + 1;
            $m.setNumeroRisposteValutative($n);
        }
        else{
            $n = $m->getNumeroRisposteEsercitative() + 1;
            $m.setNumeroRisposteEsercitative($n);
        }
        $domandaModel->updateDomandaMultipla($m->getId(), $m);
    }
}