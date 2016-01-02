<?php
//TODO qui la logica iniziale, caricamento dei controller ecc
include_once MODEL_DIR . "CorsoModel.php";
include_once MODEL_DIR . "UtenteModel.php";
include_once MODEL_DIR . "SessioneModel.php";
include_once MODEL_DIR . "TestModel.php";
include_once MODEL_DIR . "ArgomentoModel.php";
include_once MODEL_DIR . "DomandaModel.php";

$corsoModel = new CorsoModel();
$utenteModel = new UtenteModel();
$sessioneModel = new SessioneModel();
$testModel = new TestModel();
$argomentoModel = new ArgomentoModel();
$domandaModel = new DomandaModel();

$corsoId = $_URL[2];
$n = 10;

try {
    $corso = $corsoModel->readCorso($corsoId);
    $nomecorso = $corso->getNome();
} catch (ApplicationException $ex) {
    echo "<h1>ERRORE NELLA LETTURA DEL CORSO!</h1>" . $ex;
}
$nIscritti = count($utenteModel->getAllStudentiByCorso($corsoId));
$nSessioni = count($sessioneModel->getAllSessioniByCorso($corsoId));
$nTest = count($testModel->getAllTestByCorso($corsoId));
$argomenti = $argomentoModel->getAllArgomentoCorso($corsoId);
$nArgomenti = count($argomenti);
$nMultiple = 0;
$nAperte = 0;
foreach ($argomenti as $a){
    $nMultiple += count($domandaModel->getAllDomandaMultiplaByArgomento($a->getId()));
    $nAperte += count($domandaModel->getAllDomandaApertaByArgomento($a->getId()));
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
        <title>Metronic | Page Layouts - Blank Page</title>
        <?php include VIEW_DIR . "design/header.php"; ?>
        <link href="/assets/global/plugins/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css"/>
        <link href="/assets/global/plugins/simple-line-icons/simple-line-icons.min.css" rel="stylesheet" type="text/css"/>
        <link href="/assets/global/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="/assets/global/plugins/uniform/css/uniform.default.css" rel="stylesheet" type="text/css"/>
        <link href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css" rel="stylesheet" type="text/css"/>
        <!-- END GLOBAL MANDATORY STYLES -->
        <!-- BEGIN PAGE LEVEL STYLES -->
        <link rel="stylesheet" type="text/css" href="/assets/global/plugins/bootstrap-fileinput/bootstrap-fileinput.css"/>
        <link rel="stylesheet" type="text/css" href="/assets/global/plugins/bootstrap-switch/css/bootstrap-switch.min.css"/>
        <link rel="stylesheet" type="text/css" href="/assets/global/plugins/jquery-tags-input/jquery.tagsinput.css"/>
        <link rel="stylesheet" type="text/css" href="/assets/global/plugins/bootstrap-markdown/css/bootstrap-markdown.min.css">
        <link rel="stylesheet" type="text/css" href="/assets/global/plugins/typeahead/typeahead.css">
        <!-- END PAGE LEVEL STYLES -->
        <!-- BEGIN THEME STYLES -->
        <link href="/assets/global/css/components.css" id="style_components" rel="stylesheet" type="text/css"/>
        <link href="/assets/global/css/plugins.css" rel="stylesheet" type="text/css"/>
        <link href="/assets/admin/layout/css/layout.css" rel="stylesheet" type="text/css"/>
        <link id="style_color" href="/assets/admin/layout/css/themes/darkblue.css" rel="stylesheet" type="text/css"/>
        <link href="/assets/admin/layout/css/custom.css" rel="stylesheet" type="text/css"/>

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
                        <?php echo 'Statistiche '.$corso->getNome(); ?>
                    </h3>
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <a href="/docente">Home</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <a href="/docente/corso/<?php echo $corsoId; ?>">Nome Corso</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                Statistiche
                            </li>
                        </ul>
                    </div>

                    <!-- END PAGE HEADER-->
                    <!-- BEGIN PAGE CONTENT-->
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <div class="dashboard-stat red-intense">
                                <div class="visual">
                                    <i class="fa fa-users"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <?php echo $nIscritti; ?>
                                    </div>
                                    <div class="desc">
                                        Iscritti
                                    </div>
                                </div>
                                <a class="more" href="javascript:;">
                                    Visualizza <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <div class="dashboard-stat yellow-casablanca">
                                <div class="visual">
                                    <i class="fa fa-file-text"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <?php echo $nSessioni; ?>
                                    </div>
                                    <div class="desc">
                                        Sessioni
                                    </div>
                                </div>
                                <a class="more" href="javascript:;">
                                    Visualizza <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <div class="dashboard-stat yellow">
                                <div class="visual">
                                    <i class="fa fa-pencil"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <?php echo $nTest; ?>
                                    </div>
                                    <div class="desc">
                                        Test
                                    </div>
                                </div>
                                <a class="more" href="javascript:;">
                                    Visualizza <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <div class="dashboard-stat green-jungle">
                                <div class="visual">
                                    <i class="fa fa-comments"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <?php echo $nArgomenti; ?>
                                    </div>
                                    <div class="desc">
                                        Argomenti
                                    </div>
                                </div>
                                <a class="more" href="javascript:;">
                                    Visualizza <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <div class="dashboard-stat blue-madison">
                                <div class="visual">
                                    <i class="fa fa-question-circle"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <?php echo $nMultiple; ?>
                                    </div>
                                    <div class="desc">
                                        Domande Multiple
                                    </div>
                                </div>
                                <a class="more" href="javascript:;">
                                    Visualizza <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                        <div class="col-lg-2 col-md-2 col-sm-6 col-xs-12">
                            <div class="dashboard-stat purple-plum">
                                <div class="visual">
                                    <i class="fa fa-question-circle"></i>
                                </div>
                                <div class="details">
                                    <div class="number">
                                        <?php echo $nMultiple; ?>
                                    </div>
                                    <div class="desc">
                                        Domande Aperte
                                    </div>
                                </div>
                                <a class="more" href="javascript:;">
                                    Visualizza <i class="m-icon-swapright m-icon-white"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="portlet box blue-madison">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-bar-chart"></i> Test Superati
                            </div>
                            <div class="tools">
                                <a href="javascript:;" onclick="getStatisticheTest('Successo',mod);" class="expand" data-original-title="" title="">
                                </a>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#testSupBest" onclick="mod = 'Best'; getStatisticheTest('Successo',mod);"  data-toggle="tab" aria-expanded="false">
                                        Migliori </a>
                                </li>
                                <li class="">
                                    <a href="#testSupWorst" onclick="mod = 'Worst'; getStatisticheTest('Successo',mod);" data-toggle="tab" aria-expanded="true">
                                        Peggiori </a>
                                </li>
                            </ul>
                        </div>
                        <div class="portlet-body" style="display : none">
                            <div class="row">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-3">
                                        <div class="md-radio-inline">
                                            <div class="md-radio">
                                                <input type="radio" onclick="getStatisticheTest('Successo',mod);" id="valTestSup" name="testSup" class="md-radiobtn" checked="">
                                                <label for="valTestSup">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span>
                                                    Valutative </label>
                                            </div>
                                            <div class="md-radio">
                                                <input type="radio" onclick="getStatisticheTest('Successo',mod);" id="eseTestSup" name="testSup" class="md-radiobtn">
                                                <label for="eseTestSup">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span>
                                                    Esercitative </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5"></div>
                                    <div class="col-md-2">
                                        <div id="spinnerSup">
                                            <div class="input-group" style="width:150px;">
                                                <div class="spinner-buttons input-group-btn">
                                                    <button type="button" onclick="getStatisticheTest('Successo',mod);" class="btn spinner-down red-intense">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                </div>
                                                <input type="text" id="numberTestSuccesso" class="spinner-input form-control" maxlength="3" readonly="">
                                                <div class="spinner-buttons input-group-btn">
                                                    <button type="button" onclick="getStatisticheTest('Successo',mod);" class="btn spinner-up blue-madison">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div id="testSup" class="chart tab-pane active" style="height: 200px; overflow: hidden; text-align: left;">

                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="portlet box blue-madison">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-bar-chart"></i> Test Scelti
                            </div>
                            <div class="tools">
                                <a href="javascript:;"  onclick="getStatisticheTest('Scelto',modSce);" class="expand" data-original-title="" title="">
                                </a>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#testSce" onclick="modSce = 'Best'; getStatisticheTest('Scelto',modSce);"  data-toggle="tab" aria-expanded="false">
                                        Più scelti </a>
                                </li>
                                <li class="">
                                    <a href="#testSce" onclick="modSce = 'Worst'; getStatisticheTest('Scelto',modSce);" data-toggle="tab" aria-expanded="true">
                                        Meno scelti </a>
                                </li>
                            </ul>
                        </div>
                        <div class="portlet-body" style="display : none">
                            <div class="row">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-3">
                                        <div class="md-radio-inline">
                                            <div class="md-radio">
                                                <input type="radio" onclick="getStatisticheTest('Scelto',modSce);" id="valTestSce" name="testSce" class="md-radiobtn" checked="">
                                                <label for="valTestSce">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span>
                                                    Valutative </label>
                                            </div>
                                            <div class="md-radio">
                                                <input type="radio" onclick="getStatisticheTest('Scelto',modSce);" id="eseTestSce" name="testSce" class="md-radiobtn">
                                                <label for="eseTestSce">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span>
                                                    Esercitative </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5"></div>
                                    <div class="col-md-2">
                                        <div id="spinnerSce">
                                            <div class="input-group" style="width:150px;">
                                                <div class="spinner-buttons input-group-btn">
                                                    <button type="button" onclick="getStatisticheTest('Scelto',modSce);" class="btn spinner-down red-intense">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                </div>
                                                <input type="text" id="numberTestScelto" class="spinner-input form-control" maxlength="3" readonly="">
                                                <div class="spinner-buttons input-group-btn">
                                                    <button type="button" onclick="getStatisticheTest('Scelto',modSce);" class="btn spinner-up blue-madison">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div id="testSce" class="chart tab-pane active" style="height: 200px; overflow: hidden; text-align: left;">

                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="portlet box blue-madison">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-bar-chart"></i> Risposte corrette
                            </div>
                            <div class="tools">
                                <a href="javascript:;"  onclick="getStatisticheDomande('Successo',modCorr);" class="expand" data-original-title="" title="">
                                </a>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#domSup" onclick="modCorr = 'Best'; getStatisticheDomande('Successo',modCorr);"  data-toggle="tab" aria-expanded="false">
                                        Migliori </a>
                                </li>
                                <li class="">
                                    <a href="#domSup" onclick="modCorr = 'Worst'; getStatisticheDomande('Successo',modCorr);" data-toggle="tab" aria-expanded="true">
                                        Peggiori </a>
                                </li>
                            </ul>
                        </div>
                        <div class="portlet-body" style="display : none">
                            <div class="row">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-3">
                                        <div class="md-radio-inline">
                                            <div class="md-radio">
                                                <input type="radio" onclick="getStatisticheDomande('Successo',modCorr);" id="valDomSup" name="domSup" class="md-radiobtn" checked="">
                                                <label for="valDomSup">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span>
                                                    Valutative </label>
                                            </div>
                                            <div class="md-radio">
                                                <input type="radio" onclick="getStatisticheDomande('Successo',modCorr);" id="eseDomSup" name="domSup" class="md-radiobtn">
                                                <label for="eseDomSup">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span>
                                                    Esercitative </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5"></div>
                                    <div class="col-md-2">
                                        <div id="spinnerDomSup">
                                            <div class="input-group" style="width:150px;">
                                                <div class="spinner-buttons input-group-btn">
                                                    <button type="button" onclick="getStatisticheDomande('Successo',modCorr);" class="btn spinner-down red-intense">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                </div>
                                                <input type="text" id="numberDomSup" class="spinner-input form-control" maxlength="3" readonly="">
                                                <div class="spinner-buttons input-group-btn">
                                                    <button type="button" onclick="getStatisticheDomande('Successo',modCorr);" class="btn spinner-up blue-madison">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div id="domSup" class="chart tab-pane active" style="height: 200px; overflow: hidden; text-align: left;">

                                </div>
                            </div>
                        </div>
                    </div>
                    
                    
                    <div class="portlet box blue-madison">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-bar-chart"></i> Domande scelte
                            </div>
                            <div class="tools">
                                <a href="javascript:;"  onclick="getStatisticheDomande('Scelto',modDomSce);" class="expand" data-original-title="" title="">
                                </a>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#domSce" onclick="modDomSce = 'Best'; getStatisticheDomande('Scelto',modDomSce);"  data-toggle="tab" aria-expanded="false">
                                        Migliori </a>
                                </li>
                                <li class="">
                                    <a href="#domSce" onclick="modDomSce = 'Worst'; getStatisticheDomande('Scelto',modDomSce);" data-toggle="tab" aria-expanded="true">
                                        Peggiori </a>
                                </li>
                            </ul>
                        </div>
                        <div class="portlet-body" style="display : none">
                            <div class="row">
                                <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-3">
                                        <div class="md-radio-inline">
                                            <div class="md-radio">
                                                <input type="radio" onclick="getStatisticheDomande('Scelto',modDomSce);" id="valDomSce" name="domSce" class="md-radiobtn" checked="">
                                                <label for="valDomSce">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span>
                                                    Valutative </label>
                                            </div>
                                            <div class="md-radio">
                                                <input type="radio" onclick="getStatisticheDomande('Scelto',modDomSce);" id="eseDomSce" name="domSce" class="md-radiobtn">
                                                <label for="eseDomSce">
                                                    <span></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span>
                                                    Esercitative </label>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-5"></div>
                                    <div class="col-md-2">
                                        <div id="spinnerDomSce">
                                            <div class="input-group" style="width:150px;">
                                                <div class="spinner-buttons input-group-btn">
                                                    <button type="button" onclick="getStatisticheDomande('Scelto',modDomSce);" class="btn spinner-down red-intense">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                </div>
                                                <input type="text" id="numberDomSce" class="spinner-input form-control" maxlength="3" readonly="">
                                                <div class="spinner-buttons input-group-btn">
                                                    <button type="button" onclick="getStatisticheDomande('Scelto',modDomSce);" class="btn spinner-up blue-madison">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div id="domSce" class="chart tab-pane active" style="height: 200px; overflow: hidden; text-align: left;">

                                </div>
                            </div>
                        </div>
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

        <script src="/assets/admin/pages/scripts/ui-confirmations.js"></script>
        <script src="/assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js" type="text/javascript"></script>


        <script src="/assets/global/scripts/mycharts.js" type="text/javascript"></script>
        <script type="text/javascript" src="/assets/global/plugins/fuelux/js/spinner.min.js"></script>
        <script src="/assets/global/plugins/jquery.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/jquery-migrate.min.js" type="text/javascript"></script>
        <!-- IMPORTANT! Load jquery-ui.min.js before bootstrap.min.js to fix bootstrap tooltip conflict with jquery ui tooltip -->
        <script src="/assets/global/plugins/jquery-ui/jquery-ui.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/bootstrap/js/bootstrap.min.js" type="text/javascript"></script>
        <!-- END CORE PLUGINS -->
        <!-- BEGIN PAGE LEVEL PLUGINS -->
        <script type="text/javascript" src="/assets/global/plugins/fuelux/js/spinner.min.js"></script>
        <script src="/assets/global/plugins/bootstrap-maxlength/bootstrap-maxlength.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/bootstrap-touchspin/bootstrap.touchspin.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/typeahead/handlebars.min.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/typeahead/typeahead.bundle.min.js" type="text/javascript"></script>
        <!-- END PAGE LEVEL PLUGINS -->
        <!-- BEGIN PAGE LEVEL SCRIPTS -->
        <script src="/assets/global/scripts/metronic.js" type="text/javascript"></script>
        <script src="/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
        <script src="/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
        <script src="/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
        <script src="/assets/admin/pages/scripts/components-form-tools.js"></script>

        <script src="/assets/admin/pages/scripts/ui-blockui.js"></script>


        <script src="/assets/global/plugins/amcharts/amcharts/amcharts.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/amcharts/amcharts/serial.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/amcharts/amcharts/pie.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/amcharts/amcharts/radar.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/amcharts/amcharts/themes/light.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/amcharts/amcharts/themes/patterns.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/amcharts/amcharts/themes/chalk.js" type="text/javascript"></script>
        <script src="/assets/global/plugins/amcharts/amstockcharts/amstock.js" type="text/javascript"></script>
        <script src="/assets/admin/pages/scripts/charts-amcharts.js"></script>
        <script>
                                                        jQuery(document).ready(function () {
                                                            Metronic.init(); // init metronic core components
                                                            Layout.init(); // init current layout
                                                            //ChartsAmcharts.init();
                                                            QuickSidebar.init(); // init quick sidebar
                                                            $('#spinnerSup').spinner({value: 5, step: 5, min: 5, max: 20});
                                                            $('#spinnerSce').spinner({value: 5, step: 5, min: 5, max: 20});
                                                            $('#spinnerDomSup').spinner({value: 5, step: 5, min: 5, max: 20});
                                                            $('#spinnerDomSce').spinner({value: 5, step: 5, min: 5, max: 20});
                                                            mod = 'Best';
                                                            modSce = 'Best';
                                                            modCorr = 'Best';
                                                            modDomSce = 'Best';
                                                            //getStatisticheTest('Scelto',modSce);
                                                            //getStatisticheTest('Successo',mod);
                                                            //Demo.init(); // init demo features
                                                        });
        </script>

    </body>
    <!-- END BODY -->
</html>
