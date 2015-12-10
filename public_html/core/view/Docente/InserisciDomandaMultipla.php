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
$corso = null;
$argomento = null;

try {
    $corso = $cdlController->readCorso($idCorso);
} catch (ApplicationException $exception) {
    echo "ERRORE IN READ CORSO" . $exception;
}

try {
    $argomento = $argomentoController->readArgomento($idArgomento, $idCorso);
} catch (ApplicationException $exception) {
    echo "ERRORE IN READ ARGOMENTO" . $exception;
}


if (isset($_POST['testoDomanda']) && isset($_POST['punteggioErrata']) && isset($_POST['punteggioEsatta']) && isset($_POST['testoRisposta'])) {

    $testoDomanda = $_POST['testoDomanda'];
    $punteggioErrata = $_POST['punteggioErrata'];
    $punteggioEsatta = $_POST['punteggioEsatta'];
    $testoRisposte = $_POST['testoRisposta'];
    $radio = $_POST['radio'];

    $nuovaDomanda = new DomandaMultipla($idArgomento, $testoDomanda, $punteggioEsatta, $punteggioErrata, 0, 0);

    try {
        $idNuovaDomanda = $domandaController->creaDomandaMultipla($nuovaDomanda);
    } catch (ApplicationException $exception) {
        echo "ERRORE IN CREA DOMANDA MULTIPLA" . $exception;
    }
    for ($i = 0; $i < count($testoRisposte); $i++) {
        if (($i + 1) == $radio) {
            $corretta = "Si";
        } else {
            $corretta = "No";
        }
        $alternativa = new Alternativa($idNuovaDomanda, $testoRisposte[$i], 0, $corretta);
        try {
            $alternativaController->creaAlternativa($alternativa);
        } catch (ApplicationException $exception) {
            echo "ERRORE IN CREA ALTERNATIVA" . $exception;
        }
    }
    header('location: ../' . $idArgomento);
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
    <title>Inserisci Domanda Multipla</title>
    <?php include VIEW_DIR . "design/header.php"; ?>
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/bootstrap-toastr/toastr.min.css">
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-md page-header-fixed page-quick-sidebar-over-content" onload="primaRisposta()">
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
                Inserisci una nuova domanda a risposta multipla
            </h3>

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <?php
                    printf("<li>");
                    printf("<i class=\"fa fa-home\"></i>");
                    printf("<a href=\"../../../../../\">Home</a>");
                    printf("<i class=\"fa fa-angle-right\"></i>");
                    printf("</li>");
                    printf("<li>");
                    printf("<i></i>");
                    printf("<a href=\"../../../../../cdl/%s\">%s</a>", $corso->getCdlMatricola(), $cdlController->readCdl($corso->getCdlMatricola())->getNome());
                    printf("<i class=\"fa fa-angle-right\"></i>");
                    printf("</li>");
                    printf("<li>");
                    printf("<i></i>");
                    printf("<a href=\"../../../../%d\">%s</a>", $corso->getId(), $corso->getNome());
                    printf("<i class=\"fa fa-angle-right\"></i>");
                    printf("</li>");
                    printf("<li>");
                    printf("<i></i>");
                    printf("<a href=\"../%d\">%s</a>", $idArgomento, $argomento->getNome());
                    printf("<i class=\"fa fa-angle-right\"></i>");
                    printf("</li>");
                    printf("<li>");
                    printf("<i></i>");
                    printf("Inserisci Domanda");
                    printf("</li>");
                    ?>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <form id="form_sample_1" method="post" action="" class="form-horizontal form-bordered">
                <div class="portlet box blue-madison">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-edit"></i>Inserisci Domanda Multipla
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
                                    printf("<input type=\"text\" id=\"testoDomanda\" name=\"testoDomanda\" value=\"\" class=\"form-control\">");
                                    printf("<span class=\"help-block\">");
                                    printf("</span>");
                                    ?>
                                </div>
                            </div>


                            <div id="rispostenuove">

                            </div>


                            <div class="form-group form-md-line-input has-success" style="height: 100px">
                                <label class="control-label col-md-3">Inserisci Punteggio Esatta</label>

                                <div class="col-md-4">
                                    <?php
                                    printf("<input type=\"number\" id=\"punteggioDomandaEsatta\" name=\"punteggioEsatta\" value=\"\" class=\"form-control\">");
                                    printf("<span class=\"help-block\">");
                                    printf("</span>");
                                    ?>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input has-success" style="height: 100px">
                                <label class="control-label col-md-3">Inserisci Punteggio Errata</label>

                                <div class="col-md-4">
                                    <?php
                                    printf("<input type=\"number\" id=\"punteggioDomandaErrata\" name=\"punteggioErrata\" value=\"\" class=\"form-control\">");
                                    printf("<span class=\"help-block\">");
                                    printf("</span>");
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
                                    printf("<a href=\"../%d\" class=\"btn sm red-intense\">", $idArgomento);
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
<!-- BEGIN aggiunta da me -->
<script src="/assets/admin/pages/scripts/table-managed.js"></script>
<script src="/assets/admin/pages/scripts/form-validation.js"></script>
<script type="text/javascript" src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="/assets/global/plugins/jquery-validation/js/additional-methods.min.js"></script>

<script src="/assets/admin/pages/scripts/ui-confirmations.js"></script>
<script src="/assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js" type="text/javascript"></script>

<script src="/assets/admin/pages/scripts/ui-toastr.js"></script>
<script src="/assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>
<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        //QuickSidebar.init(); // init quick sidebar
        //Demo.init(); // init demo features
        TableManaged.init();
        FormValidation.init();
        UIConfirmations.init();
        UIToastr.init();
    });
</script>

<!-- PERMETTE DI INSERIRE LE RISPOSTE DINAMICAMENTE -->
<script>

    var num = 2;

    function primaRisposta() {
        var newDiv = document.createElement("DIV");
        var div = document.getElementById('rispostenuove');
        div.appendChild(newDiv);
        newDiv.innerHTML = "<div class=\"form-group form-md-line-input has-success ratio\" style=\"height: 90px\"><div class=\"control-label col-md-1\"><input type=\"radio\" name=\"radio\" value=\"1\" ></div><label class=\"control-label col-md-2\">Inserisci Testo Risposta</label><div class=\"col-md-6\"><input type=\"text\" id=\"risposte\" name=\"testoRisposta[]\" placeholder=\"\" class=\"form-control\"> <span class=\"help-block\"> </span> </div> <div class=\"col-md-3\"><a onclick=\"javascript:insRisposte()\" class=\"btn sm green-jungle\"><i class=\"fa fa-plus\"></i> Aggiungi </a> </div></div>";
    }


    function insRisposte() {
        var newDiv = document.createElement("DIV");
        newDiv.setAttribute("id", "form"+num);
        var div = document.getElementById('rispostenuove');
        var newNum = num;
        div.appendChild(newDiv);
        newDiv.innerHTML = "<div class=\"form-group form-md-line-input has-success ratio\" style=\"height: 90px\"><div class=\"control-label col-md-1\"><input type=\"radio\" name=\"radio\" value=" + num + " ></div><label class=\"control-label col-md-2\">Inserisci Testo Risposta</label><div class=\"col-md-6\"><input type=\"text\" id=\"risposte\" name=\"testoRisposta[]\" placeholder=\"\" class=\"form-control\"> <span class=\"help-block\"></span> </div> <div class=\"col-md-3\" id=\"padre"+num+"\"><a onclick=\"javascript:elimina(this)\" id=\"el"+num+"\" class=\"btn sm red-intense\"> <i class=\"fa fa-minus\"></i> Rimuovi </a> </div> </div>";
        if(num != 2) {
            var daEl = document.getElementById('el' + (newNum - 1));
            daEl.parentNode.removeChild(daEl);
        }
        num++;
    }

    function elimina(btn) {
        var newNum = num;
        if(num > 3) {
            var daAg = document.getElementById('padre' + (newNum - 2));
            daAg.innerHTML = "<a onclick=\"javascript:elimina(this)\" id=\"el" + (newNum - 2) + "\" class=\"btn sm red-intense\"> <i class=\"fa fa-minus\"></i> Rimuovi </a> ";
        }
        var daEl = document.getElementById("form"+(num-1));

        daEl.parentNode.removeChild(daEl);
        num--;
    }


</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>