<?php
/**
 * Controller che permette di modificare una Domanda Multipla
 * @author  Pasquale
 * @version 1.3
 * @since 28/12/15 12:18
 */


include_once MODEL_DIR . "DomandaModel.php";
include_once MODEL_DIR . "AlternativaModel.php";

$domandaModel = new DomandaModel();
$alternativaModel = new AlternativaModel();

$idArgomento = $_POST['idargomento'];
$idCorso = $_POST['idcorso'];
$idDomanda = $_POST['iddomanda'];
$testoRisposte = array();

for($j=1;$j<16;$j++){
    if(isset($_POST['testoRisposta'.$j])){
        $testoRisposte[$j-1] = $_POST['testoRisposta'.$j];
    }
}


if (isset($_POST['eliminatore'])) {
    $idAlternativaDaEliminare = $_POST['eliminatore'];
    $alternativaModel->deleteAlternativa($idAlternativaDaEliminare);
    header("Location: /docente/corso/" . $idCorso . "/argomento/domande/modificamultipla/" . $idArgomento . "/" . $idDomanda ."/successelimina");
} else {

    if (isset($_POST['testoDomanda']) && isset($_POST['punteggioErrata']) && isset($_POST['punteggioEsatta']) && isset($testoRisposte) && isset($_POST['radio'])) {
        $testoDomanda = $_POST['testoDomanda'];
        $punteggioErrata = $_POST['punteggioErrata'];
        $punteggioEsatta = $_POST['punteggioEsatta'];
        $radio = $_POST['radio'];
        $controlloRisposte = true;

        for($i=0;$i<count($testoRisposte);$i++){
            if(strlen($testoRisposte[$i])<1 || strlen($testoRisposte[$i])>100){
                $controlloRisposte = false;
            }
        }

        if (strlen($testoDomanda) < 2 || strlen($testoDomanda) > 500) {
            $_SESSION['errore'] = 1;
            header('Location: /docente/corso/' . $idCorso . '/argomento/domande/modificamultipla/' . $idArgomento .'/' .$idDomanda);
        } else if ($punteggioEsatta <= 0) {
            $_SESSION['errore'] = 2;
            header('Location: /docente/corso/' . $idCorso . '/argomento/domande/modificamultipla/' . $idArgomento .'/' .$idDomanda);
        } else if ($punteggioErrata > 0) {
            $_SESSION['errore'] = 3;
            header('Location: /docente/corso/' . $idCorso . '/argomento/domande/modificamultipla/' . $idArgomento .'/' .$idDomanda);
        } else if ($controlloRisposte == false) {
            $_SESSION['errore'] = 4;
            header('Location: /docente/corso/' . $idCorso . '/argomento/domande/modificamultipla/' . $idArgomento .'/' .$idDomanda);
        } else if (!isset($radio)) {
            $_SESSION['errore'] = 5;
            header('Location: /docente/corso/' . $idCorso . '/argomento/domande/modificamultipla/' . $idArgomento .'/' .$idDomanda);
        } else {

            $updatedDomanda = new DomandaMultipla($idArgomento, $testoDomanda, $punteggioEsatta, $punteggioErrata, 0, 0, 0, 0, 0, 0);

            $domandaModel->updateDomandaMultipla($idDomanda, $updatedDomanda);

            $alternative = $alternativaModel->getAllAlternativaByDomanda($idDomanda);

            for ($i = 0; $i < count($testoRisposte); $i++) {
                $idAlternativa = $alternative[$i]->getId();
                if (($i + 1) == $radio) {
                    $corretta = "Si";
                } else {
                    $corretta = "No";
                }

                $updatedAlternativa = new Alternativa($idDomanda, $testoRisposte[$i], 0, $corretta);
                $alternativaModel->updateAlternativa($idAlternativa, $updatedAlternativa);
            }

            if (isset($_POST['risposteNuove'])) {
                $rispostenuove = $_POST['risposteNuove'];
                $prevCount = count($testoRisposte);
                foreach ($rispostenuove as $item) {
                    if ($item == null || $item == '') {
                        continue;
                    } else {
                        if (++$prevCount == $radio) {
                            $corretta2 = "Si";
                        } else {
                            $corretta2 = "No";
                        }
                        $nuovaAlternativa = new Alternativa($idDomanda, $item, 0, $corretta2);
                        $alternativaModel->createAlternativa($nuovaAlternativa);
                    }
                }
            }

            header('Location: /docente/corso/' . $idCorso . '/argomento/domande/' . $idArgomento . '/successmodifica');
        }
    }else if(!isset($_POST['testoDomanda'])){
        $_SESSION['errore'] = 1;
        header('Location: /docente/corso/' . $idCorso . '/argomento/domande/modificamultipla/' . $idArgomento .'/' .$idDomanda);
    }else if(!isset($_POST['punteggioEsatta'])){
        $_SESSION['errore'] = 2;
        header('Location: /docente/corso/' . $idCorso . '/argomento/domande/modificamultipla/' . $idArgomento .'/' .$idDomanda);
    }else if(!isset($_POST['punteggioErrata'])){
        $_SESSION['errore'] = 3;
        header('Location: /docente/corso/' . $idCorso . '/argomento/domande/modificamultipla/' . $idArgomento .'/' .$idDomanda);
    }else if(!isset($_POST['testoRisposta'])){
        $_SESSION['errore'] = 4;
        header('Location: /docente/corso/' . $idCorso . '/argomento/domande/modificamultipla/' . $idArgomento .'/' .$idDomanda);
    }else if(!isset($_POST['radio'])){
        $_SESSION['errore'] = 5;
        header('Location: /docente/corso/' . $idCorso . '/argomento/domande/modificamultipla/' . $idArgomento .'/' .$idDomanda);
    }
}