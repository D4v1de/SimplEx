<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 18/11/15
 * Time: 09:58
 */

//TODO qui la logica iniziale, caricamento dei controller ecc
include_once CONTROL_DIR . "SessioneController.php";
include_once CONTROL_DIR . "CdlController.php";
$controllerSessione = new SessioneController();
$controlleCdl = new CdlController();
$idSessione = $_URL[6];
$identificativoCorso = $_URL[3];
$sessione = null;
$valu = null;
$eser = null;

if (!is_numeric($idSessione)) {
    echo "<script type='text/javascript'>alert('errore nella url!!!');</script>";
}

try {
    $sessione = $controllerSessione->readSessione($idSessione);
} catch (ApplicationException $ex) {
    echo "<h1>INSERIRE ID SESSIONE NEL PATH</h1>".$ex;
}

$corso = $controlleCdl->readCorso($identificativoCorso);
$nomecorso= $corso->getNome();

$dataFrom = $sessione->getDataInizio();
$dataTo = $sessione->getDataFine();
$tipoSessione = $sessione->getTipologia();
if ($tipoSessione == "Valutativa")
    $valu = "Checked";
else $eser = "Checked";


if(isset($_POST['avvia'])){
    $idSesToGo=$_POST['avvia'];
    $dataNow=date('Y/m/d/ h:i:s ', time());
    $newSessione = new Sessione($dataNow, dataTo, 18, "In Esecuzione", $tipoSessione, $identificativoCorso);
    $controllerSessione->updateSessione($idSessione,$newSessione);
    $vaiASessioneInCorso= "Location: /sessioneincorso";
    header($vaiASessioneInCorso);
}



if(isset($_POST['rimuovi'])){
    $idSes = $_POST['rimuovi'];
    try {
        $controllerSessione->deleteSessione($idSes);
        $tornaACasa= "Location: "."/usr/docente/corso/"."$identificativoCorso";
        header($tornaACasa);
    }
    catch(ApplicationException $ex) {
        echo "PERCHè NON FUNZIONI?".$ex;
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
<head>
    <meta charset="utf-8"/>
    <title>Visualizza Sessione</title>
    <link rel="stylesheet" type="text/css"
          href="/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css"
          href="/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/select2/select2.css">

    <?php include VIEW_DIR . "design/header.php"; ?>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-md page-header-fixed page-quick-sidebar-over-content">
<?php include VIEW_DIR . "design/headMenu.php"; ?>
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <?php include VIEW_DIR . "design/sideBar.php"; ?>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title">
                Visualizza Sessione
            </h3>

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="index.html">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="<?php echo "/usr/docente/cdl/".$corso->getCdlMatricola(); ?>"> <?php echo $controlleCdl->readCdl($corso->getCdlMatricola())->getNome(); ?> </a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <?php
                            $vaiANomeCorso="/usr/docente/corso/".$identificativoCorso;
                            printf("<a href=\"%s\">%s</a><i class=\"fa fa-angle-right\"></i>", $vaiANomeCorso ,$nomecorso);
                         ?>
                    </li>
                    <li>
                        <?php echo "Sessione ".$sessione->getId() ?>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->

            <div class="row">
                <div class="col-md-12">

                    <div class="col-md-6">
                        <div class="col-md-6">
                            <label class="control-label">Avvio:</label>

                            <div class="input-group date form_datetime">
                                <input type="text"  size="16" readonly="" class="form-control" value='<?php printf("%s", $dataFrom ); ?>' disabled="true"/>
                                        <span class="input-group-btn">
                                            <button class="btn default date-set" type="button"><i
                                                    class="fa fa-calendar"></i></button>
                                        </span>
                            </div>
                            <span class="help-block"><br></span>

                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Termine:</label>

                            <div class="input-group date form_datetime">
                                <input type="text" size="16" readonly="" class="form-control" value='<?php printf("%s", $dataTo ); ?>' disabled="true"/>
                                        <span class="input-group-btn">
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
                                    <?php printf("<input type=\"radio\" disabled value=\"Valutativa\" id=\"radio1\" %s name=\"radio1\" class=\"md-radiobtn\">", $valu);?>
                                    <label for="radio1">
                                    <span></span>
                                    <span class="check"></span>
                                    <span class="box"></span>
                                    Valutativa </label>
                                </div>
                                <div class="md-radio">
                                    <?php printf("<input disabled type=\"radio\" value=\"Esercitativa\" id=\"radio1\" %s name=\"radio2\" class=\"md-radiobtn\">", $eser);?>
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
                                    <input type="checkbox" id="checkbox1" class="md-check" disabled="true" >
                                    <label for="checkbox1">
                                    <span></span>
                                    <span class="check"></span>
                                    <span class="box"></span>
                                    Mostra esiti </label>
                                </div>
                                <div class="md-checkbox">
                                    <input type="checkbox" id="checkbox2" class="md-check" disabled="true">
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


                    <div id="tabella_test_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-striped table-bordered table-hover dataTable no-footer" id="tabella_test" role="grid" aria-describedby="tabella_studenti_info">
                            <thead>
                            <tr role="row">
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
                            $array = Array();
                            $array = $controllerSessione->getAllTestBySessione($idSessione);
                            if ($array == null) {
                                echo "l'array è null"." ".$idSessione;
                            }
                            else {
                                foreach ($array as $c) {
                                    printf("<tr class=\"gradeX odd\" role=\"row\">");
                                    printf("<td class=\"sorting_1\">Test %s</td>", $c->getId());
                                    printf("<td>%s</td>", $c->getDescrizione());
                                    printf("<td>%d</td>", $c->getNumeroMultiple());
                                    printf("<td>%d</td>", $c->getNumeroAperte());
                                    printf("<td>%d</td>", $c->getPunteggioMax());
                                    printf("<td>%d</td>", $c->getPercentualeScelto());
                                    printf("<td>%d</td>", $c->getPercentualeSuccesso());
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

                            <tr class="gradeX odd" role="row">
                                <td class="sorting_1">
                                    Mario
                                </td>
                                <td>
                                    Rossi
                                </td>
                                <td>0512100001</td>
                            </tr><tr class="gradeX even" role="row">
                                <td class="sorting_1">
                                    Giacomo
                                </td>
                                <td>
                                    Bonaventura
                                </td>
                                <td>0512100002</td>
                            </tr><tr class="gradeX odd" role="row">
                                <td class="sorting_1">
                                    Diego Armando
                                </td>
                                <td>
                                    Maradona
                                </td>
                                <td>0512100003</td>
                            </tr><tr class="gradeX even" role="row">
                                <td class="sorting_1">
                                    Francesco
                                </td>
                                <td>
                                    Totti
                                </td>
                                <td>0512100004</td>
                            </tr>

                            <tr class="gradeX odd" role="row">
                                <td class="sorting_1">
                                    Gianluca
                                </td>
                                <td>
                                    Di Marzio
                                </td>
                                <td>0512100005</td>
                            </tr>

                            <tr class="gradeX odd" role="row">
                                <td class="sorting_1">
                                    Riccardo
                                </td>
                                <td>
                                    Montolivo
                                </td>
                                <td>0512100006</td>
                            </tr>

                            <tr class="gradeX odd" role="row">
                                <td class="sorting_1">
                                    Inacio
                                </td>
                                <td>
                                    Pia
                                </td>
                                <td>0512100007</td>
                            </tr>

                            <tr class="gradeX odd" role="row">
                                <td class="sorting_1">
                                    Raffaele
                                </td>
                                <td>
                                    Auriemma
                                </td>
                                <td>0512100008</td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


        <form action="" method="post">
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-9">
                                <?php
                                printf("<button name=\"avvia\" value=\"%s\" class=\"btn sm green-jungle\"><span class=\"md-click-circle md-click-animate\" style=\"height: 94px; width: 94px; top: -23px; left: 2px;\"></span><i class=\"fa fa-play-circle-o\"></i>Avvia ora</button>",$idSessione);
                                $vaiAModifica="/usr/docente/corso/".$identificativoCorso."/sessione"."/"."creamodificasessione"."/".$idSessione;
                                $vaiAVisu="/usr/docente/corso/".$identificativoCorso."/sessione"."/"."visualizzasessione"."/".$idSessione;

                                printf(" <a href=\"%s\" class=\"btn btn-sm blue-madison\"><i class=\"fa fa-edit\"></i>ModificaSessione</a>", $vaiAModifica);
                                printf("<button type='submit' name='rimuovi' value='%d' class='btn btn-sm red-intense'><i class=\"fa fa-trash-o\"></i>Elimina Sessione</button>",$idSessione);
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

    <script>
        jQuery(document).ready(function () {
            Metronic.init(); // init metronic core components
            Layout.init(); // init current layout
            //QuickSidebar.init(); // init quick sidebar
            //Demo.init(); // init demo features
            TableManaged2.init('tabella_test','tabella_test_wrapper');
            TableManaged2.init('tabella_studenti','tabella_studenti_wrapper');

        });
    </script>

    <script>
        //SCRIPT PER AVVIARE DATETIMEPICKER
        //$(".form_datetime").datetimepicker({format: 'dd-mm-yyyy hh:ii'});
    </script>

    <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
