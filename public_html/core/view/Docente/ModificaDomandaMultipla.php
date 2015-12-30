<?php
/**
 * Created by PhpStorm.
 * User: Carlo, Pasquale
 * Date: 18/11/15
 * Time: 09:58
 */
include_once MODEL_DIR . "DomandaModel.php";
include_once MODEL_DIR . "ArgomentoModel.php";
include_once MODEL_DIR . "CdlModel.php";
include_once MODEL_DIR . "AlternativaModel.php";
include_once MODEL_DIR . "UtenteModel.php";
include_once MODEL_DIR . "CorsoModel.php";

$utenteLoggato = $_SESSION['user'];

$errore = 0;
if(isset($_SESSION['errore'])){
    $errore = $_SESSION['errore'];
    unset($_SESSION['errore']);
}

$modelCdl = new CdLModel();
$modelCorso = new CorsoModel();
$modelDomanda = new DomandaModel();
$modelArgomento = new ArgomentoModel();
$modelAlternativa = new AlternativaModel();
$modelUtente = new UtenteModel();

$idCorso = $_URL[2];
$idArgomento = $_URL[6];
$idDomanda = $_URL[7];

$corso = null;
$argomento = null;
$domandaOld = null;
$alternative = null;
$correttezzaLogin = false;


//CONTROLLO LOGIN CORRETTO
try{
    $matricolaLoggato = $utenteLoggato->getMatricola();
}catch(ApplicationException $exception){
    echo "ERRORE IN GET MATRICOLA" . $exception;
}

try{
    $docentiAssociati = $modelUtente->getAllDocentiByCorso($idCorso);
}catch(ApplicationException $exception){
    echo "ERRORE IN GET DOCENTE ASSOCIATI" . $exception;
}

foreach($docentiAssociati as $docente){
    if($docente->getMatricola() == $matricolaLoggato){
        $correttezzaLogin = true;
    }
}

if($correttezzaLogin == false){
    header('Location: /docente');
}




try {
    $corso = $modelCorso->readCorso($idCorso);
} catch (ApplicationException $exception) {
    echo "ERRORE IN READ CORSO" . $exception;
}
try {
    $argomento = $modelArgomento->readArgomento($idArgomento);
} catch (ApplicationException $exception) {
    echo "ERRORE IN READ ARGOMENTO" . $exception;
}
try {
    $domandaOld = $modelDomanda->readDomandaMultipla($idDomanda);
} catch (ApplicationException $exception) {
    echo "ERRORE IN GET DOMANDA MULTIPLA" . $exception;
}
try {
    $alternative = $modelAlternativa->getAllAlternativaByDomanda($idDomanda);
} catch (ApplicationException $exception) {
    echo "ERRORE IN GET ALL ALTERNATIVE" . $exception;
}

$numRisposte = count($alternative);

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
                    printf("<a href=\"/docente/cdl/%s\">%s</a>", $corso->getCdlMatricola(), $modelCdl->readCdl($corso->getCdlMatricola())->getNome());
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
            <form id="form_sample_2" method="post" action="/docente/modificamultipla" class="form-horizontal form-bordered">
                <?php
                if($errore == 1){
                    echo "<div class=\"alert alert-danger\"><button class=\"close\" data-close=\"alert\"></button>La lunghezza del testo della domanda dev'essere compreso tra 2 e 500!</div>";
                }else if($errore == 2){
                    echo "<div class=\"alert alert-danger\"><button class=\"close\" data-close=\"alert\"></button>Il punteggio esatto dev'essere > 0! </div>";
                }else if($errore == 3){
                    echo "<div class=\"alert alert-danger\"><button class=\"close\" data-close=\"alert\"></button>Il punteggio errato dev'essere < 0! </div>";
                }else if($errore == 4){
                    echo "<div class=\"alert alert-danger\"><button class=\"close\" data-close=\"alert\"></button>La lunghezza delle risposte dev'essere compresa tra 1 e 100! </div>";
                }else if($errore == 5){
                    echo "<div class=\"alert alert-danger\"><button class=\"close\" data-close=\"alert\"></button>Devi selezionare l'alternativa corretta! </div>";
                }

                ?>
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
                                <div class="col-md-3">
                                    <?php
                                    printf("<a href=\"javascript:insRisposte();\" class=\"btn sm green-jungle\"><i class=\"fa fa-plus\"></i> Aggiungi Risposta</a>");
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
                                    <input type="hidden" name="idargomento" value="<?php echo $idArgomento; ?>">
                                    <input type="hidden" name="idcorso" value="<?php echo $idCorso; ?>">
                                    <input type="hidden" name="iddomanda" value="<?php echo $idDomanda; ?>">
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
            "<label id=\"label"+num+"\" for=\"radio"+num+"\"><span></span><span class=\"check\"></span><span class=\"box\"></span>"+
            "</label></div></div></div></div></div>" +
            "<label class=\"control-label col-md-2\">Inserisci Testo Risposta</label><div class=\"col-md-6\"><input type=\"text\" name=\"risposteNuove[]\" placeholder=\"\" class=\"form-control\"> <span class=\"help-block\"></span> </div> <div class=\"col-md-3\" id=\"padre"+num+"\"><a onclick=\"javascript:elimina(this)\" id=\"el"+num+"\" class=\"btn sm red-intense\"> <i class=\"fa fa-minus\"></i> Rimuovi </a> </div> </div>";
        num++;
    }

    function elimina(btn) {

        var idAttuale = btn.getAttribute('id');
        var numAttuale = idAttuale.substr(2);

        var daEliminare = btn.parentNode.parentNode.parentNode;
        daEliminare.parentNode.removeChild(daEliminare);


        if(numAttuale >= num){}
        else {
            for (i = numAttuale; i < (num-1); i++) {

                var div = document.getElementById('form' + (parseInt(i) + 1));
                div.setAttribute('id', 'form' + i);

                var label = document.getElementById('label' + (parseInt(i) + 1));
                label.setAttribute('id', 'label' + i);
                label.setAttribute('for','radio' + i);


                var radio = document.getElementById('radio' + (parseInt(i) + 1));
                radio.setAttribute('id', 'radio' + i);
                radio.setAttribute('value', '' + i);

                var el = document.getElementById('el' + (parseInt(i) + 1));
                el.setAttribute('id', 'el' + i);
            }
            num--;
        }
    }


</script>

<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
