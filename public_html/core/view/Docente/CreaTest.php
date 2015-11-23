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
                    Crea Test
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
                            <a href="#">Crea Test</a>
                        </li>

                    </ul>
                </div>

            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <form>
                <div class="form-body">
                    <div class="portlet box grey-cascade">
                        <div class="portlet-title">
                            <div class="caption">
                                Informazioni
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title=""></a>
                            </div>
                        </div>

                        <div class="portlet-body">
                            <h4> Descrizione</h4>
                                <div class="col-md-12">
                                    <textarea class="form-control" rows="4" placeholder="Inserisci descrizione" style="resize:none"></textarea>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4> Tipologia selezione domande</h4>
                                            <div class="col-md-10">
                                                    <div class="md-radio-inline">
                                                            <div class="md-radio">
                                                                    <input type="radio" id="radio53" name="radio2" class="md-radiobtn">
                                                                    <label for="radio53">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span>
                                                                    Manuale </label>
                                                            </div>
                                                            <div class="md-radio">
                                                                    <input type="radio" id="radio54" name="radio2" class="md-radiobtn">
                                                                    <label for="radio54">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span>
                                                                    Random </label>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-md-line-input has-success">
                                            <div class="input-icon">
                                                <input type="text" class="form-control">
                                                    <label for="form_control_1">Numero domande a risposta aperta:</label>
                                                        <span class="help-block">Inserire numero</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group form-md-line-input has-success">
                                            <div class="input-icon">
                                                <input type="text" class="form-control">
                                                    <label for="form_control_1">Numero domande a risposta aperta:</label>
                                                        <span class="help-block">Inserire numero</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    <div class="portlet box grey-cascade">
                        <div class="portlet-title">
                            <div class="caption">
                                Argomenti
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title=""></a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div id="sample_1_wrapper" class="dataTables_wrapper no-footer">
                                <div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="sample_1" role="grid" aria-describedby="sample_1_info">
                                        <tbody>
                                            <tr class="gradeX odd" role="row">
                                                <td width="1px">
                                                    <div class="md-checkbox">
                                                        <input type="checkbox" id="checkbox33" class="md-check">
                                                        <label for="checkbox33">
                                                            <span class="inc"></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="sorting_1">
                                                    Introduzione all'ingegneria del software
                                                </td>
                                                <td>80%</td>
                                            </tr>  
                                            <tr class="gradeX odd" role="row">
                                                <td width="1px">
                                                    <div class="md-checkbox">
                                                        <input type="checkbox" id="checkbox34" class="md-check">
                                                        <label for="checkbox34">
                                                            <span class="inc"></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                            <td class="sorting_1">
                                                Introduzione UML
                                            </td>
                                            <td> 70%</td>
                                            </tr>
                                            <tr class="gradeX odd" role="row">
                                                <td width="1px">
                                                    <div class="md-checkbox">
                                                        <input type="checkbox" id="checkbox35" class="md-check">
                                                        <label for="checkbox35">
                                                            <span class="inc"></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="sorting_1">
                                                    Use-Case
                                                </td>
                                                <td>15%</td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions row">
                    <div class="col-md-9"></div>
                        <button type="button" class="btn red-intense">Annulla</button>
                        <button type="submit" class="btn green-jungle">Conferma</button>
                    </div>
                </div>
            </form>
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
