<?php
/**
 * Created by PhpStorm.
 * User: fede_dr
 * Date: 18/11/15
 * Time: 21:47
 */

//TODO qui la logica iniziale, caricamento dei controller ecc
include_once CONTROL_DIR . "CdlController.php";
$controller = new CdlController();

if (isset($_POST['nome']) && isset($_POST['tipologia']) && isset($_POST['matricola']) && isset($_POST['cdlmatricola'])) {

    $nome = $_POST['nome'];
    $tipologia = $_POST['tipologia'];
    $matricola = $_POST['matricola'];
    $cdlMatricola = $_POST['cdlmatricola'];

    if (empty($nome) && empty($matricola) && empty($cdlMatricola)) {
        echo "<script type='text/javascript'>alert('devi riempire tutti i campi!');</script>";
    } else if (empty($nome)) {
        echo "<script type='text/javascript'>alert('devi inserire il nome!');</script>";
    } else if (empty($matricola)) {
        echo "<script type='text/javascript'>alert('devi inserire la matricola!');</script>";
    } else if (empty($cdlMatricola)) {
        echo "<script type='text/javascript'>alert('devi inserire la matricola del CdL!');</script>";
    } else {

        try {
            $corso = new Corso($matricola, $nome, $tipologia, $cdlMatricola);
            $controller->creaCorso($corso);

            header('location: view');
        }
        catch (ApplicationException $ex) {
            echo "<h1>CREACORSO FALLITO!</h1>.$ex";
        }
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
    <title>Crea Corso</title>
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
                Crea Corso
            </h3>

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="../../../gestionale/admin/index.html">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="view">GestioneCorsi</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="crea">CreaCorso</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->


            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->

                    <form method="post" action="">

                        <div class="portlet box blue-madison">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-globe"></i>Crea nuovo Corso
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse" data-original-title="" title="">
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body">

                                <div class="portlet-body form">
                                    <div class="form-group form-md-line-input">
                                        <div class="col-md-10">
                                            <select class="form-control" id="tipologiaCorso" name="tipologia">
                                                <option value="Semestrale">Semestrale</option>
                                                <option value="Annuale">Annuale</option>
                                            </select>

                                            <div class="form-control-focus">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" id="nomeCorso" name="nome"
                                                   placeholder="Inserisci nome" value="<?php if(isset($nome)) echo $nome; ?>" required>

                                            <div class="form-control-focus">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <div class="col-md-10">
                                            <input type="number" class="form-control" id="matricolaCorso" name="matricola"
                                                   placeholder="Inserisci matricola" value="<?php if(isset($matricola)) echo $matricola; ?>" required>

                                            <div class="form-control-focus">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <div class="col-md-10">
                                            <input type="number" class="form-control" id="cdlmatricolaCorso"
                                                   name="cdlmatricola"
                                                   placeholder="Inserisci cdlmatricola" value="<?php if(isset($cdlMatricola)) echo $cdlMatricola; ?>" required>

                                            <div class="form-control-focus">
                                            </div>
                                        </div>
                                    </div>

                                </div>

                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-actions">
                                    <div class="col-md-3">
                                        <button type="submit" class="btn green-jungle">Conferma</button>
                                    </div>
                                    <div class="col-md-3">
                                        <input type="reset" value="Annulla" class="btn red-intense"/>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    <!-- END EXAMPLE TABLE PORTLET-->
                </div>
            </div>


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

<script src="/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<!-- BEGIN aggiunta da me -->
<script src="/assets/admin/pages/scripts/table-managed.js"></script>
<!-- END aggiunta da me -->

<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        //QuickSidebar.init(); // init quick sidebar
        //Demo.init(); // init demo features
        TableManaged.init();
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
