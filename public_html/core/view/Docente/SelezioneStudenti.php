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
                Selezione studenti
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
                        <a href="#">Abilita Studenti</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <br>
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
                <div class="col-md-9">
                </div>
                <div class="col-md-3">
                  <button type="button" class="btn red">Annulla</button>
                  <button type="submit" class="btn green">Conferma</button>
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
