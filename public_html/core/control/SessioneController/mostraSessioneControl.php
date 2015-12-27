<?php
/**
 * Created by PhpStorm.
 * User: Antonio Luca
 * Date: 22/12/2015
 * Time: 23:28
 */

$idCorso = $_URL[2];
$idSessione=$_URL[4];
$sessioneByUrl = $sessioneModel->readSessione($_URL[4]);

$url = "/docente/corso/".$idCorso."/sessione/".$idSessione."/creamodificasessione2";
$post = 'tieni='.json_encode($sessioneByUrl);
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $post);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_HEADER, false);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, false);
curl_exec($ch);

