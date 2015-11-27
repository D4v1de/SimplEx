<?php
/**
 * Created by PhpStorm.
 * User: fede_dr
 * Date: 23/11/15
 * Time: 21:59
 */

//TODO qui la logica iniziale, caricamento dei controller ecc
include_once CONTROL_DIR . "CdlController.php";
$controller = new CdlController();

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
    <?php include VIEW_DIR . "header.php"; ?>
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/select2/select2.css">
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css">
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
                Gestione Corsi
            </h3>

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="../../../gestionale/admin/index.html">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="gestionecorsi">GestioneCorsi</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->


            <div class="portlet box blue-madison">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-globe"></i>Gestione dei Corsi
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title="">
                        </a>
                    </div>
                    <div class="actions">
                        <a href="creacorso" class="btn btn-default btn-sm">
                            <i class="fa fa-pencil"></i> Crea nuovo Corso </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="tabella_2_wrapper" class="dataTables_wrapper no-footer">
                        <div class="table-scrollable">
                            <table class="table table-striped table-bordered table-hover dataTable no-footer"
                                   id="tabella_2" role="grid" aria-describedby="tabella_2_info">
                                <thead>
                                <tr role="row">
                                    <th class="table-checkbox sorting_disabled" rowspan="1" colspan="1" aria-label=""
                                        style="width: 24px;">
                                        <input type="checkbox" class="group-checkable" data-set="#tabella_2 .checkboxes">
                                    </th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="sample_2" rowspan="1"
                                        colspan="1" aria-label="Username: activate to sort column ascending"
                                        aria-sort="ascending" style="width: 78px;">
                                        Matricola
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="sample_2" rowspan="1" colspan="1"
                                        aria-label="Email: activate to sort column ascending" style="width: 137px;">
                                        Nome
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="sample_2" rowspan="1" colspan="1"
                                        aria-label="Status: activate to sort column ascending" style="width: 36px;">
                                        Tipologia
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="sample_2" rowspan="1" colspan="1"
                                        aria-label="Status: activate to sort column ascending" style="width: 36px;">
                                        Matricola CdL
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $array = Array();
                                $array = $controller->getCorsi();
                                if($array == null){echo "l'array è null";}
                                foreach($array as $c) {
                                    printf("<tr class=\"gradeX odd\" role=\"row\">");
                                    printf("<td><input type=\"checkbox\" class=\"checkboxes\" value=\"1\"></td>");
                                    printf("<td class=\"sorting_1\">%s</td>",$c->getMatricola());
                                    printf("<td class=\"sorting_1\"><a href=\"modificacorso/%s\">%s</a></td>",$c->getId() ,$c->getNome());
                                    printf("<td><span class=\"label label-sm label-success\">%s</span></td>",$c->getTipologia());
                                    printf("<td>%s</td>",$c->getCdlMatricola());
                                    printf("</tr>");
                                    }
                                ?>
                                </tbody>
                            </table>
                        </div>

                    </div>
                </div>
            </div>


            <!-- END PAGE CONTENT-->
        </div>
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
<!-- END aggiunta da me -->
<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        //QuickSidebar.init(); // init quick sidebar
        //Demo.init(); // init demo features
        TableManaged.init("tabella_2","tabella_2_wrapper");
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
