<?php
/**
 * Created by NetBeans.
 * User: Fabiano
 * Date: 03/12/15
 * Time: 16:00
 */
include_once CONTROL_DIR . "TestController.php";
$testController = new TestController();
include_once CONTROL_DIR . "ElaboratoController.php";
$elaboratoController = new ElaboratoController();

$corsoId = $_GET['corso_id'];
$number = $_GET['num'];
$type = $_GET['type'];
$mod = $_GET['mod'];
$tests = $testController->getAllTestbyCorso($corsoId);

$n = count($tests);

if ($type == "scelto")
    for ($i=0; $i < $n; $i++)        
        $toSort[$tests[$i]->getId()] = ($n != 0)? $tests[$i]->getPercentualeScelto()/$n * 100:0;
else if ($type == "successo")
    for ($i=0; $i < $n; $i++){
        $n2 = $tests[$i]->getPercentualeScelto();
            
        $toSort[$tests[$i]->getId()] = ($n2 != 0)? $tests[$i]->getPercentualeSuccesso()/$tests[$i]->getPercentualeScelto() * 100:0;
    }
if ($mod != "best")
    asort($toSort);
else
    arsort($toSort);

$keys = null;
$values = null;
foreach ($toSort as $key => $value){
    $keys[] = $key;
    if ($type == "scelto")
        $values[] = round($value,2);
    else if ($type == "successo"){
            $values[] = round($value,2);
        }
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

echo "$toReturn";
    
