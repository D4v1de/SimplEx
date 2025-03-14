<?php
/**
 * Controller creaCorso permette di creare un Corso.
 * @author Federico De Rosa
 * @version 1
 * @since 28/12/15 22:18
 */

include_once MODEL_DIR . "CorsoModel.php";
$modelcorso = new CorsoModel();

$corsi = null;
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

if (isset($_POST['nome']) && isset($_POST['tipologia']) && isset($_POST['matricola']) && isset($_POST['tipologia2'])) {

    $nome = $_POST['nome'];
    $tipologia = $_POST['tipologia'];
    $matricola = $_POST['matricola'];
    $cdlmatricola = $_POST['tipologia2'];

    $_SESSION['nome'] = $nome;
    $_SESSION['matricola'] = $matricola;
    $_SESSION['tipologia'] = $tipologia;
    $_SESSION['tipologia2'] = $cdlmatricola;

    //controllo sul nome
    if(empty($nome) || !preg_match('/^[a-zA-Z0-9\s-èòìàù]+$/', $nome)) {
        $flag2 = 0;
    }

    //controllo sulla tipologia
    if(empty($tipologia) || !in_array($tipologia, Config::$TIPI_CORSO)) {
        $flag3 = 0;
    }

    //controllo sulla matricola
    if(empty($matricola) || !is_numeric($matricola) || (strlen($matricola) != 10)) {
        $flag4 = 0;
    }
    foreach($corsi as $c) {
        if($c->getMatricola() == $matricola) {
            $flag = 0;
        }
    }

    //controllo cdl matricola
    if(empty($cdlmatricola) || !is_numeric($cdlmatricola)) {
        $flag5 = 0;
    }

    $_SESSION['flag'] = $flag;
    $_SESSION['flag2'] = $flag2;
    $_SESSION['flag3'] = $flag3;
    $_SESSION['flag4'] = $flag4;
    $_SESSION['flag5'] = $flag5;

    if($flag && $flag2 && $flag3 && $flag4 && $flag5) {
        try {
            $corso = new Corso($matricola, $nome, $tipologia, $cdlmatricola);
            $id = $modelcorso->createCorso($corso);

            unset($_SESSION['nome']);
            unset($_SESSION['tipologia']);
            unset($_SESSION['matricola']);
            unset($_SESSION['tipologia2']);


            header('location: /admin/corsi/gestione/' . $id . '/successcrea');
        } catch (ApplicationException $ex) {
            echo "<h1>CREACORSO FALLITO!</h1>.$ex";
        }
    }
    else {
        header('location: /admin/corsi/crea');
    }
}