<?php
/**
 * Controller che permette di rimuovere una Domanda Multipla
 * @author Pasquale
 * @version 1.3
 * @since 28/12/15 11:13
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