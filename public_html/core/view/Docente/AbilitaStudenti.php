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
    <title>Simplex</title>
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
                Abilita Studenti
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
                        <a href="#">Nome Sessione</a>
                        <i class="fa fa-angle-right"></i>
                    </li>

                    <li>
                        Abilita Studenti
                    </li>
                </ul>
            </div>

            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->

            <div class="portlet box blue-madison">
            <div class="portlet-title">
                <div class="caption">
                    <i class="fa fa-user"></i>Studenti
                </div>

                <div class="tools">
                    <a href="javascript:;" class="collapse" data-original-title="" title="">
                    </a>
                </div>

                <div class="actions">
                    <div class="btn-group">
                        <ul class="dropdown-menu pull-right">
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-pencil"></i> Print </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-trash-o"></i> Save as PDF </a>
                            </li>
                            <li>
                                <a href="javascript:;">
                                    <i class="fa fa-ban"></i> Export to Excel </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="portlet-body">


                <div id="tabella_studenti_wrapper" class="dataTables_wrapper no-footer">
                    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="tabella_studenti" role="grid" aria-describedby="tabella_studenti_info">
                        <thead>
                        <tr role="row">
                            <th class="table-checkbox sorting_disabled" rowspan="1" colspan="1" aria-label="
                                                        " style="width: 24px;">
                                <input type="checkbox" class="group-checkable" data-set="#tabella_studenti .checkboxes">
                            </th>
                            <th class="sorting_asc" tabindex="0" aria-controls="sample_2" rowspan="1" colspan="1" aria-sort="ascending" aria-label="
                                                                 Username
                                                        : activate to sort column ascending" style="width: 106px;">
                                Nome
                            </th><th class="sorting" tabindex="0" aria-controls="sample_2" rowspan="1" colspan="1" aria-label="
                                                                 Email
                                                        : activate to sort column ascending" style="width: 181px;">
                                Cognome
                            </th>
                            <th class="sorting-disabled" tabindex="0" aria-controls="sample_2" rowspan="1" colspan="1" aria-label="
                                                                 Email
                                                        : activate to sort column ascending" style="width: 181px;">
                                Matricola
                            </th>

                        </tr>
                        </thead>
                        <tbody>

                        <tr class="gradeX odd" role="row">
                            <td>
                                <input type="checkbox" class="checkboxes" value="1">
                            </td>
                            <td class="sorting_1">
                                Mario
                            </td>
                            <td>
                                Rossi
                            </td>
                            <td>0512100001</td>
                        </tr><tr class="gradeX even" role="row">
                            <td>
                                <input type="checkbox" class="checkboxes" value="1">
                            </td>
                            <td class="sorting_1">
                                Giacomo
                            </td>
                            <td>
                                Bonaventura
                            </td>
                            <td>0512100002</td>
                        </tr><tr class="gradeX odd" role="row">
                            <td>
                                <input type="checkbox" class="checkboxes" value="1">
                            </td>
                            <td class="sorting_1">
                                Diego Armando
                            </td>
                            <td>
                                Maradona
                            </td>
                            <td>0512100003</td>
                        </tr><tr class="gradeX even" role="row">
                            <td>
                                <input type="checkbox" class="checkboxes" value="1">
                            </td>
                            <td class="sorting_1">
                                Francesco
                            </td>
                            <td>
                                Totti
                            </td>
                            <td>0512100004</td>
                        </tr>

                        <tr class="gradeX odd" role="row">
                            <td>
                                <input type="checkbox" class="checkboxes" value="1">
                            </td>
                            <td class="sorting_1">
                                Gianluca
                            </td>
                            <td>
                                Di Marzio
                            </td>
                            <td>0512100005</td>
                        </tr>

                        <tr class="gradeX odd" role="row">
                            <td>
                                <input type="checkbox" class="checkboxes" value="1">
                            </td>
                            <td class="sorting_1">
                                Riccardo
                            </td>
                            <td>
                                Montolivo
                            </td>
                            <td>0512100006</td>
                        </tr>

                        <tr class="gradeX odd" role="row">
                            <td>
                                <input type="checkbox" class="checkboxes" value="1">
                            </td>
                            <td class="sorting_1">
                                Inacio
                            </td>
                            <td>
                                Pia
                            </td>
                            <td>0512100007</td>
                        </tr>

                        <tr class="gradeX odd" role="row">
                            <td>
                                <input type="checkbox" class="checkboxes" value="1">
                            </td>
                            <td class="sorting_1">
                                Raffaele
                            </td>
                            <td>
                                Auriemma
                            </td>
                            <td>0512100008</td>
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
        TableManaged.init("tabella_studenti","tabella_studenti_wrapper");
        //TableManaged.init(3);
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
