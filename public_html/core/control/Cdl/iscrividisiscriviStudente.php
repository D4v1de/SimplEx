<?php
/**
 * Controller iscrividisiscriviStudente permette di far iscrivere o disiscrivere uno Studente ad un Corso
 * @author Federico De Rosa
 * @version 1
 * @since 29/12/15 14:58
 */

include_once MODEL_DIR . "UtenteModel.php";
$modelutente = new UtenteModel();

$studente = null;
$matricola = $_SESSION['matstudente'];
$idcdl = $_SESSION['idcdl'];
unset($_SESSION['idcdl']);
unset($_SESSION['matstudente']);

try {
    $studente = $modelutente->getUtenteByMatricola($matricola);

} catch (ApplicationException $ex) {
    echo "<h1>GETUTENTEBYMATRICOLA FALLITO!</h1>" . $ex;
}

if (isset($_POST['iscrivi'])) {
    $iscrivi = $_POST['iscrivi'];
    $modelutente->iscriviStudenteCorso($studente->getMatricola(), $iscrivi);
    header("location: /studente/cdl/".$idcdl."/iscritto");
}
if (isset($_POST['disiscrivi'])) {
    $disiscrivi = $_POST['disiscrivi'];
    $modelutente->disiscriviStudenteCorso($studente->getMatricola(), $disiscrivi);
    header("location: /studente/cdl/".$idcdl."/disiscritto");
}