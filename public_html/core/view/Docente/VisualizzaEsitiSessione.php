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
     <link rel="stylesheet" type="text/css" href="/assets/global/plugins/select2/select2.css">
    <link rel="stylesheet" type="text/css"
          href="/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css">
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
                    Esiti Sessione
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
                            Esiti Sessione
                        </li>
                    </ul>
                </div>

            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->

            <div class="row">
            <div class="col-md-12">
                <div class="col-md-8"></div>
                <label>Soglia esiti:
                    <input type="search" class="form-control input-small input-inline" placeholder="" aria-controls="sample_1"/>
                </label>
                <a href="javascript:;" class="btn sm green-jungle">
                    Conferma
                </a>
            </div>
        </div>
            <!-- TABELLA 1 -->

            <div class="portlet box blue-madison">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-file-text-o"></i>Test
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title="">
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="tabella_test2_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-striped table-bordered table-hover dataTable no-footer"
                                   id="tabella_test2" role="grid" aria-describedby="tabella_test2_info">
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
                                        </tr>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>

            <!-- TABELLA 2 -->

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet box blue-madison">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-user"></i>Studenti
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title="">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div id="tabella_studenti_esiti_wrapper" class="dataTables_wrapper no-footer">
                                <div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="tabella_studenti_esiti" role="grid" aria-describedby="tabella_studenti_esiti_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="
                                         Username
                                : activate to sort column ascending" style="width: 119px;">
                                                Nome
                                            </th><th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Email
                                " style="width: 210px;">
                                                Cognome
                                            </th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Email
                                " style="width: 100px;">
                                                Matricola
                                            </th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Email
                                " style="width: 100px;">
                                                Esito
                                            </th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Email
                                " style="width: 100px;">
                                                Stato
                                            </th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Email
                                " style="width: 100px;">
                                                Stato Correzione
                                            </th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Email
                                " style="width: 25%;">
                                                Azioni
                                            </th>
                                        </tr>
                                        
                                        </thead>
                                        <tbody>
                                        <tr class="gradeX odd" role="row">
                                            <td>
                                                Fabiano
                                            </td>
                                            <td class="sorting_1">
                                                Pecorelli
                                            </td>
                                            <td>
                                                0512100001
                                            </td>
                                            <td>
                                                0/60
                                            </td>
                                            <td>
                                                Ritirato
                                            </td>
                                            <td>
                                                <font color="green"> Corretto </font>
                                            </td>
                                            <td>
                                                <a href="correggitest" class="btn btn-sm blue-madison">
                                                    <i class="fa fa-pencil"></i> Correggi
                                                </a>
                                                <a href="visualizzatestdocente" class="btn btn-sm default" disabled="true">
                                                    Visualizza
                                                </a>
                                            </td>
                                        </tr>


                                        <tr class="gradeX even" role="row">
                                            <td>
                                                Elvira
                                            </td>
                                            <td class="sorting_1">
                                                Zanin
                                            </td>
                                            <td>
                                                0512100002
                                            </td>
                                            <td>
                                                59/60
                                            </td>
                                            <td>
                                                Promosso
                                            </td>
                                            <td>
                                                <font color="green"> Corretto </font>
                                            </td>
                                            <td>
                                                <a href="correggitest" class="btn btn-sm blue-madison">
                                                    <i class="fa fa-pencil"></i> Correggi
                                                </a>
                                                <a href="visualizzatestdocente" class="btn btn-sm default">
                                                    Visualizza
                                                </a>
                                            </td>                                            
                                        </tr>

                                        <tr class="gradeX even" role="row">
                                             <td>
                                                Fabio
                                            </td>
                                            <td class="sorting_1">
                                                Esposito
                                            </td>
                                            <td>
                                                0512100003
                                            </td>
                                            <td>
                                                54/60
                                            </td>
                                            <td>
                                                Promosso
                                            </td>
                                            <td>
                                                <font color="green"> Corretto </font>
                                            </td>
                                            <td>
                                                <a href="correggitest" class="btn btn-sm blue-madison">
                                                    <i class="fa fa-pencil"></i> Correggi
                                                </a>
                                                <a href="visualizzatestdocente" class="btn btn-sm default">
                                                    Visualizza
                                                </a>
                                            </td>
                                        </tr>
                                        
                                        <tr class="gradeX even" role="row">
                                             <td>
                                                Pasquale
                                            </td>
                                            <td class="sorting_1">
                                                Martiniello
                                            </td>
                                            <td>
                                                0512100004
                                            </td>
                                            <td>
                                                50/60
                                            </td>
                                            <td>
                                                Promosso
                                            </td>
                                            <td>
                                                <font color="green"> Corretto </font>
                                            </td>
                                            <td>
                                                <a href="correggitest" class="btn btn-sm blue-madison">
                                                    <i class="fa fa-pencil"></i> Correggi
                                                </a>
                                                <a href="visualizzatestdocente" class="btn btn-sm default">
                                                    Visualizza
                                                </a>
                                            </td>
                                        </tr>
                                        
                                        <tr class="gradeX even" role="row">
                                             <td>
                                                Christian
                                            </td>
                                            <td class="sorting_1">
                                                De Blasio
                                            </td>
                                            <td>
                                                0512100005
                                            </td>
                                            <td>
                                                35/60*
                                            </td>
                                            <td>
                                                
                                            </td>
                                            <td>
                                                <font color="red"> Non Corretto </font>
                                            </td>
                                            <td>
                                                <a href="correggitest" class="btn btn-sm blue-madison">
                                                    <i class="fa fa-pencil"></i> Correggi
                                                </a>
                                                <a href="visualizzatestdocente" class="btn btn-sm default">
                                                    Visualizza
                                                </a>
                                            </td>
                                        </tr>
                                        
                                        <tr class="gradeX even" role="row">
                                             <td>
                                                Carlo
                                            </td>
                                            <td class="sorting_1">
                                                Di Domenico
                                            </td>
                                            <td>
                                                0512100006
                                            </td>
                                            <td>
                                                60L/60
                                            </td>
                                            <td>
                                                Promosso
                                            </td>
                                            <td>
                                                <font color="green"> Corretto </font>
                                            </td>
                                            <td>
                                                <a href="correggitest" class="btn btn-sm blue-madison">
                                                    <i class="fa fa-pencil"></i> Correggi
                                                </a>
                                                <a href="visualizzatestdocente" class="btn btn-sm default">
                                                    Visualizza
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
<!-- BEGIN aggiunta da me -->
<script src="/assets/admin/pages/scripts/table-managed.js"></script>
<!-- END aggiunta da me -->
<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        //QuickSidebar.init(); // init quick sidebar
        //Demo.init(); // init demo features
        TableManaged2.init("tabella_test2","tabella_test2_wrapper");
        TableManaged2.init("tabella_studenti_esiti","tabella_studenti_esiti_wrapper");
        //TableManaged.init(3);
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
