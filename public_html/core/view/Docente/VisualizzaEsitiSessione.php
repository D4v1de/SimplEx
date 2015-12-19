<?php
/**
 *La view che consente al docente di visualizzare gli esiti di una sessione
 *
 * @author Antonio Luca D'Avanzo
 * @version 1
 * @since 18/11/15 09:58
 */

//TODO qui la logica iniziale, caricamento dei controller ecc
include_once CONTROL_DIR . "SessioneController.php";
include_once CONTROL_DIR . "CdlController.php";
include_once CONTROL_DIR . "ControllerTest.php";
include_once CONTROL_DIR . "DomandaController.php";
include_once CONTROL_DIR . "RispostaApertaController.php";
include_once CONTROL_DIR . "RispostaMultiplaController.php";
include_once CONTROL_DIR . "AlternativaController.php";
include_once CONTROL_DIR . "ElaboratoController.php";

$controllerSessione = new SessioneController();
$controlleCdl = new CdlController();
$idSessione = $_URL[4];
$identificativoCorso = $_URL[2];
$domandaController = new DomandaController();
$elaboratoController = new ElaboratoController();
$testController = new ControllerTest();
$alternativaController = new AlternativaController();
$soglia=null;
$flag=1;
$sessioneByUrl = $controllerSessione->readSessione($_URL[4]);
$dataFrom = $sessioneByUrl->getDataInizio();
$dataTo = $sessioneByUrl->getDataFine();
$sogliaMin=$sessioneByUrl->getSogliaAmmissione();
$tipoSessione = $sessioneByUrl->getTipologia();
$soglia=$sessioneByUrl->getSogliaAmmissione();

if($_URL[6]=="autoendsuccess") {
    $dataNow=date('Y/m/d/ H:i:s ', time());
    $dataTo=$dataNow;
    $newSessione = new Sessione($dataFrom, $dataNow, 18, "Eseguita", $tipoSessione, $identificativoCorso);
    $controllerSessione->updateSessione($idSessione,$newSessione);
}

if($_URL[6]=="norestart") {
    $flag=0;
}

try {
    $corso = $controlleCdl->readCorso($identificativoCorso);
    $nomecorso= $corso->getNome();
}
catch (ApplicationException $ex) {
    echo "<h1>ERRORE NELLA LETTURA DEL CORSO!</h1>" . $ex;
}

if(isset($_POST['soglia'])){
    $soglia=$_POST['soglia'];
    $sessioneAggiornata = new Sessione($dataFrom, $dataTo, $soglia , $sessioneByUrl->getStato(), $sessioneByUrl->getTipologia(), $identificativoCorso);
    $controllerSessione->updateSessione($_URL[4], $sessioneAggiornata);
    header("Refresh:0");
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
     <link rel="stylesheet" type="text/css" href="/assets/global/plugins/select2/select2.css">
    <link rel="stylesheet" type="text/css"
          href="/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css">
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
                    Esiti Sessione
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
                            <?php
                            $vaiAVisu="/docente/corso/".$identificativoCorso."/sessione"."/".$idSessione."/"."visualizzasessione";
                            printf("<a href=\"%s\">%s</a><i class=\"fa fa-angle-right\"></i>", $vaiAVisu ,"Sessione ".$idSessione);
                            ?>
                            </li>
                        <li>
                            Esiti
                        </li>
                    </ul>
                </div>

            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
        <form method="post" action="">
            <div class="row">
            <div class="col-md-12">
                <div class="col-md-8"></div>
                <label>Soglia esiti:
                    <?php printf("<input type='search' name='soglia' class='form-control input-small input-inline' placeholder='%s' aria-controls='sample_1'/>", $soglia);?>
                </label>
                <button  class="btn sm green-jungle">
                    Conferma
                </button>
            </div>
        </div>
            <!-- TABELLA 1 -->
            <?php
            if($flag==0) {
                printf("<div class='alert alert-danger'>
                    <button class=\"close\" data-close=\"alert\"></button>
                      Uno o più Tests sono stati già corretti. Impossibile riprendere la sessione! </div>");
            }
            ?>
            <div class="portlet box blue-madison">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-file-text-o"></i>Test
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title="">
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="tabella_test2_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-striped table-bordered table-hover dataTable no-footer"
                                   id="tabella_test2" role="grid" aria-describedby="tabella_test2_info">
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
                                        $array = $controllerSessione->getAllTestBySessione($idSessione);
                                        if ($array == null) {
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

            <!-- TABELLA 2 -->

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet box blue-madison">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-user"></i>Studenti
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title="">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div id="tabella_studenti_esiti_wrapper" class="dataTables_wrapper no-footer">
                                <div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="tabella_studenti_esiti" role="grid" aria-describedby="tabella_studenti_esiti_info">
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
                                " style="width: 100px;">
                                                Esito
                                            </th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Email
                                " style="width: 100px;">
                                                Stato Correzione
                                            </th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Email
                                " style="width: 25%;">
                                                Azioni
                                            </th>
                                        </tr>
                                        
                                        </thead>
                                        <tbody>
                                        <?php
                                        $esaminandiSessione = Array();
                                        $toDisable="";
                                        $esaminandiSessione= $controllerSessione->getEsaminandiSessione($idSessione);
                                        if ($esaminandiSessione == null) {
                                        }
                                        else {
                                            foreach ($esaminandiSessione as $c) {
                                                $ela=$elaboratoController->readElaborato($c->getMatricola(),$idSessione);
                                                printf("<tr class=\"gradeX odd\" role=\"row\">");
                                                printf("<td class=\"sorting_1\">%s</td>", $c->getNome());
                                                printf("<td>%s</td>", $c->getCognome());
                                                printf("<td>%s</td>", $c->getMatricola());
                                                if($ela->getStato()=="Corretto") {
                                                    if($ela->getEsitoFinale()>=$sogliaMin)
                                                      printf("<td><span class=\"label label-sm label-success\">%s</span>", $ela->getEsitoFinale());
                                                    else
                                                        printf("<td><span class=\"label label-sm label-danger\">%s</span>", $ela->getEsitoFinale());
                                                }
                                                else
                                                    printf("<td>%s</td>", $ela->getEsitoParziale());
                                                printf("<td>%s</td>", $ela->getStato());
                                                printf("<td><a href='/docente/corso/%s/sessione/%s/correggi/%s' class=\"btn btn-sm blue-madison\">
                                                    <i class=\"fa fa-pencil\"></i> Correggi
                                                </a>  <a href='/docente/corso/%s/sessione/%s/visualizza/%s' class=\"btn btn-sm default\">
                                                    Visualizza
                                                </a></td>",$identificativoCorso,$idSessione, $c->getMatricola(),$identificativoCorso,$idSessione, $c->getMatricola());
                                                printf("</tr>");
                                            }
                                        }
                                        ?>
                                        </tr>
                                        
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

        </form>
                    </div>

                </div>
            </div>


            <!-- END PAGE CONTENT-->


            

    <!-- END CONTENT -->
</div>
<!-- END CONTAINER -->
<?php include VIEW_DIR . "design/footer.php"; ?>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<?php include VIEW_DIR . "design/js.php"; ?>

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
<script src="/assets/admin/pages/scripts/form-validation.js"></script>
<script type="text/javascript" src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="/assets/global/plugins/jquery-validation/js/additional-methods.min.js"></script>
<!-- END aggiunta da me -->
<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        //QuickSidebar.init(); // init quick sidebar
        //Demo.init(); // init demo features
        TableManaged2.init("tabella_test2","tabella_test2_wrapper");
        TableManaged2.init("tabella_studenti_esiti","tabella_studenti_esiti_wrapper");
        //TableManaged.init(3);
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
