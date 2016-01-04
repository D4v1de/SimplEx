<?php
/**
 * Questo Control permette al docente di modificare una sessione.
 * @author Antonio Luca D'Avanzo
 * @version 1
 * @since  23/12/2015 11:00
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
$flag=1;
$pio=1;
$idSessione="";
$idSessione= $_URL[4];
if (!is_numeric($idSessione)) {
    echo "<script type='text/javascript'>alert('errore nella url!!!');</script>";
}
$idCorso ="";
$idCorso = $_URL[2];
if (!is_numeric($idCorso)) {
    echo "<script type='text/javascript'>alert('errore nella url!!!');</script>";
}


    if($dataFromSettato=isset($_POST['dataFrom']) && $radio1Settato=isset($_POST['radio1']) && $dataToSettato=isset($_POST['dataTo'])) {

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
        $oldTipologia=$sessioneByUrl->getTipologia();
        
        
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
                    $tests = $testModel->getAllTestBySessione($idSessione);
                    $sessioneModel->deleteAllTestFromSessione($idSessione);
                    foreach ($tests as $updated) {
                        if ($oldTipologia == "Valutativa"){
                            $perc = $updated->getPercentualeSceltoVal() -1;
                            $updated->setPercentualeSceltoVal($perc);
                        }
                        else{
                            $perc = $updated->getPercentualeSceltoEse() -1;
                            $updated->setPercentualeSceltoEse($perc);
                        }
                        $aperte = $domandaModel->getAllDomandeAperteByTest($updated->getId());
                        foreach ($aperte as $updatedDom){
                            if ($oldTipologia == "Valutativa"){
                                $percDom = $updatedDom->getPercentualeSceltaVal() -1;
                                $updatedDom->setPercentualeSceltaVal($percDom);
                            }
                            else{
                                $percDom = $updatedDom->getPercentualeSceltaEse() -1;
                                $updatedDom->setPercentualeSceltaEse($percDom);
                            }
                            $domandaModel->updateDomandaAperta($updatedDom->getId(), $updatedDom);
                        }
                        $multiple = $domandaModel->getAllDomandeMultipleByTest($updated->getId());
                        foreach ($multiple as $updatedDom){
                            if ($oldTipologia == "Valutativa"){
                                $percDom = $updatedDom->getPercentualeSceltaVal() -1;
                                $updatedDom->setPercentualeSceltaVal($percDom);
                            }
                            else{
                                $percDom = $updatedDom->getPercentualeSceltaEse() -1;
                                $updatedDom->setPercentualeSceltaEse($percDom);
                            }
                            $domandaModel->updateDomandaMultipla($updatedDom->getId(), $updatedDom);
                        }
                        $testModel->updateTest($updated->getId(), $updated);
                    }
                    foreach ($cbTest as $t) {
                        $sessioneModel->associaTestSessione($idSessione, $t);
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

                if($someStudentsChange=isset($_POST['students'])){
                    if ($someStudentsChange) {
                        $cbStudents = Array();
                        $cbStudents = $_POST['students'];
                        $allStuAbi = $utenteModel->getAllStudentiSessione($idSessione);
                        foreach ($allStuAbi as $s) {
                            $utenteModel->disabilitaStudenteSessione($idSessione, $s->getMatricola());
                        }
                        foreach ($cbStudents as $s) {
                            $utenteModel->abilitaStudenteSessione($idSessione, $s);
                        }
                    }
                }
            }
            catch (ApplicationException $ex) {
                echo "<h1>ERRORE NELLE OPERAZIONI DELLA SESSIONE (fase modifica)!</h1>" . $ex;
            }
        }


        if($flag==0) {
            $_SESSION['flag'] = $flag;
            $tornaACasa = "Location: "."/docente/corso/"."$idCorso"."/sessione/".$idSessione."/creamodificasessione2/error";
        }
        else {
            $tornaACasa = "Location: " . "/docente/corso/" . "$idCorso" . "/successmodifica";
        }
        header($tornaACasa);
    }
    else {

    }


/* da termina vado qui e da qui a esiti
$newSessione = new Sessione($dataFrom, $dataTo, $soglia, "In esecuzione", $tipoSessione, $identificativoCorso);
$sessioneModel->updateSessione($idSessione,$newSessione);*/
