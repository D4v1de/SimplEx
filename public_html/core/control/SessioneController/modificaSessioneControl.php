<?php
/**
 * Created by PhpStorm.
 * User: Antonio Luca
 * Date: 23/12/2015
 * Time: 11:52
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

    if($dataFromSettato=isset($_POST['dataFrom']) && $radio1Settato=isset($_POST['radio1']) && $dataToSettato=isset($_POST['dataTo']) && $someTestsAorD=isset($_POST['tests']) ) {

        if($dataFromSettato)
            $newOrOldDataFrom = $_POST['dataFrom'];
        else
            $newOrOldDataFrom= $dataFrom;
        if($dataToSettato)
            $newOrOldDataTo = $_POST['dataTo'];
        else
            $newOrOldDataTo = $_POST['dataTo'];

        $newtipoSessione = $_POST['radio1'];

        $sessioneByUrl = $sessioneModel->readSessione($_URL[4]);
        $stato=$sessioneByUrl->getStato();
        $sogliAmm=$sessioneByUrl->getSogliaAmmissione();

        $timeTo = strtotime( $newOrOldDataTo);
        $toCompareTo = date('yyyy-mm-dd hh:ii:ss', $timeTo);
        $timeFrom = strtotime($newOrOldDataFrom);
        $toCompareFrom = date('yyyy-mm-dd hh:ii:ss', $timeFrom);
        if ($toCompareTo < $toCompareFrom) {
            $flag = 0;
        }

        else {
            try {
                $sessioneAggiornata = new Sessione($newOrOldDataFrom, $newOrOldDataTo, $sogliAmm, $stato, $newtipoSessione, $idCorso);
                $sessioneModel->disabilitaMostraEsito($idSessione);
                $sessioneModel->disabilitaMostraRisposteCorrette($idSessione);

                if (isset($_POST['cbShowEsiti'])) {
                    $sessioneModel->abilitaMostraEsito($idSessione);
                }

                if (isset($_POST['cbShowRispCorr'])) {
                    $sessioneModel->abilitaMostraRisposteCorrette($idSessione);
                }

                $sessioneModel->updateSessione($_URL[4], $sessioneAggiornata);

                if (isset($_POST['tests'])) {
                    $cbTest = Array();
                    $cbTest = $_POST['tests'];
                    $sessioneModel->deleteAllTestFromSessione($idSessione);
                    foreach ($cbTest as $t) {
                        $sessioneModel->associaTestSessione($idSessione, $t);
                        $updated = $testController->readTest($t);
                        $perc = $updated->getPercentualeScelto() +1;
                        $updated->setPercentualeScelto($perc);
                        $testController->updateTest($t, $updated);
                    }
                }

                if($someStudentsChange=isset($_POST['students'])){
                    if ($someStudentsChange) {
                        $cbStudents = Array();
                        $cbStudents = $_POST['students'];
                        $allStuAbi = $sessioneModel->getAllStudentiBySessione($idSessione);
                        foreach ($allStuAbi as $s) {
                            $sessioneModel->disabilitaStudenteSessione($idSessione, $s->getMatricola());
                        }
                        foreach ($cbStudents as $s) {
                            $sessioneModel->abilitaStudenteSessione($idSessione, $s);
                        }
                    }
                }
            }
            catch (ApplicationException $ex) {
                echo "<h1>ERRORE NELLE OPERAZIONI DELLA SESSIONE (fase modifica)!</h1>" . $ex;
            }


            if($flag==0) {
                $tornaACasa = "Location: "."/docente/corso/"."$idCorso"."/sessione/0/creamodificasessione2/error";
            }
            else
                $tornaACasa= "Location: "."/docente/corso/"."$idCorso"."/successmodifica";
            header($tornaACasa);
        }
    }
    else {

    }
