<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 18/11/15
 * Time: 09:58
 */
include_once CONTROL_DIR . "DomandaController.php";
$domandaController = new DomandaController();

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
        $domanda = new DomandaAperta(9, 20, $testo, $punteggio, 0);
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
    <title>Inserisci Domanda Aperta</title>
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
                Inserisci una nuova domanda a risposta aperta
            </h3>

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="">NomeCorso</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="homecorsodocente">Nome Argomento</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="#">Nuova Domanda Aperta</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <!-- BEGIN FORM-->
            <form method="post" action="inserisci" class="form-horizontal form-bordered">
                <div class="portlet box blue-madison">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-globe"></i>Inserisci Domanda Aperta
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse" data-original-title="" title="">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body form">
                        <div class="form-body">
                            <div class="form-group form-md-line-input has-success" style="height: 90px">
                                <label class="control-label col-md-3">Inserisci Testo Domanda</label>

                                <div class="col-md-6">
                                    <input type="text" name="testo" id="testoDomanda" placeholder=""
                                           class="form-control">
                                            <span class="help-block">
                                                Inserisci il testo della domanda </span>
                                </div>
                            </div>
                            <div class="form-group form-md-line-input has-success" style="height: 90px">
                                <label class="control-label col-md-3">Inserisci Punteggio</label>

                                <div class="col-md-4">
                                    <input type="number" id="punteggioDomanda" name="punteggio" placeholder=""
                                           class="form-control">
                                            <span class="help-block">
                                                Inserisci il punteggio massimo per la domanda </span>
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
                            <a href="../../listadomande" class="btn sm red-intense">
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
