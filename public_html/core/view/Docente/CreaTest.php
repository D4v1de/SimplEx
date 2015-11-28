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
                    <div class="portlet box blue-madison">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-info-circle"></i>Informazioni
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
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="tabella_argomenti2_wrapper" class="dataTables_wrapper no-footer">
                       <table class="table table-striped table-bordered table-hover dataTable no-footer"
                                   id="tabella_argomenti2" role="grid" aria-describedby="tabella_argomenti2_info">
                                <thead>
                                        <tr role="row">
                                            <th class="table-checkbox sorting_disabled" rowspan="1" colspan="1" aria-label="
                                                        " style="width: 24px;">
                                                <input type="checkbox" class="group-checkable" data-set="#tabella_argomenti2 .checkboxes">
                                            </th>
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
                                                <input type="checkbox" class="checkboxes" value="1">
                                            </td>
                                            <td>
                                                Argomento 1
                                            </td>
                                            <td class="sorting_1">
                                                34%
                                            </td>
                                            <td>
                                                <a href="modificaargomento" class="btn btn-sm blue-madison">
                                                     <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="javascript:;" class="btn btn-sm red-intense">
                                                     <i class="fa fa-trash-o"></i>
                                                </a>
                                            </td>
                                        </tr>


                                        <tr class="gradeX even" role="row">
                                            <td>
                                                <input type="checkbox" class="checkboxes" value="1">
                                            </td>
                                            <td>
                                                Argomento 2
                                            </td>
                                            <td class="sorting_1">
                                                87%
                                            </td>
                                            <td>
                                                <a href="modificaargomento" class="btn btn-sm blue-madison">
                                                     <i class="fa fa-edit"></i>
                                                </a>
                                                <a href="javascript:;" class="btn btn-sm red-intense">
                                                     <i class="fa fa-trash-o"></i>
                                                </a>
                                            </td>                                            
                                        </tr>

                                        <tr class="gradeX even" role="row">
                                            <td>
                                                <input type="checkbox" class="checkboxes" value="1">
                                            </td>
                                            <td>
                                                Argomento 3
                                            </td>
                                            <td class="sorting_1">
                                                60%
                                            </td>
                                            <td>
                                                <a href="modificaargomento" class="btn btn-sm blue-madison">
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

                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-9">
                                    <a href="javascript:;" class="btn sm green-jungle"><span class="md-click-circle md-click-animate" style="height: 94px; width: 94px; top: -23px; left: 2px;"></span>
                                        Conferma
                                    </a>
                                    <a href="javascript:;" class="btn sm red-intense">
                                        Annulla
                                    </a>
                                </div>
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
        TableManaged.init("tabella_argomenti2","tabella_argomenti2_wrapper");
        //TableManaged.init(3);
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
