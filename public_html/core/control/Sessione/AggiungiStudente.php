<?php
/**
 * Created by PhpStorm.
 * User: Antonio Luca
 * Date: 30/12/2015
 * Time: 22:52
 */
$idSessione=$_URL[4];
$identificativoCorso = $_URL[2];

$vaiAddStu= "Location: "."/docente/corso/".$identificativoCorso."/sessione"."/".$idSessione."/"."sessioneincorso/aggiungistudente";
header($vaiAddStu);
