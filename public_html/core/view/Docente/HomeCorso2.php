<?php
/**
 * Created by PhpStorm.
 * User: Fabiano
 * Date: 23/11/15
 * Time: 21:59
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
    <title>Nome Corso</title>
    <?php include VIEW_DIR . "header.php"; ?>
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/select2/select2.css">
    <link rel="stylesheet" type="text/css"
          href="/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css">
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
                Nome Corso
            </h3>

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="index">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        Nome Corso
                    </li>
                </ul>
            </div>

            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->

            <div class="portlet box blue-madison">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-files-o"></i>Sessioni
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title="">
                        </a>
                    </div> 
                    <div class="actions">
                        <a href="creamodificasessione" class="btn btn-default btn-sm">
                            <i class="fa fa-plus"></i> Crea Sessione </a>
                        <a href="javascript:;" class="btn btn-default btn-sm">
                            <i class="fa fa-print"></i> Print </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="tabella_sessioni_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-striped table-bordered table-hover dataTable no-footer"
                               id="tabella_sessioni" role="grid" aria-describedby="tabella_sessioni_info">
                            <thead>
                                <tr role="row">
                                    <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                                 sortAscending
                                        " style="width: 210px;">
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
                                        " style="width: 20%;">
                                                 Azioni
                                        </th></tr>
                                </thead>
                                <tbody>
                                <tr class="gradeX odd" role="row">
                                        <td class="sorting_1">
                                            <a>Sessione 1</a>
                                        </td>
                                        <td class="sorting_1">
                                            19/11/2015 16:00
                                        </td>
                                        <td>
                                            Eseguita
                                        </td>
                                        <td class="center">
                                            <a href="visualizzaesitisessione" class="btn btn-sm default">
                                              Esiti
                                            </a>
                                            <a href="javascript:;" class="btn btn-sm blue-madison">
                                                <i class="fa fa-edit"></i>
                                            </a>  
                                            <a href="javascript:;" class="btn btn-sm red-intense">
                                                <i class="fa fa-trash-o"></i>
                                            </a>  
                                        </td>

                                </tr>
                                <tr class="gradeX even" role="row">
                                        <td class="sorting_1">
                                            Sessione 2
                                        </td>
                                        <td class="sorting_1">
                                                 04/10/2015 15:00
                                        </td>
                                        <td>
                                            Eseguita
                                        </td>
                                        <td class="center">
                                            <a href="visualizzaesitisessione" class="btn btn-sm default">
                                              Esiti
                                            </a>
                                            <a href="javascript:;" class="btn btn-sm blue-madison">
                                                <i class="fa fa-edit"></i>
                                            </a> 
                                            <a href="javascript:;" class="btn btn-sm red-intense">
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                        </td>

                                </tr>
                                <tr class="gradeX even" role="row">
                                        <td class="sorting_1">
                                            Sessione 3
                                        </td>
                                        <td class="sorting_1">
                                                 04/11/2015 16:00
                                        </td>
                                        <td>
                                            Non Eseguita
                                        </td>
                                        <td class="center">
                                            <a href="visualizzaesitisessione" class="btn btn-sm default" disabled=true">
                                              Esiti
                                            </a>
                                            <a href="javascript:;" class="btn btn-sm blue-madison">
                                                <i class="fa fa-edit"></i>
                                            </a> 
                                            <a href="javascript:;" class="btn btn-sm red-intense">
                                                <i class="fa fa-trash-o"></i>
                                            </a>
                                        </td>

                                </tr>                        
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>



            <div class="portlet box blue-madison">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-file-text-o"></i>Test
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title="">
                        </a>
                    </div>
                    <div class="actions">
                        <a href="createst" class="btn btn-default btn-sm">
                            <i class="fa fa-plus"></i> Crea Test </a>
                        <a href="javascript:;" class="btn btn-default btn-sm">
                            <i class="fa fa-print"></i> Print </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="tabella_test_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-striped table-bordered table-hover dataTable no-footer"
                                   id="tabella_test" role="grid" aria-describedby="tabella_test_info">
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
                                " style="width: 14%;">
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
                                                <a href="javascript:;" class="btn btn-sm blue-madison">
                                                <i class="fa fa-edit"></i>
                                                </a>  
                                                <a href="javascript:;" class="btn btn-sm red-intense">
                                                    <i class="fa fa-trash-o"></i>
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
                                                <a href="javascript:;" class="btn btn-sm blue-madison">
                                                    <i class="fa fa-edit"></i>
                                                </a>  
                                                <a href="javascript:;" class="btn btn-sm red-intense">
                                                    <i class="fa fa-trash-o"></i>
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
                                                <a href="javascript:;" class="btn btn-sm blue-madison">
                                                    <i class="fa fa-edit"></i>
                                                </a>  
                                                <a href="javascript:;" class="btn btn-sm red-intense">
                                                    <i class="fa fa-trash-o"></i>
                                                </a> 
                                            </td>
                                        </tr>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>


            <div class="portlet box blue-madison">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-book"></i>Argomenti
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title="">
                        </a>
                    </div>
                    <div class="actions">
                        <a href="inserisciargomento" class="btn btn-default btn-sm">
                            <i class="fa fa-plus"></i> Aggiungi Argomento </a>
                        <a href="javascript:;" class="btn btn-default btn-sm">
                            <i class="fa fa-print"></i> Print </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="tabella_argomenti_wrapper" class="dataTables_wrapper no-footer">
                       <table class="table table-striped table-bordered table-hover dataTable no-footer"
                                   id="tabella_argomenti" role="grid" aria-describedby="tabella_argomenti_info">
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
                                " style="width: 14%;">
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
                                                <a href="javascript:;" class="btn btn-sm blue-madison">
                                                     <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="javascript:;" class="btn btn-sm red-intense">
                                                     <i class="fa fa-trash-o"></i>
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
                                                <a href="javascript:;" class="btn btn-sm blue-madison">
                                                     <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="javascript:;" class="btn btn-sm red-intense">
                                                     <i class="fa fa-trash-o"></i>
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
                                                <a href="javascript:;" class="btn btn-sm blue-madison">
                                                     <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="javascript:;" class="btn btn-sm red-intense">
                                                     <i class="fa fa-trash-o"></i>
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
        TableManaged2.init("tabella_sessioni","tabella_sessioni_wrapper");
        TableManaged2.init("tabella_test","tabella_test_wrapper");
        TableManaged2.init("tabella_argomenti","tabella_argomenti_wrapper");
        //TableManaged.init(3);
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
