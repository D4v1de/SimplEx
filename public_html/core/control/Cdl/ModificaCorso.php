<?php
/**
 * Controller modificaCorso permette di modificare un Corso.
 * @author Federico De Rosa
 * @version 1
 * @since 29/12/15 00:38
 */

include_once MODEL_DIR . "CorsoModel.php";
$modelcorso = new CorsoModel();

$corsi = Array();
$corso = null;
$new = null;
$idcorso = $_SESSION['idcorso'];
unset($_SESSION['idcorso']);
$flag = 1;
$flag2 = 1;
$flag3 = 1;
$flag4 = 1;
$flag5 = 1;

try {
    $corsi = $modelcorso->getAllCorsi();
} catch (ApplicationException $ex) {
    echo "<h1>GETCORSI FALLITO!</h1>" . $ex;
}
try {
    $corso = $modelcorso->readCorso($idcorso);
} catch (ApplicationException $ex) {
    echo "<h1>INSERIRE ID CORSO NEL PATH</h1>" . $ex;
}

if (isset($_POST['nome']) && isset($_POST['tipologia']) && isset($_POST['matricola']) && isset($_POST['tipologia2'])) {

    $nomenew = $_POST['nome'];
    $tipologianew = $_POST['tipologia'];
    $matricolanew = $_POST['matricola'];
    $cdlmatricolanew = $_POST['tipologia2'];

    $x = array_search($corso ,$corsi);
    unset($corsi[$x]);

    //controllo sul nome
    if(empty($nomenew) || !preg_match('/^[a-zA-Z0-9\s-èòìàù]+$/', $nomenew)) {
        $flag2 = 0;
    }

    //controllo sulla tipologia
    if(empty($tipologianew) || !in_array($tipologianew, Config::$TIPI_CORSO)) {
        $flag3 = 0;
    }

    //controllo sulla matricola
    if(empty($matricolanew) || !is_numeric($matricolanew) || (strlen($matricolanew) != 10)) {
        $flag4 = 0;
    }
    foreach($corsi as $c) {
        if($c->getMatricola() == $matricolanew) {
            $flag = 0;
        }
    }

    //controllo cdl matricola
    if(empty($cdlmatricolanew) || !is_numeric($cdlmatricolanew)) {
        $flag5 = 0;
    }

    $_SESSION['flag'] = $flag;
    $_SESSION['flag2'] = $flag2;
    $_SESSION['flag3'] = $flag3;
    $_SESSION['flag4'] = $flag4;
    $_SESSION['flag5'] = $flag5;

    if($flag && $flag2 && $flag3 && $flag4 && $flag5) {
        try {
            $new = new Corso($matricolanew, $nomenew, $tipologianew, $cdlmatricolanew);
            $modelcorso->updateCorso($corso->getId(), $new);

            header('location: /admin/corsi/view/successmodifica');
        } catch (ApplicationException $ex) {
            echo "<h1>MODIFICACORSO FALLITO!</h1>" . $ex;
        }
    }
    else {
        header('location: /admin/corsi/modifica/'.$idcorso);
    }
}