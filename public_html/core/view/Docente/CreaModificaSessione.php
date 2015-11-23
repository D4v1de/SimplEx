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
                Crea Sessione / Modifica Sessione
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
                        </li>
                    </ul>
                </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <form>
                <div class="form-body">
                    <div clas="row">
                        <div class="col-md-12">
                            <div class="col-md-4">
                                <div class="form-group form-md-line-input has-success">
                                    <div class="input-icon">
                                        <input type="text" class="form-control">
                                            <label for="form_control_1">Nome</label>
                                                <span class="help-block">Inserire nome sessione</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="col-md-4">
                                    <label class="control-label">Avvio:</label>
                                    <div class="input-group date form_datetime">
                                        <input type="text" size="16" readonly="" class="form-control"/>
                                        <span class="input-group-btn">
                                            <button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Ora:</label>
                                        <div class="input-icon right">
                                                <input type="text" class="form-control input-circle" placeholder="Ora Avvio">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-1"></div>
                                <div class="col-md-4">
                                    <label class="control-label">Termine:</label>
                                    <div class="input-group date form_datetime">
                                        <input type="text" size="16" readonly="" class="form-control"/>
                                        <span class="input-group-btn">
                                            <button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-md-1">
                                    <div class="form-group">
                                        <label>Ora:</label>
                                        <div class="input-icon right">
                                                <input type="text" class="form-control input-circle" placeholder="Termine">
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet box grey-cascade">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-globe"></i>Test
                                    </div>
                                    <div class="tools">
                                        <input type="radio" name"val" value"val"> Valutativo
                                        <input type="radio"> Esercitativo
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
                                                        <th width="1px">
                                                            <div class="md-checkbox">
                                                                <input type="checkbox" id="testAll" class="md-check">
                                                                <label for="testAll">
                                                                <span></span>
                                                                <span class="check"></span>
                                                                <span class="box"></span>
                                                                </label>
                                                            </div>
                                                        </th>
                                                        <th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="
                                                     Username
                                            : activate to sort column ascending" style="width: 119px;">
                                                            Nome
                                                        </th><th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                                     Email
                                            " style="width: 210px;">
                                                            Data creazione
                                                        </th><th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                                     Points
                                            " style="width: 73px;">
                                                            N° multiple
                                                        </th>
                                                        <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                                     Status
                                            " style="width: 119px;">
                                                            N° aperte
                                                        </th>
                                                        <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                                     Status
                                            " style="width: 119px;">
                                                            Punteggio massimo
                                                        </th>
                                                        <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                                     Status
                                            " style="width: 119px;">
                                                            Inserito
                                                        </th>
                                                        <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                                     Status
                                            " style="width: 119px;">
                                                            Superato
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="gradeX odd" role="row">
                                                        <td width="1px">
                                                            <div class="md-checkbox">
                                                                <input type="checkbox" id="test1" class="md-check">
                                                                <label for="test1">
                                                                <span></span>
                                                                <span class="check"></span>
                                                                <span class="box"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>Test 1</td>
                                                        <td class="sorting_1">10/11/2015</td>
                                                        <td>10</td>
                                                        <td>2</td>
                                                        <td>30</td>
                                                        <td>0%</td>
                                                        <td>0%</td>
                                                    </tr>
                                                    <tr class="gradeX even" role="row">
                                                        <td>
                                                            <div class="md-checkbox">
                                                                <input type="checkbox" id="test2" class="md-check">
                                                                <label for="test2">
                                                                <span></span>
                                                                <span class="check"></span>
                                                                <span class="box"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>Test 2</td>
                                                        <td class="sorting_1">23/03/2016</td>
                                                        <td>30</td>
                                                        <td>0</td>
                                                        <td>60</td>
                                                        <td>10%</td>
                                                        <td>70%</td>
                                                    </tr>

                                                    <tr class="gradeX even" role="row">
                                                        <td>
                                                            <div class="md-checkbox">
                                                                <input type="checkbox" id="test3" class="md-check">
                                                                <label for="test3">
                                                                <span></span>
                                                                <span class="check"></span>
                                                                <span class="box"></span>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>Test 3</td>
                                                        <td class="sorting_1">15/11/2015</td>
                                                        <td>0</td>
                                                        <td>10</td>
                                                        <td>100</td>
                                                        <td>5%</td>
                                                        <td>15%</td>                                            
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>                    
                        </div>
                    </div>
                    
            <div class="portlet box grey-cascade">
                <div class="portlet-title">
                        <div class="caption">
                                <i class="fa fa-globe"></i>Studenti

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
                                            <tr class="gradeX odd" role="row">
                                                <th width ="1px">
                                                        <div class="md-checkbox">
                                                            <input type="checkbox" id="studentiAll" class="md-check">
                                                            <label for="studentiAll">
                                                            <span></span>
                                                            <span class="check"></span>
                                                            <span class="box"></span>
                                                            </label>
                                                        </div>
                                                </th>
                                                <th>Nome</th>
                                                <th>Cognome</th>
                                                <th>Matricola</th>
                                            </tr>       
                                    </thead>

                                    <tbody>

                                        <tr class="gradeX odd" role="row">
                                                <td>
                                                    <div class="md-checkbox">
                                                        <input type="checkbox" id="studente1" class="md-check">
                                                        <label for="studente1">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="sorting_1">
                                                         Mario
                                                </td>
                                                <td>
                                                         Rossi
                                                </td>
                                                <td>
                                                         0512100000
                                                </td>
                                        </tr>  <tr class="gradeX odd" role="row">
                                                <td>
                                                    <div class="md-checkbox">
                                                        <input type="checkbox" id="studente2" class="md-check">
                                                        <label for="studente2">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="sorting_1">
                                                         Giuseppe
                                                </td>
                                                <td>
                                                         Verdi
                                                </td>
                                                <td>
                                                         0512100001
                                                </td>
                                        </tr>
                                          <tr class="gradeX odd" role="row">
                                                <td>
                                                    <div class="md-checkbox">
                                                        <input type="checkbox" id="studente3" class="md-check">
                                                        <label for="studente3">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="sorting_1">
                                                         Antonio
                                                </td>
                                                <td>
                                                         Bianchi
                                                </td>
                                                <td>
                                                         0512100002
                                                </td>
                                        </tr>
                                        <tr class="gradeX odd" role="row">
                                                <td>
                                                    <div class="md-checkbox">
                                                        <input type="checkbox" id="studente4" class="md-check">
                                                        <label for="studente4">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="sorting_1">
                                                         Michele
                                                </td>
                                                <td>
                                                         Neri
                                                </td>
                                                <td>
                                                         0512100003
                                                </td>
                                        </tr>
                                        <tr class="gradeX odd" role="row">
                                                <td>
                                                    <div class="md-checkbox">
                                                        <input type="checkbox" id="studente5" class="md-check">
                                                        <label for="studente5">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="sorting_1">
                                                         Antonio
                                                </td>
                                                <td>
                                                         Di Natale
                                                </td>
                                                <td>
                                                         0512100004
                                                </td>
                                        </tr>
                                        <tr class="gradeX odd" role="row">
                                                <td>
                                                    <div class="md-checkbox">
                                                        <input type="checkbox" id="studente6" class="md-check">
                                                        <label for="studente6">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="sorting_1">
                                                         Francesco
                                                </td>
                                                <td>
                                                         Luzzi
                                                </td>
                                                <td>
                                                         0512100005
                                                </td>
                                        </tr>
                                        <tr class="gradeX odd" role="row">
                                                <td>
                                                    <div class="md-checkbox">
                                                        <input type="checkbox" id="studente7" class="md-check">
                                                        <label for="studente7">
                                                        <span></span>
                                                        <span class="check"></span>
                                                        <span class="box"></span>
                                                        </label>
                                                    </div>
                                                </td>
                                                <td class="sorting_1">
                                                         Loris
                                                </td>
                                                <td>
                                                         Lusi
                                                </td>
                                                <td>
                                                         0512100006
                                                </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                </div>
            </div>
                <div class="form-actions row">
                    <div class="col-md-9"></div>
                        <a href="javascript:;" class="btn sm red-intense">
                            Annulla
                        </a>
                        <a href="javascript:;" class="btn sm green-jungle">
                            Conferma
                        </a>
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
