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
$idArgomento = $_URL[6];
$corso = $cdlController->readCorso($idCorso);
$argomento = $argomentoController->readArgomento($idArgomento, $idCorso);

if (isset($_POST['domanda'])){
    $domandaController->rimuoviDomandaAperta($_POST['domanda'],$idArgomento,$idCorso);
    header('Refresh:0');
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
    <?php
    printf("<title>%s</title>", $argomento->getNome());
    ?>
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
                Lista Domande
            </h3>

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <?php
                    printf("<li>");
                    printf("<i class=\"fa fa-home\"></i>");
                    printf("<a href=\"../../../../\">Home</a>");
                    printf("<i class=\"fa fa-angle-right\"></i>");
                    printf("</li>");
                    printf("<li>");
                    printf("<i></i>");
                    printf("<a href=\"../../../%d\">%s</a>", $corso->getId(), $corso->getNome());
                    printf("<i class=\"fa fa-angle-right\"></i>");
                    printf("</li>");
                    printf("<li>");
                    printf("<i></i>");
                    printf("<a href=\"\">%s</a>", $argomento->getNome());
                    printf("<i class=\"fa fa-angle-right\"></i>");
                    printf("</li>");
                    ?>
                </ul>
            </div>

            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <!-- Da scegliere quali pulsanti lasciare
            <div class="row">

                <div class="col-md-offset-3 col-md-3">
                    <?php
                    printf("<a href=\"inserisciaperta/%d\" class=\"btn sm green-jungle\">", $idArgomento);
                    ?>
                    <i class="fa fa-plus"></i> Nuova Domanda Aperta
                    </a>
               </div>
                <div class="col-md-3">
                    <?php
                    printf("<a href=\"inseriscimultipla/%d\" class=\"btn sm green-jungle\">", $idArgomento);
                    ?>
                    <i class="fa fa-plus"></i> Nuova Domanda Multipla
                    </a>
                </div>
            </div>
            <br> -->

            <!--INIZIO TABELLA DOMANDE APERTE-->
            <div class="portlet box blue-madison">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-book"></i>Domande Aperte
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title="">
                        </a>
                    </div>
                    <div class="actions">
                        <?php
                        printf("<a href=\"inserisciaperta/%d\" class=\"btn btn-default btn-sm\">", $idArgomento);
                        ?>
                        <i class="fa fa-plus"></i> Nuova Domanda Aperta
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <?php
                    $domandeAperte = $domandaController->getAllAperte($idArgomento, $idCorso);
                    foreach ($domandeAperte as $d) {
                        printf("<div class=\"portlet\">");
                        printf("<div class=\"portlet-title \">");
                        printf("<div class=\"caption\">");
                        printf("<i class=\"fa fa-file-o\"></i>%s", $d->getTesto());
                        printf("</div>");
                        printf("<form method=\"post\" action=\"\" class=\"actions\">");
                        printf("<a href=\"modificaaperta/%d/%d\" class=\"btn green-jungle\"><i class=\"fa fa-edit\"></i> Modifica </a>", $idArgomento, $d->getId());
                        printf("<button class=\"btn sm red-intense\" type=\"submit\" name=\"domanda\" value=\"%d\"><i class=\"fa fa-remove\"></i> Rimuovi </button>", $d->getId());
                        printf("</form>");
                        printf("</div>");
                        printf("</div>");
                    }
                    ?>
                </div>
            </div>

            <!--FINE TABELLA DOMANDE APERTE-->
            <!--INIZIO TABELLA DOMANDE MULTIPLE-->
            <div class="portlet box blue-madison">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-book"></i>Domande Multiple
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title="">
                        </a>
                    </div>
                    <div class="actions">
                        <?php
                        printf("<a href=\"inseriscimultipla/%d\" class=\"btn btn-default btn-sm\">", $idArgomento);
                        ?>
                        <i class="fa fa-plus"></i> Nuova Domanda Multipla
                        </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <?php
                    $domandeMultiple = $domandaController->getAllMultiple($idArgomento, $idCorso);
                    foreach ($domandeMultiple as $d) {
                        $risposte = $alternativaController->getAllAlternativa($d->getId(), $d->getArgomentoId(), $d->getArgomentoCorsoId());

                        printf("<div class=\"portlet \">");
                        printf("<div class=\"portlet-title\">");
                        printf("<div class=\"caption\">");
                        printf("<i class=\"fa fa-file-o\"></i>%s", $d->getTesto());
                        printf("</div>");
                        printf("<div class=\"tools\">");
                        printf("<a href=\"javascript:;\" class=\"collapse\" data-original-title=\"\" title=\"\"></a>");
                        printf("</div>");
                        printf("<div class=\"actions\">");
                        printf("<a href=\"javascript:;\" class=\"btn green-jungle\"><i class=\"fa fa-edit\"></i> Modifica </a>");
                        printf("<a href=\"javascript:;\" class=\"btn red-intense\"><i class=\"fa fa-remove\"></i> Rimuovi </a>");
                        printf("</div>");
                        printf("</div>");
                        printf("<div class=\"portlet-body\">");
                        printf("<div id=\"tabella_domanda1_wrapper\" class=\"dataTables_wrapper no-footer\">");
                        printf("<table class=\"table table-striped table-bordered table-hover dataTable no-footer\"id=\"tabella_domanda1\" role=\"grid\" aria-describedby=\"tabella_domanda1_info\">");
                        printf("<tbody>");
                        foreach ($risposte as $r) {
                            printf("<tr class=\"gradeX odd\" role=\"row\">");
                            printf("<td width='30'>");
                            printf("<input type=\"checkbox\" disabled=\"\" checked=\"\">");
                            printf("</td>");
                            printf("<td>%s</td>", $r->getTesto());
                            printf("</tr>");
                        }
                        printf("</tbody>");
                        printf("</table>");
                        printf("</div>");
                        printf("</div>");
                        printf("</div>");
                    }
                    ?>
                </div>
            </div>
            <!--FINE TABELLA DOMANDE APERTE-->

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
<!-- BEGIN PAGE LEVEL PLUGINS aggiunta da me-->
<script type="text/javascript" src="/assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript"
        src="/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS aggiunta da me-->
<!-- BEGIN aggiunta da me -->
<script src="/assets/admin/pages/scripts/table-managed.js"></script>
<!-- END aggiunta da me -->
<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        //QuickSidebar.init(); // init quick sidebar
        //Demo.init(); // init demo features
        TableManaged2.init("tabella_domanda1", "tabella_domanda1_wrapper");
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
