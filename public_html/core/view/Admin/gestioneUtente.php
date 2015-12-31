<?php
/**
 * View della gestione utente
 * @author Sergio Shevchenko, Giusy Tufano
 * @version 1.2
 * @since 23/11/15
 */

include_once MODEL_DIR . "UtenteModel.php";
$uModel = new UtenteModel();
$utente = $uModel->getUtenti();
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
    <title>Gestione utente</title>
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
                Gestione Utente
            </h3>

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="/adm">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="/admin/utenti">Gestione Utente</a>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->

            <form method="post" action="">

                <div class="portlet box blue-madison">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-university"></i>Scegli un Utente
                        </div>

                        <div class="actions">
                            <a href="/admin/utenti/crea/docente"
                               class="btn btn-default btn-sm">
                                <i class="fa fa-plus"></i> Docente
                            </a>
                        </div>
                        <div class="actions">
                            <a href="/admin/utenti/crea/studente"
                               class="btn btn-default btn-sm">
                                <i class="fa fa-plus"></i> Studente
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="tabella_5_wrapper" class="dataTables_wrapper no-footer">
                            <table class="table table-striped table-bordered table-hover dataTable no-footer"
                                   id="tabella_5" role="grid" aria-describedby="tabella_5_info">
                                <thead>
                                <tr role="row">

                                    <th class="sorting_asc" tabindex="0" aria-controls="sample_2" rowspan="1"
                                        colspan="1" aria-label="Username: activate to sort column ascending"
                                        aria-sort="ascending" style="width: 78px;">
                                        Matricola
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="sample_2" rowspan="1"
                                        colspan="1"
                                        aria-label="Email: activate to sort column ascending" style="width: 137px;">
                                        Nome
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="sample_2" rowspan="1"
                                        colspan="1"
                                        aria-label="Email: activate to sort column ascending" style="width: 137px;">
                                        Cognome
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="sample_2" rowspan="1"
                                        colspan="1"
                                        aria-label="Status: activate to sort column ascending" style="width: 36px;">
                                        Tipologia
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($utente as $d) {
                                    printf("<tr class=\"gradeX odd\" role=\"row\">");
                                    printf("<td><a class='btn default btn-xs green-stripe' href='/admin/utenti/view/%s'>%s</a></td>", $d->getMatricola(), $d->getMatricola());
                                    printf("<td>%s</td>", $d->getNome());
                                    printf("<td><span>%s</span></td>", $d->getCognome());
                                    printf("<td><span class=\"label label-sm label-success\">%s</span></td>", $d->getTipologia());
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
<script type="text/javascript"
        src="/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS aggiunta da me-->

<script src="/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>

<script src="/assets/admin/pages/scripts/table-managed.js"></script>
<script src="/assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>

<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        //QuickSidebar.init(); // init quick sidebar
        //Demo.init(); // init demo features
        TableManaged2.init("tabella_5", "tabella_5_wrapper");

        var table = $("#tabella_5").dataTable();
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
        $(tableTools.fnContainer()).insertBefore("#tabella_5_wrapper");
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
