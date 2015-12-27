<?php
/**
 * Created by PhpStorm.
 * User: Antonio Luca
 * Date: 23/12/2015
 * Time: 13:05
 */

include_once MODEL_DIR . "SessioneModel.php";
include_once BEAN_DIR . "Sessione.php";

$sessioneModel = new SessioneModel();
$idCorso = $_URL[2];

if(isset($_POST['IdSes'])){
    $idSes = $_POST['IdSes'];
    try {
        $controllerSessione->deleteSessione($idSes);
        header("location: "."/docente/corso/".$identificativoCorso."/successelimina");
    }
    catch(ApplicationException $ex) {
        echo "ERRORE". $ex;
    }

    $tornaACasa= "Location: "."/docente/corso/"."$idCorso"."/successelimina";
    header($tornaACasa);
}