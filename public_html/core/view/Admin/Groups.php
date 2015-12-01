<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 01/12/15
 * Time: 21:09
 */
$i = 0;
$arr = array();
foreach (Config::$TIPI_UTENTE as $item)
    $arr[] = array('value' => $i++, 'text' => $item);
echo json_encode($arr);