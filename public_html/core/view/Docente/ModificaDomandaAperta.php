<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 18/11/15
 * Time: 09:58
 */

include_once CONTROL_DIR . "DomandaController.php";
include_once CONTROL_DIR . "ArgomentoController.php";
include_once CONTROL_DIR . "CdlController.php";

$cdlController = new CdlController();
$domandaController = new DomandaController();
$argomentoController = new ArgomentoController();

$idCorso = $_URL[3];
$idArgomento = $_URL[7];
$idDomanda = $_URL[8];
$domandaOld = $domandaController->getDomandaAperta($idDomanda,$idArgomento,$idCorso);

if (isset($_POST['testo']) && isset($_POST['punteggio'])) {

    $testo = $_POST['testo'];
    $punteggio = $_POST['punteggio'];

    if (empty($testo) && empty($punteggio)) {
        echo "<script type='text/javascript'>alert('Devi riempire tutti i campi!');</script>";
    } else if (empty($testo)) {
        echo "<script type='text/javascript'>alert('Devi inserire il testo!');</script>";
    } else if (empty($punteggio)) {
        echo "<script type='text/javascript'>alert('Devi inserire il punteggio!');</script>";
    } else {
        $updatedDomanda = new DomandaAperta($idArgomento,$idCorso, $testo, $punteggio, 0);
        $domandaController->modificaDomandaAperta($idDomanda,$idArgomento,$idCorso,$updatedDomanda);

        header('location: ../../'.$idArgomento);
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
    <title>Modifica Domanda Aperta</title>
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
                Modifica una domanda a risposta aperta
            </h3>

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <?php
                    $corso = $cdlController->readCorso($idCorso);
                    $argomento = $argomentoController->readArgomento($idArgomento,$idCorso);

                    printf("<li>");
                    printf("<i class=\"fa fa-home\"></i>");
                    printf("<a href=\"../../../../../../\">Home</a>");
                    printf("<i class=\"fa fa-angle-right\"></i>");
                    printf("</li>");
                    printf("<li>");
                    printf("<i></i>");
                    printf("<a href=\"../../../../../%d\">%s</a>",$corso->getId(),$corso->getNome());
                    printf("<i class=\"fa fa-angle-right\"></i>");
                    printf("</li>");
                    printf("<li>");
                    printf("<i></i>");
                    printf("<a href=\"../../%d\">%s</a>",$idArgomento, $argomento->getNome());
                    printf("<i class=\"fa fa-angle-right\"></i>");
                    printf("</li>");
                    printf("<li>");
                    printf("<i></i>");
                    printf("Modifica Domanda");
                    printf("</li>");
                    ?>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <form method="post" action="" class="form-horizontal form-bordered">
                <div class="portlet box blue-madison">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-edit"></i>Modifica Domanda Aperta
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse" data-original-title="" title="">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->
                        <div class="form-body">
                            <div class="form-group form-md-line-input has-success" style="height: 100px">
                                <label class="control-label col-md-3">Inserisci Testo Domanda</label>

                                <div class="col-md-6">
                                    <?php
                                    printf("<input type=\"text\" id=\"testoDomanda\" name=\"testo\" value=\"%s\" class=\"form-control\">",$domandaOld->getTesto());
                                    printf("<span class=\"help-block\">");
                                    printf("Inserisci il testo della domanda </span>");
                                    ?>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input has-success" style="height: 100px">
                                <label class="control-label col-md-3">Inserisci Punteggio</label>

                                <div class="col-md-4">
                                    <?php
                                    printf("<input type=\"number\" id=\"punteggioDomanda\" name=\"punteggio\" value=\"%d\" class=\"form-control\">",$domandaOld->getPunteggioMax());
                                    printf("<span class=\"help-block\">");
                                    printf("Inserisci il punteggio della domanda </span>");
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-9">
                                    <button type="submit" class="btn sm green-jungle">Conferma</button>
                                    <?php
                                    printf("<a href=\"../../%d\" class=\"btn sm red-intense\">",$idArgomento);
                                    ?>
                                        Annulla
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
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
