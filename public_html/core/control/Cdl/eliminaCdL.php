<?php
/**
 * Created by PhpStorm.
 * User: fede_dr
 * Date: 29/12/15
 * Time: 13:18
 */

include_once MODEL_DIR . "CdLModel.php";
$modelcdl = new CdLModel();

$checkbox = Array();

if (isset($_POST['checkbox'])) {
    $checkbox = $_POST['checkbox'];
    if (count($checkbox) >= 1) {
        foreach ($checkbox as $c) {
            try {
                $modelcdl->deleteCdL($c);
            } catch (ApplicationException $ex) {
                echo "<h1>ELIMINACDL FALLITO!</h1>" . $ex;
            }
        }
        header('Location: /admin/cdl/view/successelimina');
    }
}