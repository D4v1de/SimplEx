<?php
/**
 * Controller che permette di modificare un Argomento
 * @author Carlo
 * @version 1.2
 * @since 27/12/15 10:09
 */
include_once MODEL_DIR . "ArgomentoModel.php";

$argomentoModel = new ArgomentoModel();

if(isset($_POST['nome']) && isset($_POST['idargomento']) && isset($_POST['idcorso'])) {
    $nome = $_POST['nome'];
    $idcorso = $_POST['idcorso'];
    $idargomento = $_POST['idargomento'];
    if (strlen($nome) < 2 || strlen($nome) > 500) {
        $_SESSION['errore'] = 1;
        header('Location: /docente/corso/' . $idcorso . '/argomento/modifica/' . $idargomento);
    }else {
        $argomento = new Argomento($idcorso, $nome);
        $argomentoModel->updateArgomento($idargomento, $argomento);
        header('Location: /docente/corso/' . $idcorso . '/successmodifica');
    }
}elseif(!isset($_POST['nome'])){
    $_SESSION['errore'] = 1;
    header('Location: /docente/corso/' . $idcorso . '/argomento/inserisci');
}