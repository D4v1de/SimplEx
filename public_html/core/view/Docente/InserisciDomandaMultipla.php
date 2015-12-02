<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 18/11/15
 * Time: 09:58
 */
//TODO qui la logica iniziale, caricamento dei controller ecc
include_once CONTROL_DIR . "DomandaController.php";
include_once CONTROL_DIR . "AlternativaController.php";
$alternativaController = new AlternativaController();
$domandaController = new DomandaController();
if (isset($_POST['testoD']) && isset($_POST['punteggioErr']) && isset($_POST['punteggioEs'])) {
    $testoDomanda = $_POST['testoD'];
    $punteggioErr = $_POST['punteggioErr'];
    $punteggioEs = $_POST['punteggioEs'];

    if (empty($testo) && empty($punteggio)) {
        echo "<script type='text/javascript'>alert('Devi riempire tutti i campi!');</script>";
    } else if (empty($testo)) {
        echo "<script type='text/javascript'>alert('Devi inserire il testo!');</script>";
    } else if (empty($punteggio)) {
        echo "<script type='text/javascript'>alert('Devi inserire il punteggio!');</script>";
    } else {
        $domandaController->creaDomandaAperta($domanda);

        header('location: ../../listadomande');
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
    <title>Inserisci Domanda Multipla</title>
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
                Inserisci una nuova domanda a risposta multipla
            </h3>

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="index.html">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">Nome Corso</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">Nome Argomento</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">Nuova Domanda Multipla</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <form method="post" action="inserisci" class="form-horizontal form-bordered">
                <div class="portlet box blue-madison">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-globe"></i>Inserisci Domanda Multipla
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse" data-original-title="" title="">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <!-- BEGIN FORM-->

                        <div class="form-body">
                            <div class="form-group form-md-line-input has-success" style="height: 90px">
                                <label class="control-label col-md-3">Inserisci Testo Domanda</label>

                                <div class="col-md-6">
                                    <input type="text" id="testoDomanda" nome="testoD" placeholder="" class="form-control">
                                            <span class="help-block">
                                                Inserisci il testo della domanda </span>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input has-success ratio" style="height: 90px">
                                <label class="control-label col-md-3">
                                    <span class="checked"><input type="radio" name="optionsRadios2"
                                                                 value="option1"></span>
                                    Inserisci Testo Risposta</label>

                                <div class="col-md-6">
                                    <input type="text" placeholder="" class="form-control">
                                            <span class="help-block">
                                                Inserisci il testo della risposta </span>
                                </div>
                                <div class="col-md-3">
                                    <a href="javascript:;" class="btn sm green-jungle">
                                        <i class="fa fa-plus"></i> Aggiungi
                                    </a>
                                    <a href="javascript:;" class="btn sm red-intense">
                                        <i class="fa fa-minus"></i> Rimuovi
                                    </a>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input has-success ratio" style="height: 90px">
                                <label class="control-label col-md-3">
                                    <span class="checked"><input type="radio" name="optionsRadios2"
                                                                 value="option2"></span>
                                    Inserisci Testo Risposta</label>

                                <div class="col-md-6">
                                    <input type="text" placeholder="" class="form-control">
                                            <span class="help-block">
                                                Inserisci il testo della risposta </span>
                                </div>
                                <div class="col-md-3">
                                    <a href="javascript:;" class="btn sm green-jungle">
                                        <i class="fa fa-plus"></i> Aggiungi
                                    </a>
                                    <a href="javascript:;" class="btn sm red-intense">
                                        <i class="fa fa-minus"></i> Rimuovi
                                    </a>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input has-success" style="height: 90px">
                                <label class="control-label col-md-3">Inserisci Punteggio Esatta</label>

                                <div class="col-md-4">
                                    <input type="number" placeholder="" class="form-control">
                                            <span class="help-block">
                                                Inserisci il punteggio per risposta esatta </span>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input has-success" style="height: 90px">
                                <label class="control-label col-md-3">Inserisci Punteggio Errata</label>

                                <div class="col-md-4">
                                    <input type="number" placeholder="" class="form-control">
                                            <span class="help-block">
                                                Inserisci il punteggio per risposta errata </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-md-9">
                                            <button type="submit" class="btn sm green-jungle">
                                                Conferma
                                            </button>
                                            </a>
                                            <a href="../../listadomande" class="btn sm red-intense">
                                                Annulla
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- END FORM-->
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
