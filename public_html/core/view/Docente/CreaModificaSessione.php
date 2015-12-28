<?php
/**
 * La view che consente al docente di creare e modificare una sessione
 *
 * @author Antonio Luca D'Avanzo
 * @version 1
 * @since 18/11/15 09:58
 */
include_once CONTROL_DIR . "UtenteController.php";
$controllerUtente = new UtenteController();
include_once CONTROL_DIR . "SessioneController.php";
$controller = new SessioneController();
include_once CONTROL_DIR . "CdlController.php";
$controlleCdl = new CdlController();
include_once CONTROL_DIR . "TestController.php";
$testController = new TestController();
include_once CONTROL_DIR . "ElaboratoController.php";
$controllerElaborato = new ElaboratoController();
$idCorso = $_URL[2];
$numProfs=0;
$doc = $_SESSION['user'];
$docentiOe=$controllerUtente->getDocenteAssociato($idCorso);
foreach($docentiOe as $d) {
    if($doc==$d){
        $numProfs++;
    }
}
if($numProfs==0){
    header("Location: "."/docente/corso/".$corso->getId());
}

try {
    $corso = $controlleCdl->readCorso($idCorso);
    $nomecorso= $corso->getNome();
}
catch (ApplicationException $ex) {
    echo "<h1>ERRORE NELLA LETTURA DEL CORSO!</h1>" . $ex;
}

$idSessione=0;
$someStudentsChange=null;
$dataToSettato=null;
$sogliAmm=null;
$stato=null;
$someTestsAorD=false;
$perModificaDataFrom =  null;
$perModificaDataTo = null;
$valu = null;
$eser = null;
$flag=1;
$showE="";
$showRC="";

if($_URL[4]!=0) {
    try {
        $idSessione=$_URL[4];
        try {
            $sessioneByUrl = $controller->readSessione($_URL[4]);
            $dataFrom = $sessioneByUrl->getDataInizio();
            $dataTo = $sessioneByUrl->getDataFine();
            $tipoSessione = $sessioneByUrl->getTipologia();
        }
        catch (ApplicationException $ex) {
            echo "<h1>ERRORE NELLA LETTURA DELLA SESSIONE!</h1>" . $ex;
        }
        $perModificaDataFrom = $dataFrom;
        $perModificaDataTo = $dataTo;
        if ($tipoSessione == "Valutativa")
            $valu = "Checked";
        else $eser = "Checked";

        try {
            if ($controller->readMostraEsitoSessione($idSessione) == "Si") {
                $showE = "Checked";
            }
            if ($controller->readMostraRisposteCorretteSessione($idSessione) == "Si")
                $showRC = "Checked";
        }
        catch (ApplicationException $ex) {
            echo "<h1>ERRORE NELLA LETTURA DEI \"MOSTRA\"!</h1>" . $ex;
        }

    } catch (ApplicationException $ex) {
        echo "<h1>errore! ApplicationException->errore manca id sessione nel path!</h1>";
        echo "<h4>" . $ex . "</h4>";
    }
}

else {

}

if($_URL[4]==0) {
    if(isset($_POST['dataFrom']) && isset($_POST['radio1']) && isset($_POST['dataTo']) && $someTestsAorD=isset($_POST['tests']) ) {
        $newdataFrom = $_POST['dataFrom'];
        $newdataTo = $_POST['dataTo'];
        $newtipoSessione = $_POST['radio1'];

        $sogliAmm = 18;
        $stato = 'Non Eseguita';

        $timeTo = strtotime($newdataTo);
        $toCompareTo = date('yyyy-mm-dd hh:ii:ss', $timeTo);

        $timeFrom = strtotime($newdataFrom);
        $toCompareFrom = date('yyyy-mm-dd hh:ii:ss', $timeFrom);

        if ($toCompareTo < $toCompareFrom) {
            $flag = 0;
        } else {
            $sessione = new Sessione($newdataFrom, $newdataTo, $sogliAmm, $stato, $newtipoSessione, $idCorso);
            try {
                $idNuovaSessione = $controller->creaSessione($sessione);

                if (isset($_POST['cbShowEsiti'])) {
                    $controller->abilitaMostraEsito($idNuovaSessione);
                }

                if (isset($_POST['cbShowRispCorr'])) {
                    $controller->abilitaMostraRisposteCorrette($idNuovaSessione);
                }

                if (isset($_POST['students'])) {
                    $cbStudents = $_POST['students'];
                    if ($cbStudents == null) {
                        echo "<h1>CBSTUDENTS VUOTO!</h1>";
                    } else {
                        foreach ($cbStudents as $s) {
                            $controller->abilitaStudenteASessione($idNuovaSessione, $s);
                        }
                    }
                }

                if ($someTestsAorD) {
                    $cbTest = Array();
                    $cbTest = $_POST['tests'];
                    if ($cbTest != null) {
                        print_r($cbTest);
                    }

                    foreach ($cbTest as $t) {
                        $controller->associaTestASessione($idNuovaSessione, $t);
                        $updated = $testController->readTest($t);
                        $perc = $updated->getPercentualeScelto() +1;
                        $updated->setPercentualeScelto($perc);
                        $testController->updateTest($t, $updated);
                    }
                    
                    //Statistica percentuale scelta test
                    
                    /*$allTests = $testController->getAllTestbyCorso($idCorso);
                    $sessioni = $controller->getAllSessioniByCorso($idCorso);
                    foreach ($allTests as $test){
                        $testId = $test->getId();
                        $c = 0;
                        foreach ($sessioni as $s){
                            $tests = $testController->getAllTestBySessione($s->getId());
                            foreach ($tests as $t)
                                if ($t->getId() == $testId)
                                    $c++;
                            }
                            $updated = $testController->readTest($testId);
                            $perc = $c/count($sessioni) * 100;
                            $updated->setPercentualeScelto($perc);
                            $testController->updateTest($testId, $updated);
                        }*/
                    }
            } catch (ApplicationException $ex) {
                echo "<h1>ERRORE NELLE OPERAZIONI DELLA SESSIONE (fase creazione)!</h1>" . $ex;
            }
                $tornaACasa= "Location: "."/docente/corso/"."$idCorso"."/successinserimento";
                header($tornaACasa);
        }
    }
}

if($_URL[4]!=0) {
    if($dataFromSettato=isset($_POST['dataFrom']) && $radio1Settato=isset($_POST['radio1']) && $dataToSettato=isset($_POST['dataTo']) && $someTestsAorD=isset($_POST['tests']) ) {

        if($dataFromSettato)
            $newOrOldDataFrom = $_POST['dataFrom'];
        else
            $newOrOldDataFrom= $dataFrom;
        if($dataToSettato)
            $newOrOldDataTo = $_POST['dataTo'];
        else
            $newOrOldDataTo = $_POST['dataTo'];

        $newtipoSessione = $_POST['radio1'];

        $sessioneByUrl = $controller->readSessione($_URL[4]);
        $stato=$sessioneByUrl->getStato();
        $sogliAmm=$sessioneByUrl->getSogliaAmmissione();

        $timeTo = strtotime( $newOrOldDataTo);
        $toCompareTo = date('yyyy-mm-dd hh:ii:ss', $timeTo);
        $timeFrom = strtotime($newOrOldDataFrom);
        $toCompareFrom = date('yyyy-mm-dd hh:ii:ss', $timeFrom);
        if ($toCompareTo < $toCompareFrom) {
            $flag = 0;
        }

        else {
        try {
            $sessioneAggiornata = new Sessione($newOrOldDataFrom, $newOrOldDataTo, $sogliAmm, $stato, $newtipoSessione, $idCorso);
            $controller->disabilitaMostraEsito($idSessione);
            $controller->disabilitaMostraRisposteCorrette($idSessione);

            if (isset($_POST['cbShowEsiti'])) {
                $controller->abilitaMostraEsito($idSessione);
            }

            if (isset($_POST['cbShowRispCorr'])) {
                $controller->abilitaMostraRisposteCorrette($idSessione);
            }

            $controller->updateSessione($_URL[4], $sessioneAggiornata);

            if (isset($_POST['tests'])) {
                    $cbTest = Array();
                    $cbTest = $_POST['tests'];
                    $controller->deleteAllTestFromSessione($idSessione);
                    foreach ($cbTest as $t) {
                        $controller->associaTestASessione($idSessione, $t);
                        $updated = $testController->readTest($t);
                        $perc = $updated->getPercentualeScelto() +1;
                        $updated->setPercentualeScelto($perc);
                        $testController->updateTest($t, $updated);
                    }
            }

            if($someStudentsChange=isset($_POST['students'])){
            if ($someStudentsChange) {
                $cbStudents = Array();
                $cbStudents = $_POST['students'];
                $allStuAbi = $controller->getAllStudentiBySessione($idSessione);
                foreach ($allStuAbi as $s) {
                    $controller->disabilitaStudenteDaSessione($idSessione, $s->getMatricola());
                }
                foreach ($cbStudents as $s) {
                    $controller->abilitaStudenteASessione($idSessione, $s);
                }
            }
        }
        }
        catch (ApplicationException $ex) {
            echo "<h1>ERRORE NELLE OPERAZIONI DELLA SESSIONE (fase modifica)!</h1>" . $ex;
        }


        $tornaACasa= "Location: "."/docente/corso/"."$idCorso";
        header($tornaACasa);
        }
    }
    else {

    }

}

?>
<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="en">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head >
    <meta charset="utf-8"/>
    <title>Gestione Sessione</title>
    <link rel="stylesheet" type="text/css"
          href="/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css"
          href="/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/select2/select2.css">
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/bootstrap-toastr/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/bootstrap-toastr/toastr.min.css">

    <?php include VIEW_DIR . "design/header.php"; ?>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-md page-header-fixed page-quick-sidebar-over-content">
<?php include VIEW_DIR . "design/headMenu.php"; ?>
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container" >
    <?php include VIEW_DIR . "design/sideBar.php"; ?>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title">
                <?php
                $creaSes="Crea Sessione";
                $modSes= "Modifica Sessione";
                if($_URL[4]!=0)
                    printf("%s",$modSes);
                else
                    printf("%s",$creaSes);
                ?>
            </h3>

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="/docente">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="<?php echo "/docente/cdl/".$corso->getCdlMatricola(); ?>"> <?php echo $controlleCdl->readCdl($corso->getCdlMatricola())->getNome(); ?> </a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <?php
                        $vaiANomeCorso="/docente/corso/".$idCorso;
                        printf("<a href=\"%s\">%s</a><i class=\"fa fa-angle-right\"></i>", $vaiANomeCorso ,$nomecorso);
                        ?>
                    </li>
                    <li>
                        <?php echo "Sessione ".$idSessione ?>
                    </li>
                </ul>
            </div>

            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <form action="" method="post" id="form_sample_2">

                <?php
                if($flag==0) {
                    printf("<div class='alert alert-danger'>
                    <button class=\"close\" data-close=\"alert\"></button>
                       La data di Fine non può essere inferiore alla data di Inizio. </div>");
                }
                    printf("<div class='alert alert-danger display-hide'>
                    <button class=\"close\" data-close=\"alert\"></button>
                    Occorre selezionare almeno un Test con Avvio e Termine.
                </div>");
                ?>
            <div class="row">
                <div class="col-md-12">

                    <div class="col-md-6">
                        <div class="col-md-6">

                            <label class="control-label">Avvio:</label>

                            <div class="input-group date form_datetime">

                                <input name="dataFrom" type="text" value='<?php printf("%s", $perModificaDataFrom ); ?>' size="16" readonly="" class="form-control"/>
                                        <span class="input-group-btn">
                                            <button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
                                        </span>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Termine:</label>

                            <div class="input-group date form_datetime">
                                <input name="dataTo" id="dataTo" class="form-control" type="text" value='<?php printf("%s",$perModificaDataTo ); ?>' size="16"  readonly="" />
                                        <span class="input-group-btn" >
                                            <button class="btn default date-set" type="button"><i
                                                    class="fa fa-calendar"></i></button>
                                        </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-md-radios">
                            <label>Seleziona tipologia</label>
                            <div class="md-radio-list">
                                <div class="md-radio">
                                    <?php printf("<input type=\"radio\" value=\"Valutativa\" checked id=\"radio1\" %s name=\"radio1\" class=\"md-radiobtn\">", $valu);?>
                                    <label for="radio1">
                                    <span></span>
                                    <span class="check"></span>
                                    <span class="box"></span>
                                    Valutativa </label>
                                </div>
                                <div class="md-radio">
                                    <?php printf("<input type=\"radio\" value=\"Esercitativa\" id=\"radio2\" %s name=\"radio1\" class=\"md-radiobtn\">", $eser);?>
                                    <label for="radio2">
                                    <span></span>
                                    <span class="check"></span>
                                    <span class="box"></span>
                                    Esercitativa </label>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group form-md-checkboxes">
                            <label>Seleziona preferenze</label>
                            <div class="md-checkbox-list">
                                <div class="md-checkbox">
                                    <input type="checkbox" id="checkbox1" <?php printf("%s",$showE) ?>  name="cbShowEsiti" class="md-check">
                                    <label for="checkbox1">
                                    <span></span>
                                    <span class="check"></span>
                                    <span class="box"></span>
                                    Mostra esiti </label>
                                </div>
                                <div class="md-checkbox">
                                    <input type="checkbox" id="checkbox2" <?php printf("%s",$showRC) ?> name="cbShowRispCorr" class="md-check">
                                    <label for="checkbox2">
                                    <span></span>
                                    <span class="check"></span>
                                    <span class="box"></span>
                                    Mostra risposte corrette </label>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="portlet box blue-madison">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-file-text-o"></i>Test
                    </div>

                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title="">
                        </a>
                    </div>


                    <div class="actions">
                        <div class="btn-group">
                            <ul class="dropdown-menu pull-right">
                                <li>
                                    <a href="javascript:;">
                                        <i class="fa fa-pencil"></i> Print </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <i class="fa fa-trash-o"></i> Save as PDF </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <i class="fa fa-ban"></i> Export to Excel </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">


                    <div id="tabella_test_wrapper" class="dataTables_wrapper no-footer" >
                        <table class="table table-striped table-bordered table-hover dataTable no-footer" id="tabella_test" role="grid" aria-describedby="tabella_studenti_info">
                            <thead>
                            <tr role="row">
                                <th class="table-checkbox sorting_disabled" rowspan="1" colspan="1" aria-label="
                                                        " style="width: 24px;">
                                    <input type="checkbox" class="group-checkable" data-set="#tabella_test .checkboxes">
                                </th>
                                <th class="sorting-disabled" tabindex="0" aria-controls="sample_2" rowspan="1" colspan="1" aria-label="
                                                                 Email
                                                        : activate to sort column ascending" style="width: 106px;">
                                    Nome
                                </th><th class="sorting-disabled" tabindex="0" aria-controls="sample_2" rowspan="1" colspan="1" aria-label="
                                                                 Email
                                                        : activate to sort column ascending" style="width: 181px;">
                                    Descrizione
                                </th>
                                <th class="sorting-disabled" tabindex="0" aria-controls="sample_2" rowspan="1" colspan="1" aria-label="
                                                                 Email
                                                        : activate to sort column ascending" style="width: 181px;">
                                    N° Multiple
                                </th>
                                <th class="sorting-disabled" tabindex="0" aria-controls="sample_2" rowspan="1" colspan="1" aria-label="
                                                                 Email
                                                        : activate to sort column ascending" style="width: 181px;">
                                    N° Aperte
                                </th>
                                <th class="sorting-disabled" tabindex="0" aria-controls="sample_2" rowspan="1" colspan="1" aria-label="
                                                                 Email
                                                        : activate to sort column ascending" style="width: 181px;">
                                    Punteggio Massimo
                                </th>
                                <th class="sorting-disabled" tabindex="0" aria-controls="sample_2" rowspan="1" colspan="1" aria-label="
                                                                 Email
                                                        : activate to sort column ascending" style="width: 181px;">
                                    % Inserito
                                </th>
                                <th class="sorting-disabled" tabindex="0" aria-controls="sample_2" rowspan="1" colspan="1" aria-label="
                                                                 Email
                                                        : activate to sort column ascending" style="width: 181px;">
                                    % Superato
                                </th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php
                            $toCheck=null;
                            $array = Array();
                            try {
                                $array = $controller->getAllTestByCorso($idCorso);
                                $testsOfSessione = $controller->getAllTestBySessione($_URL[4]);
                            }
                            catch (ApplicationException $ex) {
                                echo "<h1>ERRORE NELLA LETTURA DEI TESTS!</h1>" . $ex;
                            }
                            if ($array == null) {
                            }
                            else {
                                $sessioniByCorso = $controller->getAllSessioniByCorso($idCorso);
                                foreach ($array as $c) {
                                    $elaborati = $controllerElaborato->getAllElaboratiTest($c->getId());
                                    if ($sessioniByCorso != null)
                                        $percSce = round(($c->getPercentualeScelto()/count($sessioniByCorso)*100),2);
                                    else
                                        $percSce = 0;
                                    if ($elaborati != null)
                                        $percSuc = round(($c->getPercentualeSuccesso()/count($elaborati)*100),2);
                                    else
                                        $percSuc = 0;
                                    printf("<tr class=\"gradeX odd\" role=\"row\">");
                                    foreach($testsOfSessione as $t){
                                        if($c->getId()==$t->getId())
                                            $toCheck="Checked";
                                    }
                                    printf("<td><input name=\"tests[]\" type=\"checkbox\" %s class=\"checkboxes\" value='%d'></td>",$toCheck, $c->getId());
                                    $toCheck="";
                                    printf("<td class=\"sorting_1\">Test %s</td>", $c->getId());
                                    printf("<td>%s</td>", $c->getDescrizione());
                                    printf("<td>%d</td>", $c->getNumeroMultiple());
                                    printf("<td>%d</td>", $c->getNumeroAperte());
                                    printf("<td>%d</td>", $c->getPunteggioMax());
                                    printf("<td>%d%%</td>", $percSce);
                                    printf("<td>%d%%</td>", $percSuc);
                                    printf("</tr>");
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="portlet box blue-madison">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-user"></i>Studenti
                    </div>

                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title="">
                        </a>
                    </div>

                    <div class="actions">
                        <div class="btn-group">
                            <ul class="dropdown-menu pull-right">
                                <li>
                                    <a href="javascript:;">
                                        <i class="fa fa-pencil"></i> Print </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <i class="fa fa-trash-o"></i> Save as PDF </a>
                                </li>
                                <li>
                                    <a href="javascript:;">
                                        <i class="fa fa-ban"></i> Export to Excel </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="portlet-body">


                    <div id="tabella_studenti_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-striped table-bordered table-hover dataTable no-footer" id="tabella_studenti" role="grid" aria-describedby="tabella_studenti_info">
                            <thead>
                            <tr role="row">
                                <th class="table-checkbox sorting_disabled" rowspan="1" colspan="1" aria-label="
                                                        " style="width: 24px;">
                                    <input type="checkbox" class="group-checkable" data-set="#tabella_studenti .checkboxes">
                                </th>
                                <th class="sorting_asc" tabindex="0" aria-controls="sample_2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="
                                                                 Username
                                                        : activate to sort column ascending" style="width: 106px;">
                                    Nome
                                </th><th class="sorting" tabindex="0" aria-controls="sample_2" rowspan="1" colspan="1" aria-label="
                                                                 Email
                                                        : activate to sort column ascending" style="width: 181px;">
                                    Cognome
                                </th>
                                <th class="sorting-disabled" tabindex="0" aria-controls="sample_2" rowspan="1" colspan="1" aria-label="
                                                                 Email
                                                        : activate to sort column ascending" style="width: 181px;">
                                    Matricola
                                </th>

                            </tr>
                            </thead>

                            <tbody>

                            <?php
                            $array = Array();
                            $toCheckS="";
                            try {
                                $array = $controller->getAllStudentiByCorso($idCorso);
                                $studentsOfSessione = $controller->getAllStudentiBySessione($idSessione);
                            }
                            catch (ApplicationException $ex) {
                                echo "<h1>ERRORE NELLA LETTURA DEGLI STUDENTI!</h1>" . $ex;
                            }
                            if ($array == null) {
                            }
                            else {
                                foreach ($array as $c) {
                                    printf("<tr class=\"gradeX odd\" role=\"row\">");
                                    foreach($studentsOfSessione as $t){
                                        if($c->getMatricola()==$t->getMatricola())
                                            $toCheckS="Checked";
                                    }
                                    printf("<td><input name=\"students[]\" type=\"checkbox\" %s class=\"checkboxes\" value='%s'></td>",$toCheckS, $c->getMatricola());
                                    $toCheckS="";
                                    printf("<td class=\"sorting_1\">%s</td>", $c->getNome());
                                    printf("<td>%s</td>", $c->getCognome());
                                    printf("<td>%s</td>", $c->getMatricola());
                                    printf("</tr>");
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


            <div class="form-actions">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-9">
                                <button type="submit" class="btn sm green-jungle "  data-toggle="confirmation"
                                        data-singleton="true" data-popout="true" title="Sicuro?"> <span class="md-click-circle md-click-animate" style="height: 94px; width: 94px; top: -23px; left: 2px;"></span>
                                    Salva
                                </button>
                                    <?php
                                    $vaiANomeCorso="/docente/corso/".$idCorso;
                                    printf("<a href=\"%s\" class=\"btn sm red-intense\">Annulla</a>", $vaiANomeCorso ,$nomecorso);
                                    ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            </form>
            <!-- END PAGE CONTENT-->
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END CONTAINER -->
    <?php include VIEW_DIR . "design/footer.php"; ?>
    <!-- END FOOTER -->
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <?php include VIEW_DIR . "design/js.php"; ?>

    <!--Script specifici per la pagina -->
    <script src="/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
    <script src="/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
    <script type="text/javascript" src="/assets/global/plugins/select2/select2.min.js"></script>
    <script type="text/javascript" src="/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript"
            src="/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
    <script src="/assets/admin/pages/scripts/table-managed.js"></script>

    <script type="text/javascript"
            src="/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/assets/admin/pages/scripts/form-validation.js"></script>
    <script type="text/javascript" src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="/assets/global/plugins/jquery-validation/js/additional-methods.min.js"></script>
    <script src="/assets/admin/pages/scripts/ui-toastr.js"></script>
    <script src="/assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>
    <script src="/assets/admin/pages/scripts/ui-confirmations.js"></script>
    <script src="/assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js" type="text/javascript"></script>

    <script>
        jQuery(document).ready(function () {
            Metronic.init();
            Layout.init();
            TableManaged.init('tabella_test','tabella_test_wrapper');
            TableManaged.init('tabella_studenti','tabella_studenti_wrapper');
            UIToastr.init();
            UIConfirmations.init();
            FormValidation.init();
        });
    </script>

    <script>
        $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii:ss'});
    </script>

    <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
