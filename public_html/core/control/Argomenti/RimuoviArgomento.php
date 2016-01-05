<?php
/**
 * Controller che permette di eliminare un Argomento
 * @author Carlo
 * @version 1.2
 * @since 27/12/15 09:44
 */
include_once MODEL_DIR . "ArgomentoModel.php";

$argomentoModel = new ArgomentoModel();

if(isset($_POST['id']) && isset($_POST['idcorso'])) {
    $id = $_POST['id'];
    $idcorso = $_POST['idcorso'];
    $argomentoModel->deleteArgomento($id);
    header('Location: /docente/corso/' . $idcorso . '/successelimina');
}