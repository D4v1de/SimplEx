<?php
/**
 * Questo Control permette al docente di creare una sessione.
 * @author Antonio Luca D'Avanzo
 * @version 1
 * @since  22/12/2015 20:03
 */

include_once MODEL_DIR . "SessioneModel.php";
include_once MODEL_DIR . "UtenteModel.php";
include_once MODEL_DIR . "TestModel.php";
include_once MODEL_DIR . "DomandaModel.php";
include_once BEAN_DIR . "Sessione.php";

$sessioneModel = new SessioneModel();
$utenteModel = new UtenteModel();
$domandaModel = new DomandaModel();
$testModel = new TestModel();
$idCorso ="";
$idCorso = $_URL[2];
if (!is_numeric($idCorso)) {
    echo "<script type='text/javascript'>alert('errore nella url!!!');</script>";
}
$flag=1;
$pio=1;
$someTestsAorD=false;


    if(isset($_POST['dataFrom']) && isset($_POST['radio1']) && isset($_POST['dataTo']) && $someTestsAorD=isset($_POST['tests']) ) {

        $newdataFrom = $_POST['dataFrom'];
        $newdataTo = $_POST['dataTo'];
        $newtipoSessione = $_POST['radio1'];

        $sogliAmm = 18;
        $stato = 'Non Eseguita';

        $timeTo = strtotime($newdataTo);
        $toCompareTo = date('y-m-d H:i:s', $timeTo);

        $timeFrom = strtotime($newdataFrom);
        $toCompareFrom = date('y-m-d H:i:s', $timeFrom);

        if ($toCompareTo < $toCompareFrom) {
            $flag = 0;
        } else {
            $sessione = new Sessione($newdataFrom, $newdataTo, $sogliAmm, $stato, $newtipoSessione, $idCorso);
            try {

                $idNuovaSessione = $sessioneModel->createSessione($sessione);

                if (isset($_POST['cbShowEsiti'])) {
                    $sessioneModel->abilitaMostraEsito($idNuovaSessione);
                }

                if (isset($_POST['cbShowRispCorr'])) {
                    $sessioneModel->abilitaMostraRisposteCorrette($idNuovaSessione);
                }

                if (isset($_POST['students'])) {
                    $cbStudents = $_POST['students'];
                    if ($cbStudents == null) {
                        echo "<h1>CBSTUDENTS VUOTO!</h1>";
                    } else {
                        foreach ($cbStudents as $s) {
                            $utenteModel->abilitaStudenteSessione($idNuovaSessione,$s);
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
                        $updated = $testModel->readTest($t);
                        if ($newtipoSessione == "Valutativa"){
                            $perc = $updated->getPercentualeSceltoVal() +1;
                            $updated->setPercentualeSceltoVal($perc);
                        }
                        else{
                            $perc = $updated->getPercentualeSceltoEse() +1;
                            $updated->setPercentualeSceltoEse($perc);
                        }
                        $aperte = $domandaModel->getAllDomandeAperteByTest($t);
                        foreach ($aperte as $updatedDom){
                            if ($newtipoSessione == "Valutativa"){
                                $percDom = $updatedDom->getPercentualeSceltaVal() +1;
                                $updatedDom->setPercentualeSceltaVal($percDom);
                            }
                            else{
                                $percDom = $updatedDom->getPercentualeSceltaEse() +1;
                                $updatedDom->setPercentualeSceltaEse($percDom);
                            }
                            $domandaModel->updateDomandaAperta($updatedDom->getId(), $updatedDom);
                        }
                        $multiple = $domandaModel->getAllDomandeMultipleByTest($t);
                        foreach ($multiple as $updatedDom){
                            if ($newtipoSessione == "Valutativa"){
                                $percDom = $updatedDom->getPercentualeSceltaVal() +1;
                                $updatedDom->setPercentualeSceltaVal($percDom);
                            }
                            else{
                                $percDom = $updatedDom->getPercentualeSceltaEse() +1;
                                $updatedDom->setPercentualeSceltaEse($percDom);
                            }
                            $domandaModel->updateDomandaMultipla($updatedDom->getId(), $updatedDom);
                        }
                $testModel->updateTest($t, $updated);
                    }
                }
            } catch (ApplicationException $ex) {
                echo "<h1>ERRORE NELLE OPERAZIONI DELLA SESSIONE (fase creazione)!</h1>" . $ex;
            }
        }
        if($flag==0) {
            $_SESSION['flag'] = $flag;
            $tornaACasa = "Location: "."/docente/corso/"."$idCorso"."/sessione/0/creamodificasessione";
        }
        else
            $tornaACasa= "Location: "."/docente/corso/"."$idCorso"."/successinserimento";
        header($tornaACasa);

    }

if($someTestsAorD==false) {
    $pio=0;
    $_SESSION['pio'] = $pio;
    $tornaACasa = "Location: "."/docente/corso/"."$idCorso"."/sessione/0/creamodificasessione";
    header($tornaACasa);
}

