<?php
/**
 * View Profilo
 *
 * @author Sergio Shevchenko
 * @version 1.2
 * @since 11/12/15
 */

include_once MODEL_DIR . "UtenteModel.php";
include_once MODEL_DIR . "CdLModel.php";
$ctr = new UtenteModel();
$victim = null;
try {
    $victim = $ctr->getUtenteByMatricola($_SESSION['user']->getMatricola());
    $_SESSION['user'] = $victim; // refresh
    $cdlCtr = new CdLModel();
    if (is_numeric($victim->getCdlMatricola())) {
        $cdl = $cdlCtr->readCdl($victim->getCdlMatricola());
    }
} catch (ApplicationException $ex) {
    header('Location: /?error=Utente non trovato');
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
    <title><?php echo $victim->getNome() . " " . $victim->getCognome() ?> - Visualizza Utente</title>
    <?php include VIEW_DIR . "design/header.php"; ?>
    <!-- BEGIN PLUGINS USED BY X-EDITABLE -->
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/select2/select2.css"/>
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.css"/>
    <link rel="stylesheet" type="text/css"
          href="/assets/global/plugins/bootstrap-datepicker/css/bootstrap-datepicker3.min.css"/>
    <link rel="stylesheet" type="text/css"
          href="/assets/global/plugins/bootstrap-timepicker/css/bootstrap-timepicker.min.css"/>
    <link rel="stylesheet" type="text/css"
          href="/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css"/>
    <link rel="stylesheet" type="text/css"
          href="/assets/global/plugins/bootstrap-editable/bootstrap-editable/css/bootstrap-editable.css"/>
    <link rel="stylesheet" type="text/css"
          href="/assets/global/plugins/bootstrap-editable/inputs-ext/address/address.css"/>
    <!-- END PLUGINS USED BY X-EDITABLE -->

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
                <?php echo $victim->getNome() . " " . $victim->getCognome() ?>
            </h3>

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="/">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="/me">Mio profilo</a>
                    </li>

                </ul>
            </div>

            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->

            <div class="portlet box blue-madison">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-graduation-cap"></i>Profilo utente
                    </div>
                </div>
                <div class="portlet-body">
                    <div class="row">
                        <div class="col-md-12">
                            <table id="user" class="table table-bordered table-striped">
                                <tbody>
                                <tr>
                                    <td style="width:15%">
                                        Nome
                                    </td>
                                    <td style="width:50%">
                                        <?= $victim->getNome() ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:15%">
                                        Cognome
                                    </td>
                                    <td style="width:50%">
                                        <?= $victim->getCognome() ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:15%">
                                        Matricola
                                    </td>
                                    <td style="width:50%">
                                        <?= $victim->getMatricola() ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:15%">
                                        E-mail
                                    </td>
                                    <td style="width:50%">
                                        <?= $victim->getUsername() ?>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:15%">
                                        Tipo utente
                                    </td>
                                    <td style="width:50%">
                                        <?= $victim->getTipologia() ?>
                                    </td>
                                </tr>
                                <?php if ($victim->getTipologia() == "Studente") { ?>
                                    <tr>
                                        <td style="width:15%">
                                            Cdl Appartenente
                                        </td>
                                        <td style="width:50%">
                                            <?= $cdl->getNome() ?>
                                        </td>
                                    </tr> <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="row">
                        <form method="post">
                            <input type="hidden" name="action" value="elimina"/>
                            <input type="hidden" name="matricola" value="<?= $victim->getMatricola() ?>"/>

                            <div class="col-md-3">
                                <a class="btn green-jungle"
                                   href="/modifica/"><i class="fa fa-edit"></i> Modifica</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
</div>


<!-- END PAGE CONTENT-->
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

<script src="/assets/admin/pages/scripts/ui-confirmations.js"></script>
<script src="/assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js"
        type="text/javascript"></script>
<script src="/assets/admin/pages/scripts/ui-toastr.js"></script>
<script src="/assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>

<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        QuickSidebar.init(); // init quick sidebar
        UIConfirmations.init();
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
