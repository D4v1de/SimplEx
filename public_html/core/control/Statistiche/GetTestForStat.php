<?php
/**
 * Controller per la gestione delle statistiche dei test
 *
 * @author Fabiano Pecorelli
 * @version 1.0
 * @since 22/12/15
 */
include_once MODEL_DIR . "TestModel.php";
$testModel = new TestModel();
include_once MODEL_DIR . "SessioneModel.php";
$sessioneModel = new SessioneModel();
$flag = 0;
$toSort = Array();
$corsoId = $_GET['corso_id'];
if (!is_numeric($corsoId)) {
    $flag = 1;
}
$number = $_GET['num'];
if (!is_numeric($number)) {
    $flag = 1;
}
$type = $_GET['type'];
if (empty($type) || !preg_match('/^[a-zA-Z0-9\s-èòìàù]+$/', $type)) {
    $flag = 1;
}
$mod = $_GET['mod'];
if (empty($mod) || !preg_match('/^[a-zA-Z0-9\s-èòìàù]+$/', $mod)) {
    $flag = 1;
}
$kind = $_GET['kind'];
if (empty($kind) || !preg_match('/^[a-zA-Z0-9\s-èòìàù]+$/', $kind)) {
    $flag = 1;
}
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
            $n2 = $tests[$i]->getNumeroSceltaValutativa();
            $toSort[$tests[$i]->getId()] = ($n2 > 0)? $tests[$i]->getPercentualeSuccessoVal()/$n2 * 100:0;
        }
}
else{
    if ($type == "scelto")
        for ($i=0; $i < $n; $i++)        
            $toSort[$tests[$i]->getId()] = ($n1Ese > 0)? $tests[$i]->getPercentualeSceltoEse()/$n1Ese * 100:0;
    else if ($type == "successo")
        for ($i=0; $i < $n; $i++){
            $n2 = $tests[$i]->getNumeroSceltaEsercitativa();
            $toSort[$tests[$i]->getId()] = ($n2 > 0)? $tests[$i]->getPercentualeSuccessoEse()/$n2 * 100:0;
        }
}
        
            
if ($toSort != null){
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
    
}