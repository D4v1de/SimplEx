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
                    Seleziona domande
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
                            <a href="#">Nome Test</a>
                            <i class="fa fa-angle-right"></i>
                        </li>

                        <li>
                            <a href="#">Seleziona Domande</a>
                        </li>
                    </ul>
                </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
        
            <form>
                <div class="form-body">
                    <div class="portlet box grey-cascade">
                        <div class="portlet-title">
                            <div class="caption">UML</div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title=""></a>
                            </div>
                        </div>

                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover dataTable no-footer">
                                <thead>
                                    <tr role="row">
                                        <th class="table-checkbox sorting_disabled">
                                            <div class="md-checkbox">
                                                <input type="checkbox" id="arg1" class="md-check">
                                                <label for="arg1">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span>
                                                </label>
                                            </div>
                                        </th>
                                        <th class="table-checkbox sorting_disabled">
                                            Testo
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-label="Risposte corrette: activate to sort column ascending" style="width: 10%;">
                                            Tipo
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-label="Risposte corrette: activate to sort column ascending" style="width: 15%;">
                                            Risposte corrette
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="gradeX odd" role="row">
                                        <td>
                                            <div class="md-checkbox">
                                                <input type="checkbox" id="arg1d1" class="md-check">
                                                <label for="arg1d1">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="">
                                            Come si rappresenta una dipendenza in UML?
                                        </td>
                                        <td>Multipla</td>
                                        <td>80%</td>
                                    </tr>
                                    <tr class="gradeX odd" role="row">
                                        <td>
                                            <div class="md-checkbox">
                                                <input type="checkbox" id="arg1d2" class="md-check">
                                                <label for="arg1d2">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="">
                                            Cosa contiene la prima colonna di un sequence diagram?
                                        </td>
                                        <td>Multipla</td>
                                        <td>55%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="portlet box grey-cascade">
                        <div class="portlet-title">
                            <div class="caption">Use Case</div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title=""></a>
                            </div>
                        </div>

                        <div class="portlet-body">
                            <table class="table table-striped table-bordered table-hover dataTable no-footer">
                                <thead>
                                    <tr role="row">
                                        <th class="table-checkbox sorting_disabled">
                                            <div class="md-checkbox">
                                                <input type="checkbox" id="arg2" class="md-check">
                                                <label for="arg2">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span>
                                                </label>
                                            </div>
                                        </th>
                                        <th class="table-checkbox sorting_disabled">
                                            Testo
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-label="Risposte corrette: activate to sort column ascending" style="width: 10%;">
                                            Tipo
                                        </th>
                                        <th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-label="Risposte corrette: activate to sort column ascending" style="width: 15%;">
                                            Risposte corrette
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr class="gradeX odd" role="row">
                                        <td>
                                            <div class="md-checkbox">
                                                <input type="checkbox" id="arg2d1" class="md-check">
                                                <label for="arg2d1">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="">
                                            Cosa NON contiene il flusso di eventi di uno Use Case?
                                        </td>
                                        <td>Multipla</td>
                                        <td>40%</td>
                                    </tr>
                                    <tr class="gradeX odd" role="row">
                                        <td>
                                            <div class="md-checkbox">
                                                <input type="checkbox" id="arg2d2" class="md-check">
                                                <label for="arg2d2">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="">
                                            Descrivere tutti i campi della tabella di uno Use Case
                                        </td>
                                        <td>Aperta</td>
                                        <td>28%</td>
                                    </tr>
                                    <tr class="gradeX odd" role="row">
                                        <td>
                                            <div class="md-checkbox">
                                                <input type="checkbox" id="arg2d3" class="md-check">
                                                <label for="arg2d3">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span>
                                                </label>
                                            </div>
                                        </td>
                                        <td class="">
                                            Quale tra queste affermazioni sugli Use Case non è corretta?
                                        </td>
                                        <td>Multipla</td>
                                        <td>75%</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-9"></div>
                            <div class="form-actions row">
                                <button type="button" class="btn red-intense">Annulla</button>
                                <button type="submit" class="btn green-jungle">Conferma</button>
                            </div>              
                        </div>
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
