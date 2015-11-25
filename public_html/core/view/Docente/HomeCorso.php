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
                Home Corso
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
                        </li>
                    </ul>
                </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->

            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-8"></div>
                    <div class="col-md-4">
                        <div class="col-md-6">
                            <label class="control-label">Dal:</label>
                                <div class="input-group date form_datetime">
                                    <input type="text" size="16" readonly="" class="form-control"/>
                                    <span class="input-group-btn">
                                        <button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                        </div>
                        <div class="col-md-6">
                            <label class="control-label">Al:</label>
                                <div class="input-group date form_datetime">
                                    <input type="text" size="16" readonly="" class="form-control"/>
                                    <span class="input-group-btn">
                                        <button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
                                    </span>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
            <br/>
            <div class="row">
                <div class="col-md-12">
                    <div class="portlet box grey-cascade">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-globe"></i>Sessioni
                            </div>
                            <div class="tools">
                                    <a href="javascript:;" class="collapse" data-original-title="" title="">
                                    </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                        <div id="sample_1_wrapper" class="dataTables_wrapper no-footer">

                        <div class="table-scrollable">
                        <table class="table table-striped table-bordered table-hover dataTable no-footer" id="sample_1" role="grid" aria-describedby="sample_1_info">
                        <thead>
                        <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="
                                         Username
                                : activate to sort column ascending" style="width: 119px;">
                                         Nome
                                </th><th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Email
                                " style="width: 210px;">
                                         Data e ora
                                </th><th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Points
                                " style="width: 73px;">
                                         Stato
                                </th><th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Status
                                " style="width: 15%;">
                                         Azioni
                                </th></tr>
                        </thead>
                        <tbody>
                        <tr class="gradeX odd" role="row">
                                <td>
                                    Sessione 1
                                </td>
                                <td class="sorting_1">
                                    19/11/2015 16:00
                                </td>
                                <td>
                                    Eseguita
                                </td>
                                <td class="center">
                                    <a href="javascript:;" class="btn btn-sm default">
                                      Esiti
                                    </a>
                                    <a href="javascript:;" class="btn btn-sm default">
                                        <i class="fa fa-info-circle"></i>
                                    </a>
                                </td>

                        </tr>
                        <tr class="gradeX even" role="row">
                                <td>
                                    Sessione 2
                                </td>
                                <td class="sorting_1">
                                         04/10/2015 15:00
                                </td>
                                <td>
                                    Eseguita
                                </td>
                                <td class="center">
                                    <a href="javascript:;" class="btn btn-sm default">
                                      Esiti
                                    </a>
                                    <a href="javascript:;" class="btn btn-sm default">
                                        <i class="fa fa-info-circle"></i>
                                    </a>
                                </td>

                        </tr>
                        <tr class="gradeX even" role="row">
                                <td>
                                    Sessione 3
                                </td>
                                <td class="sorting_1">
                                         04/11/2015 16:00
                                </td>
                                <td>
                                    Non Eseguita
                                </td>
                                <td class="center">
                                    <a href="javascript:;" class="btn btn-sm default" disabled="true">
                                      Esiti
                                    </a>
                                    <a href="javascript:;" class="btn btn-sm default">
                                        <i class="fa fa-info-circle"></i>
                                    </a>
                                </td>

                        </tr>                        
                        </tbody>
                        </table>
                        </div>
                </div>
             </div>
                    
                    
            </div>

            </div>

         </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-10"></div>
                        <div class="col-md-2">
                            <a href="javascript:;" class="btn green-jungle">
                                Crea Sessione <i class="fa fa-plus"></i>
                            </a>
                            <span class="help-block"> <br> </span>
                        </div>
                    </div>
                </div>

            <!-- TABELLA 2 -->

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet box grey-cascade">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-globe"></i>Test
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title="">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div id="sample_1_wrapper" class="dataTables_wrapper no-footer">

                                <div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="sample_1" role="grid" aria-describedby="sample_1_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="
                                         Username
                                : activate to sort column ascending" style="width: 119px;">
                                                Nome
                                            </th><th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Email
                                " style="width: 210px;">
                                                Data creazione
                                            </th><th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Points
                                " style="width: 73px;">
                                                N° multiple
                                            </th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Status
                                " style="width: 119px;">
                                                N° aperte
                                            </th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Status
                                " style="width: 119px;">
                                                Punteggio massimo
                                            </th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Status
                                " style="width: 119px;">
                                                Inserito
                                            </th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Status
                                " style="width: 119px;">
                                                Superato
                                            </th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Status
                                " style="width: 7%;">
                                                Azioni
                                            </th>


                                        </tr>
                                        </thead>
                                        <tbody>
                                        <tr class="gradeX odd" role="row">
                                            <td>
                                                Test 1
                                            </td>
                                            <td class="sorting_1">
                                                10/11/2015
                                            </td>
                                            <td>
                                                10
                                            </td>
                                            <td>
                                                2
                                            </td>
                                            <td>
                                                30
                                            </td>
                                            <td>
                                                0%
                                            </td>
                                            <td>
                                                0%
                                            </td>
                                            <td class="center">
                                                <a href="javascript:;" class="btn btn-sm default">
                                                    <i class="fa fa-info-circle"></i>
                                                </a>
                                            </td>
                                        </tr>


                                        <tr class="gradeX even" role="row">
                                            <td>
                                                Test 2
                                            </td>
                                            <td class="sorting_1">
                                                23/03/2016
                                            </td>
                                            <td>
                                                30
                                            </td>
                                            <td>
                                                0
                                            </td>
                                            <td>
                                                60
                                            </td>
                                            <td>
                                                10%
                                            </td>
                                            <td>
                                                70%
                                            </td>
                                            <td class="center">
                                                <a href="javascript:;" class="btn btn-sm default">
                                                    <i class="fa fa-info-circle"></i>
                                                </a>
                                            </td>
                                        </tr>

                                        <tr class="gradeX even" role="row">
                                            <td>
                                                Test 3
                                            </td>
                                            <td class="sorting_1">
                                                15/11/2015
                                            </td>
                                            <td>
                                                0
                                            </td>
                                            <td>
                                                10
                                            </td>
                                            <td>
                                                100
                                            </td>
                                            <td>
                                                5%
                                            </td>
                                            <td>
                                                15%
                                            </td>
                                            <td class="center">
                                                <a href="javascript:;" class="btn btn-sm default">
                                                    <i class="fa fa-info-circle"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                    </div>
                    
                </div>
            </div>
            <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-10"></div>
                        <div class="col-md-2">
                            <a href="javascript:;" class="btn green-jungle">
                                Crea Test <i class="fa fa-plus"></i>
                            </a>
                            <span class="help-block"> <br> </span>
                        </div>
                    </div>
                </div>


            <!-- TABELLA 3 -->

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet box grey-cascade">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-globe"></i>Argomenti
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title="">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div id="sample_1_wrapper" class="dataTables_wrapper no-footer">

                                <div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="sample_1" role="grid" aria-describedby="sample_1_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="
                                         Username
                                : activate to sort column ascending" style="width: 119px;">
                                                Nome
                                            </th><th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Email
                                " style="width: 210px;">
                                                Risposte Corrette
                                            </th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Email
                                " style="width: 15%;">
                                                Azioni
                                            </th>
                                        </tr>
                                        
                                        </thead>
                                        <tbody>
                                        <tr class="gradeX odd" role="row">
                                            <td>
                                                Argomento 1
                                            </td>
                                            <td class="sorting_1">
                                                34%
                                            </td>
                                            <td>
                                                <a href="javascript:;" class="btn btn-sm red-intense">
                                                     <i class="fa fa-minus"></i>
                                                </a>
                                                <a href="javascript:;" class="btn btn-sm default">
                                                     <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>


                                        <tr class="gradeX even" role="row">
                                            <td>
                                                Argomento 2
                                            </td>
                                            <td class="sorting_1">
                                                87%
                                            </td>
                                            <td>
                                                <a href="javascript:;" class="btn btn-sm red-intense">
                                                     <i class="fa fa-minus"></i>
                                                </a>
                                                <a href="javascript:;" class="btn btn-sm default">
                                                     <i class="fa fa-edit"></i>
                                                </a>
                                            </td>                                            
                                        </tr>

                                        <tr class="gradeX even" role="row">
                                            <td>
                                                Argomento 3
                                            </td>
                                            <td class="sorting_1">
                                                60%
                                            </td>
                                            <td>
                                                <a href="javascript:;" class="btn btn-sm red-intense">
                                                     <i class="fa fa-minus"></i>
                                                </a>
                                                <a href="javascript:;" class="btn btn-sm default">
                                                     <i class="fa fa-edit"></i>
                                                </a>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                    </div>

                </div>
            </div>
            
            <div class="row">
                    <div class="col-md-12">
                        <div class="col-md-10"></div>
                        <div class="col-md-2">
                            <a href="javascript:;" class="btn green-jungle">
                                Crea Argomento <i class="fa fa-plus"></i>
                            </a>
                            <span class="help-block"> <br> </span>
                        </div>
                    </div>
                </div>


            <!-- END PAGE CONTENT-->


            

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
