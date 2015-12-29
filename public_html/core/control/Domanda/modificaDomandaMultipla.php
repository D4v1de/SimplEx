<?php
/**
 * Created by PhpStorm.
 * User: pasquale
 * Date: 29/12/15
 * Time: 12.43
 */
include_once MODEL_DIR . "DomandaModel.php";
include_once MODEL_DIR . "AlternativaModel.php";

$domandaModel = new DomandaModel();
$alternativaModel = new AlternativaModel();
$idArgomento = $_POST['idargomento'];
$idCorso = $_POST['idcorso'];
$idDomanda = $_POST['iddomanda'];

if (isset($_POST['eliminatore'])) {
    $idAlternativaDaEliminare = $_POST['eliminatore'];
    $alternativaModel->deleteAlternativa($idAlternativaDaEliminare);
    header("Location: /docente/corso/" . $idCorso . "/argomento/domande/modificamultipla/" . $idArgomento . "/" . $idDomanda ."/successelimina");
} else {

    if (isset($_POST['testoDomanda']) && isset($_POST['punteggioErrata']) && isset($_POST['punteggioEsatta']) && isset($_POST['testoRisposta']) && isset($_POST['radio'])) {
        $testoDomanda = $_POST['testoDomanda'];
        $punteggioErrata = $_POST['punteggioErrata'];
        $punteggioEsatta = $_POST['punteggioEsatta'];
        $testoRisposte = $_POST['testoRisposta'];
        $radio = $_POST['radio'];

        $updatedDomanda = new DomandaMultipla($idArgomento, $testoDomanda, $punteggioEsatta, $punteggioErrata, 0, 0);

        $domandaModel->updateDomandaMultipla($idDomanda, $updatedDomanda);

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

}