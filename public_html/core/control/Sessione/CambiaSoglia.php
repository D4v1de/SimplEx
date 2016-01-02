<?php
/**
 * Created by PhpStorm.
 * User: Antonio Luca
 * Date: 02/01/2016
 * Time: 16:07
 */

$soglia=$_POST['soglia'];
$sessioneAggiornata = new Sessione($dataFrom, $dataTo, $soglia , $sessioneByUrl->getStato(), $sessioneByUrl->getTipologia(), $identificativoCorso);
$sessioneModel->updateSessione($_URL[4], $sessioneAggiornata);

