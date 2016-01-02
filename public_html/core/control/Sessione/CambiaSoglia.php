<?php
/**
 * Questo Control permette di modificare la soglia di ammissione di una sessione.
 * @author Antonio Luca D'Avanzo
 * @version 1
 * @since  02/01/2016 16:07
 */

$soglia=$_POST['soglia'];
$sessioneAggiornata = new Sessione($dataFrom, $dataTo, $soglia , $sessioneByUrl->getStato(), $sessioneByUrl->getTipologia(), $identificativoCorso);
$sessioneModel->updateSessione($_URL[4], $sessioneAggiornata);

