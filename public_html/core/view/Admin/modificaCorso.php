<?php
/**
 * La view consente all'Admin di modificare un Corso presente nel sistema SimplEx
 * @author Federico De Rosa
 * @version 1
 * @since 23/11/15 09:58
 */

//TODO qui la logica iniziale, caricamento dei controller ecc
include_once CONTROL_DIR . "CdlController.php";
include_once CONTROL_DIR . "UtenteController.php";
$controller = new CdlController();
$controllerUtenti = new UtenteController();

$docenteassociato = Array();
$corsi = Array();
$corso = null;
$cdls = null;
$url = null;
$flag = 1;

$url = $_URL[3];
if (!is_numeric($url)) {
    echo "<script type='text/javascript'>alert('errore nella url!!!');</script>";
}

try {
    $corso = $controller->readCorso($url);
} catch (ApplicationException $ex) {
    echo "<h1>INSERIRE ID CORSO NEL PATH</h1>" . $ex;
}
try {
    $docenteassociato = $controllerUtenti->getDocenteAssociato($corso->getId());
} catch (ApplicationException $ex) {
    echo "<h1>GETDOCENTIASSOCIATI FALLITO!</h1>" . $ex;
}
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

$nome = $corso->getNome();
$tipologia = $corso->getTipologia();
$matricola = $corso->getMatricola();
$cdlmatricola = $corso->getCdlMatricola();

if (isset($_POST['nome']) && isset($_POST['tipologia']) && isset($_POST['matricola']) && isset($_POST['tipologia2'])) {

    $nomenew = $_POST['nome'];
    $tipologianew = $_POST['tipologia'];
    $matricolanew = $_POST['matricola'];
    $cdlmatricolanew = $_POST['tipologia2'];

    //controllo sul nome
    if(empty($nomenew)) {
        $flag2 = 0;
    }

    //controllo sulla tipologia
    if(empty($tipologianew)) {
        $flag3 = 0;
    }

    $x = array_search($corso ,$corsi);
    unset($corsi[$x]);

    //controllo sulla matricola
    if(empty($matricola) || !is_numeric($matricola)) {
        $flag4 = 0;
    }
    foreach($corsi as $c) {
        if($c->getMatricola() == $matricolanew) {
            $flag = 0;
        }
    }

    //controllo cdl matricola
    if(empty($cdlmatricola) || !is_numeric($cdlmatricola)) {
        $flag5 = 0;
    }

    if($flag) {
        try {
            $new = new Corso($matricolanew, $nomenew, $tipologianew, $cdlmatricolanew);
            $controller->modificaCorso($corso->getId(), $new);

            header('location: /admin/corsi/view/successmodifica');
        } catch (ApplicationException $ex) {
            echo "<h1>MODIFICACORSO FALLITO!</h1>" . $ex;
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
    <title>Modifica Corso</title>
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
                Modifica Corso
            </h3>

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="/admin">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="/admin/corsi/view">GestioneCorsi</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="/admin/corsi/modifica/<?php echo $corso->getId(); ?>"><?php echo $nome; ?></a>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->

            <div class="row">
                <div class="col-md-12">
                    <div class="form">
                        <form action="#" class="form-horizontal form-bordered form-row-stripped">
                            <div class="form-actions">
                                <div class="col-md col-md-10">
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
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <div class="row">
                <h3></h3>
            </div>

            <div class="row">
                <div class="col-md-12">

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

                        <!-- BEGIN EXAMPLE TABLE PORTLET-->
                        <div class="portlet box blue-madison">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-globe"></i>Modifica Corso
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
                                            <input type="text" class="form-control" name="nome" id="nomeCorso"
                                                   Value="<?php echo $nome; ?>">

                                            <div class="form-control-focus">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group form-md-line-input">
                                        <div class="col-md-10">
                                            <input type="text" class="form-control" name="matricola"
                                                   id="matricolaCorso" value="<?php echo $matricola; ?>">

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
                                    <div class="col-md-offset-1 col-md-5">
                                        <a href="<?php printf('/admin/corsi/gestione/%s', $corso->getId()); ?>"
                                           class="btn blue-madison">Associa Docente</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
            </div>
        </div>


        <!-- END PAGE CONTENT-->
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
