<?php
/**
 * Created by PhpStorm.
 * User: fede_dr
 * Date: 23/11/15
 * Time: 21:58
 */

//TODO qui la logica iniziale, caricamento dei controller ecc
include_once CONTROL_DIR . "CdlController.php";
include_once CONTROL_DIR . "UtenteController.php";
$controller = new CdlController();
$controllerUtenti = new UtenteController();

$docenteassociato = Array();
$checkbox = Array();
$corso = null;
$docenti = null;
$docente = null;
$url = null;

$url = $_URL[3];
if(!is_numeric($url)) {
    echo "<script type='text/javascript'>alert('errore nella url!!!');</script>";
}

try {
    $corso = $controller->readCorso($url);
}
catch (ApplicationException $ex) {
    echo "<h1>INSERIRE ID CORSO NEL PATH!</h1>".$ex;
}
try {
    $docenti = $controllerUtenti->getDocenti();
}
catch (ApplicationException $ex) {
    echo "<h1>GETDOCENTI FALLITA!</h1>".$ex;
}
try {
    $docenteassociato = $controllerUtenti->getDocenteAssociato($corso->getId());
}
catch (ApplicationException $ex) {
    echo "<h1>GETDOCENTIASSOCIATI FALLITO!</h1>".$ex;
}

if (isset($_POST['checkbox']) && !isset($_POST['elimina'])) {

    $checkbox = $_POST['checkbox'];

    foreach ($docenteassociato as $da) {
        if (!in_array($da->getMatricola(), $checkbox)) {
            try {
                $controller->eliminaInsegnamento($corso->getId(), $da->getMatricola());
            } catch (ApplicationException $ex) {
                echo "<h1>ELIMINAINSEGNAMENTO FALLITO!</h1>".$ex;
            }
        }
    }
    foreach ($checkbox as $c) {
        $docente = $controllerUtenti->getUtenteByMatricola($c);
        if (!in_array($docente, $docenteassociato)) {
            try {
                $controller->creaInsegnamento($corso->getId(), $c);
            } catch (ApplicationException $ex) {
                echo "<h1>CREAZIONEINSEGNAMENTO FALLITO!</h1>".$ex;
            }
        }
    }
    header('location: /adm/corsi/gestione/' . $corso->getId() . '/successassocia');
}

if (isset($_POST['elimina'])) {

    foreach ($docenteassociato as $da) {
        try {
            $controller->eliminaInsegnamento($corso->getId(), $da->getMatricola());
        } catch (ApplicationException $ex) {
            echo "<h1>ELIMINAINSEGNAMENTI FALLITO!</h1>".$ex;
        }
    }
    header('location: /adm/corsi/gestione/' . $corso->getId() . '/successassocia');
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
    <title><?php echo $corso->getNome(); ?></title>
    <?php include VIEW_DIR . "design/header.php"; ?>
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/select2/select2.css">
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css">
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
                View Corso
            </h3>

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="/adm">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="/adm/corsi/view">GestioneCorsi</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="/adm/corsi/gestione/<?php echo $corso->getId(); ?>"><?php echo $corso->getNome(); ?></a>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->

            <div class="row">
                <div class="col-md-12">
                    <div class="form">
                        <form action="" class="form-horizontal form-bordered form-row-stripped">
                            <div class="form-actions">
                                <div class="col-md col-md-7">
                                    <h3><?php echo $corso->getNome(); ?></h3>
                                    <h5>Matricola: <?php echo $corso->getMatricola(); ?></h5>
                                    <h5>Tipologia: <?php echo $corso->getTipologia(); ?></h5>
                                    <?php
                                    if (count($docenteassociato) >= 1) {
                                        foreach ($docenteassociato as $d) {
                                            printf('<h5>Docente: %s %s</h5>', $d->getNome(), $d->getCognome());
                                        }
                                    } else if (count($docenteassociato) < 1) {
                                        printf('<h5>Questo corso non ha docenti Associati!</h5>');
                                    }
                                    ?>
                                </div>
                                <div class="col-md-offset-3 col-md-2">
                                    <h3></h3>
                                    <a href="<?php printf('/adm/corsi/modifica/%s', $corso->getId()); ?>">
                                        <button type="button" class="btn green-jungle">Modifica</button>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <h3></h3>
            </div>

            <form id="form_sample_2" method="post" action="">

                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    Ci sono alcuni errori nei dati. Devi selezionare almeno un Docente.
                </div>

                <div class="portlet box blue-madison">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-university"></i>Scegli un Docente
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse" data-original-title="" title="">
                            </a>
                        </div>
                        <div class="actions">
                            <button type="submit" data-toggle="confirmation" data-singleton="true" data-popout="true" title="sei sicuro?" class="btn btn-default btn-sm">
                                <i class="fa fa-plus"></i> Associa
                            </button>
                            <button type="submit" name="elimina" value="elimina" data-toggle="confirmation" data-singleton="true" data-popout="true" title="sei sicuro?" class="btn btn-default btn-sm">
                                <i class="fa fa-minus"></i> Disassocia Tutti
                            </button>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="tabella_4_wrapper" class="dataTables_wrapper no-footer">
                            <table class="table table-striped table-bordered table-hover dataTable no-footer display"
                                   id="tabella_4" role="grid" aria-describedby="tabella_4_info" cellspacing="0" width="100%">
                                <thead>
                                <tr role="row">
                                    <th class="table-checkbox sorting_disabled" rowspan="1" colspan="1"
                                        aria-label="">
                                        <input type="checkbox" class="group-checkable"
                                               data-set="#tabella_4 .checkboxes">
                                    </th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="sample_2" rowspan="1"
                                        colspan="1" aria-label="Username: activate to sort column ascending"
                                        aria-sort="ascending">
                                        Nome
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="sample_2" rowspan="1"
                                        colspan="1"
                                        aria-label="Email: activate to sort column ascending">
                                        Cognome
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="sample_2" rowspan="1"
                                        colspan="1"
                                        aria-label="Status: activate to sort column ascending">
                                        Matricola
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($docenti as $d) {
                                    printf("<tr class=\"gradeX odd\" role=\"row\">");
                                    if (in_array($d, $docenteassociato)) {
                                        printf("<td><input type=\"checkbox\" class=\"checkboxes\" name=\"checkbox[]\" id=\"checkbox\" value=\"%s\" checked></td>", $d->getMatricola());
                                    } else {
                                        printf("<td><input type=\"checkbox\" class=\"checkboxes\" name=\"checkbox[]\" id=\"checkbox\" value=\"%s\"></td>", $d->getMatricola());
                                    }
                                    printf("<td><a href=\"/adm/utenti/view/%s\">%s</a></td>", $d->getMatricola(), $d->getNome());
                                    printf("<td><span class=\"label label-sm label-success\">%s</span></td>", $d->getCognome());
                                    printf("<td>%s</td>", $d->getMatricola());
                                    printf("</tr>");
                                }
                                ?>
                                </tbody>
                            </table>
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
<script type="text/javascript" src="/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
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

<script src="/assets/admin/pages/scripts/ui-confirmations.js"></script>
<script src="/assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js" type="text/javascript"></script>
<script src="/assets/admin/pages/scripts/ui-toastr.js"></script>
<script src="/assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>
<!-- END aggiunta da me -->
<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        //QuickSidebar.init(); // init quick sidebar
        //Demo.init(); // init demo features
        TableManaged.init("tabella_4", "tabella_4_wrapper");
        FormValidation.init();
        UIToastr.init();
        UIConfirmations.init();
        checkNotifiche();

        /*$('#tabella_4_wrapper').DataTable( {
            scrollY:        50vh,
            scrollCollapse: true,
            paging:         false
        } );*/


        /*var table = $('#tabella_4_wrapper');

        table.find('.group-checkable').change(function () {
            var set = jQuery(this).attr("data-set");
            var checked = jQuery(this).is(":checked");
            jQuery(set).each(function () {
                if (checked) {
                    $(this).attr("checked", true);
                } else {
                    $(this).attr("checked", false);
                }
            });
            jQuery.uniform.update(set);
        });*/

    });
</script>
<script>
    function checkNotifiche(){
        var href = window.location.href;
        var last = href.substr(href.lastIndexOf('/') + 1);
        if(last == 'successassocia'){
            toastr.success('Associazione avvenuta con successo!', 'Associa Docente-Corso');
        }
    }
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
