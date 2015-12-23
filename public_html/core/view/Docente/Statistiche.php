<?php
//TODO qui la logica iniziale, caricamento dei controller ecc
include_once CONTROL_DIR . "TestController.php";
include_once CONTROL_DIR . "ArgomentoController.php";
include_once CONTROL_DIR . "ElaboratoController.php";
include_once CONTROL_DIR . "SessioneController.php";
include_once CONTROL_DIR . "CdlController.php";

$controlleCdl = new CdlController();
$testController = new TestController();
$argomentoController = new ArgomentoController();
$elaboratoController = new ElaboratoController();
$sessioneController = new SessioneController();

$corsoId = $_URL[2];
$tests = $testController->getAllTestbyCorso($corsoId);
$n = 10;
$arguments = $argomentoController->getArgomenti($corsoId);

try {
    $corso = $controlleCdl->readCorso($corsoId);
    $nomecorso = $corso->getNome();
} catch (ApplicationException $ex) {
    echo "<h1>ERRORE NELLA LETTURA DEL CORSO!</h1>" . $ex;
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
                        <?php echo 'Correzione Elaborato di ' ?>
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
                                Esegui Test
                            </li>
                        </ul>
                    </div>

                    <!-- END PAGE HEADER-->
                    <!-- BEGIN PAGE CONTENT-->
                    <div id="test1" class="portlet box blue-madison">
                        <div class="portlet-title">
                            <div class="caption">
                                <i onclick="prova();" class="fa fa-bar-chart"></i> Test
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title="">
                                </a>
                            </div>
                            <ul class="nav nav-tabs">
                                <li class="active">
                                    <a href="#portlet_tab1" onclick=" initChartSampleTestScelto();" data-toggle="tab" aria-expanded="true">
                                        Inserimento </a>
                                </li>
                                <li class="">
                                    <a href="#testSupBest" onclick="getStatisticheTest('Best');"  data-toggle="tab" aria-expanded="false">
                                        Promossi </a>
                                </li>
                            </ul>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                <div id="spinner4">
                                <div class="input-group" style="width:150px;">
                                    <div class="spinner-buttons input-group-btn">
                                        <button type="button" onclick="getStatisticheTest('Best');" class="btn spinner-down red">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                    </div>
                                    <input type="text" id="qui" class="spinner-input form-control" maxlength="3" readonly="">
                                    <div class="spinner-buttons input-group-btn">
                                        <button type="button" onclick="getStatisticheTest('Best');" class="btn spinner-up blue">
                                            <i class="fa fa-plus"></i>
                                        </button>
                                    </div>
                                </div>
                                </div>
                            </div>
                            <div class="tab-content">
                                <div id="portlet_tab1" class="chart tab-pane active" style="height: 500px; overflow: hidden; text-align: left;">

                                </div>
                                <div id="testSupBest" class="chart tab-pane" style="height: 500px; overflow: hidden; text-align: left;">

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="tab-pane active chart" id="portlet_tab4">

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
                                            initChartSampleTestScelto();
                                            //ChartsAmcharts.init();
                                            QuickSidebar.init(); // init quick sidebar
                                            ComponentsFormTools.init();
                                            
                                            //Demo.init(); // init demo features
                                        });
        </script>
        <script>
            var initChartSample1 = function () {
                var string = "[{\"year\": 2009,\"income\": 23.5,\"expenses\": 22.8}, {\"year\": 2010,\"income\": 26.2,\"expenses\": 22.8},]";
                var chart = AmCharts.makeChart("chart_1", {
                    "type": "serial",
                    "theme": "light",
                    "pathToImages": Metronic.getGlobalPluginsPath() + "amcharts/amcharts/images/",
                    "autoMargins": false,
                    "marginLeft": 30,
                    "marginRight": 8,
                    "marginTop": 10,
                    "marginBottom": 26,
                    "fontFamily": 'Open Sans',
                    "color": '#888',
                    "dataProvider": [{
                            "year": 5,
                            "income": 23.5,
                            "expenses": 22.8
                        }, {
                            "year": 3,
                            "income": 26.2,
                            "expenses": 22.8
                        }, ],
                    /*"dataProvider": [{
                     "year": 2009,
                     "income": 23.5,
                     "expenses": 22.8
                     }, {
                     "year": 2010,
                     "income": 26.2,
                     "expenses": 22.8
                     }, {
                     "year": 2011,
                     "income": 30.1,
                     "expenses": 23.9
                     }, {
                     "year": 2012,
                     "income": 29.5,
                     "expenses": 25.1
                     }, {
                     "year": 2013,
                     "income": 30.6,
                     "expenses": 27.2,
                     "dashLengthLine": 5
                     }, {
                     "year": 2014,
                     "income": 34.1,
                     "expenses": 29.9,
                     "dashLengthColumn": 5,
                     "alpha": 0.2,
                     "additional": "(projection)"
                     }],*/
                    "valueAxes": [{
                            "axisAlpha": 0,
                            "position": "left"
                        }],
                    "startDuration": 1,
                    "graphs": [{
                            "alphaField": "alpha",
                            "balloonText": "<span style='font-size:13px;'>[[title]] in [[category]]:<b>[[value]]</b> [[additional]]</span>",
                            "dashLengthField": "dashLengthColumn",
                            "fillAlphas": 1,
                            "title": "Income",
                            "type": "column",
                            "valueField": "income"
                        }, {
                            "balloonText": "<span style='font-size:13px;'>[[title]] in [[category]]:<b>[[value]]</b> [[additional]]</span>",
                            "bullet": "round",
                            "dashLengthField": "dashLengthLine",
                            "lineThickness": 3,
                            "bulletSize": 7,
                            "bulletBorderAlpha": 1,
                            "bulletColor": "#FFFFFF",
                            "useLineColorForBulletBorder": true,
                            "bulletBorderThickness": 3,
                            "fillAlphas": 0,
                            "lineAlpha": 1,
                            "title": "Expenses",
                            "valueField": "expenses"
                        }],
                    "categoryField": "year",
                    "categoryAxis": {
                        "gridPosition": "start",
                        "axisAlpha": 0,
                        "tickLength": 0
                    }
                });

                $('#chart_1').closest('.portlet').find('.fullscreen').click(function () {
                    chart.invalidateSize();
                });
            }
            num = 10;
            function prova(){
            alert("OK");
            Metronic.blockUI({
                target: '#test1',
                animate: true
            });
    Metronic.startPageLoading({animate: true});
            };
        </script>
        <!-- END JAVASCRIPTS -->
        <!-- START CHARTS -->
        <?php
        echo'    <script>
                   
            var initChartSampleTestScelto = function() {
                var chart = AmCharts.makeChart("portlet_tab1", {
                    "type": "serial",
                    "theme": "none",
                    "marginRight": 70,
                    
                    
                    "dataProvider": [';
        $sessioniByCorso = $sessioneController->getAllSessioniByCorso($corsoId);
        for ($i = 0; $i < $n; $i++) {
            $testId = $tests[$i]->getId();
            $elaborati = $elaboratoController->getAllElaboratiTest($testId);
            if ($sessioniByCorso != null)
                $percSce = round(($tests[$i]->getPercentualeScelto() / count($sessioniByCorso) * 100), 2);
            else
                $percSce = 0;
            if ($elaborati != null)
                $percSuc = round(($tests[$i]->getPercentualeSuccesso() / count($elaborati) * 100), 2);
            else
                $percSuc = 0;
            echo'{
                            "year":';
            echo '"Test ' . $tests[$i]->getId() . '"';
            echo ',"income": ';
            echo $percSce;
            echo ',"color": "#FF0000" ';
            echo '},';
        }
        echo '],"startDuration": 1,
                    "graphs": [{
                        "balloonText": "<span style=\'font-size:13px;\'>[[title]] nel <b>[[value]]%</b> delle Sessioni [[additional]]</span>",
                        "fillColorsField": "color",
                        "fillAlphas": 0.9,
                        "lineAlpha": 0.2,
                        "title": "Inserito",
                        "type": "column",
                        "valueField": "income"
                    }],
                    
                    "chartCursor": {
                      "categoryBalloonEnabled": false,
                      "cursorAlpha": 0,
                      "zoomable": false
                    },
                    "categoryField": "year",
                    "categoryAxis": {
                        "gridPosition": "start",
                        "axisAlpha": 0,
                        "tickLength": 0
                    }
                });

                $(\'#portlet_tab1\').closest(\'.portlet\').find(\'.fullscreen\').click(function() {
                    chart.invalidateSize();
                });
                }
                
            var initChartSampleTestSuccesso = function() {
                var chart = AmCharts.makeChart("portlet_tab2", {
                    "type": "serial",
                    "theme": "light",
                    "pathToImages": Metronic.getGlobalPluginsPath() + "amcharts/amcharts/images/",
                    "autoMargins": false,
                    "marginLeft": 30,
                    "marginRight": 8,
                    "marginTop": 10,
                    "marginBottom": 26,

                    "fontFamily": \'Open Sans\',            
                    "color":    \'#888\',

                    "dataProvider": [';
        for ($i = 0; $i < $n; $i++) {
            $testId = $tests[$i]->getId();
            $elaborati = $elaboratoController->getAllElaboratiTest($testId);
            if ($elaborati != null)
                $percSuc = round(($tests[$i]->getPercentualeSuccesso() / count($elaborati) * 100), 2);
            else
                $percSuc = 0;
            echo'{
                            "year":';
            echo '"Test ' . $tests[$i]->getId() . '"';
            echo ',"income": ';
            echo $percSuc;
            echo '},';
        }
        echo '],"startDuration": 1,
                    "graphs": [{
                        "alphaField": "alpha",
                        "balloonText": "<span style=\'font-size:13px;\'>[[title]]: <b>[[value]]%</b> [[additional]]</span>",
                        "dashLengthField": "dashLengthColumn",
                        "fillAlphas": 1,
                        "title": "Studenti promossi",
                        "type": "column",
                        "valueField": "income"
                    }, {
                        "balloonText": "<span style=\'font-size:13px;\'>[[title]] in [[category]]:<b>[[value]]</b> [[additional]]</span>",
                        "bullet": "round",
                        "dashLengthField": "dashLengthLine",
                        "lineThickness": 3,
                        "bulletSize": 7,
                        "bulletBorderAlpha": 1,
                        "bulletColor": "#FFFFFF",
                        "useLineColorForBulletBorder": true,
                        "bulletBorderThickness": 3,
                        "fillAlphas": 0,
                        "lineAlpha": 1,
                        "title": "Expenses",
                        "valueField": "expenses"
                    }],
                    "categoryField": "year",
                    "categoryAxis": {
                        "gridPosition": "start",
                        "axisAlpha": 0,
                        "tickLength": 0
                    }
                });

                $(\'#portlet_tab2\').closest(\'.portlet\').find(\'.fullscreen\').click(function() {
                    chart.invalidateSize();
                });
                }
    </script>';
        ?>
    </body>
    <!-- END BODY -->
</html>
