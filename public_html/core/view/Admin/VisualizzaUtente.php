<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 30/11/15
 * Time: 20:29
 */
include_once CONTROL_DIR . "UtenteController.php";
include_once CONTROL_DIR . "CdlController.php";
$ctr = new UtenteController();
$user = null;
$cdl = null;
try {
    $user = $ctr->getUtenteByMatricola($_URL[3]);
    $cdlCtr = new CdlController();
    $cdl = $cdlCtr->readCdl($user->getCdlMatricola());
} catch (ApplicationException $ex) {
    header('Location: /adm/utenti');
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
    <title>Nome Corso</title>
    <?php include VIEW_DIR . "header.php"; ?>
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
                <?php echo $user->getNome() . " " . $user->getCognome() ?>
            </h3>

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="index">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="index">Utenti</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="index">Visualizza</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <?php echo $user->getNome() . " " . $user->getCognome() ?>
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
                                        <a href="javascript:;" id="name" data-type="text" data-pk="1"
                                           data-original-title="Nome utente" class="editable editable-click">
                                            <?= $user->getNome() ?>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:15%">
                                        Cognome
                                    </td>
                                    <td style="width:50%">
                                        <a href="javascript:;" id="surname" data-type="text" data-pk="1"
                                           data-original-title="Cognome utente" class="editable editable-click">
                                            <?= $user->getCognome() ?>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:15%">
                                        Matricola
                                    </td>
                                    <td style="width:50%">
                                        <a href="javascript:;" id="matricola" data-type="text" data-pk="1"
                                           data-original-title="Matricola" class="editable editable-click">
                                            <?= $user->getMatricola() ?>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:15%">
                                        E-mail
                                    </td>
                                    <td style="width:50%">
                                        <a href="javascript:;" id="email" data-type="text" data-pk="1"
                                           data-original-title="Email" class="editable editable-click">
                                            <?= $user->getUsername() ?>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:15%">
                                        Tipo utente
                                    </td>
                                    <td style="width:50%">
                                        <a href="javascript:;" id="tipo" data-type="select" data-pk="1" data-value="0"
                                           data-source="/adm/utenti/groups" data-original-title="Select group"
                                           class="editable editable-click">
                                            <?= $user->getTipologia() ?> </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width:15%">
                                       Corso di laurea
                                    </td>
                                    <td style="width:50%">
                                        <a href="javascript:;" id="cdl" data-type="select2" data-pk="1"
                                           data-value="<?= $cdl->getNome() ?>"
                                           data-original-title="Seleziona CdL"
                                           class="editable editable-click">Bahamas</a>
                                    </td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
</div>


<!-- END PAGE CONTENT-->
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

<!-- XEDITABLE -->
<script type="text/javascript" src="/assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="/assets/global/plugins/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
<script type="text/javascript" src="/assets/global/plugins/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
<script type="text/javascript"
        src="/assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.min.js"></script>
<script type="text/javascript"
        src="/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script type="text/javascript" src="/assets/global/plugins/moment.min.js"></script>
<script type="text/javascript" src="/assets/global/plugins/jquery.mockjax.js"></script>
<script type="text/javascript"
        src="/assets/global/plugins/bootstrap-editable/bootstrap-editable/js/bootstrap-editable.js"></script>
<script type="text/javascript" src="/assets/global/plugins/bootstrap-editable/inputs-ext/address/address.js"></script>
<script type="text/javascript"
        src="/assets/global/plugins/bootstrap-editable/inputs-ext/wysihtml5/wysihtml5.js"></script>
<!-- END XEDITABLE -->

<script src="/assets/admin/pages/scripts/form-editable-utente.js"></script>


<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        FormEditable.init();
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
