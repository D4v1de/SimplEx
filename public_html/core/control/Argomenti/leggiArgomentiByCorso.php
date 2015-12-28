<?php
/**
 * Created by PhpStorm.
 * User: Carlo
 * Date: 23/12/15
 * Time: 17:20
 */

include_once MODEL_DIR . "ArgomentoModel.php";
include_once BEAN_DIR . "Argomento.php";

$argomentoModel = new ArgomentoModel();

if(isset($_URL[2])) {
    $idcorso = $_URL[2];
    $array = array();
    $argomenti = array();
    $array = $argomentoModel->getAllArgomentoCorso($idcorso);
    foreach ($array as $argomento) {
        $argomenti[] = serialize($argomento);
    }
    $_SESSION['argomenti'] = $argomenti;

    header('Location: /docente/corso/' . $idcorso);
}