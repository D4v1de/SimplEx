<?php
/**
 * Created by PhpStorm.
 * User: Carlo
 * Date: 23/12/15
 * Time: 16:30
 */

include_once MODEL_DIR . "ArgomentoModel.php";

$argomentoModel = new ArgomentoModel();

if(isset($_POST['idargomento'])){
    $idargomento = $_POST['idargomento'];
    $argomento = $argomentoModel->readArgomento($idargomento);

    $_SESSION['argomento'] = $argomento;
}

