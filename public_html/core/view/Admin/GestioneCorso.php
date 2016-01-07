<?php
/**
 * La view consente all'Admin di visualizzare un corso e tutti i docenti ad esso associati, eventualmente associare o disassociare docenti
 * @author Federico De Rosa
 * @version 1
 * @since 23/11/15 21:58
 */

include_once MODEL_DIR . "UtenteModel.php";
$modelutente = new UtenteModel();
include_once MODEL_DIR . "CorsoModel.php";
$modelcorso = new CorsoModel();

$docenteassociato = Array();
$corso = null;
$docenti = null;
$url = null;

$url = $_URL[3];
$_SESSION['idcorso'] = $url;
if(!is_numeric($url)) {
    echo "<script type='text/javascript'>alert('errore url!!(idcorso)');</script>";
}

try {
    $corso = $modelcorso->readCorso($url);
}
catch (ApplicationException $ex) {
    echo "<h1>INSERIRE ID CORSO NEL PATH!</h1>".$ex;
}
try {
    $docenti = $modelutente->getAllDocenti();
}
catch (ApplicationException $ex) {
    echo "<h1>GETDOCENTI FALLITA!</h1>".$ex;
}
try {
    $docenteassociato = $modelutente->getAllDocentiByCorso($corso->getId());
}
catch (ApplicationException $ex) {
    echo "<h1>GETDOCENTIASSOCIATI FALLITO!</h1>".$ex;
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
    <title><?php echo $corso->getNome(); ?></title>
    <?php include VIEW_DIR . "design/header.php"; ?>
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/select2/select2.css">
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/datatables/extensions/TableTools/css/dataTables.tableTools.css">
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/bootstrap-toastr/toastr.min.css">
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
                Associa Docente Corso
            </h3>

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="/admin">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="/admin/corsi/view">GestioneCorsi</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        Corso <?php echo $corso->getNome(); ?>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->

            <div class="row">
                <div class="col-md-12">
                    <div class="form">
                        <form action="" class="form-horizontal form-bordered form-row-stripped">
                            <div class="form-actions">
                                <div class="col-md col-md-7">
                                    <h3><?php echo $corso->getNome(); ?></h3>
                                    <h5>Matricola: <?php echo $corso->getMatricola(); ?></h5>
                                    <h5>Tipologia: <?php echo $corso->getTipologia(); ?></h5>
                                    <?php
                                    if (count($docenteassociato) >= 1) {
                                        foreach ($docenteassociato as $d) {
                                            printf('<h5>Docente: %s %s</h5>', $d->getNome(), $d->getCognome());
                                        }
                                    } else if (count($docenteassociato) < 1) {
                                        printf('<h5>Questo corso non ha docenti Associati!</h5>');
                                    }
                                    ?>
                                </div>
                                <div class="col-md-offset-3 col-md-2">
                                    <h3></h3>
                                    <a href="<?php printf('/admin/corsi/modifica/%s', $corso->getId()); ?>">
                                        <button type="button" class="btn green-jungle">Modifica</button>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <h3></h3>
            </div>

            <form id="form_sample_2" method="post" action="/admin/corsi/associa">

                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    Ci sono alcuni errori nei dati. Devi selezionare almeno un Docente.
                </div>

                <div class="portlet box blue-madison">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-university"></i>Scegli un Docente
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse" data-original-title="" title="">
                            </a>
                        </div>
                        <div class="actions">
                            <button type="submit" data-toggle="confirmation" data-singleton="true" data-popout="true" title="sei sicuro?" class="btn btn-default btn-sm">
                                <i class="fa fa-plus"></i> Associa
                            </button>
                            <button type="submit" name="elimina" value="elimina" data-toggle="confirmation" data-singleton="true" data-popout="true" title="sei sicuro?" class="btn btn-default btn-sm">
                                <i class="fa fa-minus"></i> Disassocia Tutti
                            </button>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="tabella_4_wrapper" class="dataTables_wrapper no-footer">
                            <table class="table table-striped table-bordered table-hover dataTable no-footer display"
                                   id="tabella_4" role="grid" aria-describedby="tabella_4_info" cellspacing="0" width="100%">
                                <thead>
                                <tr role="row">
                                    <th class="table-checkbox sorting_disabled" rowspan="1" colspan="1"
                                        aria-label="">
                                        <input type="checkbox" class="group-checkable"
                                               data-set="#tabella_4 .checkboxes">
                                    </th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="sample_2" rowspan="1"
                                        colspan="1" aria-label="" aria-sort="ascending">
                                        Cognome
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="sample_2" rowspan="1"
                                        colspan="1" aria-label="">
                                        Nome
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="sample_2" rowspan="1"
                                        colspan="1" aria-label="">
                                        Matricola
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($docenti as $d) {
                                    printf("<tr class=\"gradeX odd\" role=\"row\">");
                                    if (in_array($d, $docenteassociato)) {
                                        printf("<td><input type=\"checkbox\" class=\"checkboxes\" name=\"checkbox[]\" id=\"checkbox\" value=\"%s\" checked></td>", $d->getMatricola());
                                    } else {
                                        printf("<td><input type=\"checkbox\" class=\"checkboxes\" name=\"checkbox[]\" id=\"checkbox\" value=\"%s\"></td>", $d->getMatricola());
                                    }
                                    printf("<td><a class=\"btn default btn-xs green-stripe\" href=\"/admin/utenti/view/%s\">%s</a></td>", $d->getMatricola(), $d->getCognome());
                                    printf("<td>%s</td>", $d->getNome());
                                    printf("<td>%s</td>", $d->getMatricola());
                                    printf("</tr>");
                                }
                                ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

            </form>
            <!-- END PAGE CONTENT-->
        </div>
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
<!-- BEGIN PAGE LEVEL PLUGINS aggiunta da me-->
<script type="text/javascript" src="/assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS aggiunta da me-->

<script src="/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<!-- BEGIN aggiunta da me -->
<script src="/assets/admin/pages/scripts/table-managed.js"></script>

<script src="/assets/admin/pages/scripts/form-validation.js"></script>
<script type="text/javascript" src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="/assets/global/plugins/jquery-validation/js/additional-methods.min.js"></script>

<script src="/assets/admin/pages/scripts/ui-confirmations.js"></script>
<script src="/assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js" type="text/javascript"></script>
<script src="/assets/admin/pages/scripts/ui-toastr.js"></script>
<script src="/assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>

<script src="/assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<!-- END aggiunta da me -->
<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        //QuickSidebar.init(); // init quick sidebar
        //Demo.init(); // init demo features
        TableManaged.init("tabella_4", "tabella_4_wrapper");
        FormValidation.init();
        UIToastr.init();
        UIConfirmations.init();
        checkNotifiche();

        var table = $("#tabella_4").dataTable();
        var tableTools = new $.fn.dataTable.TableTools(table, {
            //"sSwfPath": "//cdn.datatables.net/tabletools/2.2.4/swf/copy_csv_xls_pdf.swf",
            "sSwfPath": "/assets/global/plugins/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
            "aButtons": [
                {
                    "sExtends": "xls",
                    "sButtonText": "<button><i class='fa fa-file-excel-o'></i> Excel</button>"
                },
                {
                    "sExtends": "pdf",
                    "sButtonText": "<button><i class='fa fa-file-pdf-o'></i> PDF</button>"
                }
            ]
        });
        $(tableTools.fnContainer()).insertBefore("#tabella_4_wrapper");
    });
</script>
<script>
    function checkNotifiche(){
        var href = window.location.href;
        var last = href.substr(href.lastIndexOf('/') + 1);
        if(last == 'successassocia'){
            toastr.success('Associazione avvenuta con successo!', 'Associa Docente-Corso');
        }
        if(last == 'successcrea') {
            toastr.success('Creazione Corso avvenuta con successo!', 'Creazione');
        }
    }
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
