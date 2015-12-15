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
include_once CONTROL_DIR . "ElaboratoController.php";
$domandaController = new DomandaController();
$elaboratoController = new ElaboratoController();
$testController = new ControllerTest();
$sessioneController = new SessioneController();
$alternativaController = new AlternativaController();
$rmCon = new RispostaMultiplaController();
$corsoId = $_URL[2];
$sessId = $_URL[5];
$sessione = $sessioneController->readSessione($sessId);
$studente = $_SESSION['user'];
$matricola = $studente->getMatricola();
$elaborato = $elaboratoController->readElaborato($matricola,$sessId);

$now = date("Y-m-d H:i:s");
$end = $sessione->getDataFine();
$start = $sessione->getDataInizio();
if ($now < $start || $now > $end || strcmp($elaborato->getStato(),"Non corretto"))
    header("Location: "."/studente/corso/"."$corsoId"."/");

$studente = $testController->getUtentebyMatricola($matricola);
$nome = $studente->getNome();
$cognome = $studente->getCognome();

$testId = $elaborato->getTestId();
$multiple = $domandaController->getAllDomandeMultipleByTest($testId);
$aperte = $domandaController->getAllDomandeAperteByTest($testId);

if (isset($_GET['abbandona'])){
    $elaborato->setEsitoParziale(0);
    $elaborato->setEsitoFinale(0);
    $elaborato->setStato("Corretto");
    $elaboratoController->updateElaborato($matricola,$sessId,$elaborato);   
    header("Location: "."/studente/corso/"."$corsoId"."/");
}

if (isset($_GET['consegna'])){
    $rispMul = $rmCon->getMultipleByElaborato($elaborato);
    $punteggio = 0;
    foreach ($rispMul as $rm) {
        $dom = $domandaController->getDomandaMultipla($rm->getDomandaMultiplaId());
        $multId = $rm->getDomandaMultiplaId();
        $puntCorrAlt = $domandaController->readPunteggioCorrettaAlternativo($multId, $testId);
        $puntErrAlt = $domandaController->readPunteggioErrataAlternativo($multId, $testId);
        $puntCor = ($puntCorrAlt != null)? $puntCorrAlt:$dom->getPunteggioCorretta();
        $puntErr = ($puntErrAlt != null)? $puntErrAlt:$dom->getPunteggioErrata();
        $altCor = $alternativaController->getAlternativaCorrettaByDomanda($multId);
        if ($rm->getAlternativaId() != 0)
            if ($altCor->getId() == $rm->getAlternativaId()){
                $punteggio = $punteggio + $puntCor;
                $rm->setPunteggio($puntCor);
            }
            else{
                $punteggio = $punteggio + $puntErr;
                $rm->setPunteggio($puntErr);
            }
            $rmCon->updateRispostaMultipla($rm, $sessId, $matricola, $multId);
    }
    $elaborato->setEsitoParziale($punteggio);
    
    $elaborato->setStato("Parzialmente corretto");
    $elaboratoController->updateElaborato($matricola,$sessId,$elaborato);   
    header("Location: "."/studente/corso/"."$corsoId"."/");
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
    <meta charset="utf-8" />
    <title>Metronic | Page Layouts - Blank Page</title>
    <script src="jquery-1.11.3.min.js"></script>
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
                            <a href="/studente">Home</a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            <a href="/studente/corso/<?php echo $corsoId; ?>">Nome Corso</a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            Esegui Test
                        </li>
                    </ul>
                </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            
        <form action="" method="GET">
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
                            $selectedAlt = null;
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
                            function setRispostaMultiplaAlternativa($elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaMultiplaId){
                                $rmCon = new RispostaMultiplaController();
                                $risp = $rmCon->readRispostaMultipla($elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaMultiplaId);
                                return $risp->getAlternativaId();
                            }
                            function setRispostaApertaValue($elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaApertaId){
                                $raCon = new RispostaApertaController();
                                $risp = $raCon->readRispostaAperta($elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaApertaId);
                                return $risp->getTesto();
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
                                        $selectedAlt = setRispostaMultiplaAlternativa($sessId, $matricola, $multId);
                                    }
                                    echo "<h3>".$testo."</h3>";
                                    echo '<div class="form-group form-md-checkboxes">';
                                    echo '<div class="md-checkbox-list">';
                                    $alternative = $alternativaController->getAllAlternativaByDomanda($multId);
                                    foreach ($alternative as $r){
                                        $altId = $r->getId();
                                        echo    '<div class="md-checkbox">
                                                    <input type="checkbox" id="alt-'.$altId.'" name="mul-'.$multId.'" ';
                                        if ($selectedAlt == $altId) echo 'checked';
                                        echo        ' onclick="javascript: updateMultipla(this.name,this.id);" class="md-check">
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
                                    $txt = null;
                                    try{
                                        creaRispostaAperta($sessId, $matricola, $apId, null, null);
                                    }
                                    catch (ApplicationException $ex){
                                        $txt = setRispostaApertaValue($sessId, $matricola, $apId);
                                    }
                                    echo '<h3>'.$testo.'</h3>';
                                    echo    '<div class="form-group">
                                                <textarea class="form-control" id="ap-'.$apId.'" rows="3" placeholder="Inserisci risposta" style="resize:none">'.$txt.'</textarea>
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
                                            <button type="submit" name="consegna" class="btn green" data-toggle="confirmation" data-singleton="true" data-popout="true" title="Sei sicuro di voler consegnare?">Consegna</button>
                                            <button type="submit" name="abbandona" class="btn red-intense" data-toggle="confirmation" data-singleton="true" data-popout="true" title="Vuoi davvero ritirarti? Ti verrà assegnato esito nullo.">Abbandona</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </form>
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

<script src="/assets/admin/pages/scripts/ui-confirmations.js"></script>
<script src="/assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js" type="text/javascript"></script>

<script src="/assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
<script src="/assets/admin/pages/scripts/ui-alert-dialog-api.js"></script>
<script src="/assets/admin/pages/scripts/ui-blockui.js"></script>
<script>
    var sId = <?= $sessId ?>;
    var mat = "<?= $matricola; ?>";
    var intId = null;
    var intId2 = null;
    var intId3 = null;
    var intId4 = null;
    var intCheck = null;
    var intWait = null;
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        UIConfirmations.init();
        UIAlertDialogApi.init();
        checkConnection();
        intCheck = setInterval(checkConnection,1000);
        //Metronic.startPageLoading({animate: true});
        //window.setTimeout(function() {
        //    Metronic.stopPageLoading();
        //}, 2000);
        //countdown
        $.get("/studente/gestoreCountdown?sessId="+sId,function(data){StartCounter(data);});
        intId2 = setInterval(function(){$.post("/studente/gestoreCountdown?sessId="+sId,function(data){StartCounter(data);});},10000);
        //fine countdown
        //controller abilitazione
        $.get("/studente/controllerAbilitazione?mat="+mat+"&sessId="+sId,function(data){valutaAbilitazione(data);});
        intId4 = setInterval(function(){$.get("/studente/controllerAbilitazione?mat="+mat+"&sessId="+sId,function(data){valutaAbilitazione(data);});},10000);
        //fine controller
        //aperte
        $("textarea").focus(function() {
            var apId = $(this).attr('id');
            $.get("/studente/controllerAbilitazione?mat="+mat+"&sessId="+sId,function(data){
                check = valutaAbilitazione(data);
                $.get("/studente/gestoreCountdown?sessId="+sId,function(data){
                var date= data.split("|");
                var end = date[0];
                var start = date[1];
                check = check & (new Date(start).getTime() < new Date(end).getTime());
                StartCounter(data);
                    if (check){
                        intId3 = setInterval(function(){
                            var testo = document.getElementById($(this).attr('id')).value;
                            var res = apId.split('-');
                            var id = res[1];
                            $.post("/studente/updateAperta?mat="+mat+"&sessId="+sId+"&domId="+id+"&testo="+testo);
                        },1000);
                    }
                });
            });
        });
        $("textarea").blur(function() {
            if (check){
                var apId = $(this).attr('id');
                var testo = document.getElementById($(this).attr('id')).value;
                var res = apId.split('-');
                var id = res[1];
                $.post("/studente/updateAperta?mat="+mat+"&sessId="+sId+"&domId="+id+"&testo="+testo);
                clearInterval(intId3);
            }
        });/*
        $("textarea").each(function(){
            $.get("/getApertaValue?mat="+mat+"&sessId="+sId+"&domId="+id+"&testo="+testo);
        });*/
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
            $.get("/studente/controllerAbilitazione?mat="+mat+"&sessId="+sId,function(data){
                check = valutaAbilitazione(data);
                $.get("/studente/gestoreCountdown?sessId="+sId,function(data){
                var date= data.split("|");
                var end = date[0];
                var start = date[1];
                check = check & (new Date(start).getTime() < new Date(end).getTime());
                StartCounter(data);
                    if (check){
                        $.post("/studente/updateMultipla?mat="+mat+"&sessId="+sId+"&domId="+rId+"&altId="+aId);
                    }
                });
            });
        });
        //fine multiple
        //QuickSidebar.init(); // init quick sidebar
        //Demo.init(); // init demo features
    });
</script>
<!-- countdown -->
<script>
    
   function checkConnection() {
        if (navigator.onLine) {
        } else {
            Metronic.blockUI({
                esegui: true
            });
            Metronic.startPageLoading({animate: true});
            clearInterval(intCheck);
            intWait = setInterval(waitConnection,1000);
        }
    }
    
    function waitConnection() {
        if (navigator.onLine) {
            Metronic.unblockUI();
            Metronic.stopPageLoading();
            clearInterval(intWait);
            intCheck = setInterval(checkConnection,1000);
        } else {
        }
    }

//Metronic.startPageLoading({animate: true});
        //window.setTimeout(function() {
        //    Metronic.stopPageLoading();
        //}, 2000);
        
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
            $.get("/studente/gestoreCountdown?sessId="+sId,function(data){
                var date= data.split("|");
                var end = date[0];
                var start = date[1];
                if (new Date(start).getTime() >= new Date(end).getTime()){
                    countdown.innerHTML = '<span class="time" style="color: #c30"> Tempo Scaduto </span>';
                    timeout_scaduto();
                }
                else{
                    var target_date = new Date(end).getTime();
                    var current_date = new Date(start).getTime();
                    showTime(current_date,target_date);
                    clearInterval(intId2);
                    intId2 = setInterval(function(){$.get("/studente/gestoreCountdown?sessId="+sId,function(data){StartCounter(data);});},10000);
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
    var valutaAbilitazione = function(string){
        if (string == "Corretto"){
            bootbox.dialog({
                message: "Impossibile continuare l'esecuzione. Il tuo test è stato annullato.",
                title: "Test annullato!",
                closeButton: false,
                buttons: {
                  conferma: {
                    label: "Ok",
                    className: "red",
                    callback: function() {
                      location.href = "/studente/corso/<?php echo $corsoId; ?>";
                    }
                  }
                }
            });
            clearInterval(intId);
            clearInterval(intId2);
            clearInterval(intId3);
            clearInterval(intId4);
            return false;
        }
        else if (string == "Parzialmente corretto"){
            bootbox.dialog({
                message: "Impossibile continuare l'esecuzione. Hai già sostenuto questo test in precedenza.",
                title: "Test già eseguito!",
                closeButton: false,
                buttons: {
                  conferma: {
                    label: "Ok",
                    className: "red",
                    callback: function() {
                      location.href = "/studente/corso/<?php echo $corsoId; ?>";
                    }
                  }
                }
            });
            clearInterval(intId);
            clearInterval(intId2);
            clearInterval(intId3);
            clearInterval(intId4);
            return false;
        }
        else return true;
    }
                                            
    function timeout_scaduto(){
        bootbox.dialog({
                    message: "Vuoi consegnare o ritirarti?",
                    title: "Tempo scaduto!",
                    closeButton: false,
                    buttons: {
                      consegna: {
                        label: "Consegna",
                        className: "green",
                        callback: function() {
                            $.post("/studente/consegna?mat="+mat+"&sessId="+sId);
                            location.href = "/studente/corso/<?php echo $corsoId; ?>";
                        }
                      },
                      abbandona: {
                        label: "Abbandona",
                        className: "red",
                        callback: function() {
                            $.post("/studente/abbandona?mat="+mat+"&sessId="+sId);
                            location.href = "/studente/corso/<?php echo $corsoId; ?>";
                        }
                      }
                    }
                });
                clearInterval(intId);
                clearInterval(intId2);
                clearInterval(intId3);
                clearInterval(intId4);
            }
        
            /*
    var Consegna = function(){
               
        }
        
        
        var Abbandona = function(){
            if (r == true){
                confirm("lallalla");
                $.post("/abbandona?mat="+mat+"&sessId="+sId);
            }
        }*/
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
