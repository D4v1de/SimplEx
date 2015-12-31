<?php
/**
 * Created by PhpStorm.
 * User: Antonio Luca
 * Date: 30/12/2015
 * Time: 23:01
 */

$idCorso = $_URL[2];
$idSessione = $_URL[4];

if(isset( $_POST['aggiorna'])) {
    header("location: " ."/docente/corso/".$idCorso."/sessione/".$idSessione."/aggiornasessioneincorso");
}

if(isset( $_POST['addStu'])) {
    header("location: " ."/docente/corso/".$idCorso."/sessione/".$idSessione."/aggiungistudente/");
}

if(isset( $_POST['termina'] )) {
    header("location: " ."/docente/corso/".$idCorso."/sessione/".$idSessione."/terminasessione/");
}

if(isset( $_POST['annullaEsame'])) {
    header("location: " ."/docente/corso/".$idCorso."/sessione/".$idSessione."/annullaesame/".$_POST['annullaEsame']);
}