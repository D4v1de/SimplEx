<?php

include_once MODEL_DIR . "ArgomentoModel.php";
include_once MODEL_DIR . "CdlModel.php";
include_once MODEL_DIR . "DomandaModel.php";
include_once MODEL_DIR . "CorsoModel.php";
include_once MODEL_DIR . "TestModel.php";

$modelCdl = new CdlModel();
$modelArgomento = new ArgomentoModel();
$modelCorso = new CorsoModel();
$modelDomande  = new DomandaModel();
$modelTest = new TestModel();


function parseInt($Str) {
    return (int)$Str;
}

$identificativoCorso=$_GET["idcorso"];
function associaAperTest($idDomanda, $idTest, $punteggioMaxAlternativo){
        $domandaModel = new DomandaModel();
        if($punteggioMaxAlternativo == NULL){$domanda=$domandaModel->readDomandaAperta($idDomanda);
        $punteggioMaxAlternativo=(int)$domanda->getPunteggioMax();
        }
        return $domandaModel->associaDomandaApertaTest($idDomanda, $idTest, $punteggioMaxAlternativo);
    }
    
function associaMultTest($idDomanda, $idTest, $punteggioCorrettaAlternativo, $punteggioErrataAlternativo){
        $domandaModel = new DomandaModel();
        if($punteggioCorrettaAlternativo == NULL){$domanda=$domandaModel->readDomandaMultipla($idDomanda);
        $punteggioCorrettaAlternativo=(int)$domanda->getPunteggioCorretta();
        }
        if($punteggioErrataAlternativo == NULL){$domanda=$domandaModel->readDomandaMultipla($idDomanda);
        $punteggioErrataAlternativo=(int)$domanda->getPunteggioErrata();
        }
        return $domandaModel->associaDomandaMultiplaTest($idDomanda, $idTest, $punteggioCorrettaAlternativo, $punteggioErrataAlternativo);
    }    

try {
    $corso = $modelCorso->readCorso(parseInt($identificativoCorso));
    $nomecorso= $corso->getNome();
}
catch (ApplicationException $ex) {
    echo "<h1>ERRORE NELLA LETTURA DEL CORSO!</h1>" . $ex;
}

function contaAperte($idcorso){
    $cont=0;
    $modelArgomento = new ArgomentoModel();
    $modelDomande  = new DomandaModel();
    $Argomenti=$modelArgomento->getAllArgomentoCorso($idcorso);
    foreach($Argomenti as $x){
        $nuoveAperte = $modelDomande->getAllDomandaApertaByArgomento($x->getId());
        foreach($nuoveAperte as $h){
            $cont++;
        }
    }
    return $cont;
}

function contaMultiple($idcorso){
    $cont=0;
    $modelArgomento = new ArgomentoModel();
    $modelDomande  = new DomandaModel();
    $Argomenti=$modelArgomento->getAllArgomentoCorso($idcorso);
    foreach($Argomenti as $x){
        $nuoveMultiple = $modelDomande->getAllDomandaMultiplaByArgomento($x->getId());
        foreach($nuoveMultiple as $h){
            $cont++;
        }
    }
    return $cont;
}

$flag = 0;



if(isset($_POST['descrizione']) && (isset($_POST['tipologia']) && $_POST['tipologia']=='man')){
    // qui va la parte manuale
    // LA STO RIFACENDO C***O
    
    $descrizione=$_POST['descrizione']; //descrizione testo
    $daControllare='@';
    $punteggio=0;
    $cont1=0;
    $cont2=0;
    
    if(strpos($descrizione, $daControllare)){
        $tornaACasa= "Location: "."/docente/corso/"."$identificativoCorso"."/test/crea?flag=5";
        header($tornaACasa);
    }

    
    if(empty($_POST['aperte']) && empty($_POST['multiple'])) {
        //echo "DAI CAZZOOOOOOOOO(qua dobbiamo gestire l'errore nel caso non è stata selezionata nessuna check)";
        $tornaACasa= "Location: "."/docente/corso/"."$identificativoCorso"."/test/crea?flag=4";
        header($tornaACasa);
        
    }
    else {
        $domAperte=Array(); //domande aperte selezionate
        $domAperte=$_POST['aperte']; //domande aperte selezionate
        $domMultiple=Array(); //domande multiple selezionate
        $domMultiple=$_POST['multiple']; //domande multiple selezionate
        foreach($domAperte as $s){
            $cont1=$cont1+1;   //conto le domande aperte
        }
        foreach($domMultiple as $s){
            $cont2=$cont2+1;   //conto le domande multiple
        }
        $test = new Test($descrizione,0,$cont2,$cont1,0,0,$identificativoCorso);  //creo il test
        $idNuovoTest=$modelTest->createTest($test);   //inserisco il test nel db

        foreach($domAperte as $s){      //per ogni domanda aperta selezionata controllo se è stato inserito un punteggio alternativo
            $stringa=sprintf("ApertaCorr-%d", $s);
            if(!(empty($_POST[$stringa]))){  //se si associo quella domanda al test con quel valore e incremento il punteggio totale
                $z=$_POST[$stringa];
                $punteggio=$punteggio+(parseInt($z));
                associaAperTest($s,$idNuovoTest,$z);
            }else{   //altrimenti la associo con valore null(valore di default presente nel db) e incremento il punteggio totale
                $w=$modelDomande->readDomandaAperta($s);
                $punteggio=$punteggio+($w->getPunteggioMax());
                associaAperTest($s,$idNuovoTest,NULL);
            }
            $updated = $modelDomande->readDomandaAperta($s);
            $perc = $updated->getPercentualeScelta() +1;
            $updated->setPercentualeScelta($perc);
            $modelDomande->updateDomandaAperta($s, $updated);
        }
        $z1=0;
        $z2=0;
        foreach($domMultiple as $s){  //per ogni domanda multipla selezionata controllo se è stato inserito un punteggio alternativo
            $stringa1=sprintf("alternCorr-%d", $s);
            if(!(empty($_POST[$stringa1]))){  //se si incremento il punteggio totale con quel punteggio alternativo
                $z1=$_POST[$stringa1];
                $punteggio=$punteggio+(parseInt($z1));
            }else{ // altrimenti incremento con il valore di default preso dal db
                $w=$modelDomande->readDomandaMultipla($s);
                $punteggio=$punteggio+($w->getPunteggioCorretta());
                $z1=NULL;
            }
            $stringa2=sprintf("alternErr-%d", $s);
            if(!(empty($_POST[$stringa2]))){  //controllo per il punteggio alternativo dell' errore
                $z2=$_POST[$stringa2];
            }else{
                $z2=NULL;
            }
            associaMultTest($s, $idNuovoTest, $z1, $z2);//associo la domanda multipla al test
            
            $updated = $modelDomande->readDomandaMultipla($s);
            $perc = $updated->getPercentualeScelta() +1;
            $updated->setPercentualeScelta($perc);
            $modelDomande->updateDomandaMultipla($s, $updated);

        }
        $ilTest=$modelTest->readTest($idNuovoTest);
        $ilTest->setPunteggioMax($punteggio);
        $modelTest->updateTest($idNuovoTest,$ilTest);//aggiorno il valore di punteggio totale del test(finora zero) con il puteggio calcolato finora
        $tornaACasa= "Location: "."/docente/corso/"."$identificativoCorso";
        header($tornaACasa);//torno alla home
    }



}



if((isset($_POST['tipologia']) && $_POST['tipologia']=='rand') && isset($_POST['descrizione']) && isset($_POST['numAperte']) && isset($_POST['numMultiple'])){
    //qui va la parte random
    $nApe=parseInt($_POST['numAperte']);
    $nMul=parseInt($_POST['numMultiple']);
    $dbAperte;
    $dbMultiple;
    $descr=$_POST['descrizione'];
    $daControllare='@';
    
    if(strpos($descr, $daControllare)){
        $tornaACasa= "Location: "."/docente/corso/"."$identificativoCorso"."/test/crea?flag=5";
        header($tornaACasa);
    }

    if($nApe < 0 || $nMul < 0) {
        $tornaACasa= "Location: "."/docente/corso/"."$identificativoCorso"."/test/crea?flag=1";
        header($tornaACasa); //torno alla home
        //TODO echo della funzione che effettua il cambiamento di contenuto da manuale a random
        echo "<script type='text/javascript'>checkIt();</script>";
    }
    else if($nApe == 0 && $nMul == 0) {
        $tornaACasa= "Location: "."/docente/corso/"."$identificativoCorso"."/test/crea?flag=2";
        header($tornaACasa);
        //TODO echo della funzione che effettua il cambiamento di contenuto da manuale a random
        echo "<script type='text/javascript'>checkIt();</script>";
    }else if($nApe>(contaAperte($identificativoCorso)) || $nMul>(contaMultiple($identificativoCorso))){
        $tornaACasa= "Location: "."/docente/corso/"."$identificativoCorso"."/test/crea?flag=3";
        header($tornaACasa);
    }
    else  {
        $descr=$_POST['descrizione'];
        $punteggio=0;
        $Argomenti = Array();
        $Multiple = Array();
        $Aperte = Array();
        $Argomenti=$modelArgomento->getAllArgomentoCorso($identificativoCorso);
        $leAperte = Array();
        $leMultiple = Array();
        foreach($Argomenti as $a){// per ogni argomento del corso prendo tutte le aperte e le multiple
            $nuoveAperte = Array();
            $nuoveAperte = $modelDomande->getAllDomandaApertaByArgomento($a->getId());
            $Aperte = array_merge($Aperte,$nuoveAperte);
            $nuoveMultiple = Array();
            $nuoveMultiple = $modelDomande->getAllDomandaMultiplaByArgomento($a->getId());
            $Multiple = array_merge($Multiple,$nuoveMultiple);
        }
        if($nApe>1){
            $indiciA=array_rand($Aperte,$nApe);

            for($i=0;$i<$nApe;$i++){
                $leAperte[$i]=$Aperte[$indiciA[$i]];
            }
        }else if($nApe==1){
            $x=rand(0,(count($Aperte)-1));
            $leAperte[0]=$Aperte[$x];
        }else if($nApe==0){
            
        }else{
            //NON DOVREBBE MAI ARRIVARE QUI
        }
        if($nMul>1){
            $indiciM=array_rand($Multiple,$nMul);

            for($i=0;$i<$nMul;$i++){
                $leMultiple[$i]=$Multiple[$indiciM[$i]];
            }
        }else if($nMul==1){
            $x=rand(0,(count($Multiple)-1));
            $leMultiple[0]=$Multiple[$x];
        }else if($nMul==0){
            
        }else{
            //NON DOVREBBE MAI ARRIVARE QUI
        }

        foreach($leAperte as $s){ //leAperte selezionate vengono controllate per aggiorare il punteggio totale
            $w=$modelDomande->readDomandaAperta($s->getId());
            $punteggio=$punteggio+($w->getPunteggioMax());
        }
        foreach($leMultiple as $s) { //leMultiple selezionate vengono controllate per aggiorare il punteggio totale
            $w=$modelDomande->readDomandaMultipla($s->getId());
            $punteggio=$punteggio+($w->getPunteggioCorretta());
        }
        $nApe=parseInt($_POST['numAperte']);//mi riprendo il numero delle aperte
        $nMul=parseInt($_POST['numMultiple']);//mi riprendo il numero di multiple
        $test = new Test($descr,$punteggio,$nMul,$nApe,0,0,$identificativoCorso);//creo il test e lo metto nel db
        $idNuovoTest=$modelTest->creaTest($test);
        foreach($leAperte as $s){ //scansiono di nuovo le aperte per associarle al test
            $id = parseInt($s->getId());
            associaAperTest($id, $idNuovoTest, NULL);
            
            $updated = $modelDomande->readDomandaAperta($id);
            $perc = $updated->getPercentualeScelta() +1;
            $updated->setPercentualeScelta($perc);
            $modelDomande->updateDomandaAperta($id, $updated);
        }
        foreach($leMultiple as $x) { //scansiono di nuovo le multiple per associarle al test
            $id = parseInt($x->getId());
            associaMultTest($id, $idNuovoTest, NULL, NULL);
            
            $updated = $modelDomande->readDomandaMultipla($id);
            $perc = $updated->getPercentualeScelta() +1;
            $updated->setPercentualeScelta($perc);
            $modelDomande->updateDomandaMultiplaa($id, $updated);
        }

        $tornaACasa= "Location: "."/docente/corso/"."$identificativoCorso";
        header($tornaACasa); //torno alla home
    }


}

?>