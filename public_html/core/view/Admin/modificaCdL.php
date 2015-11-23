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
    <title>Modifica CdL</title>
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
                Modifica CdL
            </h3>

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="../../../gestionale/admin/index.html">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="gestionecdl">GestioneCdL</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="modificacdl">ModificaCdL</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->



            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet box grey-cascade">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-globe"></i>Modifica Corso di Laurea
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title="">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="portlet-body form">
                                <div class="form-group form-md-line-input">
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="form_control_1" value="nomeAttuale">

                                        <div class="form-control-focus">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="form_control_1" value="tipologiaAttuale">

                                        <div class="form-control-focus">
                                        </div>
                                    </div>
                                </div>
                                <div class="form-group form-md-line-input">
                                    <div class="col-md-10">
                                        <input type="text" class="form-control" id="form_control_1" value="matricolaAttuale">

                                        <div class="form-control-focus">
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <h3></h3>
                            </div>


                            <div class="table-scrollable">
                                <table class="table table-striped table-bordered table-hover dataTable no-footer"
                                       id="sample_1" role="grid" aria-describedby="sample_1_info">
                                    <thead>
                                    <tr role="row">
                                        <th class="table-checkbox sorting_disabled" rowspan="1" colspan="1"
                                            aria-label="" style="width: 24px;">
                                            <input type="checkbox" class="group-checkable"
                                                   data-set="#sample_1 .checkboxes">
                                        </th>
                                        <th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1"
                                            colspan="1" aria-sort="ascending"
                                            aria-label="Username: activate to sort column ascending"
                                            style="width: 133px;">
                                            Corso
                                        </th>
                                        <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Email"
                                            style="width: 232px;">
                                            Matricola
                                        </th>
                                        <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="Points"
                                            style="width: 82px;">
                                            Tipologia
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1"
                                            colspan="1" aria-label="Joined: activate to sort column ascending"
                                            style="width: 119px;">
                                            DocenteAssociato
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
                                            <input type="checkbox" class="checkboxes" value="1">
                                        </td>
                                        <td class="sorting_1">
                                            <a href="">Ingegneria del Software</a>
                                        </td>
                                        <td>
                                            0000000001
                                        </td>
                                        <td>
                                            Annuale
                                        </td>
                                        <td class="center">
                                            Andrea de Lucia
                                        </td>
                                        <td>
                                                <span class="label label-sm label-success">
                                                    Attivo
                                                </span>
                                        </td>
                                    </tr>
                                    <tr class="gradeX even" role="row">
                                        <td>
                                            <input type="checkbox" class="checkboxes" value="1">
                                        </td>
                                        <td class="sorting_1">
                                            <a href="">Analisi Numerica</a>
                                        </td>
                                        <td>
                                            0000000011
                                        </td>
                                        <td>
                                            Semestrale
                                        </td>
                                        <td class="center">
                                            Angelamaria Cardone
                                        </td>
                                        <td>
                                                <span class="label label-sm label-success">
                                                    Attivo
                                                </span>
                                        </td>
                                    </tr>
                                    <tr class="gradeX odd" role="row">
                                        <td>
                                            <input type="checkbox" class="checkboxes" value="1">
                                        </td>
                                        <td class="sorting_1">
                                            <a href="">Tecnologie di Sviluppo Web</a>
                                        </td>
                                        <td>
                                            0000000111
                                        </td>
                                        <td>
                                            Semestrale
                                        </td>
                                        <td class="center">
                                            Mimmo Parente
                                        </td>
                                        <td>
                                                <span class="label label-sm label-success">
                                                    Attivo
                                                </span>
                                        </td>
                                    </tr>
                                    <tr class="gradeX even" role="row">
                                        <td>
                                            <input type="checkbox" class="checkboxes" value="1">
                                        </td>
                                        <td class="sorting_1">
                                            <a href="">Fisica</a>
                                        </td>
                                        <td>
                                            0000001111
                                        </td>
                                        <td>
                                            Annuale
                                        </td>
                                        <td class="center">
                                            Annnn De Luca
                                        </td>
                                        <td>
                                                <span class="label label-sm label-warning">
                                                    Sospeso
                                                </span>
                                        </td>
                                    </tr>
                                    <tr class="gradeX odd" role="row">
                                        <td>
                                            <input type="checkbox" class="checkboxes" value="1">
                                        </td>
                                        <td class="sorting_1">
                                            <a href="">Algoritmi</a>
                                        </td>
                                        <td>
                                            0000011111
                                        </td>
                                        <td>
                                            Semestrale
                                        </td>
                                        <td class="center">
                                            Ugo Vaccaro
                                        </td>
                                        <td>
                                                <span class="label label-sm label-warning">
                                                    Sospeso
                                                </span>
                                        </td>
                                    </tr>
                                    <tr class="gradeX even" role="row">
                                        <td>
                                            <input type="checkbox" class="checkboxes" value="1">
                                        </td>
                                        <td class="sorting_1">
                                            <a href="">Ele di Teoria Computazionale</a>
                                        </td>
                                        <td>
                                            0000111111
                                        </td>
                                        <td>
                                            Semestrale
                                        </td>
                                        <td class="center">
                                            Clelia De Felice
                                        </td>
                                        <td>
                                                <span class="label label-sm label-success">
                                                    Attivo
                                                </span>
                                        </td>
                                    </tr>
                                    <tr class="gradeX odd" role="row">
                                        <td>
                                            <input type="checkbox" class="checkboxes" value="1">
                                        </td>
                                        <td class="sorting_1">
                                            <a href="">Programmazione</a>
                                        </td>
                                        <td>
                                            0001111111
                                        </td>
                                        <td>
                                            Semestrale
                                        </td>
                                        <td class="center">
                                            La Torre
                                        </td>
                                        <td>
                                                <span class="label label-sm label-warning">
                                                    Sospeso
                                                </span>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>



                            <div class="portlet-body form">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-actions">
                                            <div class="col-md-3">
                                                <button type="button" class="btn green-jungle">Conferma</button>
                                            </div>
                                            <div class="col-md-offset-1 col-md-3">
                                                <button type="button" class="btn red-intense">Annulla</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
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
