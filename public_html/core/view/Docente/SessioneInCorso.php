<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 18/11/15
 * Time: 09:58
 */

//TODO qui la logica iniziale, caricamento dei controller ecc
include_once CONTROL_DIR . "SessioneController.php";
include_once CONTROL_DIR . "CdlController.php";
$controller = new SessioneController();
$controlleCdl = new CdlController();

$idSessione=$_URL[5];
$identificativoCorso = $_URL[3];
$corso = $controlleCdl->readCorso($identificativoCorso);
$nomecorso= $corso->getNome();

    try {
        $sessioneByUrl = $controller->readSessione($idSessione);
        $dataFrom = $sessioneByUrl->getDataInizio();
        $dataTo = $sessioneByUrl->getDataFine();
        $tipoSessione = $sessioneByUrl->getTipologia();

    } catch (ApplicationException $ex) {
        echo "<h1>errore! ApplicationException->errore manca id sessione nel path!</h1>";
        echo "<h4>" . $ex . "</h4>";
    }

if(isset( $_POST['termina'])) {
    $dataNow=date('Y/m/d/ h:i:s ', time());
    //$dataTo=$dataNow;
    $newSessione = new Sessione($dataFrom, $dataNow, 18, "In Esecuzione", $tipoSessione, $identificativoCorso);
    $controller->updateSessione($idSessione,$newSessione);
    //una volta termina la sessione dove vado? Rivedo gli esiti?
}

if(isset( $_POST['datato'])) {
    $dataFineNow=$_POST['datato'];
    $newSessione = new Sessione($dataFrom, $dataFineNow, 18, "In Esecuzione", $tipoSessione, $identificativoCorso);
    $controller->updateSessione($idSessione,$newSessione);
    header("Refresh:0");
}

if(isset( $_POST['addStu'])) {
    $vaiAddStu= "Location: "."/usr/docente/corso/".$identificativoCorso."/sessione"."/".$idSesToGo."/"."sessioneincorso/aggiungistudente";
    header($vaiAddStu);
}

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
                    Sessione in Corso
                </h3>
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="index.html">Home</a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            <a href="<?php echo "/usr/docente/cdl/".$corso->getCdlMatricola(); ?>"> <?php echo $controlleCdl->readCdl($corso->getCdlMatricola())->getNome(); ?> </a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            <?php
                            $vaiANomeCorso="/usr/docente/corso/".$identificativoCorso;
                            printf("<a href=\"%s\">%s</a><i class=\"fa fa-angle-right\"></i>", $vaiANomeCorso ,$nomecorso);
                            ?>
                        </li>
                        <li>
                            <?php echo "Sessione ".$idSessione ?>
                        </li>

                    </ul>
                </div>

            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->

            <!-- TABELLA 1 -->

            <div class="row">
                <div class="col-md-12">
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
                            <div id="sample_1_wrapper" class="dataTables_wrapper no-footer">
                                <div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="sample_1" role="grid" aria-describedby="sample_1_info">
                                        <thead>
                                        <tr role="row">
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
                                        <?php
                                        $array = Array();
                                        $array = $controller->getAllTestBySessione($idSessione);
                                        if ($array == null) {
                                            echo "l'array è null"." ".$idSessione;
                                        }
                                        else {
                                            foreach ($array as $c) {
                                                printf("<tr class=\"gradeX odd\" role=\"row\">");
                                                printf("<td class=\"sorting_1\">Test %s</td>", $c->getId());
                                                printf("<td>%s</td>", $c->getDescrizione());
                                                printf("<td>%d</td>", $c->getNumeroMultiple());
                                                printf("<td>%d</td>", $c->getNumeroAperte());
                                                printf("<td>%d</td>", $c->getPunteggioMax());
                                                printf("<td>%d</td>", $c->getPercentualeScelto());
                                                printf("<td>%d</td>", $c->getPercentualeSuccesso());
                                                printf("</tr>");
                                            }
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>


                    </div>
                    
                </div>
    </div>


            <!-- TABELLA 2 -->
            <form method="post" action="">

            <div class="row">
                <div class="col-md-12">
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
                        <div class="row">
                                <div class="col-md-12">
                                    <button type="submit"  name="addStu" href="javascript:;" class="btn sm green-jungle"><i class="fa fa-plus"></i><span class="md-click-circle md-click-animate" style="height: 94px; width: 94px; top: -23px; left: 2px;"></span>
                                        Aggiungi Studente
                                    </button>
                                </div>
                        </div>
                                <div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="sample_1" role="grid" aria-describedby="sample_1_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="
                                         Username
                                : activate to sort column ascending" style="width: 119px;">
                                                Nome
                                            </th><th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Email
                                " style="width: 210px;">
                                                Cognome
                                            </th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Email
                                " style="width: 100px;">
                                                Matricola
                                            </th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Email
                                " style="width: 15%;">
                                                Azioni
                                            </th>
                                        </tr>
                                        
                                        </thead>
                                        <tbody>
                                        <tr class="gradeX odd" role="row">
                                            <td>
                                                Fabiano
                                            </td>
                                            <td class="sorting_1">
                                                Pecorelli
                                            </td>
                                            <td>
                                                0512100001
                                            </td>
                                            <td>
                                                <a href="javascript:;" class="btn btn-sm red-intense">
                                                    Annulla Esame
                                                </a>
                                            </td>
                                        </tr>


                                        <tr class="gradeX even" role="row">
                                            <td>
                                                Elvira
                                            </td>
                                            <td class="sorting_1">
                                                Zanin
                                            </td>
                                            <td>
                                                0512100002
                                            </td>
                                            <td>                                               
                                                <a href="javascript:;" class="btn btn-sm red-intense">
                                                    Annulla Esame
                                                </a>
                                            </td>                                            
                                        </tr>

                                        <tr class="gradeX even" role="row">
                                             <td>
                                                Fabio
                                            </td>
                                            <td class="sorting_1">
                                                Esposito
                                            </td>
                                            <td>
                                                0512100003
                                            </td>
                                            <td>
                                                <a href="javascript:;" class="btn btn-sm red-intense">
                                                    Annulla Esame
                                                </a>
                                            </td>
                                        </tr>
                                        
                                        <tr class="gradeX even" role="row">
                                             <td>
                                                Pasquale
                                            </td>
                                            <td class="sorting_1">
                                                Martiniello
                                            </td>
                                            <td>
                                                0512100004
                                            </td>
                                            <td>
                                                <a href="javascript:;" class="btn btn-sm red-intense">
                                                    Annulla Esame
                                                </a>
                                            </td>
                                        </tr>
                                        
                                        <tr class="gradeX even" role="row">
                                             <td>
                                                Christian
                                            </td>
                                            <td class="sorting_1">
                                                De Blasio
                                            </td>
                                            <td>
                                                0512100005
                                            </td>
                                            <td>
                                                <a href="javascript:;" class="btn btn-sm red-intense">
                                                    Annulla Esame
                                                </a>
                                            </td>
                                        </tr>
                                        
                                        <tr class="gradeX even" role="row">
                                             <td>
                                                Carlo
                                            </td>
                                            <td class="sorting_1">
                                                Di Domenico
                                            </td>
                                            <td>
                                                0512100006
                                            </td>
                                            <td>
                                                <a href="javascript:;" class="btn btn-sm red-intense">
                                                    Annulla Esame
                                                </a>
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



            <div class="row">

                    <div class="col-md-12">
                        <div class="col-md-2">
                            <label class="control-label"><h4>Termine Sessione:</h4></label>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group date form_datetime">
                                <input name="datato" type="text" value='<?php printf("%s", $dataTo) ?>' readonly size="16" class="form-control"/>
                                        <span class="input-group-btn">
                                            <button class="btn default date-set" type="button"><i
                                                    class="fa fa-calendar"></i></button>
                                        </span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" href="javascript:;" class="btn btn-sm blue-madison"><span class="md-click-circle md-click-animate" style="height: 94px; width: 94px; top: -23px; left: 2px;"></span>
                                Modifica Termine
                                <i class="fa fa-edit"></i></button>
                    </div>
                        <div class="col-md-5"></div>
                        <button type="submit"  name="termina" value="nada" class="btn sm green-jungle"><span class="md-click-circle md-click-animate" style="height: 94px; width: 94px; top: -23px; left: 2px;"></span>
                            TERMINA ORA
                        </button>

                    </div>
                </div>
            </form>


            <!-- END PAGE CONTENT-->


            

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
<script type="text/javascript" src="/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        //QuickSidebar.init(); // init quick sidebar
        //Demo.init(); // init demo features
    });
</script>
        <script>
            //SCRIPT PER AVVIARE DATETIMEPICKER
            $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii:ss'});
        </script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
