<?php


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
                Correzione Test
            </h3>

            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
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
                    
                    <h3>Domanda 1 (multipla) </h3>
                    <p><div class="checker disabled"><span><input type="checkbox" disabled="true"></span></div>Risposta 1</p>
                    <p><div class="checker disabled"><span><input type="checkbox" disabled="true"></span></div><font color="#78a300">Risposta 2</font></p>
                    <p><div class="checker disabled"><span class="checked"><input type="checkbox" disabled="true" checked="true"></span></div><font color="#d54e21">Risposta 3</font></p>
                    <p><div class="checker disabled"><span><input type="checkbox" disabled="true"></span></div>Risposta 4</p>
                    
                    <h3> Domanda 2 (aperta)</h3>
                    <div class="row">
                    <div class="form-group">
                        <div class="col-md-6">
                        <textarea disabled="true" class="form-control" rows="3" style="resize:none">Risposta data dallo studente</textarea>
                        </div>
                        <div class="col-md-1">
                            <textarea class="form-control" rows="1" style="resize:none"></textarea>
                        </div>
                        <div class="col-md-2">
                            <label>/5</label>
                        </div>
                    </div>
                        </div>
                    <h3> Domanda 3 (multipla)</h3>
                    <p><div class="checker disabled"><span><input type="checkbox" disabled="true"></span></div>Risposta 1</p>
                    <p><div class="checker disabled"><span><input type="checkbox" disabled="true"></span></div>Risposta 2</p>
                    <p><div class="checker disabled"><span><input type="checkbox" disabled="true"></span></div>Risposta 3</p>
                    <p><div class="checker disabled"><span class="checked"><input type="checkbox" disabled="true" checked="true"></span></div><font color="#78a300">Risposta 4</font></p>
                    </div>
                    </div>
                    <div class="form-actions row">
                        <div class="col-md-9">
                        </div>
                        <div class="col-md-3">
                            <button type="button" class="btn red">Annulla</button>
                            <button type="submit" class="btn green">Salva</button>
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
