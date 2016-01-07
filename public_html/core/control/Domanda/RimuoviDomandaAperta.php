<?php
/**
 * Controller che permette di rimuovere una Domanda Aperta
 * @author  Carlo, Pasquale
 * @version 1.3
 * @since 28/12/15 11:02
 */

include_once MODEL_DIR . "DomandaModel.php";
$domandaModel = new DomandaModel();

if(isset($_POST['domandaaperta'])){

    $iddomanda = $_POST['domandaaperta'];
    $idcorso = $_POST['idcorso'];
    $idargomento = $_POST['idargomento'];
    $domanda = $domandaModel->readDomandaAperta($iddomanda);
    if($domanda->getArgomentoId() == $idargomento) {
        $domandaModel->deleteDomandaAperta($iddomanda);
        header('Location: /docente/corso/' . $idcorso . '/argomento/domande/' . $idargomento);
    } else {
        header('Location: /docente/corso/' . $idcorso . '/argomento/domande/' . $idargomento);
    }
}