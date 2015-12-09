<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 18/11/15
 * Time: 09:58
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
        <title>Metronic | Page Layouts - Blank Page</title>
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
                        Lista Domande
                    </h3>
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <a href="index.html">Home</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <a href="">NomeCorso</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <a href="#">NomeArgomento</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                        </ul>
                    </div>

                    <!-- END PAGE HEADER-->
                    <!-- BEGIN PAGE CONTENT-->
                    <div class="row">
                        <!--TOP menu -->
                        <div class="col-md-offset-3 col-md-3">
                            <a href="javascript:;" class="btn sm green-jungle">
                                        <i class="fa fa-plus"></i> Nuova Domanda Aperta
                                    </a>
                        </div>
                        <div class="col-md-3">
                            <a href="javascript:;" class="btn sm green-jungle">
                                        <i class="fa fa-plus"></i> Nuova Domanda Multipla
                                    </a>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-scrollable" >
                                <table class="table table-condensed table-hover">
                                    <thead>
                                        <tr>
                                            <th width="3%"></th>

                                            <th>
                                                Quale di queste due relazioni non esiste tra due casi d'uso 
                                            </th>
                                            <th width="21%">
                                                <a href="javascript:;" class="btn sm default"><span class="md-click-circle md-click-animate" style="height: 110px; width: 110px; top: -23px; left: 1px;"></span>
                                                    Modifica <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="javascript:;" class="btn sm red-intense"><span class="md-click-circle md-click-animate" style="height: 110px; width: 110px; top: -23px; left: 1px;"></span>
                                                    Elimina <i class="fa fa-remove"></i>
                                                </a>
                                            </th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td width="5px">
                                                <input type="checkbox" disabled="" checked="">
                                            </td> 
                                            <td>
                                                Associazione
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td width="5px">
                                                <input type="checkbox" disabled="">
                                            </td> 
                                            <td>
                                                Generalizzazione
                                            </td>
                                            <td></td>
                                        </tr>
                                        <tr>
                                            <td width="5px">
                                                <input type="checkbox" disabled="">
                                            </td> 
                                            <td>
                                                Dipendenza
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
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
        <script>
            jQuery(document).ready(function () {
                Metronic.init(); // init metronic core components
                Layout.init(); // init current layout
                //QuickSidebar.init(); // init quick sidebar
                //Demo.init(); // init demo features
            });
        </script>
        <!-- END JAVASCRIPTS -->
    </body>
    <!-- END BODY -->
</html>
