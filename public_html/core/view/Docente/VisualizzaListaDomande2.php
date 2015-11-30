<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 18/11/15
 * Time: 09:58
 */
//TODO qui la logica iniziale, caricamento dei controller ecc
include_once CONTROL_DIR . "Esempio.php";
$controller = new DomandaController();
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
        <title>Lista Domande "Nome Argomento"</title>
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
                        Lista Domande
                    </h3>
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <a href="index">Home</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <a href="">NomeCorso</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <a href="homecorsodocente">NomeArgomento</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                        </ul>
                    </div>

                    <!-- END PAGE HEADER-->
                    <!-- BEGIN PAGE CONTENT-->
                    <div class="row">
                        <!--TOP menu -->
                        <div class="col-md-offset-3 col-md-3">
                            <a href="inseriscidomandaaperta" class="btn sm green-jungle">
                                <i class="fa fa-plus"></i> Nuova Domanda Aperta
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="inseriscidomandamultipla" class="btn sm green-jungle">
                                <i class="fa fa-plus"></i> Nuova Domanda Multipla
                            </a>
                        </div>
                    </div>
                    <br>
                    <!--INIZIO TABELLA DOMANDA1-->
                    <div class="portlet box blue-madison">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-book"></i>Domanda 1 
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title="">
                                </a>
                            </div>
                            <div class="actions">
                                <a href="javascript:;" class="btn btn-default btn-sm">
                                    <i class="fa fa-edit"></i> Modifica </a>
                                <a href="javascript:;" class="btn btn-default btn-sm">
                                    <i class="fa fa-remove"></i> Rimuovi </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div id="tabella_domanda1_wrapper" class="dataTables_wrapper no-footer">
                                <table class="table table-striped table-bordered table-hover dataTable no-footer"
                                       id="tabella_domanda1" role="grid" aria-describedby="tabella_domanda1_info">
                                    <thead>
                                        
                                    </thead>
                                    <tbody>
                                        <tr class="gradeX odd" role="row">
                                            <td width="3%">
                                                <input type="checkbox" disabled="" checked="">
                                            </td>
                                            <td>
                                                Risposta 1
                                            </td>
                                        </tr>
                                        <tr class="gradeX odd" role="row">
                                            <td width="3%">
                                                <input type="checkbox" disabled="">
                                            </td>
                                            <td>
                                                Risposta 2
                                            </td>
                                        </tr>
                                        <tr class="gradeX odd" role="row">
                                            <td width="3%">
                                                <input type="checkbox" disabled="">
                                            </td>
                                            <td>
                                                Risposta 3
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                    <!--FINE TABELLA DOMANDA1-->

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
        <script type="text/javascript"
        src="/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
        <!-- END PAGE LEVEL PLUGINS aggiunta da me-->
        <!-- BEGIN aggiunta da me -->
        <script src="/assets/admin/pages/scripts/table-managed.js"></script>
        <!-- END aggiunta da me -->
        <script>
            jQuery(document).ready(function () {
                Metronic.init(); // init metronic core components
                Layout.init(); // init current layout
                //QuickSidebar.init(); // init quick sidebar
                //Demo.init(); // init demo features
                TableManaged2.init("tabella_domanda1","tabella_domanda1_wrapper");
            });
        </script>
        <!-- END JAVASCRIPTS -->
    </body>
    <!-- END BODY -->
</html>
