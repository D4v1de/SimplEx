<?php
/**
 * Controller per la gestione delle statistiche delle domande
 *
 * @author Fabiano Pecorelli
 * @version 1.0
 * @since 22/12/15
 */
include_once MODEL_DIR . "TestModel.php";
$testModel = new TestModel();
include_once MODEL_DIR . "DomandaModel.php";
$domandaModel = new DomandaModel();
include_once MODEL_DIR . "SessioneModel.php";
$sessioneModel = new SessioneModel();

$corsoId = $_GET['corso_id'];
$number = $_GET['num'];
$type = $_GET['type'];
$mod = $_GET['mod'];
$kind = $_GET['kind'];
$sessioni = $sessioneModel->getAllSessionibyCorso($corsoId);

$testsVal = $testModel->getAllTestBySessioneValutativa($corsoId);
$testsEse = $testModel->getAllTestBySessioneEsercitativa($corsoId);


$multiple = $domandaModel->getAllDomandaMultiplaByCorso($corsoId);
$aperte = $domandaModel->getAllDomandaApertaByCorso($corsoId);

$allDomande = array_merge($multiple,$aperte);

$n = count($allDomande);
$n1Ese = count($testsEse);
$n1Val = count($testsVal);
if ($kind == "val"){
    if ($type == "scelto")
        foreach ($allDomande as $a)        
            $toSort[$a->getTesto()] = ($n1Val > 0)? $a->getPercentualeSceltaVal()/$n1Val * 100:0;
    else if ($type == "successo")
        foreach ($multiple as $m){
            $n2 = $m->getNumeroRisposteValutative();
            $toSort[$m->getTesto()] = ($n2 > 0)? $m->getPercentualeRispostaCorrettaVal()/$n2 * 100:0;
        }
}
else{
    if ($type == "scelto")
        foreach ($allDomande as $a)        
            $toSort[$a->getTesto()] = ($n1Ese > 0)? $a->getPercentualeSceltaEse()/$n1Ese * 100:0;
    else if ($type == "successo")
        foreach ($multiple as $m){
            $n2 = $m->getNumeroRisposteEsercitative();
            $toSort[$m->getTesto()] = ($n2 > 0)? $m->getPercentualeRispostaCorrettaEse()/$n2 * 100:0;
        }
}
            
if ($mod != "best")
    asort($toSort);
else
    arsort($toSort);

$keys = null;
$values = null;
foreach ($toSort as $key => $value){
    $keys[] = $key;
    $values[] = round($value,2);
}

$sortedK[] = current($keys);
for ($i = 1; $i < $number; $i++)
    $sortedK[] = next($keys);
$stringK = implode("-",$sortedK);

$sortedV[] = current($values);
for ($i = 1; $i < $number; $i++)
    $sortedV[] = next($values);
$stringV = implode("-",$sortedV);


$toReturn = $stringK."/".$stringV;

echo $toReturn;
    
