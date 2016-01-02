<?php
/**
 * Created by PhpStorm.
 * User: Antonio Luca
 * Date: 02/01/2016
 * Time: 15:43
 */

if(isset( $_POST['datato'])) {
    $dataFineNow=$_POST['datato'];
    $newSessione = new Sessione($dataFrom, $dataFineNow, 18, "In esecuzione", $tipoSessione, $identificativoCorso);
    $modelSessione->updateSessione($idSessione,$newSessione);
}
