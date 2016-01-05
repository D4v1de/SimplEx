<?php

/**
 * Controlla che lo studente sia abilitato ad eseguire una sessione
 *
 * @author Fabiano Pecorelli
 * @version 1.0
 * @since 03/12/15
 */
include_once MODEL_DIR . "ElaboratoModel.php";

$elMod = new ElaboratoModel();
$flag = 0;
$sessioneId = $_REQUEST["sessId"];
if (!is_numeric($sessioneId)) {
    $flag = 1;
}
$studenteMatricola = $_SESSION['user']->getMatricola();
try {
    $elaborato = $elMod->readElaborato($studenteMatricola, $sessioneId);
} catch (ApplicationException $ex) {
    $flag = 1;
}
if ($flag == 0)
    echo $elaborato->getStato();
else
    echo "Corretto";
            
    