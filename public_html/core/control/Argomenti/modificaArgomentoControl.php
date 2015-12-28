<?php
/**
 * Created by PhpStorm.
 * User: Carlo
 * Date: 23/12/15
 * Time: 09:44
 */
include_once MODEL_DIR . "ArgomentoModel.php";

$argomentoModel = new ArgomentoModel();

if(isset($_POST['nome']) && isset($_POST['idargomento']) && isset($_POST['idcorso'])) {
    $nome = $_POST['nome'];
    $idcorso = $_POST['idcorso'];
    $idargomento = $_POST['idargomento'];
    $argomento = new Argomento($idcorso,$nome);
    $argomentoModel->updateArgomento($idargomento,$argomento);
    header('Location: /docente/corso/' . $idcorso . '/successmodifica');
}