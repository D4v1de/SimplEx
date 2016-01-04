<?php
/**
 * Da questo Control possiamo raggiungere altre pagine. Viene invocato dalla view SessioneInCorso .
 * @author Antonio Luca D'Avanzo
 * @version 1
 * @since  30/12/2015 23:03
 */

$idSessione="";
$idSessione= $_URL[4];
if (!is_numeric($idSessione)) {
    echo "<script type='text/javascript'>alert('errore nella url!!!');</script>";
}
$idCorso ="";
$idCorso = $_URL[2];
if (!is_numeric($idCorso)) {
    echo "<script type='text/javascript'>alert('errore nella url!!!');</script>";
}

if(isset( $_POST['aggiorna'])) {
    header("location: " ."/docente/corso/".$idCorso."/sessione/".$idSessione."/aggiornasessioneincorso");
}
else if(isset( $_POST['addStu'])) {
    header("location: " ."/docente/corso/".$idCorso."/sessione/".$idSessione."/aggiungistudente/");
}

else if(isset( $_POST['termina'] )) {
    header("location: " ."/docente/corso/".$idCorso."/sessione/".$idSessione."/terminasessione/");
}

else if(isset( $_POST['annullaEsame'])) {
    header("location: " ."/docente/corso/".$idCorso."/sessione/".$idSessione."/annullaesame/".$_POST['annullaEsame']);
}

else {
    header("location: " . "/docente/corso/" . $idCorso . "/sessione/" . $idSessione . "/modificafine/" . $_POST['datato']);
}