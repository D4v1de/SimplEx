<?php

/**
 * Controller che permette di eliminare un Test
 * @author Fabio
 * @version 1.2
 * @since 03/01/16 04:16
 */


include_once MODEL_DIR . "TestModel.php";
$modelTest = new TestModel();

include_once MODEL_DIR . "SessioneModel.php";
$modelSessione = new SessioneModel();

include_once MODEL_DIR . "UtenteModel.php";
$modelUtente = new UtenteModel(); 


function parseInt($Str) {
    return (int)$Str;
}
$identificativoCorso=$_GET["idcorso"];

$numProfs=0;
$doc = $_SESSION['user'];
$docentiOe=$modelUtente->getAllDocentiByCorso($identificativoCorso);
foreach($docentiOe as $d) {
    if($doc==$d){
        $numProfs++;
    }
}
if($numProfs==0){
    $_SESSION["Intruso"]=1;
    header("Location: "."/docente/corso/".$identificativoCorso);
}


if(isset($_POST['idtest'])){
    $id = $_POST['idtest'];
    $modelTest->deleteTest($id);
    $tornaACasa= "Location: "."/docente/corso/"."$identificativoCorso";
    header($tornaACasa);
}

if(isset($_POST['idtestHome'])){
    $id = $_POST['idtestHome'];
    //DEVO CAPIRE SE STA COSA SI DEVE FARE O NO!!!
    /**$Tests=Array();
    $Sess=Array();
    $i=0;
    $Sess=$modelSessione->getAllSessioniByCorso($identificativoCorso); 
    foreach($Sess as $s){
        $nuoviTest=$modelTest->getAllTestBySessione($s->getId());
        $Tests=array_merge($Tests,$nuoviTest);
    }
    foreach($Tests as $t){
        if($t==$id){
           $i++; 
        }
    }
    if($i>0){
        $tornaACasa= "Location: "."/docente/corso/"."$identificativoCorso";
        header($tornaACasa);
    }else{*/
     $modelTest->deleteTest($id);
     $tornaACasa= "Location: "."/docente/corso/"."$identificativoCorso"."/successelimina";
     header($tornaACasa);   
   // }
    
}

?>