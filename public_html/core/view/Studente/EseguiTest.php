<?php
/**
 * Created by PhpStorm.
 * User: Fabiano
 * Date: 18/11/15
 * Time: 09:58
 */

//TODO qui la logica iniziale, caricamento dei controller ecc
include_once CONTROL_DIR . "ControllerTest.php";
$testController = new ControllerTest();
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
    <link rel="stylesheet" type="text/css" href="/assets/global/css/mycounter.css" />
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
                    Esegui Test
                </h3>
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="index.html">Home</a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            <a href="#">Nome Corso</a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            Esegui Test
                        </li>
                    </ul>
                </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <?php
            $matricola = "0512102390";
            $studente = $testController->getUtentebyMatricola($matricola);
            $nome = $studente->getNome();
            $cognome = $studente->getCognome();
            ?>
                <div class="portlet box blue-madison">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-file-text-o"></i>Test
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse" data-original-title="" title="">
                            </a>
                        </div>
                        <div class="actions">
                            <div id="countdown"></div>
                        </div>
                    </div>

                    <div class="portlet-body">
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-md-line-input has-success">
                                        <div class="input">
                                            <input type="text" class="form-control" value="<?php echo $nome; ?>" disabled="">
                                                <label for="form_control_1">Nome</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-md-line-input has-success">
                                        <div class="input">
                                            <input type="text" class="form-control" value="<?php echo $cognome; ?>" disabled="">
                                                <label for="form_control_1">Cognome</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-md-line-input has-success">
                                        <div class="input">
                                            <input type="text" class="form-control" value="<?php echo $matricola; ?>" disabled="">
                                                <label for="form_control_1">Matricola</label>
                                                    <span class="help-block">Inserire la matricola</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <?php
                                $testId = 2;
                                $multiple = $testController->getMultTest($testId);
                                $aperte = $testController->getAperteTest($testId);
                                $i = 1;
                                foreach ($multiple as $m) {
                                    $j = 1;
                                    $testo = $m->getTesto();
                                    echo "<h3>".$testo."</h3>";
                                    echo '<div class="form-group form-md-radios">';
                                    echo '<div class="md-radio-list">';
                                    $alternative = $testController->getRispMult($m->getId(),$m->getArgomentoId(),$m->getArgomentoCorsoId());
                                    foreach ($alternative as $r){
                                        $domId = "d%dr%d";
                                        $domId = sprintf($domId,$i,$j);
                                        $nome = "d%";
                                        $nome = sprintf($nome,$i);
                                        echo    '<div class="md-radio">
                                                    <input type="radio" id="'.$domId.'" name="'.$nome.'" class="md-radiobtn">
                                                    <label for="'.$domId.'">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span>
                                                    '.$r->getTesto().'</label>
                                                </div>';
                                        $j++;
                                    }
                                    $i++;
                                }
                                echo '</div>';
                                echo '</div>';

                                foreach ($aperte as $a) {
                                    $testo = $a->getTesto();
                                    $domId = "d%d";
                                    $domId = sprintf($domId,$i);
                                    echo '<h3>'.$testo.'</h3>';
                                    echo    '<div class="form-group">
                                                <textarea class="form-control" id="'.$domId.'" rows="3" placeholder="Inserisci risposta" style="resize:none"></textarea>
                                            </div>';
                                    $i++;
                                }
                            ?>                        
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-9">
                                    <a href="javascript:;" class="btn sm green-jungle"><span class="md-click-circle md-click-animate" style="height: 94px; width: 94px; top: -23px; left: 2px;"></span>
                                        Consegna
                                    </a>
                                    <a href="javascript:;" class="btn sm red-intense">
                                        Abbandona
                                    </a>
                                </div>
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
<?php include VIEW_DIR . "footer.php"; ?>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<?php include VIEW_DIR . "js.php"; ?>

<!--Script specifici per la pagina -->
<script src="/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="/assets/global/scripts/mycountdown.js" type="text/javascript"></script>
<script src="/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        StartCounter();
        //QuickSidebar.init(); // init quick sidebar
        //Demo.init(); // init demo features
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
