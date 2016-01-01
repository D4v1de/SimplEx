<?php
/**
 * Created by PhpStorm.
 * User: Antonio Luca
 * Date: 31/12/2015
 * Time: 00:46
 */
include_once MODEL_DIR . "ElaboratoModel.php";
include_once MODEL_DIR . "SessioneModel.php";
include_once MODEL_DIR . "AlternativaModel.php";
include_once MODEL_DIR . "RispostaApertaModel.php";
include_once MODEL_DIR . "RispostaMultiplaModel.php";
include_once MODEL_DIR . "DomandaModel.php";
include_once MODEL_DIR . "UtenteModel.php";
include_once MODEL_DIR . "CdLModel.php";
include_once MODEL_DIR . "CorsoModel.php";
include_once MODEL_DIR . "TestModel.php";
include_once BEAN_DIR . "Sessione.php";

$sessioneModel = new SessioneModel();
$utenteModel = new UtenteModel();
$testModel = new TestModel();
$corsoModel = new CorsoModel();
$cdlModel = new CdLModel();
$elaboratoModel= new ElaboratoModel();
$modelDomanda = new DomandaModel();
$modelAlternativa = new AlternativaModel();
$modelRispostaAperta = new RispostaApertaModel();
$modelRispostaMultipla = new RispostaMultiplaModel();


$url = null;
$url2 = null;
$matricola = $_URL[6];
$url2 = $_URL[4];
$url = $_URL[2];
$studente=$utenteModel->getUtenteByMatricola($matricola);
try {
    $elaborato = $elaboratoModel->readElaborato($studente->getMatricola(), $url2);
} catch (ApplicationException $ex) {
    echo "<h1>READELABORATO FALLITO!</h1>" . $ex;
}

if (isset($_POST['salva'])){
    echo "ciao";
    $fin = $elaborato->getEsitoParziale();
    foreach ($aperte as $ap){
        $apId = $ap->getId();
        $punt = $_GET['sel-'.$apId.''];
        $fin = $fin + $punt;
        $rispAp = $modelRispostaAperta->readRispostaAperta($url2, $matricola, $apId);
        $rispAp->setPunteggio($punt);
        $modelRispostaAperta->updateRispostaAperta($rispAp, $url2, $matricola, $apId);
    }
    $elaborato->setEsitoFinale($fin);

    $updated = $test;
    $soglia = $sessione->getSogliaAmmissione();
    if ($fin >= $soglia){
        $perc = $updated->getPercentualeSuccesso() +1;
        $updated->setPercentualeSuccesso($perc);
        $testModel->updateTest($elaborato->getTestId(), $updated);
    }

    $elaborato->setStato("Corretto");
    $elaboratoModel->updateElaborato($matricola,$url2,$elaborato);
    header("Location: "."/docente/corso/".$corso->getId()."/sessione"."/".$sessione->getId()."/"."esiti/show");
}