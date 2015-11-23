<?php
/**
 * Created by PhpStorm.
 * User: fede_dr
 * Date: 23/11/15
 * Time: 21:58
 */

//TODO qui la logica iniziale, caricamento dei controller ecc
include_once CONTROL_DIR . "Esempio.php";
$controller = new Esempio();
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
    <title>View Corso</title>
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
                View Corso
            </h3>

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="../../../gestionale/admin/index.html">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="gestionecdl">GestioneCorsi</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="visualizzacorso">ViewCorso</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->

            <div class="row">
                <div class="col-md-12">
                    <div class="form">
                        <form action="#" class="form-horizontal form-bordered form-row-stripped">
                            <div class="form-actions">
                                <div class="col-md col-md-5">
                                    <h3>Ingegneria del Software</h3>
                                    <h5>Matricola: 010000001</h5>
                                    <h5>Tipologia: Annuale</h5>
                                    <h5>Docente: Andrea De Lucia</h5>
                                </div>
                                <div class="col-md-offset-4 col-md-2">
                                    <h3></h3>
                                    <button type="button" class="btn green-jungle">Associa Docente</button>
                                    <h3></h3>
                                    <a href="modificacorso"><button type="button" class="btn green-jungle">Modifica</button></a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <h3></h3>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet box grey-cascade">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-globe"></i>Lista Sessioni
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title="">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-scrollable">
                                <table class="table table-striped table-bordered table-hover dataTable no-footer"
                                       id="sample_1" role="grid" aria-describedby="sample_1_info">
                                    <thead>
                                    <tr role="row">
                                        <th class="table-checkbox sorting_disabled" rowspan="1" colspan="1"
                                            aria-label="" style="width: 24px;">
                                            #
                                        </th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1"
                                            colspan="1" aria-sort="ascending"
                                            aria-label="Username: activate to sort column ascending"
                                            style="width: 133px;">
                                            Sessione
                                        </th>
                                        <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Email"
                                            style="width: 232px;">
                                            Tipo
                                        </th>
                                        <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Points"
                                            style="width: 82px;">
                                            Data
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1"
                                            colspan="1" aria-label="Joined: activate to sort column ascending"
                                            style="width: 119px;">
                                            Ora
                                        </th>
                                        <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Status"
                                            style="width: 132px;">
                                            Stato
                                        </th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr class="gradeX odd" role="row">
                                        <td>
                                            1
                                        </td>
                                        <td class="sorting_1">
                                            Sessione
                                        </td>
                                        <td>
                                            Esercitativa
                                        </td>
                                        <td>
                                            15/15/15
                                        </td>
                                        <td class="center">
                                            15:30
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-offset-2 col-md-3">
                                                    <a href="" class="label label-sm label-success">
                                                        Attiva
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="gradeX even" role="row">
                                        <td>
                                            2
                                        </td>
                                        <td class="sorting_1">
                                            Sessione
                                        </td>
                                        <td>
                                            Valutativa
                                        </td>
                                        <td>
                                            14/12/15
                                        </td>
                                        <td class="center">
                                            14:00
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-offset-2 col-md-3">
                                                    <a href="" class="label label-sm label-warning">
                                                        Terminata
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="gradeX odd" role="row">
                                        <td>
                                            3
                                        </td>
                                        <td class="sorting_1">
                                            Sessione
                                        </td>
                                        <td>
                                            Valutativa
                                        </td>
                                        <td>
                                            25/10/15
                                        </td>
                                        <td class="center">
                                            12:00
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-offset-2 col-md-3">
                                                    <a href="" class="label label-sm label-warning">
                                                        Terminata
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="gradeX even" role="row">
                                        <td>
                                            4
                                        </td>
                                        <td class="sorting_1">
                                            Sessione
                                        </td>
                                        <td>Valutativa
                                        </td>
                                        <td>
                                            20/10/15
                                        </td>
                                        <td class="center">
                                            18:00
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-offset-2 col-md-3">
                                                    <a href="" class="label label-sm label-warning">
                                                        Terminata
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr class="gradeX odd" role="row">
                                        <td>
                                            5
                                        </td>
                                        <td class="sorting_1">
                                            Sessione
                                        </td>
                                        <td>
                                            Valutativa
                                        </td>
                                        <td>
                                            21/11/15
                                        </td>
                                        <td class="center">
                                            15:00
                                        </td>
                                        <td>
                                            <div class="row">
                                                <div class="col-md-offset-2 col-md-3">
                                                    <a href="" class="label label-sm label-warning">
                                                        Terminata
                                                    </a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!-- END EXAMPLE TABLE PORTLET-->
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
        TableManaged.init();
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
