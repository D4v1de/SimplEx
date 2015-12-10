<?php
/**
 * Created by NetBeans.
 * User: fabio
 * Date: 6/12/15
 */

//TODO qui la logica iniziale, caricamento dei controller ecc
include_once CONTROL_DIR . "DomandaController.php";
$controllerDomanda = new DomandaController();

include_once CONTROL_DIR . "AlternativaController.php";
$controllerAlternativa = new AlternativaController();

$test=$_URL[5];

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
                Visualizza Test
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
                        Visualizza Test
                    </li>
                </ul>
            </div>

            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            
            <?php
                            $Multiple = Array();
                            $Multiple = $controllerDomanda->getAllDomandeMultipleByTest($test);
                            foreach($Multiple as $x) {
                                printf("entrato");
                                printf("<div class=\"portlet box blue-madison\"><div class=\"portlet-title\"><div class=\"caption\"><i class=\"fa fa-question-circle\"></i>%s</div><div class=\"tools\"><a href=\"javascript:;\" class=\"collapse\" data-original-title=\"\" title=\"\"></a></div></div>", $x->getTesto());
                                $Alternative = Array();
                                $Alternative = $controllerAlternativa->getAllAlternativaByDomanda($x->getId());
                                printf("<div class=\"portlet-body\">");
                                foreach($Alternative as $b){
                                 printf("<p>%s</p>", $b->getTesto());  
                                }
                                printf("</div></div>");
                            }
                            $Aperte = Array();
                            $Aperte = $controllerDomanda->getAllDomandeAperteByTest($test);
                            foreach($Aperte as $x){
                             printf("<div class=\"portlet box blue-madison\"><div class=\"portlet-title\"><div class=\"caption\"><i class=\"fa fa-question-circle\"></i>%s (aperta)</div></div></div>", $x->getTesto());   
                             
                            }
                            if(($Multiple==null) && ($Aperte==null)){
                                printf("<h2> Il test selezionato non ha alcuna domanda associata </h2><br><br>"); 
                            }

                            ?>
            

                            <div class="row">
                                <div class="col-md-9">
                                    
                                    <a href="../../" class="btn sm red-intense">
                                        Indietro
                                    </a>
                                </div>
                            </div>
            
            <!--
            <div class="portlet box blue-madison">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-question-circle"></i>Domanda 1
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title="">
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <p>Risposta 1</p>
                    <p><font color="#78a300">Risposta 2</font></p>
                    <p>Risposta 3</p>
                    <p>Risposta 4</p>
                </div>
            </div>
            <div class="portlet box blue-madison">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-question-circle"></i>Domanda 2
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title="">
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    Testo domanda a risposta aperta
                </div>
            </div>
            <div class="portlet box blue-madison">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-question-circle"></i>Domanda 3
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title="">
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <p>Risposta 1</p>
                    <p>Risposta 2</p>
                    <p>Risposta 3</p>
                    <p><font color="#78a300">Risposta 4</font></p>
                </div>
            </div>     
            <div class="portlet box blue-madison">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-question-circle"></i>Domanda 4
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title="">
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <p><font color="#78a300">Risposta 1</font></p>
                    <p>Risposta 2</p>
                    <p>Risposta 3</p>
                    <p>Risposta 4</p>
                </div>
            </div>
            -->
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
