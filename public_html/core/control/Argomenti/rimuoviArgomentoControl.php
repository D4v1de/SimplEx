<?php
/**
 * Created by PhpStorm.
 * User: Carlo
 * Date: 23/12/15
 * Time: 09:44
 */
include_once MODEL_DIR . "ArgomentoModel.php";

$argomentoModel = new ArgomentoModel();

if(isset($_POST['id']) && isset($_POST['idcorso'])) {
    $id = $_POST['id'];
    $idcorso = $_POST['idcorso'];
    $argomentoModel->deleteArgomento($id);
    header('Location: /docente/corso/' . $idcorso . '/successelimina');
}