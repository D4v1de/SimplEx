<?php
/**
 * La view consente ad uno Studente di visualizzare un corso e le relative sessioni
 * @author Federico De Rosa, Fabiano Pecorelli
 * @version 1
 * @since 23/11/15 21:58
 */
//TODO qui la logica iniziale, caricamento dei controller ecc
include_once MODEL_DIR . "CdLModel.php";
include_once MODEL_DIR . "CorsoModel.php";
include_once MODEL_DIR . "UtenteModel.php";
include_once MODEL_DIR . "SessioneModel.php";
include_once MODEL_DIR . "ElaboratoModel.php";
include_once MODEL_DIR . "TestModel.php";
$cdlModel = new CdLModel();
$corsoModel = new CorsoModel();
$utenteModel = new UtenteModel();
$sessioneModel = new SessioneModel();
$elaboratoModel = new ElaboratoModel();
$testModel = new TestModel();
$docenteassociato = Array();
$corso = null;
$cdl = null;
$studente = $_SESSION['user'];
$matricolaStudente = $studente->getMatricola();
$idCorso = null;

$idCorso = $_URL[2];
if (!is_numeric($idCorso)) {
    echo "<script type='text/javascript'>alert('errore url!!(idcorso)');</script>";
}
try {
    $corso = $corsoModel->readCorso($idCorso);
} catch (ApplicationException $ex) {
    echo "<h1>INSERIRE ID CORSO NEL PATH!</h1>".$ex;
}
try {
    $cdl = $cdlModel->readCdl($corso->getCdlMatricola());
} catch (ApplicationException $ex) {
    echo "<h1>READCDL FALLITO!</h1>".$ex;
}
try {
    $sessioni = $sessioneModel->getAllSessioniByStudente($matricolaStudente);
} catch (ApplicationException $ex) {
    echo "<h1>GETALLSESSIONIBYSTUDENTE FALLITO!</h1>".$ex;
}
try {
    $docenteassociato = $utenteModel->getAllDocentiByCorso($corso->getId());
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
                        <a href="/studente">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="/studente/cdls">CdL</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="/studente/cdl/<?php echo $cdl->getMatricola(); ?>"><?php echo $cdl->getNome(); ?></a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <?php echo $corso->getNome(); ?></a>
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
                                    if ($s->getCorsoId() == $corso->getId()){
                                        $elaborato = null;
                                        try {
                                            $show = $sessioneModel->readMostraEsitoSessione($s->getId());
                                            $elaborato = $elaboratoModel->readElaborato($matricolaStudente,$s->getId());
                                            if (!strcmp($show,"Si")){
                                                $parz = $elaborato->getEsitoParziale();
                                                $fin = $elaborato->getEsitoFinale();
                                                $esito = strcmp($elaborato->getStato(),"Corretto")? $parz:$fin;     
                                                $test = $testModel->readTest($elaborato->getTestId());
                                                $sogliaMax = $test->getPunteggioMax();      
                                                $punt = sprintf("%s / %s", $esito,$sogliaMax);
                                            }
                                            else $punt = null;
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
                                        printf("<td class=\"sorting_1\">%s</td>", $punt);
                                        if (($elaborato == null || (!strcmp($elaborato->getStato(),"Non corretto"))) && (strtotime(date("Y-m-d H:i:s")) < strtotime($s->getDataFine())) && (strtotime(date("Y-m-d H:i:s")) >= strtotime($s->getDataInizio())))
                                            printf("<td><a href=\"/studente/corso/%d/test/esegui/%d\" onclick=\"javascript: creaElaborato(%d)\" class=\"btn btn-sm default blue-madison\"><i class=\"fa fa-pencil\"></i> Partecipa</a></td>", $idCorso,$s->getId(),$s->getId());
                                        else if (($elaborato != null) && (strcmp($elaborato->getStato(),"Non corretto")))
                                                printf("<td><a href=\"/studente/corso/%d/test/%d\" class=\"btn btn-sm default\"><i class=\"fa fa-file-text-o\"></i> Visualizza</a></td>",$idCorso,$s->getId());
                                            else 
                                                printf("<td><a href=\"/studente/corso/%d/test/%d\" disabled class=\"btn btn-sm default\"><i class=\"fa fa-file-text-o\"></i> Visualizza</a></td>",$idCorso,$s->getId());
                                        printf("</tr>");
                                    }
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
	  xhr.open("GET", "/studente/creaElaborato?mat="+mat+"&sessId="+sId, true);   
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
