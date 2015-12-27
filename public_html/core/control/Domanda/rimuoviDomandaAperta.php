<?php
/**
 * Created by PhpStorm.
 * User: Carlo
 * Date: 27/12/15
 * Time: 13:30
 */

include_once MODEL_DIR . "DomandaModel.php";
$domandaModel = new DomandaModel();

if(isset($_POST['domandaaperta'])){
    $iddomanda = $_POST['domandaaperta'];
    $idcorso = $_POST['idcorso'];
    $idargomento = $_POST['idargomento'];
    $domandaModel->deleteDomandaAperta($iddomanda);
    header('Location: /docente/corso/'. $idcorso .'/argomento/domande/leggiargomento/' . $idargomento);
}