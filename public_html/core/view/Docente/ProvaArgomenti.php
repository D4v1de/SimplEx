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
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/jquery-nestable/jquery.nestable.css">
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
                Creazione Test
            </h3>

            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->


            <div class="container-fluid">
                <div class="col-md-6">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-comments"></i>Argomenti
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title="">
                                </a>

                            </div>
                        </div>
                        <div class="portlet-body ">
                            <div class="dd" id="nestable_list_1" >
                                <ol class="dd-list">
                                    <li class="dd-item" data-id="1">
                                        <div class="dd-handle dd-nodrag" >
                                            Argomento 1
                                        </div>
                                        <ol class="dd-list" style="">

                                            <li class="dd-item" data-id="11">
                                                <div class="dd-handle">
                                                    Domanda 1
                                                </div>
                                            </li>
                                            <li class="dd-item" data-id="12">
                                                <div class="dd-handle">
                                                    Domanda 2
                                                </div>

                                            </li>
                                            <li class="dd-item" data-id="13">
                                                <div class="dd-handle">
                                                    Domanda 3
                                                </div>
                                            </li>
                                            <li class="dd-item" data-id="14">
                                                <div class="dd-handle">
                                                    Domanda 4
                                                </div>
                                            </li>
                                        </ol>
                                    </li><li class="dd-item" data-id="2">
                                        <div class="dd-handle dd-nodrag">
                                            Argomento 2
                                        </div>
                                        <ol class="dd-list" style="">
                                            <li class="dd-item" data-id="21">
                                                <div class="dd-handle">
                                                    Domanda 1
                                                </div>
                                            </li>
                                            <li class="dd-item" data-id="22">
                                                <div class="dd-handle">
                                                    Domanda 2
                                                </div>
                                            </li>
                                            <li class="dd-item" data-id="23">
                                                <div class="dd-handle">
                                                    Domanda 3
                                                </div>
                                            </li>
                                            <li class="dd-item" data-id="24">
                                                <div class="dd-handle">
                                                    Domanda 4
                                                </div>
                                            </li>
                                            <li class="dd-item" data-id="25">
                                                <div class="dd-handle">
                                                    Domanda 5
                                                </div>
                                            </li>
                                        </ol>
                                    </li>

                                    <li class="dd-item" data-id="3">
                                        <div class="dd-handle dd-nodrag">
                                            Argomento 3
                                        </div>
                                        <ol class="dd-list" style="">
                                            <li class="dd-item" data-id="31">
                                                <div class="dd-handle">
                                                    Domanda 1
                                                </div>
                                            </li>
                                            <li class="dd-item" data-id="32">
                                                <div class="dd-handle">
                                                    Domanda 2
                                                </div>
                                            </li>
                                            <li class="dd-item" data-id="33">
                                                <div class="dd-handle">
                                                    Domanda 3
                                                </div>
                                            </li>
                                            <li class="dd-item" data-id="34">
                                                <div class="dd-handle">
                                                    Domanda 4
                                                </div>
                                            </li>
                                            <li class="dd-item" data-id="35">
                                                <div class="dd-handle">
                                                    Domanda 5
                                                </div>
                                            </li>
                                        </ol>
                                    </li>
                                    <li class="dd-item" data-id="4">
                                        <div class="dd-handle dd-nodrag">
                                            Argomento 4
                                        </div>
                                        <ol class="dd-list" style="">
                                            <li class="dd-item" data-id="41">
                                                <div class="dd-handle">
                                                    Domanda 1
                                                </div>
                                            </li>
                                            <li class="dd-item" data-id="42">
                                                <div class="dd-handle">
                                                    Domanda 2
                                                </div>
                                            </li>
                                            <li class="dd-item" data-id="43">
                                                <div class="dd-handle">
                                                    Domanda 3
                                                </div>
                                            </li>
                                            <li class="dd-item" data-id="44">
                                                <div class="dd-handle">
                                                    Domanda 4
                                                </div>
                                            </li>
                                            <li class="dd-item" data-id="45">
                                                <div class="dd-handle">
                                                    Domanda 5
                                                </div>
                                            </li>
                                        </ol>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-md-6">
                    <div class="portlet box blue">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-pencil"></i>Test
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title="">
                                </a>

                            </div>
                        </div>
                        <div class="portlet-body ">
                            <div class="dd" id="nestable_list_2">
                                Trascina le domande qui..
                                <ol class="dd-list">
                                    <li class="dd-item" data-id="" >

                                    </li>
                                </ol>
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
<script src="/assets/admin/pages/scripts/ui-nestable.js"></script>
<script src="/assets/global/plugins/jquery-nestable/jquery.nestable.js"></script>

<script src="/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        //QuickSidebar.init(); // init quick sidebar
        //Demo.init(); // init demo features
        UINestable.init();

    });

    //CollapseAll all'avvio.
    // PROBLEMA: se lo metto, funziona anche sull'altra tabella, non permettendomi di inserire nulla

    /*
    $('#nestable_list_1').nestable({
    });
    $('#nestable_list_1').nestable('collapseAll');
    */

</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
