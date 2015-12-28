<?php
/**
 * Created by PhpStorm.
 * User: Antonio Luca
 * Date: 22/12/2015
 * Time: 17:14
 */

include_once MODEL_DIR . "SessioneModel.php";
include_once MODEL_DIR . "UtenteModel.php";
include_once MODEL_DIR . "TestModel.php";
include_once BEAN_DIR . "Sessione.php";

$sessioneModel = new SessioneModel();
$utenteModel = new UtenteModel();
$testModel = new TestModel();
$flag=1;
$idCorso = $_URL[2];



    if(isset($_POST['dataFrom']) && isset($_POST['radio1']) && isset($_POST['dataTo']) && $someTestsAorD=isset($_POST['tests']) ) {
        $newdataFrom = $_POST['dataFrom'];
        $newdataTo = $_POST['dataTo'];
        $newtipoSessione = $_POST['radio1'];

        $sogliAmm = 18;
        $stato = 'Non Eseguita';

        $timeTo = strtotime($newdataTo);
        $toCompareTo = date('yyyy-mm-dd hh:ii:ss', $timeTo);

        $timeFrom = strtotime($newdataFrom);
        $toCompareFrom = date('yyyy-mm-dd hh:ii:ss', $timeFrom);

        if ($toCompareTo < $toCompareFrom) {
            $flag = 0;
        } else {
            $sessione = new Sessione($newdataFrom, $newdataTo, $sogliAmm, $stato, $newtipoSessione, $idCorso);
            try {

                $idNuovaSessione = $sessioneModel->createSessione($sessione);

                if (isset($_POST['cbShowEsiti'])) {
                    $sessioneModel->abilitaMostraEsito($idNuovaSessione);
                  //  $controller->abilitaMostraEsito($idNuovaSessione);
                }

                if (isset($_POST['cbShowRispCorr'])) {
                    $sessioneModel->abilitaMostraRisposteCorrette($idNuovaSessione);
                    //$controller->abilitaMostraRisposteCorrette($idNuovaSessione);
                }

                if (isset($_POST['students'])) {
                    $cbStudents = $_POST['students'];
                    if ($cbStudents == null) {
                        echo "<h1>CBSTUDENTS VUOTO!</h1>";
                    } else {
                        foreach ($cbStudents as $s) {
                            $utenteModel->abilitaStudenteSessione($idNuovaSessione,$s);
                            //$controller->abilitaStudenteASessione($idNuovaSessione, $s);
                        }
                    }
                }

                if ($someTestsAorD) {
                    $cbTest = Array();
                    $cbTest = $_POST['tests'];
                    if ($cbTest != null) {
                        print_r($cbTest);
                    }

                    foreach ($cbTest as $t) {
                        $sessioneModel->associaTestSessione($idNuovaSessione,$t);
                        //$controller->associaTestASessione($idNuovaSessione, $t);
                        $updated = $testModel->readTest($t);
                        $perc = $updated->getPercentualeScelto() +1;
                        $updated->setPercentualeScelto($perc);
                        $testModel->updateTest($t, $updated);
                    }

                    //Statistica percentuale scelta test

                    /*$allTests = $testController->getAllTestbyCorso($idCorso);
                    $sessioni = $controller->getAllSessioniByCorso($idCorso);
                    foreach ($allTests as $test){
                        $testId = $test->getId();
                        $c = 0;
                        foreach ($sessioni as $s){
                            $tests = $testController->getAllTestBySessione($s->getId());
                            foreach ($tests as $t)
                                if ($t->getId() == $testId)
                                    $c++;
                            }
                            $updated = $testController->readTest($testId);
                            $perc = $c/count($sessioni) * 100;
                            $updated->setPercentualeScelto($perc);
                            $testController->updateTest($testId, $updated);
                        }*/
                }
            } catch (ApplicationException $ex) {
                echo "<h1>ERRORE NELLE OPERAZIONI DELLA SESSIONE (fase creazione)!</h1>" . $ex;
            }
        }
        if($flag==0) {
            $tornaACasa = "Location: "."/docente/corso/"."$idCorso"."/sessione/0/creamodificasessione2/error";
        }
        else
            $tornaACasa= "Location: "."/docente/corso/"."$idCorso"."/successinserimento";
        header($tornaACasa);
    }


