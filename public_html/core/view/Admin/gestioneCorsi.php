<?php
/**
 * La view consente all'Admin di visualizzare tutti i corsi presenti nel sistema, ed eventualmente eliminarli
 * @author Federico De Rosa
 * @version 1
 * @since 23/11/15 21:58
 */

include_once MODEL_DIR . "CorsoModel.php";
$modelcorso = new CorsoModel();

$corsi = Array();

try {
    $corsi = $modelcorso->getAllCorsi();
} catch (ApplicationException $ex) {
    echo "<h1>GETCORSI FALLITO!</h1>" . $ex;
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
    <title>Gestione Corsi</title>
    <?php include VIEW_DIR . "design/header.php"; ?>
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/select2/select2.css">
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/bootstrap-toastr/toastr.min.css">
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/datatables/extensions/TableTools/css/dataTables.tableTools.css">
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
                Gestione Corsi
            </h3>

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="/admin">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        Gestione Corsi
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->

            <form id="form_sample_2" method="post" action="/admin/corsi/eliminacorso">

                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    Ci sono alcuni errori nei dati. Devi selezionare almeno un Corso.
                </div>

                <div class="portlet box blue-madison">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-university"></i>Gestione dei Corsi
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse" data-original-title="" title="">
                            </a>
                        </div>
                        <div class="actions">
                            <a href="/admin/corsi/crea" class="btn btn-default btn-sm">
                                <i class="fa fa-plus"></i> Crea Corso </a>
                        </div>
                        <div class="actions">
                            <button type="submit" class="btn btn-default btn-sm" data-toggle="confirmation"
                                    data-singleton="true" data-popout="true" title="sei sicuro?">
                                <i class="fa fa-minus"></i> Elimina Corso
                            </button>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="tabella_8_wrapper" class="dataTables_wrapper no-footer">
                            <table class="table table-striped table-bordered table-hover dataTable no-footer"
                                   id="tabella_8" role="grid" aria-describedby="tabella_8_info">
                                <thead>
                                <tr role="row">
                                    <th class="table-checkbox sorting_disabled" rowspan="1" colspan="1"
                                        aria-label="">
                                        <input type="checkbox" class="group-checkable"
                                               data-set="#tabella_8 .checkboxes">
                                    </th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="sample_2" rowspan="1"
                                        colspan="1" aria-label="" aria-sort="ascending">
                                        Nome
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="sample_2" rowspan="1"
                                        colspan="1" aria-label="">
                                        Matricola
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="sample_2" rowspan="1"
                                        colspan="1" aria-label="">
                                        Matricola CdL
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="sample_2" rowspan="1"
                                        colspan="1" aria-label="">
                                        Tipologia
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($corsi as $c) {
                                    printf("<tr class=\"gradeX odd\" role=\"row\">");
                                    printf("<td class=\"sorting_1\"><input type=\"checkbox\" class=\"checkboxes\" name=\"checkbox[]\" id=\"checkbox\" value=\"%s\"></td>", $c->getId());
                                    printf("<td class=\"sorting_1\"><a class=\"btn default btn-xs green-stripe\" href=\"/admin/corsi/modifica/%s\">%s</a></td>", $c->getId(), $c->getNome());
                                    printf("<td class=\"sorting_1\">%s</td>", $c->getMatricola());
                                    printf("<td class=\"sorting_1\">%s</td>", $c->getCdlMatricola());
                                    printf("<td class=\"sorting_1\"><span class=\"label label-sm label-success\">%s</span></td>", $c->getTipologia());
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
        TableManaged.init("tabella_8", "tabella_8_wrapper");
        FormValidation.init();
        UIToastr.init();
        UIConfirmations.init();
        checkNotifiche();

        var table = $("#tabella_8").dataTable();
        var tableTools = new $.fn.dataTable.TableTools(table, {
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
        $(tableTools.fnContainer()).insertBefore("#tabella_8_wrapper");
    });
</script>
<script>
    function checkNotifiche(){
        var href = window.location.href;
        var last = href.substr(href.lastIndexOf('/') + 1);
        if(last == 'successcrea'){
            toastr.success('Creazione Corso avvenuta con successo!', 'Creazione');
        }else if(last == 'successmodifica'){
            toastr.success('Modifica Corso avvenuta con successo!', 'Modifica');
        }else if(last == 'successelimina'){
            toastr.success('Eliminazione Corso avvenuta con successo!', 'Elimina');
        }
    }
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
