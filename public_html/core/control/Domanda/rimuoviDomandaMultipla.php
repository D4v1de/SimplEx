<?php
/**
 * Created by PhpStorm.
 * User: pasquale
 * Date: 29/12/15
 * Time: 12.36
 */

include_once MODEL_DIR . "DomandaModel.php";
$domandaModel = new DomandaModel();

if(isset($_POST['domandamultipla'])) {
    $idDomanda = $_POST['domandamultipla'];
    $idCorso = $_POST['idcorso'];
    $idArgomento = $_POST['idargomento'];
    $domanda = $domandaModel->readDomandaMultipla($idDomanda);
    if($domanda->getArgomentoId() == $idArgomento) {
        $domandaModel->deleteDomandaMultipla($idDomanda);
        header('Location: /docente/corso/' . $idCorso . '/argomento/domande/' . $idArgomento);
    } else {
        header('Location: /docente/corso/' . $idCorso . '/argomento/domande/' . $idArgomento);
    }
}
?>