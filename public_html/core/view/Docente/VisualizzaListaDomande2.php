<?php
/**
 * Created by PhpStorm.
 * User: Pasquale
 * Date: 18/11/15
 * Time: 09:58
 */
include_once MODEL_DIR . "DomandaModel.php";
include_once MODEL_DIR . "ArgomentoModel.php";
include_once MODEL_DIR . "CdLModel.php";
include_once MODEL_DIR . "AlternativaModel.php";
include_once MODEL_DIR . "UtenteModel.php";
include_once MODEL_DIR . "CorsoModel.php";
include_once UTILS_DIR . "controlloLogin.php";

$utenteLoggato = $_SESSION['user'];


$modelAccount = new UtenteModel();
$modelDomanda = new DomandaModel();
$modelAlternativa = new AlternativaModel();
$modelArgomento = new ArgomentoModel();
$modelCdl = new CdLModel();
$modelCorso = new CorsoModel();

$corso = null;
$argomento = null;
$idCorso = $_URL[2];
$idArgomento = $_URL[5];
$correttezzaLogin = false;

if(isset($_SESSION['idcorso'])){
    unset($_SESSION['idcorso']);
    $_SESSION['idcorso'] = $_URL[2];
}else{
    $_SESSION['idcorso'] = $_URL[2];
}

controllo();

/**
 * LEGGE IL CORSO NEL QUALE CI SI TROVA
 */
try{
    $corso = $modelCorso->readCorso($idCorso);
}catch(ApplicationException $exception){
    echo "ERRORE IN READ CORSO" . $exception;
}

/**
 * LEGGE L'ARGOMENTO PRECEDENTEMENTE SELEZIONATO
 */
try{
    $argomento = $modelArgomento->readArgomento($idArgomento);
}catch(ApplicationException $exception){
    echo "ERRORE IN READ ARGOMENTO" . $exception;
}

/**
 * RICEVE LA MATRICOLA DEL DOCENTE LOGGATO
 */
try{
    $matricolaLoggato = $utenteLoggato->getMatricola();
}catch(ApplicationException $exception){
    echo "ERRORE IN GET MATRICOLA" . $exception;
}

/**
 * RICEVE I DOCENTE ASSOCIATI AL CORSO NEL QUALE CI SI TROVA
 */
try{
    $docentiAssociati = $modelAccount->getAllDocentiByCorso($idCorso);
}catch(ApplicationException $exception){
    echo "ERRORE IN GET DOCENTE ASSOCIATI" . $exception;
}

/**
 * CONTROLLA SE NEI DOCENTI ASSOCIATI E' PRESENTE IL DOCENTE LOGGATO
 */
foreach($docentiAssociati as $docente){
    if($docente->getMatricola() == $matricolaLoggato){
        $correttezzaLogin = true;
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
    <?php
    printf("<title>%s</title>", $argomento->getNome());
    ?>
    <?php include VIEW_DIR . "design/header.php"; ?>
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/bootstrap-toastr/toastr.min.css">
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
                Lista Domande
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
                    printf("%s", $argomento->getNome());
                    printf("</li>");
                    ?>
                </ul>
            </div>

            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->


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
                    <?php
                    if($correttezzaLogin==true) {
                        printf("<div class=\"actions\">");
                        printf("<a href=\"/docente/corso/%d/argomento/domande/inserisciaperta/%d\" class=\"btn btn-default btn-sm\">", $idCorso, $idArgomento);
                        printf("<i class=\"fa fa-plus\"></i> Nuova Domanda Aperta");
                        printf("</a>");
                        printf("</div>");
                    }
                    ?>
                </div>
                <div class="portlet-body">
                    <?php
                    $domandeAperte = $modelDomanda->getAllDomandaApertaByArgomento($idArgomento);
                    foreach ($domandeAperte as $d) {
                        printf("<div class=\"portlet\">");
                        printf("<div class=\"portlet-title \">");

                        printf("<div class=\"col-md-6 caption\">");
                        printf("<i class=\"fa fa-file-o\"></i> %s", base64_decode($d->getTesto()));
                        printf("</div>");
                        printf("Punteggio Massimo: %s", $d->getPunteggioMax());
                        if($correttezzaLogin==true) {
                            printf("<form method=\"post\" action=\" /docente/rimuoviaperta \" class=\"actions\">");
                            printf("<a href=\"/docente/corso/%d/argomento/domande/modificaaperta/%d/%d\" class=\"btn green-jungle\"><i class=\"fa fa-edit\"></i> Modifica </a>", $idCorso, $idArgomento, $d->getId());
                            printf("<button class=\"btn sm red-intense\" data-toggle=\"confirmation\" data-singleton=\"true\" data-popout=\"true\" title=\"Sei sicuro?\" type=\"submit\" name=\"domandaaperta\" value=\"%d\"><i class=\"fa fa-remove\"></i> Rimuovi </button>", $d->getId());
                            printf("<input type='hidden' name='idcorso' value='%s'>", $idCorso);
                            printf("<input type='hidden' name='idargomento' value='%s'>", $idArgomento);
                            printf("</form>");
                        }
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
                    <?php
                    if($correttezzaLogin==true) {
                        printf("<div class=\"actions\" >");
                        printf("<a href=\"/docente/corso/%d/argomento/domande/inseriscimultipla/%d\" class=\"btn btn-default btn-sm\">", $idCorso, $idArgomento);
                        printf("<i class=\"fa fa-plus\" ></i > Nuova Domanda Multipla");
                        printf("</a>");
                        printf("</div>");
                    }
                    ?>
                </div>
                <div class="portlet-body">
                    <?php
                    $domandeMultiple = $modelDomanda->getAllDomandaMultiplaByArgomento($idArgomento);
                    foreach ($domandeMultiple as $d) {
                        $risposte = $modelAlternativa->getAllAlternativaByDomanda($d->getId());

                        printf("<div class=\"portlet \">");
                        printf("<div class=\"portlet-title\">");
                        printf("<div class=\"col-md-5 caption\">");
                        printf("<i class=\"fa fa-file-o\"></i> %s", base64_decode($d->getTesto()));
                        printf("</div>");
                        printf("Punteggio Corretta: %s ", $d->getPunteggioCorretta());
                        printf("Punteggio Errata: %s", $d->getPunteggioErrata());
                        printf("<div class=\"tools\">");
                        printf("<a href=\"javascript:;\" class=\"collapse\" data-original-title=\"\" title=\"\"></a>");
                        printf("</div>");

                        if($correttezzaLogin==true) {
                            printf("<form method=\"post\" action=\"/docente/rimuovimultipla\" class=\"actions\">");
                            printf("<a href=\"/docente/corso/%d/argomento/domande/modificamultipla/%d/%d\" class=\"btn green-jungle\"><i class=\"fa fa-edit\"></i> Modifica </a>", $idCorso, $idArgomento, $d->getId());
                            printf("<button class=\"btn sm red-intense\" data-toggle=\"confirmation\" data-singleton=\"true\" data-popout=\"true\" title=\"Sei sicuro?\" type=\"submit\" name=\"domandamultipla\" value=\"%d\"><i class=\"fa fa-remove\"></i> Rimuovi </button>", $d->getId());
                            printf("<input type='hidden' name='idcorso' value='%s'>", $idCorso);
                            printf("<input type='hidden' name='idargomento' value='%s'>", $idArgomento);
                        }
                        printf("</div>");
                        printf("</form>");
                        printf("<div class=\"portlet-body\">");
                        printf("<div id=\"tabella_domanda1_wrapper\" class=\"dataTables_wrapper no-footer\">");
                        printf("<table class=\"table table-striped table-bordered table-hover dataTable no-footer\"id=\"tabella_domanda1\" role=\"grid\" aria-describedby=\"tabella_domanda1_info\">");
                        printf("<tbody>");

                        foreach ($risposte as $r) {
                            printf("<tr class=\"gradeX odd\" role=\"row\">");
                            printf("<td width='30'>");
                            if(!strcmp($r->getCorretta(),'Si')){
                                printf("<input type=\"checkbox\" disabled=\"\" checked=\"\">");
                            } else  {
                                printf("<input type=\"checkbox\" disabled=\"\">");
                            }
                            printf("</td>");
                            printf("<td>%s</td>", base64_decode($r->getTesto()));
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
        checkNotifiche();

    });
</script>

<script>
    function checkNotifiche(){
        var href = window.location.href;
        var last = href.substr(href.lastIndexOf('/') + 1);
        if(last == 'successinserimento'){
            toastr.success('Inserimento avvenuto correttamente!', 'Inserimento');
        }else if(last == 'successmodifica'){
            toastr.success('Modifica avvenuta correttamente!', 'Modifica');
        }else if(last == 'successelimina'){
            toastr.success('Eliminazione avvenuta correttamente!', 'Eliminazione');
        }
    }
</script>


<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
