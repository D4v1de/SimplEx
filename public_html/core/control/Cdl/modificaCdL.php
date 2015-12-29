<?php
/**
 * Created by PhpStorm.
 * User: fede_dr
 * Date: 29/12/15
 * Time: 00:40
 */

include_once MODEL_DIR . "CdLModel.php";
$modelcdl = new CdLModel();

$cdls = Array();
$cdl = null;
$new = null;
$idcdl = $_SESSION['idcdl'];
unset($_SESSION['idcdl']);
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
try {
    $cdl = $modelcdl->readCdL($idcdl);
} catch (ApplicationException $ex) {
    echo "<h1>INSERIRE ID CDL NEL PATH!</h1>" . $ex;
}

if (isset($_POST['nome']) && isset($_POST['tipologia']) && isset($_POST['matricola'])) {

    $nomenew = $_POST['nome'];
    $tipologianew = $_POST['tipologia'];
    $matricolanew = $_POST['matricola'];

    $x = array_search($cdl ,$cdls);
    unset($cdls[$x]);

    //controllo su nome
    if(empty($nomenew) || !preg_match('/^[a-zA-Z0-9\s-èòìàù]+$/', $nomenew)) {
        $flag = 0;
    }
    foreach($cdls as $c) {
        if($c->getNome() == $nomenew) {
            $flag4 = 0;
        }
    }

    //controllo su matricola
    if(empty($matricolanew) || !is_numeric($matricolanew)) {
        $flag3 = 0;
    }
    foreach($cdls as $c) {
        if($c->getMatricola() == $matricolanew) {
            $flag5 = 0;
        }
    }

    //controllo su tipologia
    if(empty($tipologianew) || !in_array($tipologianew, Config::$TIPI_CDL)) {
        $flag2 = 0;
    }

    $_SESSION['flag'] = $flag;
    $_SESSION['flag2'] = $flag2;
    $_SESSION['flag3'] = $flag3;
    $_SESSION['flag4'] = $flag4;
    $_SESSION['flag5'] = $flag5;

    if($flag && $flag2 && $flag3 && $flag4 && $flag5) {
        try {
            $new = new CdL($matricolanew, $nomenew, $tipologianew);
            $modelcdl->updateCdL($cdl->getMatricola(), $new);

            header('location: /admin/cdl/view/successmodifica');
        } catch (ApplicationException $ex) {
            echo "<h1>MODIFICACDL FALLITO!</h1>" . $ex;
        }
    }
    else {
        header('location: /admin/cdl/modifica/'.$idcdl);
    }
}