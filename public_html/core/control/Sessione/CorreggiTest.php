<?php
/**
 * Questo Control permette al docente di correggere un test.
 * @author Antonio Luca D'Avanzo
 * @version 1
 * @since  31/12/2015 00:46
 */
include_once MODEL_DIR . "ElaboratoModel.php";
include_once MODEL_DIR . "SessioneModel.php";
include_once MODEL_DIR . "RispostaApertaModel.php";
include_once MODEL_DIR . "RispostaMultiplaModel.php";
include_once MODEL_DIR . "DomandaModel.php";
include_once MODEL_DIR . "UtenteModel.php";
include_once MODEL_DIR . "CorsoModel.php";
include_once MODEL_DIR . "TestModel.php";
include_once MODEL_DIR . "AlternativaModel.php";
include_once BEAN_DIR . "Sessione.php";

$sessioneModel = new SessioneModel();
$utenteModel = new UtenteModel();
$testModel = new TestModel();
$corsoModel = new CorsoModel();
$altMod = new AlternativaModel();
$elaboratoModel= new ElaboratoModel();
$modelDomanda = new DomandaModel();
$modelRispostaAperta = new RispostaApertaModel();
$modelRispostaMultipla = new RispostaMultiplaModel();

$corso = null;
$sessione = null;
$test = null;
$elaborato = null;
$studente = null;
$max=null;
$dom=null;
$multiple = Array();
$aperte = Array();
//$corretta = null;
$rispostaaperta = null;
$rispostamultipla = null;
$i = 0;
$url = null;
$url2 = null;
$matricola = $_URL[6];
if (!is_numeric($matricola)) {
    echo "<script type='text/javascript'>alert('errore nella url!!!');</script>";
}
$url = $_URL[2];
if (!is_numeric($url)) {
    echo "<script type='text/javascript'>alert('errore nella url!!!');</script>";
}
$url2 = $_URL[4];
if (!is_numeric($url2)) {
    echo "<script type='text/javascript'>alert('errore nella url!!!');</script>";
}
$sessioneId=$url2;

$studente=$utenteModel->getUtenteByMatricola($matricola);

try {
    $corso = $corsoModel->readCorso($url);
} catch (ApplicationException $ex) {
    echo "<h1>INSERIRE ID CORSO NEL PATH!</h1>" . $ex;
}

try {
    $elaborato = $elaboratoModel->readElaborato($studente->getMatricola(), $url2);
} catch (ApplicationException $ex) {
    echo "<h1>READELABORATO FALLITO!</h1>" . $ex;
}
try {
    $sessione = $sessioneModel->readSessione($url2);
} catch (ApplicationException $ex) {
    echo "<h1>INSERIRE ID SESSIONE NEL PATH!</h1>" . $ex;
}
try {
    $test = $testModel->readTest($elaborato->getTestId());
} catch (ApplicationException $ex) {
    echo "<h1>READTEST FALLITO!</h1>" . $ex;
}
try {
    $multiple = $modelDomanda->getAllDomandeMultipleByTest($test->getId());
} catch (ApplicationException $ex) {
    echo "<h1>GETALLDOMANDEMULTIPLEBYTEST FALLITO!</h1>" . $ex;
}
try {
    $aperte = $modelDomanda->getAllDomandeAperteByTest($test->getId());
} catch (ApplicationException $ex) {
    echo "<h1>GETALLDOMANDEAPERTEBYTEST FALLITO!</h1>" . $ex;
}

if ($elaborato->getStato() == "Non corretto") {
    $rispMul = $modelRispostaMultipla->getMultipleByElaborato($elaborato);
    $punteggio = 0;
    foreach ($rispMul as $rm) {
        $multId = $rm->getDomandaMultiplaId();
        $dom = $modelDomanda->readDomandaMultipla($multId);
        $puntCorrAlt = $modelDomanda->readPunteggioCorrettaAlternativo($multId, $elaborato->getTestId());
        $puntErrAlt = $modelDomanda->readPunteggioErrataAlternativo($multId, $elaborato->getTestId());
        $puntCor = ($puntCorrAlt != null) ? $puntCorrAlt : $dom->getPunteggioCorretta();
        $puntErr = ($puntErrAlt != null) ? $puntErrAlt : $dom->getPunteggioErrata();
        $altCor = $altMod->getAlternativaCorrettaByDomanda($multId);
        $altId = $rm->getAlternativaId();
        if ($altId != 0) {
            if ($altCor->getId() == $rm->getAlternativaId()) {
                $punteggio = $punteggio + $puntCor;
                $rm->setPunteggio($puntCor);

                $updatedDom = $modelDomanda->readDomandaMultipla($multId);
                if ($tipologia == "Valutativa") {
                    $percDom = $updatedDom->getPercentualeRispostaCorrettaVal() + 1;
                    $updatedDom->setPercentualeRispostaCorrettaVal($percDom);
                } else {
                    $percDom = $updatedDom->getPercentualeRispostaCorrettaEse() + 1;
                    $updatedDom->setPercentualeRispostaCorrettaEse($percDom);
                }
                $modelDomanda->updateDomandaMultipla($multId, $updatedDom);
            } else {
                $punteggio = $punteggio + $puntErr;
                $rm->setPunteggio($puntErr);
            }
            $updated = $altMod->readAlternativa($altId);
            $perc = $updated->getPercentualeScelta() + 1;
            $updated->setPercentualeScelta($perc);
            $altMod->updateAlternativa($altId, $updated);
        }
        $modelRispostaMultipla->updateRispostaMultipla($rm, $sessioneId, $matricola, $rm->getDomandaMultiplaId());
    }
    $elaborato->setEsitoParziale($punteggio);
    $elaborato->setStato("Parzialmente corretto");
    $elaboratoModel->updateElaborato($matricola, $sessioneId, $elaborato);
}


if (isset($_POST['salva'])){
    //valore di $_POST non utilizzato.
    $fin = $elaborato->getEsitoParziale();
    foreach ($aperte as $ap){
        $apId = $ap->getId();
        $punt = $_POST['sel-'.$apId.''];
        $fin = $fin + $punt;
        $rispAp = $modelRispostaAperta->readRispostaAperta($url2, $matricola, $apId);
        $rispAp->setPunteggio($punt);
        $modelRispostaAperta->updateRispostaAperta($rispAp, $url2, $matricola, $apId);
    }
    $elaborato->setEsitoFinale($fin);

    $updated = $test;
    $soglia = $sessione->getSogliaAmmissione();
    $tipologia = $sessione->getTipologia();
    if ($fin >= $soglia){
        if ($tipologia == "Valutativa"){
            $perc = $updated->getPercentualeSuccessoVal() +1;
            $updated->setPercentualeSuccessoVal($perc);
        }
        else{
            $perc = $updated->getPercentualeSuccessoEse() +1;
            $updated->setPercentualeSuccessoEse($perc);
        }
        $testModel->updateTest($elaborato->getTestId(), $updated);
    }

    $elaborato->setStato("Corretto");
    $elaboratoModel->updateElaborato($matricola,$url2,$elaborato);
    header("Location: "."/docente/corso/".$corso->getId()."/sessione"."/".$sessione->getId()."/"."esiti/show");
}