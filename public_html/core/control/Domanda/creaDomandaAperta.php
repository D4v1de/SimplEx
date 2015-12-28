<?php
/**
 * Created by PhpStorm.
 * User: Carlo
 * Date: 27/12/15
 * Time: 13:03
 */

include_once MODEL_DIR . "DomandaModel.php";
$domandaModel = new DomandaModel();


if(isset($_POST['testoDomanda']) && isset($_POST['punteggioEsatta']) && isset($_POST['idargomento'])) {
    $idArgomento = $_POST['idargomento'];
    $idcorso = $_POST['idcorso'];
    $testoDomanda = $_POST['testoDomanda'];
    $punteggioEsatta = $_POST['punteggioEsatta'];
    $domandaAperta = new DomandaAperta($idArgomento,$testoDomanda,$punteggioEsatta,0);
    $domandaModel->createDomandaAperta($domandaAperta);
    header('Location: /docente/corso/' . $idcorso . '/argomento/domande/' . $idArgomento .'/successinserimento');
}