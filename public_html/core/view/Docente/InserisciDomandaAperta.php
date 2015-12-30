<?php
/**
 * Created by PhpStorm.
 * User: Pasquale
 * Date: 18/11/15
 * Time: 09:58
 */
include_once MODEL_DIR . "DomandaModel.php";
include_once MODEL_DIR . "ArgomentoModel.php";
include_once MODEL_DIR . "CdlModel.php";
include_once MODEL_DIR . "UtenteModel.php";
include_once MODEL_DIR . "CorsoModel.php";

$utenteLoggato = $_SESSION['user'];

$errore = 0;
if(isset($_SESSION['errore'])){
    $errore = $_SESSION['errore'];
    unset($_SESSION['errore']);
}

$modelAccount = new UtenteModel();
$modelArgomento = new ArgomentoModel();
$modelDomanda = new DomandaModel();
$modelCdl = new CdLModel();
$modelCorso = new CorsoModel();

$corso = null;
$argomento = null;
$idCorso = $_URL[2];
$idArgomento = $_URL[6];
$correttezzaLogin = false;

/**
 * LEGGE IL CORSO NEL QUALE CI SI TROVA
 */
try {
    $corso = $modelCorso->readCorso($idCorso);
} catch (ApplicationException $exception) {
    echo "ERRORE IN READ CORSO" . $exception;
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
    $docentiAssociati = $modelAccount->getAllDocentiByCorso($corso->getId());
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
/**
 * CONTROLLA IL CORRETTO LOGIN DEL DOCENTE AL CORSO DA LUI INSEGNATO
 */
if($correttezzaLogin == false){
    header('Location: /docente');
}

try {
    $argomento = $modelArgomento->readArgomento($idArgomento);
} catch (ApplicationException $exception) {
    echo "ERRORE IN READ ARGOMENTO" . $exception;
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
    <title>Inserisci Domanda Aperta</title>
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
                Inserisci una nuova domanda a risposta aperta
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
                    printf("<a href=\"/docente/corso/%d\">%s</a>", $idCorso, $corso->getNome());
                    printf("<i class=\"fa fa-angle-right\"></i>");
                    printf("</li>");
                    printf("<li>");
                    printf("<i></i>");
                    printf("<a href=\"/docente/corso/%d/argomento/domande/%d\">%s</a>",$idCorso, $idArgomento, $argomento->getNome());
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
            <!-- BEGIN FORM-->
            <form id="form_sample_1" method="post" action="/docente/inserisciaperta" class="form-horizontal form-bordered">

                <?php
                if($errore == 1){
                    echo "<div class=\"alert alert-danger\"><button class=\"close\" data-close=\"alert\"></button>La lunghezza del testo della domanda dev'essere compreso tra 2 e 500!</div>";
                }else if($errore == 2){
                    echo "<div class=\"alert alert-danger\"><button class=\"close\" data-close=\"alert\"></button>Il punteggio dev'essere > 0! </div>";
                }

                ?>

                <div class="portlet box blue-madison">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-edit"></i>Inserisci Domanda Aperta
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="form-body">
                            <div class="form-group form-md-line-input has-success" style="height: 90px">
                                <label class="control-label col-md-3">Inserisci Testo Domanda</label>

                                <div class="col-md-6">
                                    <input type="text" name="testoDomanda" id="testoDomanda" placeholder=""
                                           class="form-control">
                                            <span class="help-block">
                                                </span>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input has-success" style="height: 90px">
                                <label class="control-label col-md-3">Inserisci Punteggio</label>

                                <div class="col-md-4">
                                    <input type="punteggioEsatta" id="punteggioDomanda" name="punteggioEsatta" placeholder=""
                                           class="form-control">
                                    <input type="hidden" name="idargomento" value="<?php echo $idArgomento; ?>">
                                    <input type="hidden" name="idcorso" value="<?php echo $idCorso; ?>">
                                            <span class="help-block">
                                                 </span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="form-action">
                    <div class="row">
                        <div class="col-md-12">
                            <button class="btn sm green-jungle" type="submit">Conferma</button>

                            </a>
                            <?php
                            printf("<a href=\"/docente/corso/%d/argomento/domande/%d\" class=\"btn sm red-intense\">", $idCorso, $idArgomento);
                            ?>
                            Annulla
                            </a>
                        </div>
                    </div>
                </div>
            </form>
            <!-- END FORM-->
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

<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
