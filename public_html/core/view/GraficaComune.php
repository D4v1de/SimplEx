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
                Template Comune
            </h3>

            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
                In questa pagina troverete tutti gli elementi grafici, in comune, che useremo.
                Quindi, se cercate qualcosa, venite qui e, nel caso non troviate nulla qui, cercate
                nel solito template
                
                <span class="help-block">
                    <br>
                </span>
                
                <div class="row">
                <div class="col-md-12">
                    <div class="portlet box grey-cascade">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-globe"></i>Bottoni
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
                                         
                                </th>
                                <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Email
                                " style="width: 210px;">
                                </th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr class="gradeX odd" role="row">
                                <td>
                                    <a href="javascript:;" class="btn btn-sm default">
                                      Bottone <i class="fa fa-edit"></i>
                                    </a>
                                </td>
                                <td class="sorting_1">
                                    <b>Modifica</b> qualcosa.  
                                </td>
                        </tr>
                        <tr class="gradeX even" role="row">
                                <td>
                                    <a href="javascript:;" class="btn sm default">
                                      Bottone
                                    </a>
                                </td>
                                <td class="sorting_1">
                                    Bottone <b>Default</b>. Io l'ho usato per ogni bottone che non aveva bisogno di un'icona particolare accanto.
                                </td>
                        </tr>
                        
                        <tr class="gradeX even" role="row">
                                <td>
                                    <a href="javascript:;" class="btn sm red">
                                Annulla
                            </a>
                                </td>
                                <td class="sorting_1">
                                    Dal nome si capisce, utilizziamolo per gli <b>Annulla</b>.
                                </td>
                        </tr>
                        
                        <tr class="gradeX even" role="row">
                                <td>
                                    <a href="javascript:;" class="btn sm green">
                                        Conferma
                                    </a>
                                </td>
                                <td class="sorting_1">
                                    Anche qui come prima, utilizziamolo per i <b>Conferma</b>.
                                </td>
                        </tr>
                        
                        <tr class="gradeX even" role="row">
                                <td>
                                    <a href="javascript:;" class="btn sm green">
                                        Aggiungi <i class="fa fa-plus"></i>
                                    </a>
                                </td>
                                <td class="sorting_1">
                                    Io l'ho utilizzato per gli <b>Aggiungi</b>.
                                </td>
                        </tr>  
                        
                        <tr class="gradeX even" role="row">
                                <td>
                                    <a href="javascript:;" class="btn sm green">
                                        Rimuovi <i class="fa fa-minus"></i>
                                    </a>
                                </td>
                                <td class="sorting_1">
                                    Io l'ho utilizzato per i <b>Rimuovi</b>.
                                </td>
                        </tr>
                        
                        
                        </tr>                        
                        </tbody>
                        </table>
                        </div>
                </div>
        </div>  
                    
                    
                </div>

            </div>
            <!-- END PAGE CONTENT-->
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
