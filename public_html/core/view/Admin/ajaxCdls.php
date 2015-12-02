<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 02/12/15
 * Time: 11:51
 */

include_once CONTROL_DIR . "CdlController.php";
$ctr = new CdlController();

$cdls = $ctr->getCdl();
$arr = array();
/** @var Cdl $item */
foreach ($cdls as $item)
    $arr[] = array('value' => $item->getMatricola(), 'text' => $item->getNome());
echo json_encode($arr);