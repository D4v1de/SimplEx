<?php
/**
 * Controller eliminaCorso permette di eliminare uno o più Corsi.
 * @author Federico De Rosa
 * @version 1
 * @since 29/12/15 13:18
 */

include_once MODEL_DIR . "CorsoModel.php";
$modelcorso = new CorsoModel();

$checkbox = Array();

if (isset($_POST['checkbox'])) {
    $checkbox = $_POST['checkbox'];
    if (count($checkbox) >= 1) {
        foreach ($checkbox as $c) {
            try {
                $modelcorso->deleteCorso($c);
            } catch (ApplicationException $ex) {
                echo "<h1>ELIMINACORSO FALLITO!</h1>" . $ex;
            }
        }
        header('Location: /admin/corsi/view/successelimina');
    }
}