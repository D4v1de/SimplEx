<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 09/12/15
 * Time: 15:41
 */

include_once CONTROL_DIR . "CdlController.php";
include_once CONTROL_DIR . "UtenteController.php";
$cdlCtrl = new CdlController();
$uCtrl = new UtenteController();
$matricola = $_URL[3];
$error = "";
if (isset($_POST['nome'])) {
    $tipologia = $_POST['tipologia'];
    $nome = $_POST['nome'];
    $cognome = $_POST['cognome'];
    $email = $_POST['email'];
    if ($tipologia != "Studente") {
        $cdlMatricola = null;
    } else {
        $cdlMatricola = $_POST['cdl'];
    }

    $pass = $_POST['pass'];

    try {
        $uCtrl->modificaUtenteByType($matricola, $nome, $cognome, $cdlMatricola, $email, $pass);
        header('location: /adm/utenti?success=Utente modificato');
        exit;
    } catch (ApplicationException $ex) {
        $error = "<h5>Modifica utente FALLITO: " . $ex->getMessage() . "</h5>";
    } catch (IllegalArgumentException $ex) {
        $error = "<h5>Modifica utente FALLITO: " . $ex->getMessage() . "</h5>";
    }
}
try {
    $victim = $uCtrl->getUtenteByMatricola($matricola);
    $cdls = $cdlCtrl->getCdl();
} catch (ApplicationException $ex) {
    header('Location: /adm/utenti/?error=Utente non esiste');
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
    <title>Modifica <?= $victim->getNome() ?> <?= $victim->getCognome() ?></title>
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
                Modifica <?= $victim->getTipologia() ?>
            </h3>

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="/adm">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="/adm/utenti">Gestione Utenti</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="/adm/utenti/view/<?= $victim->getMatricola() ?>"><?= $victim->getNome() ?> <?= $victim->getCognome() ?></a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        Modifica <?= $victim->getTipologia() ?>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->


            <div class="row">
                <div class="col-md-12">
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <?php if (!empty($error)) { ?>
                        <div class="alert alert-danger display-hide" style="display: block;">
                            <button class="close" data-close="alert"></button>
                            <span id="alert_message">
                            <?= $error; ?> </span>
                        </div>
                    <?php } ?>
                    <form id="form_sample_1" method="post" action="">
                        <input type="hidden" name="tipologia" value="<?= $victim->getTipologia() ?>">

                        <div class="portlet box blue-madison">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-globe"></i>Modifica <?= $victim->getNome() ?> <?= $victim->getCognome() ?>
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse" data-original-title="" title="">
                                    </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="portlet-body form">

                                    <div class="alert alert-danger display-hide">
                                        <button class="close" data-close="alert"></button>
                                        Ci sono alcuni errori nei dati. Per favore riprova l'inserimento.
                                    </div>
                                    <div class="alert alert-success display-hide">
                                        <button class="close" data-close="alert"></button>
                                        La tua form &egrave; stata validata!
                                    </div>

                                    <div class="form-group form-md-line-input">
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" id="nomeUtente" name="nome"
                                                   placeholder="Inserisci nome"
                                                   value="<?= $victim->getNome() ?>">

                                            <div class="form-control-focus">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" id="cognomeUtente"
                                                   name="cognome"
                                                   placeholder="Inserisci cognome"
                                                   value="<?= $victim->getCognome() ?>">

                                            <div class="form-control-focus">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <div class="col-md-10">
                                            <input type="email" class="form-control" id="email"
                                                   name="email"
                                                   placeholder="Inserisci email"
                                                   value="<?= $victim->getUsername() ?>">

                                            <div class="form-control-focus">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <div class="col-md-10">
                                            <input type="password" class="form-control" id="pass"
                                                   name="pass"
                                                   placeholder="Inserisci se necessario nuova password"
                                                   value="">

                                            <div class="form-control-focus">
                                            </div>
                                        </div>
                                    </div>
                                    <?php if ($victim->getTipologia() == "Studente") { ?>
                                        <div class="form-group form-md-line-input">
                                            <div class="col-md-10">
                                                <select class="form-control" id="cdlAppartenenza" name="cdl">
                                                    <?php
                                                    /** @var Cdl $cdl */
                                                    foreach ($cdls as $cdl) {
                                                        echo printf('<option %s value="%s">%s</option>', ($victim->getCdlMatricola() == $cdl->getMatricola()) ? "selected" : "", $cdl->getMatricola(), $cdl->getNome());
                                                    }
                                                    ?>
                                                </select>

                                                <div class="form-control-focus">
                                                </div>
                                            </div>
                                        </div>
                                    <?php } ?>
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
                                        <a href="/adm/utenti" value="Annulla" class="btn red-intense">Anulla</a>
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
