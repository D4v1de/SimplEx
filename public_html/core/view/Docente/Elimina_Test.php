<?php


include_once MODEL_DIR . "TestModel.php";
$modelTest = new TestModel();

include_once MODEL_DIR . "SessioneModel.php";
$modelSessione = new SessioneModel();


function parseInt($Str) {
    return (int)$Str;
}
$identificativoCorso=$_GET["idcorso"];

if(isset($_POST['idtest'])){
    $id = $_POST['idtest'];
    $modelTest->deleteTest($id);
    $tornaACasa= "Location: "."/docente/corso/"."$identificativoCorso";
    header($tornaACasa);
}

if(isset($_POST['idtestHome'])){
    $id = $_POST['idtestHome'];
    $Tests=Array();
    $Sess=Array();
    $i=0;
    $Sess=$modelSessione->getAllSessioniByCorso($identificativoCorso); 
    foreach($Sess as $s){
        $nuoviTest=$modelSessione->getAllTestBySessione($s->getId());
        $Tests=array_merge($Tests,$nuoviTest);
    }
    foreach($Tests as $t){
        if($t==$id){
           $i++; 
        }
    }
    if($i>0){
        
    }else{
     $modelTest->deleteTest($id);
     $tornaACasa= "Location: "."/docente/corso/"."$identificativoCorso";
     header($tornaACasa);   
    }
    
}

?>