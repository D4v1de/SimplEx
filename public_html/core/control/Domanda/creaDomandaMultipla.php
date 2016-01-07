<?php
/**
 * Controller che permette di creare una Domanda Multipla
 * @author  Pasquale
 * @version 1.3
 * @since 28/12/15 10:15
 */

include_once MODEL_DIR . "DomandaModel.php";
include_once MODEL_DIR . "AlternativaModel.php";

$domandaModel = new DomandaModel();
$alternativaModel = new AlternativaModel();

$idArgomento = $_POST['idargomento'];
$idCorso = $_POST['idcorso'];
$testoRisposte = array();

for($j=1;$j<16;$j++){
    if(isset($_POST['testoRisposta'.$j])){
        $testoRisposte[$j-1] = $_POST['testoRisposta'.$j];
    }
}



if (isset($_POST['testoDomanda']) && isset($_POST['punteggioErrata']) && isset($_POST['punteggioEsatta']) && isset($testoRisposte) && isset($_POST['radio'])) {
    //controlli
    $testoDomanda = $_POST['testoDomanda'];
    $punteggioErrata = $_POST['punteggioErrata'];
    $punteggioEsatta = $_POST['punteggioEsatta'];
    $radio = $_POST['radio'];
    $controlloRisposte = true;


    /*for($i=0;$i<count($testoRisposte);$i++){
        if(strlen($testoRisposte[$i])<1 || strlen($testoRisposte[$i])>100){
            $controlloRisposte = false;
        }
    }*/

    if (strlen($testoDomanda) < 2 || strlen($testoDomanda) > 500) {
        $_SESSION['errore'] = 1;
        header('Location: /docente/corso/' . $idCorso . '/argomento/domande/inseriscimultipla/' . $idArgomento);
    }
    else if ($punteggioEsatta <= 0) {
        $_SESSION['errore'] = 2;
        header('Location: /docente/corso/' . $idCorso . '/argomento/domande/inseriscimultipla/' . $idArgomento);
    }
    else if ($punteggioErrata > 0) {
        $_SESSION['errore'] = 3;
        header('Location: /docente/corso/' . $idCorso . '/argomento/domande/inseriscimultipla/' . $idArgomento);
    }/*
    else if ($controlloRisposte == false) {
        $_SESSION['errore'] = 4;
        header('Location: /docente/corso/' . $idCorso . '/argomento/domande/inseriscimultipla/' . $idArgomento);
    }*/

    else {
        $testoEncoded = base64_encode(strip_tags($testoDomanda));
        $nuovaDomanda = new DomandaMultipla($idArgomento, $testoEncoded, $punteggioEsatta, $punteggioErrata, 0, 0, 0, 0, 0, 0);

        $idNuovaDomanda = $domandaModel->createDomandaMultipla($nuovaDomanda);
        for ($i = 0; $i < count($testoRisposte); $i++) {
            if (($i + 1) == $radio) {
                $corretta = "Si";
            } else {
                $corretta = "No";
            }
            if ($testoRisposte[$i] == '' || $testoRisposte[$i] == null) {
                echo $i;
                continue;
            } else {
                $testoEncoded = base64_encode(strip_tags($testoRisposte[$i]));
                $alternativa = new Alternativa($idNuovaDomanda, $testoEncoded, 0, $corretta);
            }

            $alternativaModel->createAlternativa($alternativa);
        }

        header('Location: /docente/corso/' . $idCorso . '/argomento/domande/' . $idArgomento . '/successinserimento');
    }
}else if(!isset($_POST['testoDomanda'])){
    $_SESSION['errore'] = 1;
    header('Location: /docente/corso/' . $idCorso . '/argomento/domande/inseriscimultipla/' . $idArgomento);
}else if(!isset($_POST['punteggioEsatta'])){
    $_SESSION['errore'] = 2;
    header('Location: /docente/corso/' . $idCorso . '/argomento/domande/inseriscimultipla/' . $idArgomento);
}else if(!isset($_POST['punteggioErrata'])){
    $_SESSION['errore'] = 3;
    header('Location: /docente/corso/' . $idCorso . '/argomento/domande/inseriscimultipla/' . $idArgomento);
}else if(!isset($testoRisposte)){
    $_SESSION['errore'] = 4;
    header('Location: /docente/corso/' . $idCorso . '/argomento/domande/inseriscimultipla/' . $idArgomento);
}else if(!isset($_POST['radio'])){
    $_SESSION['errore'] = 5;
    header('Location: /docente/corso/' . $idCorso . '/argomento/domande/inseriscimultipla/' . $idArgomento);
}

