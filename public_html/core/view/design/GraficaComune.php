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
                        Template Comune
                    </h3>

                    <!-- END PAGE HEADER-->
                    <!-- BEGIN PAGE CONTENT-->
                    In questa pagina troverete tutti gli elementi grafici, in comune, che useremo.
                    Quindi, se cercate qualcosa, venite qui e, nel caso non troviate nulla qui, cercate
                    nel solito template. 

                    <span class="help-block">
                        <br>
                    </span>

                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet box grey-cascade">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-globe"></i>Bottoni
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
                                                    <tr role="row">
                                                        <th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="
                                                            Username
                                                            : activate to sort column ascending" style="width: 119px;">

                                                        </th>
                                                        <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                                            Email
                                                            " style="width: 210px;">
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="gradeX odd" role="row">
                                                        <td>
                                                            <a href="javascript:;" class="btn sm default">
                                                                Modifica <i class="fa fa-edit"></i>
                                                            </a>
                                                        </td>
                                                        <td class="sorting_1">
                                                            <b>Modifica</b> qualcosa.  
                                                        </td>
                                                    </tr>
                                                    <tr class="gradeX even" role="row">
                                                        <td>
                                                            <a href="javascript:;" class="btn sm default">
                                                                Bottone
                                                            </a>
                                                        </td>
                                                        <td class="sorting_1">
                                                            Bottone <b>Default</b>. Io l'ho usato per ogni bottone che non aveva bisogno di un'icona particolare accanto.
                                                        </td>
                                                    </tr>

                                                    <tr class="gradeX even" role="row">
                                                        <td>
                                                            <a href="javascript:;" class="btn sm red-intense">
                                                                Annulla
                                                            </a>
                                                        </td>
                                                        <td class="sorting_1">
                                                            Dal nome si capisce, utilizziamolo per gli <b>Annulla</b>.
                                                        </td>
                                                    </tr>

                                                    <tr class="gradeX even" role="row">
                                                        <td>
                                                            <a href="javascript:;" class="btn sm green-jungle">
                                                                Conferma
                                                            </a>
                                                        </td>
                                                        <td class="sorting_1">
                                                            Anche qui come prima, utilizziamolo per i <b>Conferma</b>.
                                                        </td>
                                                    </tr>

                                                    <tr class="gradeX even" role="row">
                                                        <td>
                                                            <a href="javascript:;" class="btn sm green-jungle">
                                                                <i class="fa fa-plus"></i> Aggiungi
                                                            </a>
                                                        </td>
                                                        <td class="sorting_1">
                                                            Io l'ho utilizzato per gli <b>Aggiungi</b>.
                                                        </td>
                                                    </tr>  

                                                    <tr class="gradeX even" role="row">
                                                        <td>
                                                            <a href="javascript:;" class="btn sm red-intense">
                                                                <i class="fa fa-minus"></i> Rimuovi
                                                            </a>
                                                        </td>
                                                        <td class="sorting_1">
                                                            Io l'ho utilizzato per i <b>Rimuovi</b>.
                                                        </td>
                                                    </tr>

                                                    <tr class="gradeX even" role="row">
                                                        <td>
                                                            <div class="md-radio-inline">
                                                                <div class="md-radio">
                                                                    <input type="radio" id="radio53" name="radio2" class="md-radiobtn">
                                                                    <label for="radio53">
                                                                        <span></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span>
                                                                        Option 1 </label>
                                                                </div>
                                                                <div class="md-radio">
                                                                    <input type="radio" id="radio54" name="radio2" class="md-radiobtn">
                                                                    <label for="radio54">
                                                                        <span></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span>
                                                                        Option 2 </label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="sorting_1">
                                                            <b>Radio Button</b>.
                                                        </td>
                                                    </tr>
                                                    <tr class="gradeX even" role="row">
                                                        <td>
                                                            <div class="md-checkbox-inline">
                                                                <div class="md-checkbox">
                                                                    <input type="checkbox" id="checkbox6" class="md-check">
                                                                    <label for="checkbox6">
                                                                        <span></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span>
                                                                        Option 1 </label>
                                                                </div>
                                                                <div class="md-checkbox">
                                                                    <input type="checkbox" id="checkbox7" class="md-check">
                                                                    <label for="checkbox7">
                                                                        <span></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span>
                                                                        Option 2 </label>
                                                                </div>
                                                                <div class="md-checkbox">
                                                                    <input type="checkbox" id="checkbox8" class="md-check">
                                                                    <label for="checkbox8">
                                                                        <span></span>
                                                                        <span class="check"></span>
                                                                        <span class="box"></span>
                                                                        Option 3 </label>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="sorting_1">
                                                            <b>Checkbox</b>.
                                                        </td> 
                                                    </tr>                        
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>  


                            </div>

                        </div>
                    </div>
                    <!-- FINE RIGA -->

                    <!-- SECONDA TABELLA -->

                    <div class="row">
                        <div class="col-md-12">
                            <div class="portlet box grey-cascade">
                                <div class="portlet-title">
                                    <div class="caption">
                                        <i class="fa fa-globe"></i>Vari Form
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
                                                    <tr role="row">
                                                        <th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="
                                                            Username
                                                            : activate to sort column ascending" style="width: 120px;">

                                                        </th>
                                                        <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                                            Email
                                                            " style="width: 750px;">
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="gradeX odd" role="row">
                                                        <td>
                                                            <div class="input-group date form_datetime">
                                                                <input type="text" size="16" readonly="" class="form-control">
                                                                <span class="input-group-btn">
                                                                    <button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
                                                                </span>
                                                            </div>
                                                        </td>
                                                        <td class="sorting_1">
                                                            <b>Calendario</b>. Usarne 2 per creare un Range di date.   
                                                        </td>
                                                    </tr>
                                                    <tr class="gradeX odd" role="row">
                                                        <td>
                                                            <div class="form-group form-md-line-input has-success">
                                                                <div class="input-icon">
                                                                    <input type="text" class="form-control">
                                                                    <label for="form_control_1">Testo</label>
                                                                    <span class="help-block">Suggerimento</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td class="sorting_1">
                                                            <b>Input Testo</b>   
                                                        </td>
                                                    </tr>


                                                    </tr>                        
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>  


                            </div>

                        </div>
                    </div>




                    <div class="row">
                        <div class="col-md-12">
                            <h4>Questo è il <b>form base</b> utilizzato nelle pagine di modifica e inserimento argomenti/domande.
                            </h4>
                        </div>
                        <span class="help-block"><br></span>
                    </div>
                    <!--INIZIO FORM-->
                    <div class="portlet box grey-cascade">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-globe"></i>FORM
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title="">
                                </a>
                                <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="">
                                </a>
                                <a href="javascript:;" class="reload" data-original-title="" title="">
                                </a>
                                <a href="javascript:;" class="remove" data-original-title="" title="">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <!-- BEGIN FORM-->
                            <form action="#" class="form-horizontal form-bordered">
                                <div class="form-body">
                                    <div class="form-group form-md-line-input has-success" style="height: 90px">
                                        <label class="control-label col-md-3">Testo</label>
                                        <div class="col-md-6">
                                            <input type="text" placeholder="" class="form-control">
                                            <span class="help-block">
                                                Suggerimento </span>
                                        </div>
                                        <div class="col-md-3">
                                            <a href="javascript:;" class="btn sm default"><span class="md-click-circle md-click-animate" style="height: 94px; width: 94px; top: -23px; left: 2px;"></span>
                                                Bottone
                                            </a>
                                        </div>

                                    </div>
                                    <div class="form-group form-md-line-input has-success" style="height: 90px">
                                        <label class="control-label col-md-3">Ratio Button</label>
                                        <div class="col-md-9">
                                            <div class="radio-list">
                                                <label>
                                                    <div class="radio"><span class="checked"><input type="radio" name="optionsRadios2" value="option1"></span></div>
                                                    Opzione 1 </label>
                                                <label>
                                                    <div class="radio"><span class=""><input type="radio" name="optionsRadios2" value="option2" checked=""></span></div>
                                                    Opzione 2 </label>
                                            </div>
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
                            <!-- END FORM-->
                        </div>
                    </div>

                    <!--FINE FORM-->

                    <div class="row">
                        <div class="col-md-12">
                            <h4>Questa è la nostra <b>tabella di default</b>.
                                La utilizziamo per tutte le pagine dove c'è bisogno di mostrare una lista (di argomenti, di cdl, etc..).</h4>
                        </div>
                        <span class="help-block"><br></span>
                    </div>

                    <div class="portlet box grey-cascade">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-globe"></i>Tabella
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title="">
                                </a>
                                <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="">
                                </a>
                                <a href="javascript:;" class="reload" data-original-title="" title="">
                                </a>
                                <a href="javascript:;" class="remove" data-original-title="" title="">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="table-toolbar">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="btn-group">
                                            <button id="sample_editable_1_new" class="btn green-jungle">
                                                Add New <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="btn-group pull-right">
                                            <button class="btn dropdown-toggle" data-toggle="dropdown">Tools <i class="fa fa-angle-down"></i>
                                            </button>
                                            <ul class="dropdown-menu pull-right">
                                                <li>
                                                    <a href="javascript:;">
                                                        Print </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;">
                                                        Save as PDF </a>
                                                </li>
                                                <li>
                                                    <a href="javascript:;">
                                                        Export to Excel </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div id="sample_1_wrapper" class="dataTables_wrapper no-footer"><div class="row"><div class="col-md-6 col-sm-12"><div class="dataTables_length" id="sample_1_length"><label>  <select name="sample_1_length" aria-controls="sample_1" class="form-control input-xsmall input-inline"><option value="5">5</option><option value="15">15</option><option value="20">20</option><option value="-1">All</option></select> records</label></div></div><div class="col-md-6 col-sm-12"><div id="sample_1_filter" class="dataTables_filter"><label>My search: <input type="search" class="form-control input-small input-inline" placeholder="" aria-controls="sample_1"></label></div></div></div><div class="table-scrollable"><table class="table table-striped table-bordered table-hover dataTable no-footer" id="sample_1" role="grid" aria-describedby="sample_1_info">
                                        <thead>
                                            <tr role="row"><th class="table-checkbox sorting_disabled" rowspan="1" colspan="1" aria-label="

                                                               " style="width: 24px;">
                                                    <div class="checker"><span><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes"></span></div>
                                                </th><th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="
                                                         Username
                                                         : activate to sort column ascending" style="width: 178px;">
                                                    Username
                                                </th><th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                                         Email
                                                         " style="width: 302px;">
                                                    Email
                                                </th><th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                                         Points
                                                         " style="width: 110px;">
                                                    Points
                                                </th><th class="sorting" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-label="
                                                         Joined
                                                         : activate to sort column ascending" style="width: 159px;">
                                                    Joined
                                                </th><th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                                         Status
                                                         " style="width: 173px;">
                                                    Status
                                                </th></tr>
                                        </thead>
                                        <tbody>
                                            <tr class="gradeX odd" role="row">
                                                <td>
                                                    <div class="checker"><span><input type="checkbox" class="checkboxes" value="1"></span></div>
                                                </td>
                                                <td class="sorting_1">
                                                    coop
                                                </td>
                                                <td>
                                                    <a href="mailto:userwow@gmail.com">
                                                        good@gmail.com </a>
                                                </td>
                                                <td>
                                                    20
                                                </td>
                                                <td class="center">
                                                    19.11.2010
                                                </td>
                                                <td>
                                                    <span class="label label-sm label-success">
                                                        Approved </span>
                                                </td>
                                            </tr><tr class="gradeX even" role="row">
                                                <td>
                                                    <div class="checker"><span><input type="checkbox" class="checkboxes" value="1"></span></div>
                                                </td>
                                                <td class="sorting_1">
                                                    foopl
                                                </td>
                                                <td>
                                                    <a href="mailto:userwow@gmail.com">
                                                        good@gmail.com </a>
                                                </td>
                                                <td>
                                                    20
                                                </td>
                                                <td class="center">
                                                    19.11.2010
                                                </td>
                                                <td>
                                                    <span class="label label-sm label-success">
                                                        Approved </span>
                                                </td>
                                            </tr><tr class="gradeX odd" role="row">
                                                <td>
                                                    <div class="checker"><span><input type="checkbox" class="checkboxes" value="1"></span></div>
                                                </td>
                                                <td class="sorting_1">
                                                    fop
                                                </td>
                                                <td>
                                                    <a href="mailto:userwow@gmail.com">
                                                        good@gmail.com </a>
                                                </td>
                                                <td>
                                                    20
                                                </td>
                                                <td class="center">
                                                    13.11.2010
                                                </td>
                                                <td>
                                                    <span class="label label-sm label-warning">
                                                        Suspended </span>
                                                </td>
                                            </tr><tr class="gradeX even" role="row">
                                                <td>
                                                    <div class="checker"><span><input type="checkbox" class="checkboxes" value="1"></span></div>
                                                </td>
                                                <td class="sorting_1">
                                                    goop
                                                </td>
                                                <td>
                                                    <a href="mailto:userwow@gmail.com">
                                                        good@gmail.com </a>
                                                </td>
                                                <td>
                                                    20
                                                </td>
                                                <td class="center">
                                                    12.11.2010
                                                </td>
                                                <td>
                                                    <span class="label label-sm label-success">
                                                        Approved </span>
                                                </td>
                                            </tr><tr class="gradeX odd" role="row">
                                                <td>
                                                    <div class="checker"><span><input type="checkbox" class="checkboxes" value="1"></span></div>
                                                </td>
                                                <td class="sorting_1">
                                                    kop
                                                </td>
                                                <td>
                                                    <a href="mailto:userwow@gmail.com">
                                                        good@gmail.com </a>
                                                </td>
                                                <td>
                                                    20
                                                </td>
                                                <td class="center">
                                                    17.11.2010
                                                </td>
                                                <td>
                                                    <span class="label label-sm label-success">
                                                        Approved </span>
                                                </td>
                                            </tr></tbody>
                                    </table></div><div class="row"><div class="col-md-5 col-sm-12"><div class="dataTables_info" id="sample_1_info" role="status" aria-live="polite">Showing 1 to 5 of 25 entries</div></div><div class="col-md-7 col-sm-12"><div class="dataTables_paginate paging_bootstrap_full_number" id="sample_1_paginate"><ul class="pagination" style="visibility: visible;"><li class="prev disabled"><a href="#" title="First"><i class="fa fa-angle-double-left"></i></a></li><li class="prev disabled"><a href="#" title="Prev"><i class="fa fa-angle-left"></i></a></li><li class="active"><a href="#">1</a></li><li><a href="#">2</a></li><li><a href="#">3</a></li><li><a href="#">4</a></li><li><a href="#">5</a></li><li class="next"><a href="#" title="Next"><i class="fa fa-angle-right"></i></a></li><li class="next"><a href="#" title="Last"><i class="fa fa-angle-double-right"></i></a></li></ul></div></div></div></div>
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
