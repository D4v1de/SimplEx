<?php
/**
 * Da questo Control possiamo raggiungere altre pagine. Viene invocato dalla view VisualizzaSessione .
 * @author Antonio Luca D'Avanzo
 * @version 1
 * @since  30/12/2015 23:50
 */
$idCorso ="";
$idCorso = $_URL[2];
if (!is_numeric($idCorso)) {
    echo "<script type='text/javascript'>alert('errore nella url!!!');</script>";
}

if(isset($_POST['rimuovi'])){
        header("location: " ."/docente/corso/".$idCorso."/rimuovisessione/".$_POST['rimuovi']);
}

if(isset($_POST['avvia'])){
    header("location: " ."/docente/corso/".$idCorso."/avviasessione/".$_POST['avvia']);
}