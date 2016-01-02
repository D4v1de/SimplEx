<?php
/**
 * Controller associaCorso permette di associare uno o più Docenti ad un Corso.
 * @author Federico De Rosa
 * @version 1
 * @since 29/12/15 13:38
 */

include_once MODEL_DIR . "UtenteModel.php";
$modelutente = new UtenteModel();
include_once MODEL_DIR . "CorsoModel.php";
$modelcorso = new CorsoModel();

$corso = null;
$docente = null;
$docenteassociato = Array();
$idcorso = $_SESSION['idcorso'];
unset($_SESSION['idcorso']);
$checkbox = Array();

try {
    $corso = $modelcorso->readCorso($idcorso);
}
catch (ApplicationException $ex) {
    echo "<h1>INSERIRE ID CORSO NEL PATH!</h1>".$ex;
}

try {
    $docenteassociato = $modelutente->getAllDocentiByCorso($corso->getId());
}
catch (ApplicationException $ex) {
    echo "<h1>GETDOCENTIASSOCIATI FALLITO!</h1>".$ex;
}

if (isset($_POST['checkbox']) && !isset($_POST['elimina'])) {

    $checkbox = $_POST['checkbox'];

    foreach ($docenteassociato as $da) {
        if (!in_array($da->getMatricola(), $checkbox)) {
            try {
                $modelcorso->deleteInsegnamento($corso->getId(), $da->getMatricola());
            } catch (ApplicationException $ex) {
                echo "<h1>ELIMINAINSEGNAMENTO FALLITO!</h1>".$ex;
            }
        }
    }
    foreach ($checkbox as $c) {
        $docente = $modelutente->getUtenteByMatricola($c);
        if (!in_array($docente, $docenteassociato)) {
            try {
                $modelcorso->createInsegnamento($corso->getId(), $c);
            } catch (ApplicationException $ex) {
                echo "<h1>CREAZIONEINSEGNAMENTO FALLITO!</h1>".$ex;
            }
        }
    }
    header('location: /admin/corsi/gestione/' . $corso->getId() . '/successassocia');
}

if (isset($_POST['elimina'])) {

    foreach ($docenteassociato as $da) {
        try {
            $modelcorso->deleteInsegnamento($corso->getId(), $da->getMatricola());
        } catch (ApplicationException $ex) {
            echo "<h1>ELIMINAINSEGNAMENTI FALLITO!</h1>".$ex;
        }
    }
    header('location: /admin/corsi/gestione/' . $corso->getId() . '/successassocia');
}