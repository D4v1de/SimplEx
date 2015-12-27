<?php
/**
 * Created by PhpStorm.
 * User: Carlo
 * Date: 23/12/15
 * Time: 17:20
 */

include_once MODEL_DIR . "ArgomentoModel.php";
include_once BEAN_DIR . "Argomento.php";
session_start();

$argomentoModel = new ArgomentoModel();


if(isset($_URL[1])){
    $idcorso = $_URL[1];
    $arrayArgomenti = $argomentoModel->getAllArgomentoCorso($idcorso);
    $_SESSION['argomenti'] = $arrayArgomenti[0];

    header('Location: /docente/corso/'.$idcorso);
}