<?php
/**
 * Created by PhpStorm.
 * User: Fabiano
 * Date: 18/11/15
 * Time: 09:58
 */

//TODO qui la logica iniziale, caricamento dei controller ecc
include_once CONTROL_DIR . "ControllerTest.php";
include_once CONTROL_DIR . "SessioneController.php";
include_once CONTROL_DIR . "DomandaController.php";
include_once CONTROL_DIR . "RispostaApertaController.php";
include_once CONTROL_DIR . "RispostaMultiplaController.php";
include_once CONTROL_DIR . "AlternativaController.php";
$domandaController = new DomandaController();
$testController = new ControllerTest();
$sessioneController = new SessioneController();
$alternativaController = new AlternativaController();
$corsoId = $_URL[3];
$sessId = $_URL[6];
$sessione = $sessioneController->readSessione($sessId);
$matricola = "0512102390";
$studente = $testController->getUtentebyMatricola($matricola);
$nome = $studente->getNome();
$cognome = $studente->getCognome();

$testId = 1;
$multiple = $domandaController->getAllDomandeMultipleByTest($testId);
$aperte = $domandaController->getAllDomandeAperteByTest($testId);
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
    <meta charset="utf-8" />
    <title>Metronic | Page Layouts - Blank Page</title>
    <link rel="stylesheet" type="text/css" href="/assets/global/css/mycounter.css" />
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
                            function creaRispostaAperta($elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaApertaId, $testo, $punteggio){
                                $raCon = new RispostaApertaController();
                                $risp = new RispostaAperta($elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaApertaId, $testo, $punteggio);
                                $raCon->createRispostaAperta($risp);
                            }
                            function creaRispostaMultipla($elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaMultiplaId, $punteggio, $alternativaId){
                                $rmCon = new RispostaMultiplaController();
                                $risp = new RispostaMultipla($elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaMultiplaId, $punteggio, $alternativaId);
                                $rmCon->createRispostaMultipla($risp);
                            }
                                $i = 1;
                                foreach ($multiple as $m) {
                                    $j = 1;
                                    $testo = $m->getTesto();
                                    $multId = $m->getId();
                                    try{
                                        creaRispostaMultipla($sessId, $matricola, $multId, null, null);
                                    }
                                    catch (ApplicationException $ex){
                                        echo '<h3>Impossibile creare risposta</h3>';
                                    }
                                    echo "<h3>".$testo."</h3>";
                                    echo '<div class="form-group form-md-checkboxes">';
                                    echo '<div class="md-checkbox-list">';
                                    $alternative = $alternativaController->getAllAlternativaByDomanda($multId);
                                    foreach ($alternative as $r){
                                        $altId = $r->getId();
                                        echo    '<div class="md-checkbox">
                                                    <input type="checkbox" id="alt-'.$altId.'" name="mul-'.$multId.'" onclick="javascript: updateMultipla(this.name,this.id);" class="md-check">
                                                    <label for="alt-'.$altId.'">
                                                    <span class="inc"></span>
                                                    <span class="check"></span>
                                                    <span class="box"></span>
                                                    '.$r->getTesto().'</label>
                                                </div>';
                                        $j++;
                                    }
                                    $i++;
                                    echo '</div>';
                                    echo '</div>';
                                }

                                foreach ($aperte as $a) {
                                    $testo = $a->getTesto();
                                    $apId = $a->getId();
                                    try{
                                        creaRispostaAperta($sessId, $matricola, $apId, null, null);
                                    }
                                    catch (ApplicationException $ex){
                                        echo '<h3>Impossibile creare risposta</h3>';
                                    }
                                    echo '<h3>'.$testo.'</h3>';
                                    echo    '<div class="form-group">
                                                <textarea class="form-control" id="ap-'.$apId.'" rows="3" placeholder="Inserisci risposta" style="resize:none"></textarea>
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
                                    <a href="javascript:;" onclick="javascript: Consegna()" class="btn sm green-jungle"><span class="md-click-circle md-click-animate" style="height: 94px; width: 94px; top: -23px; left: 2px;"></span>
                                        Consegna
                                    </a>
                                    <a onclick="javascript: Abbandona()" class="btn sm red-intense">
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
<?php include VIEW_DIR . "design/footer.php"; ?>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<?php include VIEW_DIR . "design/js.php"; ?>

<!--Script specifici per la pagina -->
<script src="/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<!--<script src="/assets/global/scripts/mycountdown.js" type="text/javascript"></script>-->
<script src="/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script>
    var sId = <?= $sessId ?>;
    var mat = "<?= $matricola; ?>";
    var intId = null;
    var intId2 = null;
    var intId3 = null;
    
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        //countdown
        $.get("/gestoreCountdown?sessId="+sId,function(data){StartCounter(data);});
        intId2 = setInterval(function(){$.post("/gestoreCountdown?sessId="+sId,function(data){StartCounter(data);});},30000);
        //fine countdown
        //aperte
        $("textarea").focus(function() {
            var apId = $(this).attr('id');
            intId3 = setInterval(function(){
            var testo = document.getElementById($(this).attr('id')).value;
            var res = apId.split('-');
            var id = res[1];
            $.post("/updateAperta?mat="+mat+"&sessId="+sId+"&domId="+id+"&testo="+testo);},10000);
            });
        $("textarea").blur(function() {
            var apId = $(this).attr('id');
            var testo = document.getElementById($(this).attr('id')).value;
            var res = apId.split('-');
            var id = res[1];
            $.post("/updateAperta?mat="+mat+"&sessId="+sId+"&domId="+id+"&testo="+testo);
            clearInterval(intId3);
        });
        //fine aperte
        //multiple
        $("input.md-check").click(function() {
            var multId = $(this).attr('name');
            var res = multId.split('-');
            var rId = res[1];
            var altId = $(this).attr('id');
            res = altId.split('-');
            var aId = res[1];
            if ($("#"+$(this).attr('id')).is(":not(:checked)")){
                aId = null;
                $("#"+$(this).attr('id')).prop( "checked", false);
            }
            else{
                $(".md-check[name="+$(this).attr('name')+"]").prop( "checked", false);
                $("#"+$(this).attr('id')).prop( "checked", true);
            }
            $.post("/updateMultipla?mat="+mat+"&sessId="+sId+"&domId="+rId+"&altId="+aId);
        });
        var updateMultipla = function(multId,altId){
            var res = multId.split('-');
            var rId = res[1];
            res = altId.split('-');
            var aId = res[1];
            if (window.XMLHttpRequest) {
                var xhr = new XMLHttpRequest();
                //metodo tradizionale di registrazione eventi   
                xhr.onreadystatechange =gestoreRichiesta;   
                xhr.open("GET", "/updateMultipla?mat="+mat+"&sessId="+sId+"&domId="+rId+"&altId="+aId, true);   
                xhr.send(""); 
            } 
            function gestoreRichiesta() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                }
            }
        }
        //fine multiple
        //QuickSidebar.init(); // init quick sidebar
        //Demo.init(); // init demo features
    });
</script>
<!-- countdown -->
<script>
   var StartCounter = function(string){
        var date= string.split("|");
        var end = date[0];
        var start = date[1];
        var target_date = new Date(end).getTime();
        var current_date = new Date(start).getTime();
        showTime(current_date,target_date);
        clearInterval(intId);
        intId = setInterval(function(){
            current_date = current_date + 1000;
            showTime(current_date,target_date);}, 1000);
    }
    
    var showTime = function (current_date,target_date) {
        var countdown = document.getElementById("countdown");
        var seconds_left = (target_date - current_date) / 1000;
        var remaining_time = seconds_left;
        var days = parseInt(seconds_left / 86400);
        seconds_left = seconds_left % 86400;

        var hours = parseInt(seconds_left / 3600);
        seconds_left = seconds_left % 3600;
        var minutes = parseInt(seconds_left / 60);
        var seconds = parseInt(seconds_left % 60);
        
        if (remaining_time > 0)
            if (remaining_time >= 600)
                countdown.innerHTML = '<span  style="color: #cf6"><span class="days">' + days +  ' <b>Giorni</b></span> <span class="hours">' + hours + ' <b>Ore</b></span> <span class="minutes">'
        + minutes + ' <b>Minuti</b></span> <span class="seconds">' + seconds + ' <b>Secondi</b></span></span>';
               // countdown.innerHTML = '<span class="time" style="color: #cf6"> '+ hours + ':' + minutes +':' + seconds + ' </span>';  
            else
                countdown.innerHTML = '<span  style="color: #c30"><span class="days">' + days +  ' <b>Giorni</b></span> <span class="hours">' + hours + ' <b>Ore</b></span> <span class="minutes">'
        + minutes + ' <b>Minuti</b></span> <span class="seconds">' + seconds + ' <b>Secondi</b></span></span>';
               // countdown.innerHTML = '<span class="time" style="color: #c30"> '+ hours + ':' + minutes +':' + seconds + ' </span>'; 
        else{ 
            $.get("/gestoreCountdown?sessId="+sId,function(data){
                var date= data.split("|");
                var end = date[0];
                var start = date[1];
                if (new Date(start).getTime() > new Date(end).getTime()){
                    countdown.innerHTML = '<span class="time" style="color: #c30"> Tempo Scaduto </span>';
                    confirm("Tempo scaduto. Vuoi consegnare?");
                    clearInterval(intId2);
                }
                else{
                    var target_date = new Date(end).getTime();
                    var current_date = new Date(start).getTime();
                    showTime(current_date,target_date);
                    clearInterval(intId2);
                    intId2 = setInterval(function(){$.get("/gestoreCountdown?sessId="+sId,function(data){StartCounter(data);});},30000);
                }
                
            });
        }
    }
</script>
<!-- risposte -->
<script>
    
</script>
<!-- consegna e abbandono -->
<script>
    var Consegna = function(){
            var r = confirm("Sei sicuro di voler consegnare? Non potrai tornare indietro.");
            if (r == true){
                $.post("/consegna?mat="+mat+"&sessId="+sId);
            }
        }
        
        
        var Abbandona = function(){
            var r = confirm("Sei sicuro di volerti ritirare dalla sessione in corso? Ti verrà assegnato esito nullo.");
            if (r == true){
                $.post("/abbandona?mat="+mat+"&sessId="+sId);
            }
        }
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
