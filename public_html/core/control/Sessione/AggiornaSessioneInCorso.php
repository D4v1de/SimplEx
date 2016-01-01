<?php
/**
 * Created by PhpStorm.
 * User: Antonio Luca
 * Date: 30/12/2015
 * Time: 23:06
 */

$idCorso = $_URL[2];
$idSessione = $_URL[4];

header("location: " ."/docente/corso/".$idCorso."/sessione/".$idSessione."/sessioneincorso/show");
