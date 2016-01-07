<?php
/**
 * Controller creaCdl che permette di creare un Corso di Laurea.
 * @author Federico De Rosa
 * @version 1
 * @since 29/12/15 00:38
 */

include_once MODEL_DIR . "CdLModel.php";
$modelcdl = new CdLModel();


$cdls = Array();
$flag = 1;
$flag2 = 1;
$flag3 = 1;
$flag4 = 1;
$flag5 = 1;

try {
    $cdls = $modelcdl->getAllCdL();
} catch (ApplicationException $ex) {
    echo "<h1>GETCDL FALLITO!</h1>" . $ex;
}

if (isset($_POST['nome']) && isset($_POST['tipologia']) && isset($_POST['matricola'])) {

    $nome = $_POST['nome'];
    $matricola = $_POST['matricola'];
    $tipologia = $_POST['tipologia'];

    $_SESSION['nome'] = $nome;
    $_SESSION['matricola'] = $matricola;
    $_SESSION['tipologia'] = $tipologia;

    //controllo sul nome
    if(empty($nome) || !preg_match('/^[a-zA-Z0-9\s-èòìàù]+$/', $nome)) {
        $flag3 = 0;
    }
    foreach($cdls as $c) {
        if(strtolower($c->getNome()) == strtolower($nome)) {
            $flag2 = 0;
        }
    }

    //controllo su matricola
    if(empty($matricola)  || !is_numeric($matricola)) {
        $flag4 = 0;
    }
    foreach($cdls as $c) {
        if($c->getMatricola() == $matricola) {
            $flag = 0;
        }
    }

    //controllo su tipologia
    if(empty($tipologia) || !in_array($tipologia, Config::$TIPI_CDL)) {
        $flag5 = 0;
    }

    $_SESSION['flag'] = $flag;
    $_SESSION['flag2'] = $flag2;
    $_SESSION['flag3'] = $flag3;
    $_SESSION['flag4'] = $flag4;
    $_SESSION['flag5'] = $flag5;

    if($flag && $flag2 && $flag3 && $flag4 && $flag5) {
        try {
            $cdl = new CdL($matricola, $nome, $tipologia);
            $modelcdl->createCdL($cdl);

            unset($_SESSION['nome']);
            unset($_SESSION['tipologia']);
            unset($_SESSION['matricola']);

            header('location: /admin/cdl/view/successcrea');
        } catch (ApplicationException $ex) {
            echo "<h1>CREACDL FALLITO!</h1>" . $ex;
        }
    }
    else {
        header('location: /admin/cdl/crea');
    }
}