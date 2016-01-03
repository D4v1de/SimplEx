<?php
/**
 * Questo Control permette di aggiornare una sessione in corso in modo tale da poter visualizzare
 * studenti abilitati che hanno appena iniziato il test.
 * @author Antonio Luca D'Avanzo
 * @version 1
 * @since  30/12/2015 23:06
 */

$idCorso = $_URL[2];
$idSessione = $_URL[4];

header("location: " ."/docente/corso/".$idCorso."/sessione/".$idSessione."/sessioneincorso/show");
