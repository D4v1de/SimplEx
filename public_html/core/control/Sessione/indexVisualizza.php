<?php
/**
 * Created by PhpStorm.
 * User: Antonio Luca
 * Date: 30/12/2015
 * Time: 20:03
 */
$idCorso = $_URL[2];

if(isset($_POST['rimuovi'])){
        header("location: " ."/docente/corso/".$idCorso."/rimuovisessione/".$_POST['rimuovi']);
}

if(isset($_POST['avvia'])){
    header("location: " ."/docente/corso/".$idCorso."/avviasessione/".$_POST['avvia']);
}