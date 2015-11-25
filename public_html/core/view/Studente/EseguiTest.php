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
                            <a href="#">Esegui Test</a>
                        </li>
                    </ul>
                </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            
            <div class="form-body">
                <div class="portlet box grey-cascade">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-globe"></i>Test
                        </div>
                        <div class="tools">
                            <div class="caption">
                                <font size="3">Tempo rimasto: ???</font>
                            </div>
                        </div>
                    </div>

                    <div class="portlet-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group form-md-line-input has-success">
                                    <div class="input-icon">
                                        <input type="text" class="form-control">
                                            <label for="form_control_1">Nome</label>
                                                <span class="help-block">Inserire il nome</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-md-line-input has-success">
                                    <div class="input-icon">
                                        <input type="text" class="form-control">
                                            <label for="form_control_1">Cognome</label>
                                                <span class="help-block">Inserire il cognome</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-md-line-input has-success">
                                    <div class="input-icon">
                                        <input type="text" class="form-control">
                                            <label for="form_control_1">Matricola</label>
                                                <span class="help-block">Inserire la matricola</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <h3> Domanda 1 (multipla) </h3>
                        <div class="form-group form-md-radios">
                            <div class="md-radio-list">
                                <div class="md-radio">
                                    <input type="radio" id="d1r1" name="radio1" class="md-radiobtn">
                                    <label for="d1r1">
                                    <span class="inc"></span>
                                    <span class="check"></span>
                                    <span class="box"></span>
                                    Riposta 1 </label>
                                </div>
                                <div class="md-radio">
                                    <input type="radio" id="d1r2" name="radio1" class="md-radiobtn">
                                    <label for="d1r2">
                                    <span class="inc"></span>
                                    <span class="check"></span>
                                    <span class="box"></span>
                                    Riposta 2 </label>
                                </div>
                                <div class="md-radio">
                                    <input type="radio" id="d1r3" name="radio1" class="md-radiobtn">
                                    <label for="d1r3">
                                    <span class="inc"></span>
                                    <span class="check"></span>
                                    <span class="box"></span>
                                    Riposta 3 </label>
                                </div>
                                <div class="md-radio">
                                    <input type="radio" id="d1r4" name="radio1" class="md-radiobtn">
                                    <label for="d1r4">
                                    <span class="inc"></span>
                                    <span class="check"></span>
                                    <span class="box"></span>
                                    Riposta 4 </label>
                                </div>
                            </div>
                        </div>

                        <h3> Domanda 2 (aperta)</h3>
                        <div class="form-group">
                            <textarea class="form-control" rows="3" placeholder="Inserisci risposta" style="resize:none"></textarea>
                        </div>
                        <h3> Domanda 3 (multipla)</h3>
                        <div class="form-group form-md-radios">
                            <div class="md-radio-list">
                                <div class="md-radio">
                                    <input type="radio" id="d2r1" name="radio1" class="md-radiobtn">
                                    <label for="d2r1">
                                    <span class="inc"></span>
                                    <span class="check"></span>
                                    <span class="box"></span>
                                    Riposta 1 </label>
                                </div>
                                <div class="md-radio">
                                    <input type="radio" id="d2r2" name="radio1" class="md-radiobtn">
                                    <label for="d2r2">
                                    <span class="inc"></span>
                                    <span class="check"></span>
                                    <span class="box"></span>
                                    Riposta 2 </label>
                                </div>
                                <div class="md-radio">
                                    <input type="radio" id="d2r3" name="radio1" class="md-radiobtn">
                                    <label for="d2r3">
                                    <span class="inc"></span>
                                    <span class="check"></span>
                                    <span class="box"></span>
                                    Riposta 3 </label>
                                </div>
                                <div class="md-radio">
                                    <input type="radio" id="d2r4" name="radio1" class="md-radiobtn">
                                    <label for="d2r4">
                                    <span class="inc"></span>
                                    <span class="check"></span>
                                    <span class="box"></span>
                                    Riposta 4 </label>
                                </div>
                            </div>
                        </div>


                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-9"></div>
                            <button type="submit" class="btn green-jungle">Conegna</button>
                            <button type="button" class="btn red-intense">Abbandona</button> 
                        </div>
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
