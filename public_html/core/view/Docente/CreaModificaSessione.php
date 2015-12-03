<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 18/11/15
 * Time: 09:58
 */

//TODO qui la logica iniziale, caricamento dei controller ecc
include_once CONTROL_DIR . "SessioneController.php";

$controller = new SessioneController();
$idCorso = $_URL[3];
//$sessioneByUrl = null;

$perModificaDataFrom =  null;
$perModificaDataTo = null;
$valu = null;
$eser = null;

if($_URL[6]!=0) {  //CASO IN CUI SI VOGLIA MODIFICARE LA SESSIONE
    try {
        $sessioneByUrl = $controller->readSessione($_URL[6]);
        $dataFrom = $sessioneByUrl->getDataInizio();
        $dataTo = $sessioneByUrl->getDataFine();
        $tipoSessione = $sessioneByUrl->getTipologia();
        $perModificaDataFrom = $dataFrom;
        $perModificaDataTo = $dataTo;
        if ($tipoSessione == "Valutativa")
            $valu = "Checked";
        else $eser = "Checked";

    } catch (ApplicationException $ex) {
        echo "<h1>errore! ApplicationException->errore manca id sessione nel path!</h1>";
        echo "<h4>" . $ex . "</h4>";
        //header('Location: ../visualizzacorso');
    }
}

else {  //CASO IN CUI SI VUOLE CREARE LA SESSIONE

}

if($_URL[6]==0) {  //CASO IN CUI SI CREA UNA SESSIONE..devono essere settati tutti i campi
    if(isset($_POST['dataFrom']) && isset($_POST['radio1']) && isset($_POST['dataTo']) ) {
        $newdataFrom = $_POST['dataFrom'];
        $newdataTo = $_POST['dataTo'];
        $newtipoSessione = $_POST['radio1'];
        echo $newdataFrom;

        $sogliAmm= 18;                             //dove la prendo?
        $stato='Non Eseguita';                     //dove lo prendo?

        if (isset($_POST['tests'])  && isset($_POST['students'])) {
            $cbTest = Array();
            $cbTest = $_POST['tests'];
            $sessione = new Sessione($newdataFrom, $newdataTo, $sogliAmm, $stato, $newtipoSessione, $idCorso);
            $controller->creaSessione($sessione);
            $tornaCasa= "Location: "."/usr/docente/corso/"."$idCorso";
            header($tornaCasa);
        }
    }
}

if($_URL[6]!=0) {  //CASO DI MODIFICA..DEVE ESSERE SETTATO !ALMENO! UNO.
    if($dataFromSettato=isset($_POST['dataFrom']) || $radio1Settato=isset($_POST['radio1']) || $dataToSettatoisset=($_POST['dataTo']) ) {
        //dalle variabili prese so quali sono settati..quelli costituiranno la nuova sessione
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
    <title>Metronic | Page Layouts - Blank Page</title>
    <link rel="stylesheet" type="text/css"
          href="/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css"
          href="/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/select2/select2.css">

    <?php include VIEW_DIR . "header.php"; ?>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-md page-header-fixed page-quick-sidebar-over-content">
<?php include VIEW_DIR . "headMenu.php"; ?>
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <?php include VIEW_DIR . "sideBar.php"; ?>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title">
                Crea Sessione / Modifica Sessione
            </h3>

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="index.html">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">Nome Corso</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">Nome Sessione</a>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <form action="" method="post">
            <div class="row">
                <div class="col-md-12">

                    <div class="col-md-6">
                        <div class="col-md-6">
                            <label class="control-label">Avvio:</label>

                            <div class="input-group date form_datetime">
                                <input name="dataFrom" type="text" value='<?php printf("%s", $perModificaDataFrom ); ?>' size="16" readonly="" class="form-control"/>
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
                                <input name="dataTo" type="text" value='<?php printf("%s",$perModificaDataTo ); ?>' size="16" readonly="" class="form-control"/>
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
                                    <?php printf("<input type=\"radio\" value=\"Valutativa\" id=\"radio1\" %s name=\"radio1\" class=\"md-radiobtn\">", $valu);?>
                                    <label for="radio1">
                                    <span></span>
                                    <span class="check"></span>
                                    <span class="box"></span>
                                    Valutativa </label>
                                </div>
                                <div class="md-radio">
                                    <?php printf("<input type=\"radio\" value=\"Esercitativa\" id=\"radio1\" %s name=\"radio2\" class=\"md-radiobtn\">", $eser);?>
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
                                    <input type="checkbox" id="checkbox1" class="md-check">
                                    <label for="checkbox1">
                                    <span></span>
                                    <span class="check"></span>
                                    <span class="box"></span>
                                    Mostra esiti </label>
                                </div>
                                <div class="md-checkbox">
                                    <input type="checkbox" id="checkbox2" class="md-check">
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
                                    Data Creazione
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
                            $array = $controller->getAllTestByCorso($idCorso);
                            if ($array == null) {
                                echo "l'array è null"." ".$idCorso;
                            }
                            else {
                                foreach ($array as $c) {
                                    printf("<tr class=\"gradeX odd\" role=\"row\">");
                                    printf("<td><input name=\"tests[]\" type=\"checkbox\" class=\"checkboxes\" value='%d'></td>", $c->getId());
                                    printf("<td class=\"sorting_1\">%s</td>", $c->getDescrizione());
                                    printf("<td>\"doveLaPrendo?\"</td>");
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
                            $array = $controller->getAllStudentiByCorso($idCorso);
                            if ($array == null) {
                                echo "l'array è null";
                            }
                            else {
                                foreach ($array as $c) {
                                    printf("<tr class=\"gradeX odd\" role=\"row\">");
                                    printf("<td><input name=\"students[]\" type=\"checkbox\" class=\"checkboxes\" value='%s'></td>", $c->getMatricola());
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
                                <button type="submit"  href="javascript:;" class="btn sm green-jungle"><span class="md-click-circle md-click-animate" style="height: 94px; width: 94px; top: -23px; left: 2px;"></span>
                                    Salva
                                </button>
                                <a href="javascript:;" class="btn sm red-intense">
                                    Annulla
                                </a>
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
    <?php include VIEW_DIR . "footer.php"; ?>
    <!-- END FOOTER -->
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <?php include VIEW_DIR . "js.php"; ?>

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
            TableManaged.init('tabella_test','tabella_test_wrapper');
            TableManaged.init('tabella_studenti','tabella_studenti_wrapper');

        });
    </script>

    <script>
        //SCRIPT PER AVVIARE DATETIMEPICKER
        $(".form_datetime").datetimepicker({format: 'dd-mm-yyyy hh:ii'});
    </script>

    <!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
