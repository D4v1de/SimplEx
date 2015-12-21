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
include_once CONTROL_DIR . "UtenteController.php";
include_once CONTROL_DIR . "ElaboratoController.php";
include_once CONTROL_DIR . "TestController.php";
$testController = new TestController();
$controllerSessione = new SessioneController();
$controlleCdl = new CdlController();
$elController = new ElaboratoController();
$identificativoCorso = $_URL[2];
$valu = null;
$eser = null;
$showE="";
$showRC="";
$flag=1;
$flag1=1;



$corso = $controlleCdl->readCorso($identificativoCorso);
$nomecorso= $corso->getNome();

if (isset($_GET['vai'])){
    $sessioni = $controllerSessione->getAllSessioniByCorso($identificativoCorso);
    if(empty($_GET['from']) || empty($_GET['to'])){
        $flag=0;
    }else{
        $timeTo = strtotime($_GET['to']);
        $toCompareTo = date('yyyy-mm-dd hh:ii:ss', $timeTo);

        $timeFrom = strtotime($_GET['from']);
        $toCompareFrom = date('yyyy-mm-dd hh:ii:ss', $timeFrom);

        if ($toCompareTo < $toCompareFrom) {
        $flag1 = 0;
        }else{
    $from = $_GET['from'];
    $to = $_GET['to'];
    $sessList = Array();
    $studenti = Array();
    $uc = new UtenteController();
    foreach ($sessioni as $s){
        $date = $s->getDataFine();
        if (($date > $from) && ($date < $to)){
            array_push($sessList,$s);
            $stud = $uc->getAllStudentiSessione($s->getID());
            $studenti = array_merge($studenti,$stud);
        }
    }
    }
}
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
    <title>Griglia Esiti</title>
    <link rel="stylesheet" type="text/css"
          href="/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">
    <link rel="stylesheet" type="text/css"
          href="/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/select2/select2.css">

    <?php include VIEW_DIR . "design/header.php"; ?>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-md page-header-fixed page-quick-sidebar-over-content">
<?php include VIEW_DIR . "design/headMenu.php"; ?>
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <?php include VIEW_DIR . "design/sideBar.php"; ?>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title">
                Griglia Esiti
            </h3>

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="index.html">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="<?php echo "/docente/cdl/".$corso->getCdlMatricola(); ?>"> <?php echo $controlleCdl->readCdl($corso->getCdlMatricola())->getNome(); ?> </a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <?php
                            $vaiANomeCorso="/docente/corso/".$identificativoCorso;
                            printf("<a href=\"%s\">%s</a><i class=\"fa fa-angle-right\"></i>", $vaiANomeCorso ,$nomecorso);
                         ?>
                    </li>
                    <li>
                        <?php echo "Griglia Esiti " ?>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <form id="form_sample_1" action='' method='GET'>
                
                <?php
                    if(!$flag) {
                        echo "<div class=\"alert alert-danger\">
                        <button class=\"close\" data-close=\"alert\"></button>
                        Errore nei Dati. Devi inserire un intervallo temporale per visualizzare gli esiti.
                        </div>";
                        
                    }
                ?>
                <?php
                    if(!$flag1) {
                        echo "<div class=\"alert alert-danger\">
                        <button class=\"close\" data-close=\"alert\"></button>
                        Errore nei Dati. Non è stato inserito un intervallo temporale valido.
                        </div>";
                        
                    }
                ?>
                
            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-1">
                    </div>
                    <div class="col-md-4">
                        <h4>Inserisci l'intervallo temporale:</h4>
                    </div>
                    <div class="col-md-6">
                        <div class="col-md-6">
                            <label class="control-label">Da:</label>

                            <div class="input-group date form_datetime">
                                <input type="text"  size="16" readonly="" name='from' class="form-control" value=''/>
                                        <span class="input-group-btn">
                                            <button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
                                        </span>
                            </div>
                            

                        </div>
                        <div class="col-md-6">
                            <label class="control-label">A:</label>

                            <div class="input-group date form_datetime">
                                <input type="text" size="16" readonly="" name='to' class="form-control" value=''/>
                                        <span class="input-group-btn">
                                            <button class="btn default date-set" type="button"><i class="fa fa-calendar"></i></button>
                                        </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-1">
                        <h2></h2>
                        <button type="submit" name='vai' href='' class="btn sm green-jungle "> <span class="md-click-circle md-click-animate" style="height: 94px; width: 94px; top: -23px; left: 2px;"></span>
                            Vai
                        </button>
                    </div>
                </div>
            </div>
            </form>

            <br>
            <br>
            
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
                    
                    <div id="tabella_studenti_wrapper" class="dataTables_wrapper no-footer" <?php if (!isset($_GET['vai']) || $_GET['from']== null || $_GET['to']== null ) echo 'hidden=""' ?>>
                        <table class="table table-striped table-bordered table-hover dataTable no-footer" id="tabella_studenti" role="grid" aria-describedby="tabella_studenti_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting-disabled" tabindex="0" aria-controls="sample_2" rowspan="1" colspan="1" aria-label="
                                                                 Email
                                                        : activate to sort column ascending" style="width: 181px;">
                                    Matricola
                                </th>
                                <?php
                                    foreach ($sessList as $s)
                                        echo '<th class="sorting-disabled" tabindex="0" aria-controls="sample_2" rowspan="1" colspan="1" aria-label="
                                                                 Email
                                                        : activate to sort column ascending" style="width: 181px;">
                                    Sessione '.$s->getId().'</th>';
                                ?>
                                <th class="sorting-disabled" tabindex="0" aria-controls="sample_2" rowspan="1" colspan="1" aria-label="
                                                                 Email
                                                        : activate to sort column ascending" style="width: 181px;">
                                    Media
                                </th>

                            </tr>
                            </thead>
                            <tbody>

                            <?php
                                foreach ($studenti as $c) {
                                    $sum = 0;
                                    $n = 0;
                                    $mat = $c->getMatricola();
                                    printf("<tr class=\"gradeX odd\" role=\"row\">");
                                    printf("<td class=\"sorting_1\">%s</td>", $mat);
                                    foreach ($sessList as $s){
                                        try{
                                            $elaborato = $elController->readElaborato($mat,$s->getId());
                                            $parz = $elaborato->getEsitoParziale();
                                            $fin = $elaborato->getEsitoFinale();
                                            $esito = strcmp($elaborato->getStato(),"Corretto")? $parz:$fin;
                                            $sum = $sum + $esito;
                                            $test = $testController->readTest($elaborato->getTestId());
                                            $sogliaMax = $test->getPunteggioMax();
                                            $n++;
                                        }
                                        catch(ApplicationException $ex){
                                            $esito = null;
                                            $sogliaMax = null;
                                        }
                                        printf("<td>%d / %d</td>", $esito,$sogliaMax);
                                    }
                                    if ($n != 0)
                                        $mean = $sum / $n;
                                    else $mean = null;
                                    printf("<td>%f</td>", $mean);
                                    printf("</tr>");
                                }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <!-- END PAGE CONTENT-->
        </div>
        <!-- END CONTENT -->
    </div>
    <!-- END CONTAINER -->
    <?php include VIEW_DIR . "design/footer.php"; ?>
    <!-- END FOOTER -->
    <!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
    <?php include VIEW_DIR . "design/js.php"; ?>

    <!--Script specifici per la pagina -->
    <script type="text/javascript" src="/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
    <script src="/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
    <script src="/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
    <script type="text/javascript" src="/assets/global/plugins/select2/select2.min.js"></script>
    <script src="/assets/admin/pages/scripts/form-validation.js"></script>
    <script type="text/javascript" src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
    <script type="text/javascript" src="/assets/global/plugins/jquery-validation/js/additional-methods.min.js"></script>
    <script type="text/javascript" src="/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
    <script type="text/javascript"
            src="/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
    <script src="/assets/admin/pages/scripts/table-managed.js"></script>

    <script type="text/javascript"
            src="/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>

    <script>
        jQuery(document).ready(function () {
            Metronic.init(); // init metronic core components
            Layout.init(); // init current layout
            //QuickSidebar.init(); // init quick sidebar
            //Demo.init(); // init demo features
            TableManaged2.init('tabella_test','tabella_test_wrapper');
            TableManaged2.init('tabella_studenti','tabella_studenti_wrapper');
            FormValidation.init();
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
