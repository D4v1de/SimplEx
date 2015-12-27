<?php
/**
 * Created by PhpStorm.
 * User: Carlo
 * Date: 23/12/15
 * Time: 16:30
 */

include_once MODEL_DIR . "ArgomentoModel.php";

$argomentoModel = new ArgomentoModel();


if(isset($_URL[6])){
    $idargomento = $_URL[6];
    try {
        $argomento = $argomentoModel->readArgomento($idargomento);
        if($argomento==null){}else{
            $_SESSION['argomento'] = serialize($argomento);
            print_r($_SESSION['argomento']);
        }
    }catch(ApplicationException $ex){
        echo "NESSUN ARGOMENTO TROVATO" . $ex;
    }
    header("Location: /docente/corso/". $_URL[2] ."/argomento/domande/". $_URL[6]);
}

