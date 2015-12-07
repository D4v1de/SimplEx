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
$domandaController = new DomandaController();
$testController = new ControllerTest();
$sessioneController = new SessioneController();
$corsoId = $_URL[3];
$sessId = $_URL[6];
$sessione = $sessioneController->readSessione($sessId);
$matricola = "0512102390";
$studente = $testController->getUtentebyMatricola($matricola);
$nome = $studente->getNome();
$cognome = $studente->getCognome();

$testId = 1;
$multiple = $domandaController->getMultTest($testId);
$aperte = $domandaController->getAperteTest($testId);
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
                                   // creaRispostaMultipla($sessId, $matricola, $multId, null, null);
                                    echo "<h3>".$testo."</h3>";
                                    echo '<div class="form-group form-md-radios">';
                                    echo '<div class="md-radio-list">';
                                    $alternative = $testController->getRispMult($m->getId(),$m->getArgomentoId(),$m->getArgomentoCorsoId());
                                    foreach ($alternative as $r){
                                        $altId = $r->getId();
                                        echo    '<div class="md-radio">
                                                    <input type="radio" id="'.$altId.'" name="'.$multId.'" onclick="javascript: AddMultipla(this.id,this.name);" class="md-radiobtn">
                                                    <label for="'.$altId.'">
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
                                   // creaRispostaAperta($sessId, $matricola, $apId, null, null);
                                    echo '<h3>'.$testo.'</h3>';
                                    echo    '<div class="form-group">
                                                <textarea class="form-control" onfocus="javascript: ApertaOnFocus(this.id);" id="'.$apId.'" rows="3" placeholder="Inserisci risposta" style="resize:none"></textarea>
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
<!--<script src="/assets/global/scripts/mycountdown.js" type="text/javascript"></script>-->
<script src="/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        StartCounter();
        setInterval(StartCounter,10000);
        //QuickSidebar.init(); // init quick sidebar
        //Demo.init(); // init demo features
    });
</script>
<!-- inizializza risposta multipla 
<script>
    var CreateMultipla = function(dom){
        var mat = "<?= $matricola; ?>";
        var sId = <?= $sessId ?>;
	if (window.XMLHttpRequest) {
	  var xhr = new XMLHttpRequest();
	  //metodo tradizionale di registrazione eventi   
	  xhr.onreadystatechange =gestoreRichiesta;   
	  xhr.open("GET", "/inizializzaMultipla?mat="+mat+"&sessId="+sId+"&domId="+dom, true);   
	  //xhr.open("GET", "/usr/studente/corso/18", true);   
	  xhr.send(""); 
	} 
	function gestoreRichiesta() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert(xhr.responseText);
            }
	}
    }
</script>
<!-- inizializza risposta aperta 
<script>
    var CreateAperta = function(dom){
        var mat = "<?= $matricola; ?>";
        var sId = <?= $sessId ?>;
	if (window.XMLHttpRequest) {
	  var xhr = new XMLHttpRequest();
	  //metodo tradizionale di registrazione eventi   
	  xhr.onreadystatechange =gestoreRichiesta;   
	  xhr.open("GET", "/inizializzaAperta?mat="+mat+"&sessId="+sId+"&domId="+dom, true);   
	  //xhr.open("GET", "/usr/studente/corso/18", true);   
	  xhr.send(""); 
	} 
	function gestoreRichiesta() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert(xhr.responseText);
            }
	}
    }
</script>
<!-- risposta aperta -->
<script>
    /*var ApertaOnFocus = function(domId){
        var mat = "<?= $matricola; ?>";
        var sId = <?= $sessId ?>;
        var cId = <?= $corsoId ?>;
        if (window.XMLHttpRequest) {
	  var xhr = new XMLHttpRequest();
	  //metodo tradizionale di registrazione eventi   
	  xhr.onreadystatechange =gestoreRichiesta;   
	  xhr.open("GET", "/inizializzaAperta?mat="+mat+"&sessId="+sId+"&domId="+domId+"&corsoId="+cId, true);   
	  //xhr.open("GET", "/usr/studente/corso/18", true);   
	  xhr.send(""); 
	} 
	function gestoreRichiesta() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                //alert(xhr.responseText);
                setInterval(UpdateAperta(domId),10000);
            }
        }
    }*/
    var UpdateAperta = function(domId){
        var mat = "<?= $matricola; ?>";
        var sId = <?= $sessId ?>;
        var testo = document.getElementById(domId).value;
	if (window.XMLHttpRequest) {
	  var xhr = new XMLHttpRequest();
	  //metodo tradizionale di registrazione eventi   
	  xhr.onreadystatechange =gestoreRichiesta;   
	  xhr.open("GET", "/updateAperta?mat="+mat+"&sessId="+sId+"&testo="+testo, true);   
	  //xhr.open("GET", "/usr/studente/corso/18", true);   
	  xhr.send(""); 
	} 
	function gestoreRichiesta() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert(xhr.responseText);
            }
	}
}
</script>
<!-- countdown -->
<script>
    var target_date;
    var current_date;
    var intId = null;
    var getDates = function(){
        var sId = <?= $sessId ?>;
        if (window.XMLHttpRequest) {
              var xhr = new XMLHttpRequest();
              //metodo tradizionale di registrazione eventi   
              xhr.onreadystatechange =gestoreRichiesta;   
              xhr.open("GET", "/gestoreCountdown?sessId="+sId, true);   
              //xhr.open("GET", "/usr/studente/corso/18", true);   
              xhr.send(""); 
            }
        function gestoreRichiesta() {
            var date= xhr.responseText.split("|");
            var end = date[0];
            var start = date[1];
            target_date = new Date(end).getTime();
            current_date = new Date(start).getTime();
        }
    }
    var StartCounter = function(){
        getDates();
        // set the date we're counting down to
        // variables for time units
        var days, hours, minutes, seconds;

        // get tag element
        var countdown = document.getElementById('countdown');
        // update the tag with id "countdown" every 1 second
        
        
        
       // showTime();
        clearInterval(intId);
        intId = setInterval(showTime, 1000);
    }
    var showTime = function () {
        // find the amount of "seconds" between now and target
        var seconds_left = (target_date - current_date) / 1000;
        var remaining_time = seconds_left;
        // do some time calculations
        days = parseInt(seconds_left / 86400);
        seconds_left = seconds_left % 86400;

        hours = parseInt(seconds_left / 3600);
        seconds_left = seconds_left % 3600;

        // green #ccff66 #00cc33
        // red #cc3300
        minutes = parseInt(seconds_left / 60);
        seconds = parseInt(seconds_left % 60);

        // format countdown string + set tag value
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
            countdown.innerHTML = '<span class="time" style="color: #c30"> Tempo Scaduto </span>';
            
        }
        current_date = current_date + 1000;
    }
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
