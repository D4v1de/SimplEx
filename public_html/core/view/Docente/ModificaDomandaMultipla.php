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
include_once CONTROL_DIR . "AlternativaController.php";

$cdlController = new CdlController();
$domandaController = new DomandaController();
$argomentoController = new ArgomentoController();
$alternativaController = new AlternativaController();

$idCorso = $_URL[3];
$idArgomento = $_URL[7];
$idDomanda = $_URL[8];
$corso = $cdlController->readCorso($idCorso);
$argomento = $argomentoController->readArgomento($idArgomento, $idCorso); //Chiedere se deve essere modificato
$domandaOld = $domandaController->getDomandaMultipla($idDomanda);
$risposte = $alternativaController->getAllAlternativaByDomanda($idDomanda);


if (isset($_POST['testoDomanda']) && isset($_POST['punteggioErr']) && isset($_POST['punteggioEs']) && isset($_POST['risposte']) && isset($_POST['radio']) ) {

    $testoDomanda = $_POST['testoDomanda'];
    $punteggioErrata = $_POST['punteggioErr'];
    $punteggioEsatta = $_POST['punteggioEs'];
    $testoRisposte = $_POST['risposte'];
    $radio = $_POST['radio'];


    if (empty($testoDomanda) && empty($punteggioErrata) && empty($punteggioEsatta)) {
        echo "<script type='text/javascript'>alert('Devi riempire tutti i campi!');</script>";
    } else if (empty($testoDomanda)) {
        echo "<script type='text/javascript'>alert('Devi inserire il testo!');</script>";
    } else if (empty($punteggioEsatta)) {
        echo "<script type='text/javascript'>alert('Devi inserire il punteggio esatta diverso da 0!');</script>";
    }else if (empty($radio)) {
        echo "<script type='text/javascript'>alert('Devi inserire una risposta corretta');</script>";
    }else if (empty($testoRisposte)) {
        echo "<script type='text/javascript'>alert('Devi inserire una risposta');</script>";
    }else {
        $i =0;
        foreach($risposte as $r) {
            if($radio == $r->getId()){
                $corretta="Si";
            } else {
                $corretta="No";
            }
            $updatedAlternativa = new Alternativa($idDomanda, $testoRisposte[$i],0,$corretta);
            $alternativaController->modificaAlternativa($r->getId(),$updatedAlternativa);
            $i = $i+1;
        }
        $updatedDomanda = new DomandaMultipla($idArgomento,$testoDomanda,$punteggioEsatta,$punteggioErrata,0,0);
        $domandaController->modificaDomandaMultipla($idDomanda,$updatedDomanda);
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
    <title>Modifica Domanda Multipla</title>
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
                Modifica una domanda a risposta multipla
            </h3>

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <?php
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
                            <i class="fa fa-edit"></i>Modifica Domanda Multipla
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
                                    printf("<input type=\"text\" id=\"testoDomanda\" name=\"testoDomanda\" value=\"%s\" class=\"form-control\">", $domandaOld->getTesto());
                                    printf("<span class=\"help-block\">");
                                    printf("Inserisci il testo della domanda </span>");
                                    ?>
                                </div>
                            </div>
                            <?php
                            foreach ($risposte as $r) {
                                printf("<div class=\"form-group form-md-line-input has-success ratio\" style=\"height: 100px\">");
                                printf("<div class=\"control-label col-md-1\">");
                                if(!strcmp($r->getCorretta(),"Si")){
                                    printf("<input type=\"radio\"  checked=\"\" id=\"radio\" name=\"radio\" value=\"%d\">", $r->getId());
                                } else {
                                    printf("<input type=\"radio\" id=\"radio\" name=\"radio\" value=\"%d\">", $r->getId());
                                }
                                printf("</div>");
                                printf("<label class=\"control-label col-md-2\">");
                                printf("Inserisci Testo Risposta</label>");
                                printf("<div class=\"col-md-6\">");
                                printf("<input type=\"text\" value=\"%s\" id=\"risposte\" name=\"risposte[]\" class=\"form-control\">", $r->getTesto());
                                printf("<span class=\"help-block\">");
                                printf("Inserisci il testo della risposta </span>");
                                printf("</div>");
                                printf("<div class=\"col-md-3\">");
                                printf("<a href=\"javascript:;\" class=\"btn sm green-jungle\">");
                                printf("<i class=\"fa fa-plus\"></i> Aggiungi");
                                printf("</a>");
                                printf("<a href=\"javascript:;\" class=\"btn sm red-intense\">");
                                printf("<i class=\"fa fa-minus\"></i> Rimuovi");
                                printf("</a>");
                                printf("</div>");
                                printf("</div>");
                            }
                            ?>
                            <div class="form-group form-md-line-input has-success" style="height: 100px">
                                <label class="control-label col-md-3">Inserisci Punteggio Esatta</label>

                                <div class="col-md-4">
                                    <?php
                                    printf("<input type=\"number\" id=\"punteggioDomandaEsatta\" name=\"punteggioEs\" value=\"%d\" class=\"form-control\">",$domandaOld->getPunteggioCorretta());
                                    printf("<span class=\"help-block\">");
                                    printf("Inserisci il punteggio della domanda esatta</span>");
                                    ?>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input has-success" style="height: 100px">
                                <label class="control-label col-md-3">Inserisci Punteggio Errata</label>

                                <div class="col-md-4">
                                    <?php
                                    printf("<input type=\"number\" id=\"punteggioDomandaErrata\" name=\"punteggioErr\" value=\"%d\" class=\"form-control\">",$domandaOld->getPunteggioErrata());
                                    printf("<span class=\"help-block\">");
                                    printf("Inserisci il punteggio della domanda esatta</span>");
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
                                    printf("<a href=\"../../%d\" class=\"btn sm red-intense\">", $idArgomento);
                                    ?>
                                    Annulla
                                    </a>
                                </div>
                            </div>
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
