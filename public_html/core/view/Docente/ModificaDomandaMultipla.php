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

$idCorso = $_URL[2];
$idArgomento = $_URL[6];
$idDomanda = $_URL[7];

$corso = null;
$argomento = null;
$domandaOld = null;
$alternative = null;

try {
    $corso = $cdlController->readCorso($idCorso);
} catch (ApplicationException $exception) {
    echo "ERRORE IN READ CORSO" . $exception;
}
try {
    $argomento = $argomentoController->readArgomento($idArgomento, $idCorso); //Chiedere se deve essere modificato
} catch (ApplicationException $exception) {
    echo "ERRORE IN READ ARGOMENTO" . $exception;
}
try {
    $domandaOld = $domandaController->getDomandaMultipla($idDomanda);
} catch (ApplicationException $exception) {
    echo "ERRORE IN GET DOMANDA MULTIPLA" . $exception;
}
try {
    $alternative = $alternativaController->getAllAlternativaByDomanda($idDomanda);
} catch (ApplicationException $exception) {
    echo "ERRORE IN GET ALL ALTERNATIVE" . $exception;
}

$numRisposte = count($alternative);

if (isset($_POST['eliminatore'])) {
    $idArgomentoDaEliminare = $_POST['eliminatore'];
    try {
        $alternativaController->rimuoviAlternativa($idArgomentoDaEliminare);
    } catch (ApplicationException $exception) {
        echo "ERRORE IN RIMUOVI ALTERNATIVA" . $exception;
    }
    header("Location: /docente/corso/" . $idCorso . "/argomento/domande/modificamultipla/" . $idArgomento . "/" . $idDomanda ."/successelimina");

} else {

    if (isset($_POST['testoDomanda']) && isset($_POST['punteggioErrata']) && isset($_POST['punteggioEsatta']) && isset($_POST['testoRisposta']) && isset($_POST['radio'])) {
        $testoDomanda = $_POST['testoDomanda'];
        $punteggioErrata = $_POST['punteggioErrata'];
        $punteggioEsatta = $_POST['punteggioEsatta'];
        $testoRisposte = $_POST['testoRisposta'];
        $radio = $_POST['radio'];

        $updatedDomanda = new DomandaMultipla($idArgomento, $testoDomanda, $punteggioEsatta, $punteggioErrata, 0, 0);

        try {
            $domandaController->modificaDomandaMultipla($idDomanda, $updatedDomanda);
        } catch (ApplicationException $exception) {
            echo "ERRORE IN MODIFICA DOMANDA MULTIPLA" . $exception;
        }

        for ($i = 0; $i < count($testoRisposte); $i++) {
            $idAlternativa = $alternative[$i]->getId();
            if (($i + 1) == $radio) {
                $corretta = "Si";
            } else {
                $corretta = "No";
            }

            $updatedAlternativa = new Alternativa($idDomanda, $testoRisposte[$i], 0, $corretta);
            try {
                $alternativaController->modificaAlternativa($idAlternativa, $updatedAlternativa);
            } catch (ApplicationException $exception) {
                echo "ERRORE MODIFICA ALTERNATIVA" . $exception;
            }
        }

        if (isset($_POST['risposteNuove'])) {
            $rispostenuove = $_POST['risposteNuove'];
            $prevCount = count($testoRisposte);
            foreach ($rispostenuove as $item) {
                if ($item == null || $item == '') {
                    continue;
                } else{
                    if (++$prevCount == $radio) {
                        $corretta2 = "Si";
                    } else {
                        $corretta2 = "No";
                    }
                $nuovaAlternativa = new Alternativa($idDomanda, $item, 0, $corretta2);
                try {
                    $alternativaController->creaAlternativa($nuovaAlternativa);
                } catch (ApplicationException $exception) {
                    echo "ERRORE IN CREA ALTERNATIVA" . $exception;
                }
              }
            }
        }

        header('Location: /docente/corso/'. $corso->getId() .'/argomento/domande/'. $argomento->getId() .'/successmodifica');
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
    <?php include VIEW_DIR . "design/header.php"; ?>
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/bootstrap-toastr/toastr.min.css">
    <!--    <link href="/assets/global/plugins/icheck/skins/all.css" rel="stylesheet" type="text/css"/>-->

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
                Modifica una domanda a risposta multipla
            </h3>

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <?php
                    printf("<li>");
                    printf("<i class=\"fa fa-home\"></i>");
                    printf("<a href=\"/docente\">Home</a>");
                    printf("<i class=\"fa fa-angle-right\"></i>");
                    printf("</li>");
                    printf("<li>");
                    printf("<i></i>");
                    printf("<a href=\"/docente/cdl/%s\">%s</a>", $corso->getCdlMatricola(), $cdlController->readCdl($corso->getCdlMatricola())->getNome());
                    printf("<i class=\"fa fa-angle-right\"></i>");
                    printf("</li>");
                    printf("<li>");
                    printf("<i></i>");
                    printf("<a href=\"/docente/corso/%d\">%s</a>", $corso->getId(), $corso->getNome());
                    printf("<i class=\"fa fa-angle-right\"></i>");
                    printf("</li>");
                    printf("<li>");
                    printf("<i></i>");
                    printf("<a href=\"/docente/corso/%d/argomento/domande/%d\">%s</a>",$idCorso, $idArgomento, $argomento->getNome());
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
            <form id="form_sample_1" method="post" action="" class="form-horizontal form-bordered">
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
                                    printf("</span>");
                                    ?>
                                </div>
                            </div>
                            <?php
                            $numRadio = 1;
                            foreach ($alternative as $r) {
                                printf("<div class=\"form-group form-md-line-input has-success ratio\" style=\"height: 100px\">");
                                printf("<div class=\"col-md-1\"><div class=\"col-md-offset-6 col-md-6\">");
                                printf("<div class=\"form-md-radios\"><div class=\"md-radio-list\"><div class=\"md-radio\">");
                                if (!strcmp($r->getCorretta(), "Si")) {
                                    printf("<input type=\"radio\" checked=\"\" id=\"radio%d\" value = \"%d\" name = \"radio\" class=\"md-radiobtn\" >",$numRadio, $numRadio);
                                } else {
                                    printf("<input type=\"radio\" id=\"radio%d\" value = \"%d\" name = \"radio\" class=\"md-radiobtn\" >",$numRadio, $numRadio);
                                }
                                printf("<label for=\"radio%d\"><span ></span ><span class=\"check\" ></span ><span class=\"box\" ></span >",$numRadio);
                                printf("</label></div></div></div></div></div>");
                                printf("<label class=\"control-label col-md-2\">");
                                printf("Inserisci Testo Risposta</label>");
                                printf("<div class=\"col-md-6\">");
                                printf("<input type=\"text\" value=\"%s\" id=\"risposte\" name=\"testoRisposta[]\" class=\"form-control\">", $r->getTesto());
                                printf("<span class=\"help-block\">");
                                printf("</span>");
                                printf("</div>");
                                printf("<div class=\"col-md-3\">");
                                printf("<a href=\"javascript:insRisposte();\" class=\"btn sm green-jungle\">");
                                printf("<i class=\"fa fa-plus\"></i> Aggiungi");
                                printf("</a>");
                                printf("<button name=\"eliminatore\" value=\"%s\" class=\"btn sm red-intense\" data-toggle=\"confirmation\" data-singleton=\"true\" data-popout=\"true\" title=\"sei sicuro?\">", $r->getId());
                                printf("<i class=\"fa fa-minus\"></i> Rimuovi");
                                printf("</button>");
                                printf("</div>");
                                printf("</div>");
                                $numRadio++;
                            }
                            ?>
                            <div id="rispostenuove">

                            </div>


                            <div class="form-group form-md-line-input has-success" style="height: 100px">
                                <label class="control-label col-md-3">Inserisci Punteggio Esatta</label>

                                <div class="col-md-4">
                                    <?php
                                    printf("<input type=\"number\" id=\"punteggioDomandaEsatta\" name=\"punteggioEsatta\" value=\"%d\" class=\"form-control\">", $domandaOld->getPunteggioCorretta());
                                    printf("<span class=\"help-block\">");
                                    printf("</span>");
                                    ?>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input has-success" style="height: 100px">
                                <label class="control-label col-md-3">Inserisci Punteggio Errata</label>

                                <div class="col-md-4">
                                    <?php
                                    printf("<input type=\"number\" id=\"punteggioDomandaErrata\" name=\"punteggioErrata\" value=\"%d\" class=\"form-control\">", $domandaOld->getPunteggioErrata());
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
                                    printf("<a href=\"/docente/corso/%d/argomento/domande/%d\" class=\"btn sm red-intense\">", $idCorso, $idArgomento);
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
<script src="/assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js"
        type="text/javascript"></script>
<!--<script src="/assets/global/plugins/icheck/icheck.js" type="text/javascript"></script>-->

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
        checkNotifiche();
    });
</script>

<script>
    function checkNotifiche(){
        var href = window.location.href;
        var last = href.substr(href.lastIndexOf('/') + 1);
        if(last == 'successelimina'){
            toastr.success('Risposta eliminata correttamente!', 'Eliminazione');
        }
    }
</script>


<script>

    var num = <?php echo $numRisposte+1; ?>;
    var numRispOld = num;


    function insRisposte() {
        var newDiv = document.createElement("DIV");
        newDiv.setAttribute("id", "form" + num);
        var div = document.getElementById('rispostenuove');
        var newNum = num;
        div.appendChild(newDiv);
        newDiv.innerHTML = "<div class=\"form-group form-md-line-input has-success ratio\" style=\"height: 90px\">"+
            "<div class=\"col-md-1\"><div class=\"col-md-offset-6 col-md-6\"><div class=\"form-md-radios\"><div class=\"md-radio-list\"><div class=\"md-radio\">"+
            "<input type=\"radio\" id=\"radio"+num+"\" value=\""+num+"\" name=\"radio\" class=\"md-radiobtn\">"+
            "<label for=\"radio"+num+"\"><span></span><span class=\"check\"></span><span class=\"box\"></span>"+
            "</label></div></div></div></div></div>" +
            "<label class=\"control-label col-md-2\">Inserisci Testo Risposta</label><div class=\"col-md-6\"><input type=\"text\" name=\"risposteNuove[]\" placeholder=\"\" class=\"form-control\"> <span class=\"help-block\"></span> </div> <div class=\"col-md-3\" id=\"padre"+num+"\"><a onclick=\"javascript:elimina(this)\" id=\"el"+num+"\" class=\"btn sm red-intense\"> <i class=\"fa fa-minus\"></i> Rimuovi </a> </div> </div>";
        if (num > (numRispOld)) {
            var daEl = document.getElementById('el' + (newNum - 1));
            daEl.parentNode.removeChild(daEl);
        }
        //$("#ich").iCheck();
        num++;
    }

    function elimina(btn) {
        var newNum = num;
        if (num > numRispOld + 1) {
            var daAg = document.getElementById('padre' + (newNum - 2));
            daAg.innerHTML = "<a onclick=\"javascript:elimina(this)\" id=\"el" + (newNum - 2) + "\" class=\"btn sm red-intense\"> <i class=\"fa fa-minus\"></i> Rimuovi </a> ";
        }
        var daEl = document.getElementById("form" + (num - 1));

        daEl.parentNode.removeChild(daEl);
        num--;
    }


</script>

<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
