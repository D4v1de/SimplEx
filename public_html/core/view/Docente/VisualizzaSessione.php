<?php
/**
 * La view che consente al docente di visualizzare una sessione
 * @author Antonio Luca D'Avanzo
 * @version 1
 * @since 18/11/15 09:58
 */
include_once MODEL_DIR . "ElaboratoModel.php";
include_once MODEL_DIR . "SessioneModel.php";
include_once MODEL_DIR . "UtenteModel.php";
include_once MODEL_DIR . "CdLModel.php";
include_once MODEL_DIR . "CorsoModel.php";
include_once MODEL_DIR . "TestModel.php";
include_once BEAN_DIR . "Sessione.php";

$sessioneModel = new SessioneModel();
$utenteModel = new UtenteModel();
$testModel = new TestModel();
$corsoModel = new CorsoModel();
$cdlModel = new CdLModel();
$elaboratoModel = new ElaboratoModel();


$idSessione="";
$idSessione= $_URL[4];
if (!is_numeric($idSessione)) {
    echo "<script type='text/javascript'>alert('errore nella url!!!');</script>";
}
$identificativoCorso ="";
$identificativoCorso = $_URL[2];
if (!is_numeric($identificativoCorso)) {
    echo "<script type='text/javascript'>alert('errore nella url!!!');</script>";
}

$numProfs = 0;

$doc = $_SESSION['user'];

$docentiOe = $utenteModel->getAllDocentiByCorso($identificativoCorso);
foreach ($docentiOe as $d) {
    if ($doc == $d) {
        $numProfs++;
    }
}
if ($numProfs == 0) {
    header("Location: " . "/docente/corso/" . $corso->getId());
}

$sessione = null;
$valu = null;
$eser = null;
$showE = "";
$showRC = "";

if (!is_numeric($idSessione)) {
    echo "<script type='text/javascript'>alert('errore nella url!!!');</script>";
}

try {
    $sessione = $sessioneModel->readSessione($idSessione);
} catch (ApplicationException $ex) {
    echo "<h1>INSERIRE ID SESSIONE NEL PATH</h1>" . $ex;
}

$corso = $corsoModel->readCorso($identificativoCorso);
$nomecorso = $corso->getNome();

$dataFrom = $sessione->getDataInizio();
$dataTo = $sessione->getDataFine();
$tipoSessione = $sessione->getTipologia();
$soglia = $sessione->getSogliaAmmissione();
if ($sessioneModel->readMostraEsitoSessione($sessione->getId()) == "Si") {
    $showE = "Checked";
}
if ($sessioneModel->readMostraRisposteCorretteSessione($sessione->getId()) == "Si")
    $showRC = "Checked";

if ($tipoSessione == "Valutativa")
    $valu = "Checked";
else
    $eser = "Checked";
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
        <link rel="stylesheet" type="text/css" href="/assets/global/plugins/bootstrap-toastr/toastr.min.css">
        <link rel="stylesheet" type="text/css" href="/assets/global/plugins/datatables/extensions/TableTools/css/dataTables.tableTools.css">
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
                    <div id="demo"></div>
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <a href="/docente">Home</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <a href="<?php echo "/docente/cdl/" . $corso->getCdlMatricola(); ?>"> <?php echo $cdlModel->readCdl($corso->getCdlMatricola())->getNome(); ?> </a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <?php
                                $vaiANomeCorso = "/docente/corso/" . $identificativoCorso;
                                printf("<a href=\"%s\">%s</a><i class=\"fa fa-angle-right\"></i>", $vaiANomeCorso, $nomecorso);
                                ?>
                            </li>
                            <li>
                                <?php echo "Sessione " . $sessione->getId() ?>
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
                                        <input type="text"  size="16" readonly="" id="dataFrom" class="form-control" value='<?php printf("%s", $dataFrom); ?>' disabled="true"/>
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
                                        <input type="text" size="16" readonly="" id="dataTo" class="form-control" value='<?php printf("%s", $dataTo); ?>' disabled="true"/>
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
                                            <?php printf("<input type=\"radio\" disabled value=\"Valutativa\" id=\"radio1\" %s name=\"radio1\" class=\"md-radiobtn\">", $valu); ?>
                                            <label for="radio1">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span>
                                                Valutativa </label>
                                        </div>
                                        <div class="md-radio">
                                            <?php printf("<input disabled type=\"radio\" value=\"Esercitativa\" id=\"radio1\" %s name=\"radio2\" class=\"md-radiobtn\">", $eser); ?>
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
                                            <input type="checkbox" id="checkbox1" <?php printf("%s", $showE) ?> class="md-check" disabled="true" >
                                            <label for="checkbox1">
                                                <span></span>
                                                <span class="check"></span>
                                                <span class="box"></span>
                                                Mostra esiti </label>
                                        </div>
                                        <div class="md-checkbox">
                                            <input type="checkbox" id="checkbox2" <?php printf("%s", $showRC) ?> class="md-check" disabled="true">
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
                                        $array = $testModel->getAllTestBySessione($idSessione);
                                        if ($array == null) {
                                            
                                        } else {
                                            $sessioniByCorso = $sessioneModel->getAllSessioniByCorso($identificativoCorso);
                                            foreach ($array as $c) {
                                                if ($sessioniByCorso != null) {
                                                    $scelti = $c->getPercentualeSceltoVal() + $c->getPercentualeSceltoEse();
                                                    $percSce = round(($scelti / count($sessioniByCorso) * 100), 2);
                                                } else
                                                    $percSce = 0;
                                                    $succ = $c->getPercentualeSuccessoEse() + $c->getPercentualeSuccessoVal();
                                                    $n = $c->getNumeroSceltaValutativa() + $c->getNumeroSceltaEsercitativa();
                                                    if ($n > 0)
                                                        $percSuc = round(($succ / $n * 100), 2);
                                                    else
                                                        $percSuc = 0;
                                                printf("<tr class=\"gradeX odd\" role=\"row\">");
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
$studentsOfSessione = Array();
$studentsOfSessione = $utenteModel->getAllStudentiSessione($idSessione);
if ($studentsOfSessione == null) {
    
} else {
    foreach ($studentsOfSessione as $c) {
        printf("<tr class=\"gradeX odd\" role=\"row\">");
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

                    <form action="/docente/corso/<?php echo $identificativoCorso; ?>/indexvisualizza" method="post">
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-9">
<?php
$avviaOripr = "Avvia Ora";
$disabled = "";
if ($sessione->getStato() == "Eseguita") {
    $avviaOripr = "Riprendi";
    $disabled = "disabled";
}
printf("<button name=\"avvia\"  value=\"%s\" class=\"btn sm green-jungle\"  data-toggle=\"confirmation\"
                                        data-singleton=\"true\" data-popout=\"true\" title=\"Sicuro?\"><span class=\"md-click-circle md-click-animate\" style=\"height: 94px; width: 94px; top: -23px; left: 2px;\"></span><i class=\"fa fa-play-circle-o\"></i>%s</button>", $idSessione, $avviaOripr);
$vaiAModifica = "/docente/corso/" . $identificativoCorso . "/sessione" . "/" . $idSessione . "/" . "creamodificasessione";
$vaiAVisu = "/docente/corso/" . $identificativoCorso . "/sessione" . "/" . $idSessione . "/" . "visualizzasessione";

printf(" <a href=\"%s\" class=\"btn btn-sm blue-madison\"><i class=\"fa fa-edit\"></i>Modifica Sessione</a>", $vaiAModifica);
printf("<button type='submit' name='rimuovi' value='%d' class='btn btn-sm red-intense'  data-toggle=\"confirmation\"
                                        data-singleton=\"true\" data-popout=\"true\" %s title=\"Sicuro?\"><i class=\"fa fa-trash-o\"></i>Elimina Sessione</button>", $idSessione, $disabled);
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
            <script src="/assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js" type="text/javascript"></script>
            <script src="/assets/admin/pages/scripts/ui-confirmations.js"></script>
            <script type="text/javascript"
            src="/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
            <script src="/assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>


            <script>
                jQuery(document).ready(function () {
                    Metronic.init();
                    Layout.init();
                    TableManaged2.init('tabella_test', 'tabella_test_wrapper');
                    TableManaged2.init('tabella_studenti', 'tabella_studenti_wrapper');
                    UIConfirmations.init();
                    UIAlertDialogApi.init();

                    var tableT = $("#tabella_test").dataTable();
                    var tableToolsT = new $.fn.dataTable.TableTools(tableT, {
                        //"sSwfPath": "//cdn.datatables.net/tabletools/2.2.4/swf/copy_csv_xls_pdf.swf",
                        "sSwfPath": "/assets/global/plugins/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
                        "aButtons": [
                            {
                                "sExtends": "xls",
                                "sButtonText": "<i class='fa fa-file-excel-o'></i> Excel"
                            },
                            {
                                "sExtends": "pdf",
                                "sButtonText": "<i class='fa fa-file-pdf-o'></i> PDF"
                            }
                        ]
                    });
                    $(tableToolsT.fnContainer()).insertBefore("#tabella_test_wrapper");

                    var tableS = $("#tabella_studenti").dataTable();
                    var tableToolsS = new $.fn.dataTable.TableTools(tableS, {
                        //"sSwfPath": "//cdn.datatables.net/tabletools/2.2.4/swf/copy_csv_xls_pdf.swf",
                        "sSwfPath": "/assets/global/plugins/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
                        "aButtons": [
                            {
                                "sExtends": "xls",
                                "sButtonText": "<i class='fa fa-file-excel-o'></i> Excel"
                            },
                            {
                                "sExtends": "pdf",
                                "sButtonText": "<i class='fa fa-file-pdf-o'></i> PDF"
                            }
                        ]
                    });
                    $(tableToolsS.fnContainer()).insertBefore("#tabella_studenti_wrapper");
                });
            </script>
            <script src="/assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
            <!-- END JAVASCRIPTS -->

            <script>
                var count = 0;
                function loadDoc() {

                    var dataFrom = document.getElementById('dataFrom').value;
                    var dataTo = document.getElementById('dataTo').value;
                    var xhttp = new XMLHttpRequest();
                    xhttp.onreadystatechange = function () {
                        if (xhttp.readyState == 4 && xhttp.status == 200) {
                            var boT = new Date(dataFrom.substr(0, 4), dataFrom.substr(5, 2) - 1, dataFrom.substr(8, 2), dataFrom.substr(11, 2), dataFrom.substr(14, 2), dataFrom.substr(17, 2));
                            var timeFromServer = new Date(xhttp.responseText.substr(0, 4), xhttp.responseText.substr(5, 2) - 1, xhttp.responseText.substr(8, 2), xhttp.responseText.substr(11, 2), xhttp.responseText.substr(14, 2), xhttp.responseText.substr(17, 2));
                            var bdataTo = new Date(dataTo.substr(0, 4), dataTo.substr(5, 2) - 1, dataTo.substr(8, 2), dataTo.substr(11, 2), dataTo.substr(14, 2), dataTo.substr(17, 2));
                            if (boT > timeFromServer)
                                ;
                            else {
                                if (count == 0 && bdataTo > timeFromServer) {
                                    bootbox.dialog({
                                        message: "Visualizza i dettagli della Sessione in corso!",
                                        title: "La sessione è iniziata.",
                                        closeButton: false,
                                        buttons: {
                                            conferma: {
                                                label: "Ok",
                                                className: "green",
                                                callback: function () {
                                                    var var1 = '/docente/corso/';
                                                    var var2 =<?php echo "$identificativoCorso" ?>;
                                                    var var3 = '/sessione/';
                                                    var var4 =<?php echo "$idSessione" ?>;
                                                    var var5 = '/sessioneincorso';
                                                    var res1 = var1.concat(var2);
                                                    var res2 = res1.concat(var3);
                                                    var res3 = res2.concat(var4);
                                                    var res4 = res3.concat(var5);
                                                    location.href = res4;
                                                }
                                            }
                                        }
                                    });
                                    count++;
                                }
                            }
                        }
                    };
                    xhttp.open("GET", "/docente/corso/something/gestoredata", true);
                    xhttp.send();
                }
                setInterval(loadDoc, 10000);
            </script>
            <!-- END JAVASCRIPTS -->
    </body>
    <!-- END BODY -->
</html>
