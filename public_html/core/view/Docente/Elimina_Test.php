<?php


include_once MODEL_DIR . "TestModel.php";


$modelTest = new TestModel();


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

?>