<?php
/**
 * Created by NetBeans.
 * User: fabio
 * Date: 6/12/15
 */
// TODO qui la logica iniziale, caricamento dei model ecc
include_once MODEL_DIR . "DomandaModel.php";
$ModelDomanda = new DomandaModel();

include_once MODEL_DIR . "CdLModel.php";
$ModelCdl = new CdLModel();

include_once MODEL_DIR . "CorsoModel.php";
$ModelCorso = new CorsoModel();

include_once MODEL_DIR . "TestModel.php";
$ModelTest = new TestModel();

include_once MODEL_DIR . "AlternativaModel.php";
$ModelAlternativa = new AlternativaModel();

include_once MODEL_DIR . "RispostaMultiplaModel.php";
$rmModel = new RispostaMultiplaModel();

$test = $_URL[4];
$identificativoCorso = $_URL[2];

function parseInt($Str) {
    return (int) $Str;
}

try {
    $corso = $ModelCorso->readCorso($identificativoCorso);
    $nomecorso = $corso->getNome();
} catch (ApplicationException $ex) {
    echo "<h1>ERRORE NELLA LETTURA DEL CORSO!</h1>" . $ex;
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
        <title><?php
$titoloPagina = "Test " . $test;
echo $titoloPagina;
?></title>
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
                        Visualizza Test
                    </h3>
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <a href="index.html">Home</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <a href="<?php echo "/docente/cdl/" . $corso->getCdlMatricola(); ?>"> <?php echo $ModelCdl->readCdl($corso->getCdlMatricola())->getNome(); ?> </a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
<?php
$vaiANomeCorso = "/docente/corso/" . $identificativoCorso;
printf("<a href=\"%s\">%s</a><i class=\"fa fa-angle-right\"></i>", $vaiANomeCorso, $nomecorso);
?>
                            </li>
                            <li>
<?php echo $titoloPagina; ?>
                            </li>
                        </ul>
                    </div>

                    <!-- END PAGE HEADER-->
                    <!-- BEGIN PAGE CONTENT-->

<?php
$Multiple = Array();
$Multiple = $ModelDomanda->getAllDomandeMultipleByTest($test);
$testsVal = $ModelTest->getAllTestBySessioneValutativa($identificativoCorso);
$testsEse = $ModelTest->getAllTestBySessioneEsercitativa($identificativoCorso);
$nEse = count($testsEse);
$nVal = count($testsVal);
$nSce = $nEse + $nVal;
    
foreach ($Multiple as $x) {
    
    $risps = $rmModel->getAllRisposteMultipleByDomanda($x->getId());
    $risposte = $ModelAlternativa->getAllAlternativaByDomanda($x->getId());
    $scelte = $x->getPercentualeSceltaVal() + $x->getPercentualeSceltaEse();
    $percSce = ($nSce != 0)? round($scelte / $nSce * 100):0;

    printf("<div class=\"portlet box blue-madison\">");
    printf("<div class=\"portlet-title\">");
    printf("<div class=\"col-md-5 caption\">");
    printf("<i class=\"fa fa-file-o\"></i>%s", base64_decode($x->getTesto()));
    printf("</div>");
    printf("<div class=\"caption\">");
    printf("Punteggio Corretta: %s &nbsp", $ModelDomanda->readPunteggioCorrettaAlternativo($x->getId(), $test));
    printf("</div>");
    printf("<div class=\"caption\">");
    printf("Punteggio Errata: %s &nbsp", $ModelDomanda->readPunteggioErrataAlternativo($x->getId(), $test));
    printf("</div>");
    printf("<div class=\"caption\">");
    printf("Percentuale Scelta: %s%%", $percSce);
    printf("</div>");
    printf("<div class=\"tools\">");
    printf("<a href=\"javascript:;\" class=\"collapse\" data-original-title=\"\" title=\"\"></a>");
    printf("</div>");
    printf("</div>");
    printf("<div class=\"portlet-body\">");
    printf("<div id=\"tabella_domanda1_wrapper\" class=\"dataTables_wrapper no-footer\">");
    printf("<table class=\"table table-striped table-bordered table-hover dataTable no-footer\"id=\"tabella_domanda1\" role=\"grid\" aria-describedby=\"tabella_domanda1_info\">");
    printf("<tbody>");

    foreach ($risposte as $r) {
        if (count($risps) == 0) {
            $percSel = 0;
        } else {
            $percSel = round(($r->getPercentualeScelta() / count($risps) * 100), 2);
        }
        printf("<tr class=\"gradeX odd\" role=\"row\">");
        printf("<td width='30'>");
        if (!strcmp($r->getCorretta(), 'Si')) {
            printf("<input type=\"checkbox\" disabled=\"\" checked=\"\">");
        } else {
            printf("<input type=\"checkbox\" disabled=\"\">");
        }
        printf("</td>");
        printf("<td>%s</td><td align=\"right\">Selezionata: %d%%</td>", base64_decode($r->getTesto()), $percSel);
        printf("</tr>");
    }
    printf("</tbody>");
    printf("</table>");
    printf("</div>");
    printf("</div>");
    printf("</div>");
}
$Aperte = Array();
$Aperte = $ModelDomanda->getAllDomandeAperteByTest($test);
foreach ($Aperte as $x) {
    $tests = $ModelTest->getAllTestByCorso($identificativoCorso);
    $risps = $rmModel->getAllRisposteMultipleByDomanda($x->getId());
    if ($tests != null) {
        $scelte = $x->getPercentualeSceltaVal() + $x->getPercentualeSceltaEse();
        $percSce = round(($scelte / count($tests) * 100));
    }

    printf("<div class=\"portlet box blue-madison\">");
    printf("<div class=\"portlet-title\">");
    printf("<div class=\"col-md-5 caption\">");
    printf("<i class=\"fa fa-file-o\"></i>%s (APERTA)", base64_decode($x->getTesto()));
    printf("</div>");
    printf("<div class=\"caption\">");
    printf("Punteggio Max Corretta: %s &nbsp", $ModelDomanda->readPunteggioMaxAlternativo($x->getId(), $test));
    printf("</div>");
    printf("<div class=\"caption\">");
    printf("Percentuale Scelta: %s%%", $percSce);
    printf("</div>");
    printf("</div>");
    printf("<div class=\"portlet-body\">");
    printf("<div id=\"tabella_domanda1_wrapper\" class=\"dataTables_wrapper no-footer\">");
    printf("<table class=\"table table-striped table-bordered table-hover dataTable no-footer\"id=\"tabella_domanda1\" role=\"grid\" aria-describedby=\"tabella_domanda1_info\">");
    printf("</table>");
    printf("</div>");
    printf("</div>");
    printf("</div>");
}
if (($Multiple == null) && ($Aperte == null)) {
    printf("<h2> Il test selezionato non ha alcuna domanda associata </h2><br><br>");
}
?>

                    <form action="/docente/Elimina_Test?idcorso=<?= $identificativoCorso ?>" method="POST">
                        <div class="row">
                            <div class="col-md-4">
<?php
printf("<button class=\"btn btn-sm red-intense\" type=\"submit\" name=\"idtest\" title=\"\" id=\"%d\" value=\"%d\" data-popout=\"true\" data-toggle=\"confirmation\" data-singleton=\"true\" data-original-title=\"Sei sicuro?\">Elimina Test</button>", parseInt($test), parseInt($test));
?>
                            </div>

                            <div class="col-md-4">
<?php
printf("<a href=\"/docente/corso/%d/success\" class=\"btn sm red-intense\">Indietro</a>", $identificativoCorso);
?>
                            </div>
                        </div>
                    </form>


                    <!--
                    <div class="portlet box blue-madison">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-question-circle"></i>Domanda 1
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title="">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <p>Risposta 1</p>
                            <p><font color="#78a300">Risposta 2</font></p>
                            <p>Risposta 3</p>
                            <p>Risposta 4</p>
                        </div>
                    </div>
                    <div class="portlet box blue-madison">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-question-circle"></i>Domanda 2
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title="">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            Testo domanda a risposta aperta
                        </div>
                    </div>
                    <div class="portlet box blue-madison">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-question-circle"></i>Domanda 3
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title="">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <p>Risposta 1</p>
                            <p>Risposta 2</p>
                            <p>Risposta 3</p>
                            <p><font color="#78a300">Risposta 4</font></p>
                        </div>
                    </div>     
                    <div class="portlet box blue-madison">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-question-circle"></i>Domanda 4
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title="">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <p><font color="#78a300">Risposta 1</font></p>
                            <p>Risposta 2</p>
                            <p>Risposta 3</p>
                            <p>Risposta 4</p>
                        </div>
                    </div>
                    -->
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
        <script src="/assets/admin/pages/scripts/table-managed.js"></script>
        <script src="/assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js" type="text/javascript"></script>
        <script src="/assets/admin/pages/scripts/ui-confirmations.js"></script>

        <script src="/assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>
        <script src="/assets/admin/pages/scripts/ui-toastr.js"></script>
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
