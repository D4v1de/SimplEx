<?php
/**
 * Created by PhpStorm.
 * User: fede_dr
 * Date: 23/11/15
 * Time: 21:58
 */
//TODO qui la logica iniziale, caricamento dei controller ecc
include_once CONTROL_DIR . "CdlController.php";
include_once CONTROL_DIR . "UtenteController.php";
include_once CONTROL_DIR . "SessioneController.php";
include_once CONTROL_DIR . "ElaboratoController.php";
include_once CONTROL_DIR . "TestController.php";
$controller = new CdlController();
$utenteController = new UtenteController();
$sessioneController = new SessioneController();
$elaboratoController = new ElaboratoController();
$testController = new TestController();
$docenteassociato = Array();
$corso = null;
$cdl = null;
$matricolaStudente = "0512102390";
$url = null;

$url = $_URL[3];
if (!is_numeric($url)) {
    echo "<script type='text/javascript'>alert('errore nella url!!!');</script>";
}
try {
    $corso = $controller->readCorso($url);
} catch (ApplicationException $ex) {
    echo "<h1>INSERIRE ID CORSO NEL PATH!</h1>".$ex;
}
try {
    $cdl = $controller->readCdl($corso->getCdlMatricola());
} catch (ApplicationException $ex) {
    echo "<h1>READCDL FALLITO!</h1>".$ex;
}
try {
    $sessioni = $sessioneController->getAllSessioniByStudente($matricolaStudente);
} catch (ApplicationException $ex) {
    echo "<h1>GETALLSESSIONIBYSTUDENTE FALLITO!</h1>".$ex;
}
try {
    $docenteassociato = $utenteController->getDocenteAssociato($corso->getId());
} catch (ApplicationException $ex) {
    echo "<h1>GETDOCENTIASSOCIATI FALLITO</h1>".$ex;
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
    <title><?php echo $corso->getNome(); ?></title>
    <?php include VIEW_DIR . "design/header.php"; ?>
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/select2/select2.css">
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css">
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
                Corso di <?php echo $cdl->getNome(); ?>
            </h3>

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="../../../../index.html">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="../..">CdL</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="../../cdl/<?php echo $cdl->getMatricola(); ?>"><?php echo $cdl->getNome(); ?></a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <?php echo $corso->getNome(); ?>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->

            <div class="row">
                <div class="col-md-12">
                    <div class="form">
                        <form action="#" class="form-horizontal form-bordered form-row-stripped">
                            <div class="form-actions">
                                <div class="col-md col-md-10">
                                    <h3><?php echo $corso->getNome(); ?></h3>
                                    <h5>Matricola: <?php echo $corso->getMatricola(); ?></h5>
                                    <h5>Tipologia: <?php echo $corso->getTipologia(); ?></h5>
                                    <?php
                                    if (count($docenteassociato) >= 1) {
                                        foreach ($docenteassociato as $d) {
                                            printf('<h5>Docente: %s %s</h5>', $d->getNome(), $d->getCognome());
                                        }
                                    } else if (count($docenteassociato) < 1) {
                                        printf('<h5>Questo corso non ha docenti Associati!</h5>');
                                    }
                                    ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <h3></h3>
            </div>

            <form method="post" action="">

                <div class="portlet box blue-madison">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-university"></i>Sessioni
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse" data-original-title="" title="">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="tabella_4_wrapper" class="dataTables_wrapper no-footer">
                            <table class="table table-striped table-bordered table-hover dataTable no-footer"
                                   id="tabella_4" role="grid" aria-describedby="tabella_4_info">
                                <thead>
                                <tr role="row">
                                    <th class="sorting_asc" tabindex="0" aria-controls="sample_2" rowspan="1"
                                        colspan="1" aria-label="Username: activate to sort column ascending"
                                        aria-sort="ascending">
                                        Nome
                                    </th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="sample_2" rowspan="1"
                                        colspan="1" aria-label="Username: activate to sort column ascending"
                                        aria-sort="ascending">
                                        Data e ora
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="sample_2" rowspan="1"
                                        colspan="1"
                                        aria-label="Email: activate to sort column ascending">
                                        Tipologia
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="sample_2" rowspan="1"
                                        colspan="1"
                                        aria-label="Status: activate to sort column ascending">
                                        Esito
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="sample_2" rowspan="1"
                                        colspan="1"
                                        aria-label="Status: activate to sort column ascending">
                                        Azioni
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($sessioni as $s) {
                                    $elaborato = null;
                                    try {
                                        $elaborato = $elaboratoController->readElaborato($matricolaStudente,$s->getId());
                                        $parz = $elaborato->getEsitoParziale();
                                        $fin = $elaborato->getEsitoFinale();
                                        $esito = strcmp($elaborato->getStato(),"Corretto")? $parz:$fin;     
                                        $test = $testController->readTest($elaborato->getTestId());
                                        $sogliaMax = $test->getPunteggioMax();      
                                        $punt = sprintf("%s / %s", $esito,$sogliaMax);
                                    } catch (ApplicationException $ex) {
                                        $punt = null;
                                    }
                                    printf("<tr class=\"gradeX odd\" role=\"row\">");
                                    printf("<td class=\"sorting_1\">Sessione %d</td>", $s->getId());
                                    printf("<td class=\"sorting_1\">%s</td>", $s->getDataInizio());
                                    if (!strcmp($s->getTipologia(), "Esercitativa"))
                                        printf("<td class=\"sorting_1\"><span class=\"label label-sm label-success\">%s</span></td>", $s->getTipologia());
                                    else
                                        printf("<td class=\"sorting_1\"><span class=\"label label-sm label-danger\">%s</span></td>", $s->getTipologia());
                                    printf("<td class=\"sorting_1\"><a href=\"\">%s</a></td>", $punt);
                                    if (($elaborato == null) && (strtotime(date("Y-m-d H:i:s")) < strtotime($s->getDataFine())))
                                        printf("<td><a href=\"./%d/test/esegui/%d\" onclick=\"javascript: creaElaborato(%d)\" class=\"btn btn-sm default blue-madison\"><i class=\"fa fa-pencil\"></i> Partecipa</a></td>", $url,$s->getId(),$s->getId());
                                    else
                                        if ($elaborato != null)
                                            printf("<td><a href=\"./%d/test/%d\" class=\"btn btn-sm default\"><i class=\"fa fa-file-text-o\"></i> Visualizza</a></td>",$url,$s->getId());
                                        else
                                            printf("<td><a href=\"./%d/test/%d\" disabled class=\"btn btn-sm default\"><i class=\"fa fa-file-text-o\"></i> Visualizza</a></td>",$url,$s->getId());
                                    printf("</tr>");
                                }
                                ?>
                                </tbody>
                            </table>

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
<script type="text/javascript" src="/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
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
        TableManaged2.init("tabella_4", "tabella_4_wrapper");
    });
</script>
<script>
    var creaElaborato = function(sId){
        var mat = "<?= $matricolaStudente; ?>";
        if (window.XMLHttpRequest) {
	  var xhr = new XMLHttpRequest();
	  //metodo tradizionale di registrazione eventi   
	  xhr.onreadystatechange =gestoreRichiesta;   
	  xhr.open("GET", "/creaElaborato?mat="+mat+"&sessId="+sId, true);   
	  xhr.send(""); 
	} 
	function gestoreRichiesta() {
            if (xhr.readyState == 4 && xhr.status == 200) {
            }
	}
    }
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>