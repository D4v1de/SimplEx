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
                        Inserisci una nuova domanda a risposta multipla
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
                                <a href="#">Nome Argomento</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <a href="#">Nuova Domanda Multipla</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                        </ul>
                    </div>
                    <!-- END PAGE HEADER-->
                    <!-- BEGIN PAGE CONTENT-->
                    <div class="portlet box grey-cascade">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-globe"></i> Inserisci Domanda
                            </div>
                            <div class="tools">
                                <a href="" class="collapse" data-original-title="" title="">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <form role="form">
                                <div class="form-body">

                                    <div class="form-group col-md-12">
                                        <label class="control-label col-md-8">Inserisci testo domanda
                                            <input type="text" class="form-control" placeholder="Inserisci Testo">
                                        </label>
                                        <div class="radio-list col-md-12">
                                            <label class="col-md-12">
                                                Inserisci testo risposta
                                            </label>
                                            <div class="radio col-sm-2" id="uniform-optionsRadios1"><span><input type="radio" name="optionsRadios" id="optionsRadios1" value="option1" checked=""></span></div>
                                            <div class="col-sm-8">
                                                <input type="text" class="form-control" placeholder="Inserisci risposta">
                                            </div>
                                            <a href="javascript:;" class="btn sm green-jungle"><span class="md-click-circle md-click-animate" style="height: 108px; width: 108px; top: -27px; left: 37px;"></span>
                                                <i class="fa fa-plus"></i> Aggiungi
                                            </a>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label ">Inserisci punteggio risposta esatta</label>
                                        <div class="col-md-3">
                                            <input type="number" class="form-control" placeholder="Inserisci punteggio">
                                        </div>
                                        <a href="javascript:;" class="btn sm red-intense">
                                            Azzera
                                        </a>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-3 control-label ">Inserisci punteggio risposta errata</label>
                                        <div class="col-md-3">
                                            <input type="number" class="form-control" placeholder="Inserisci punteggio">
                                        </div>
                                        <a href="javascript:;" class="btn sm red-intense">
                                            Azzera
                                        </a>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <a href="javascript:;" class="btn sm green-jungle"><span class="md-click-circle md-click-animate" style="height: 94px; width: 94px; top: -23px; left: 2px;"></span>
                                        Conferma
                                    </a>
                                    <a href="javascript:;" class="btn sm red-intense">
                                        Annulla
                                    </a>
                                </div>
                            </form>
                        </div>
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
