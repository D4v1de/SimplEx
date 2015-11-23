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
                    Aggiungi Studente
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
                            <i class="fa fa-angle-right"></i>
                        </li>

                        <li>
                            <a href="#">Aggiungi Studente</a>
                        </li>
                    </ul>
                </div>

            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
         
            <div class="portlet box grey-cascade">
                        <div class="portlet-title">
                            <div class="caption">Use Case</div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title=""></a>
                            </div>
                        </div>

                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover dataTable no-footer">
                                <thead>
                                    <tr role="row">
                                        <th class="table-checkbox sorting_disabled">
                                            <input type ="checkbox">
                                        </th>
                                        <th class="table-checkbox sorting_disabled">
                                            Nome
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-label="Risposte corrette: activate to sort column ascending" style="width: 174px;">
                                            Cognome
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-label="Risposte corrette: activate to sort column ascending" style="width: 174px;">
                                            Matricola
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="gradeX odd" role="row">
                                        <td>
                                            <input type ="checkbox">
                                        </td>
                                        <td class="">
                                            Carlo
                                        </td>
                                        <td>Di Domenico</td>
                                        <td>0512102316</td>
                                    </tr>
                                    <tr class="gradeX odd" role="row">
                                        <td>
                                            <input type ="checkbox">
                                        </td>
                                        <td class="">
                                            Fabiano
                                        </td>
                                        <td>Pecorelli</td>
                                        <td>0512102390</td>
                                    </tr>
                                    <tr class="gradeX odd" role="row">
                                        <td>
                                            <input type ="checkbox">
                                        </td>
                                        <td class="">
                                            Fabio
                                        </td>
                                        <td>Esposito</td>
                                        <td>0512102426</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
            
            
            
            
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-9"></div>
                    <button type="button" class="btn red-intense">Annulla</button> 
                    <button type="submit" class="btn green-jungle">Conferma</button>                
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
