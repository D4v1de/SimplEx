<?php
/**
 * La view consente all'Admin di creare un nuovo Corso
 * @author Federico De Rosa
 * @version 1
 * @since 18/11/15 21:58
 */

//TODO qui la logica iniziale, caricamento dei controller ecc
include_once CONTROL_DIR . "CdlController.php";
$controller = new CdlController();

$corso = null;
$cdls = Array();
$flag = 1;

try {
    $cdls = $controller->getCdl();
} catch (ApplicationException $ex) {
    echo "<h1>GETCDL FALLITO!</h1>" . $ex;
}
try {
    $corsi = $controller->getCorsi();
} catch (ApplicationException $ex) {
    echo "<h1>GETCORSI FALLITO!</h1>" . $ex;
}

if (isset($_POST['nome']) && isset($_POST['tipologia']) && isset($_POST['matricola']) && isset($_POST['tipologia2'])) {

    $nome = $_POST['nome'];
    $tipologia = $_POST['tipologia'];
    $matricola = $_POST['matricola'];
    $cdlmatricola = $_POST['tipologia2'];

    foreach($corsi as $c) {
        if($c->getMatricola() == $matricola) {
            $flag = 0;
        }
    }
    if($flag) {
        try {
            $corso = new Corso($matricola, $nome, $tipologia, $cdlmatricola);
            $id = $controller->creaCorso($corso);

            header('location: /admin/corsi/gestione/' . $id . '/successcrea');
        } catch (ApplicationException $ex) {
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
                Crea Corso
            </h3>

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="/adm">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="/admin/corsi/view">GestioneCorsi</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="/admin/corsi/crea">CreaCorso</a>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->


            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <form id="form_sample_1" method="post" action="">

                        <?php
                        if(!$flag) {
                            echo "<div class=\"alert alert-danger\"><button class=\"close\" data-close=\"alert\"></button>La matricola del corso è già presente nel DataBase.</div>";
                        }
                        ?>
                        <div class="alert alert-danger display-hide">
                            <button class="close" data-close="alert"></button>
                            Ci sono alcuni errori nei dati. Per favore riprova l'inserimento.
                        </div>
                        <!--<div class="alert alert-success display-hide">
                            <button class="close" data-close="alert"></button>
                            La tua form &egrave; stata validata!
                        </div>-->

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
                                                <option value="">Seleziona</option>
                                                <?php
                                                foreach(Config::$TIPI_CORSO as $t) {
                                                    if($tipologia == $t) {
                                                        printf("<option value=\"%s\" selected>%s</option>",$t,$t);
                                                    }
                                                    else {
                                                        printf("<option value=\"%s\">%s</option>",$t,$t);
                                                    }
                                                }
                                                ?>
                                            </select>

                                            <div class="form-control-focus">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" id="nomeCorso" name="nome"
                                                   placeholder="Inserisci nome"
                                                   value="<?php if (isset($nome)) echo $nome; ?>">

                                            <div class="form-control-focus">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" id="matricolaCorso"
                                                   name="matricola"
                                                   placeholder="Inserisci matricola"
                                                   value="<?php if (isset($matricola)) echo $matricola; ?>">

                                            <div class="form-control-focus">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <div class="col-md-10">
                                            <select class="form-control" id="tipologiaCorso" name="tipologia2">
                                                <option value="">Seleziona</option>
                                                <?php
                                                foreach($cdls as $c) {
                                                    if($cdlmatricola == $c->getMatricola()) {
                                                        printf("<option value=\"%s\" selected>%s - %s</option>",$c->getMatricola(),$c->getMatricola(),$c->getNome());
                                                    }
                                                    else {
                                                        printf("<option value=\"%s\">%s - %s</option>",$c->getMatricola(),$c->getMatricola(),$c->getNome());
                                                    }
                                                }
                                                ?>
                                            </select>

                                            <div class="form-control-focus">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <h3></h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-actions">
                                    <div class="col-md-3">
                                        <input type="submit" value="Conferma" class="btn green-jungle"/>
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

<script src="/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<!-- BEGIN aggiunta da me -->
<script src="/assets/admin/pages/scripts/table-managed.js"></script>
<script src="/assets/admin/pages/scripts/form-validation.js"></script>
<script type="text/javascript" src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="/assets/global/plugins/jquery-validation/js/additional-methods.min.js"></script>
<!-- END aggiunta da me -->

<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        //QuickSidebar.init(); // init quick sidebar
        //Demo.init(); // init demo features
        TableManaged.init();
        FormValidation.init();
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
