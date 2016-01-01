<?php

/**
 * La view che consente al docente di creare e modificare una sessione
 *
 * @author Antonio Luca D'Avanzo
 * @version 1
 * @since 18/11/15 09:58
 */

/*
include_once CONTROL_DIR . "UtenteController.php";
$controllerUtente = new UtenteController();
include_once CONTROL_DIR . "Sessione.php";
$controller = new SessioneController();
include_once CONTROL_DIR . "CdlController.php";
$controlleCdl = new CdlController();
include_once CONTROL_DIR . "TestController.php";
$testController = new TestController();
include_once CONTROL_DIR . "ElaboratoController.php";
$controllerElaborato = new ElaboratoController();
*/

include_once MODEL_DIR . "UtenteModel.php";
$modelUtente = new UtenteModel();
include_once MODEL_DIR . "SessioneModel.php";
$modelSessione = new SessioneModel();
include_once MODEL_DIR . "CdLModel.php";
$modelCdl = new CdLModel();
include_once MODEL_DIR . "CorsoModel.php";
$modelCorso = new CorsoModel();
include_once MODEL_DIR . "TestModel.php";
$testModel = new TestModel();
include_once MODEL_DIR . "ElaboratoModel.php";
$modelElaborato = new ElaboratoModel();
$idCorso = $_URL[2];
$numProfs=0;

$doc = $_SESSION['user'];
//$mostra=false;
$max=9999;

/*if(isset($_SESSION['mostra']))
    $mostra=$_SESSION['mostra'];
unset($_SESSION['mostra']);

if(isset($_SESSION['max']))
    $max=$_SESSION['max'];
unset($_SESSION['max']);
*/

$docentiOe=$modelUtente->getAllDocentiByCorso($idCorso);
foreach($docentiOe as $d) {
    if($doc==$d){
        $numProfs++;
    }
}
if($numProfs==0){
    header("Location: "."/docente/corso/".$corso->getId());
}

try {
    $corso = $modelCorso->readCorso($idCorso);
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
$flag=null;
$showE="";
$showRC="";

$flag = isset($_SESSION['flag']) ? $_SESSION['flag'] : 1;
unset($_SESSION['flag']);

if($_URL[4]!=0) {
    try {
        $idSessione=$_URL[4];
        try {
            $sessioneByUrl = $modelSessione->readSessione($_URL[4]);
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
            if ($modelSessione->readMostraEsitoSessione($idSessione) == "Si") {
                $showE = "Checked";
            }
            if ($modelSessione->readMostraRisposteCorretteSessione($idSessione) == "Si")
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
                        <a href="<?php echo "/docente/cdl/".$corso->getCdlMatricola(); ?>"> <?php echo $modelCdl->readCdl($corso->getCdlMatricola())->getNome(); ?> </a>
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
            <form <?php
                  if($_URL[4]==0)
                    printf("action=\"/docente/corso/%s/sessione/%s/creasessione\"",$idCorso,$idSessione);
                  else
                      printf("action=\"/docente/corso/%s/sessione/%s/modificasessione\"",$idCorso,$idSessione);
            ?> method="post" id="form_sample_2">

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
                        <div class="col-md-2">
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
                        <div class="col-md-2">
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
                        <div class="col-md-2">
                            <label >Punteggio Test</label>
                            <select  class="form-control" id="maxTest" name="max">
                                <?php
                                $tests = $testModel->getAllTestByCorso($idCorso);
                                $array[0]=-9999;
                                $uguale=false;
                                if($max!=9999)
                                    printf("<option value = '%s' > %s </option >",$max,$max);
                                else
                                    printf("<option value = 'scegli' > Scegli </option >");
                                foreach($tests as $t) {
                                        for($x = 0; $x < sizeof($array); $x++) {
                                            if ($t->getPunteggioMax()==$array[$x]) {
                                                $uguale=true;
                                            }
                                        }
                                          if($uguale==false) { //vuol dire che è diverso da tutti->posso metterlo
                                            printf("<option value = '%s' > %s </option >",$t->getPunteggioMax(),$t->getPunteggioMax());
                                            array_push($array,$t->getPunteggioMax());
                                            }
                                    $uguale=false;
                                }

                                ?>
                                </select>
                            <button type="submit" class="btn md green-jungle " name="filtra" data-toggle="confirmation"
                                    data-singleton="true" data-popout="true" title="Sicuro?"> <span class="md-click-circle md-click-animate" style="height: 94px; width: 94px; top: -23px; left: 2px;"></span>
                                Filtra
                            </button>
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

                               // if($mostra==true) {
                                $toCheck=null;
                                $array = Array();
                                try {
                                    $array = $testModel->getAllTestByCorso($idCorso);
                                    $testsOfSessione = $testModel->getAllTestBySessione($idSessione);
                                }
                                catch (ApplicationException $ex) {
                                    echo "<h1>ERRORE NELLA LETTURA DEI TESTS!</h1>" . $ex;
                                }
                                if ($array == null) {
                                }
                                else {
                                    $sessioniByCorso = $modelSessione->getAllSessioniByCorso($idCorso);
                                    foreach ($array as $c) {
                                        /*$elaborati = $modelElaborato->getAllElaboratiTest($c->getId());
                                        if ($sessioniByCorso != null) //FABIANO
                                            $percSce = round(($c->getPercentualeScelto()/count($sessioniByCorso)*100),2);
                                        else
                                            $percSce = 0;
                                        if ($elaborati != null)
                                            $percSuc = round(($c->getPercentualeSuccesso()/count($elaborati)*100),2);
                                        else
                                            $percSuc = 0;*/
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
                                        printf("<td>%d%%</td>", 0);  //FABIANO
                                        printf("<td>%d%%</td>", 0);  //FABIANO
                                        printf("</tr>");
                                    }
                                }
                               // }
                                ?>
                                </tbody>
                                <div <?php echo "id=nomeCorso"; echo "value='".$idCorso."'" ?>></div>
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
                                    $array = $modelUtente->getAllStudentiByCorso($idCorso);
                                    $studentsOfSessione = $modelUtente->getAllStudentiSessione($idSessione);
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
                                   <?php
                                   if($_URL[4]==0)
                                    printf("<button type=\"submit\" class=\"btn sm green-jungle \"  data-toggle=\"confirmation\"
                                            data-singleton=\"true\" data-popout=\"true\" title=\"Sicuro?\"> <span class=\"md-click-circle md-click-animate\" style=\"height: 94px; width: 94px; top: -23px; left: 2px;\"></span>
                                        Crea
                                    </button>");
                                   else
                                       printf("<button type=\"submit\" class=\"btn sm green-jungle \"  data-toggle=\"confirmation\"
                                            data-singleton=\"true\" data-popout=\"true\" title=\"Sicuro?\"> <span class=\"md-click-circle md-click-animate\" style=\"height: 94px; width: 94px; top: -23px; left: 2px;\"></span>
                                        Modifica
                                    </button>");

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
