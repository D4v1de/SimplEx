<?php
/**
 * Questo Control permette di abilitare uno studente ad una sessione.
 * @author Antonio Luca D'Avanzo
 * @version 1
 * @since  31/12/2015 00:26
 */

include_once MODEL_DIR . "UtenteModel.php";
$utenteModel = new UtenteModel();
$idSessione=$_URL[4];
$idCorso = $_URL[2];

if(isset($_POST['abilita'])) {
        $cbStudents= Array();
        $cbStudents = $_POST['students'];
        print_r($cbStudents);
        $allStuAbi= $utenteModel->getAllStudentiSessione($idSessione);
        print_r($allStuAbi);
        foreach($allStuAbi as $s) {
            $utenteModel->disabilitaStudenteSessione($idSessione, $s->getMatricola());
        }
        foreach($cbStudents as $s) {
            $utenteModel->abilitaStudenteSessione($idSessione, $s);
        }
    header("Location: "."/docente/corso/".$idCorso."/"."sessione"."/".$idSessione."/"."sessioneincorso/show");

}

