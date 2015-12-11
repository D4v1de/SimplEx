<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 18/11/15
 * Time: 09:58
 */

//TODO qui la logica iniziale, caricamento dei controller ecc
include_once CONTROL_DIR . "CdlController.php";
include_once CONTROL_DIR . "UtenteController.php";
include_once CONTROL_DIR . "TestController.php";
include_once CONTROL_DIR . "DomandaController.php";
include_once CONTROL_DIR . "AlternativaController.php";
include_once CONTROL_DIR . "RispostaApertaController.php";
include_once CONTROL_DIR . "RispostaMultiplaController.php";
$controller = new CdlController();
$controllerUtente = new UtenteController();
$controllerTest = new TestController();
$controllerDomanda = new DomandaController();
$controllerAlternativa = new AlternativaController();
$controllerRispostaAperta = new RispostaApertaController();
$controllerRispostaMultipla = new RispostaMultiplaController();


$cdl = null;
$corso = null;
$docenteassociato = Array();
$test = null;
$multiple = Array();
$aperte = Array();
$alternative = Array();
$rispostaaperta = null;
$rispostamultipla = null;
$url = null;
$url2 = null;


$url = $_URL[3];
if (!is_numeric($url)) {
    echo "<script type='text/javascript'>alert('errore nella url!!!');</script>";
}
$url2 = $_URL[5];
if (!is_numeric($url)) {
    echo "<script type='text/javascript'>alert('errore nella url!!!');</script>";
}

try {
    $corso = $controller->readCorso($url);
} catch (ApplicationException $ex) {
    echo "<h1>INSERIRE ID CORSO NEL PATH!</h1>" . $ex;
}
try {
    $cdl = $controller->readCdl($corso->getCdlMatricola());
} catch (ApplicationException $ex) {
    echo "<h1>READCDL FALLITO!</h1>" . $ex;
}
try {
    $docenteassociato = $controllerUtente->getDocenteAssociato($corso->getId());
} catch (ApplicationException $ex) {
    echo "<h1>GETDOCENTIASSOCIATI FALLITO</h1>".$ex;
}
try {
    $test = $controllerTest->readTest($url2);
} catch (ApplicationException $ex) {
    echo "<h1>INSERIRE ID TEST NEL PATH!</h1>" . $ex;
}
try {
    $multiple = $controllerDomanda->getAllDomandeMultipleByTest($test->getId());
} catch (ApplicationException $ex) {
    echo "<h1>GETALLDOMANDEMULTIPLEBYTEST FALLITO!</h1>" . $ex;
}
try {
    $aperte = $controllerDomanda->getAllDomandeAperteByTest($test->getId());
} catch (ApplicationException $ex) {
    echo "<h1>GETALLDOMANDEAPERTEBYTEST FALLITO!</h1>" . $ex;
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
    <title>Visualizza Test</title>
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
                Visualizza <?php echo 'Test ' . $test->getId(); ?>
            </h3>

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="../../../../index.html">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="../../../">CdL</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="../../../cdl/<?php echo $cdl->getMatricola(); ?>"><?php echo $cdl->getNome(); ?></a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="../../<?php echo $corso->getId(); ?>"><?php echo $corso->getNome(); ?></a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="../test/<?php echo $test->getId(); ?>"><?php echo 'Test ' . $test->getId(); ?></a>
                        <i class="fa fa-angle-right"></i>
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
                                <div class="col-md col-md-8">
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
                                <div class="col-md col-md-4">
                                    <h3>Esito: 90/100</h3>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <h3></h3>
            </div>

            <?php
                foreach ($multiple as $m) {
                    printf("<div class=\"portlet box blue-madison\"><div class=\"portlet-title\"><div class=\"caption\"><i class=\"fa fa-question-circle\"></i>%s</div><div class=\"tools\"><a href=\"javascript:;\" class=\"collapse\" data-original-title=\"\" title=\"\"></a></div></div>", $m->getTesto());
                    printf("<div class=\"portlet-body\">");
                    try {
                        $alternative = $controllerAlternativa->getAllAlternativaByDomanda($m->getId());
                    } catch (ApplicationException $ex) {
                        echo "<h1>GETALLALTERNATIVABYDOMANDA FALLITO!</h1>" . $ex;
                    }
                    foreach ($alternative as $a) {
                        printf("<p>%s</p>", $a->getTesto());
                    }
                    printf("</div></div>");
                }
                foreach ($aperte as $a) {
                    printf("<div class=\"portlet box blue-madison\"><div class=\"portlet-title\"><div class=\"caption\"><i class=\"fa fa-question-circle\"></i>%s (aperta)</div><div class=\"tools\"><a href=\"javascript:;\" class=\"collapse\" data-original-title=\"\" title=\"\"></a></div></div>", $a->getTesto());
                    printf("<div class=\"portlet-body\">");
                    printf("</div></div>");
                }
                if (($multiple == null) && ($aperte == null)) {
                    printf("<h2> Il test selezionato non ha alcuna domanda associata </h2>");
                }
            ?>

            <div class="row">
                <div class="col-md-12">
                    <div class="form-actions">
                        <div class="col-md-offset-1 col-md-4">
                            <a href=""><button type="button" class="btn green-jungle">Indietro</button></a>
                        </div>
                    </div>
                </div>
            </div>

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
