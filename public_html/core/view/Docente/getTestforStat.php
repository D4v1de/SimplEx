<?php
/**
 * Created by NetBeans.
 * User: Fabiano
 * Date: 03/12/15
 * Time: 16:00
 */
include_once MODEL_DIR . "TestModel.php";
$testModel = new TestModel();
include_once MODEL_DIR . "ElaboratoModel.php";
$elaboratoModel = new ElaboratoModel();
include_once MODEL_DIR . "SessioneModel.php";
$sessioneModel = new SessioneModel();

$corsoId = $_GET['corso_id'];
$number = $_GET['num'];
$type = $_GET['type'];
$mod = $_GET['mod'];
$kind = $_GET['kind'];
$tests = $testModel->getAllTestbyCorso($corsoId);
$sessioni = $sessioneModel->getAllSessionibyCorso($corsoId);

$n = count($tests);

if ($type == "scelto"){
    $n1Val = 0;
    $n1Ese = 0;
    foreach ($sessioni as $s){
        if ($s->getTipologia() == "Valutativa")
            $n1Val++;
        else $n1Ese++;
    }
}
if ($kind == "val"){
    if ($type == "scelto")
        for ($i=0; $i < $n; $i++)        
            $toSort[$tests[$i]->getId()] = ($n1Val > 0)? $tests[$i]->getPercentualeSceltoVal()/$n1Val * 100:0;
    else if ($type == "successo")
        for ($i=0; $i < $n; $i++){
            $n2 = 100;// $testModel->readNumeroSceltaTestValutativa($tests[$i]->getId());
            $toSort[$tests[$i]->getId()] = ($n2 > 0)? $tests[$i]->getPercentualeSuccessoVal()/$n2 * 100:0;
        }
}
else{
    if ($type == "scelto")
        for ($i=0; $i < $n; $i++)        
            $toSort[$tests[$i]->getId()] = ($n1Ese > 0)? $tests[$i]->getPercentualeSceltoEse()/$n1Ese * 100:0;
    else if ($type == "successo")
        for ($i=0; $i < $n; $i++){
            $n2 =100;// $testModel->readNumeroSceltaTestEsercitativa($tests[$i]->getId());
            $toSort[$tests[$i]->getId()] = ($n2 > 0)? $tests[$i]->getPercentualeSuccessoEse()/$n2 * 100:0;
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
    
