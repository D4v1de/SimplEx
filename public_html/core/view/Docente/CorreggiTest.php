<?php

/**
 *La view che consente al docente di correggere l’elaborato di uno studente
 * @author Antonio Luca D'Avanzo, Fabiano Pecorelli
 * @version 1
 * @since 18/11/15 09:58
 */

include_once CONTROL_DIR . "ControllerTest.php";
include_once CONTROL_DIR . "SessioneController.php";
include_once CONTROL_DIR . "DomandaController.php";
include_once CONTROL_DIR . "RispostaApertaController.php";
include_once CONTROL_DIR . "RispostaMultiplaController.php";
include_once CONTROL_DIR . "AlternativaController.php";
include_once CONTROL_DIR . "ElaboratoController.php";
include_once CONTROL_DIR . "CdlController.php";

$controlleCdl = new CdlController();
$domandaController = new DomandaController();
$elaboratoController = new ElaboratoController();
$testController = new ControllerTest();
$sessioneController = new SessioneController();
$alternativaController = new AlternativaController();
$raController = new RispostaApertaController();

$corsoId = $_URL[2];
$sessId = $_URL[4];
$matricola = $_URL[6];

$sessione = $sessioneController->readSessione($sessId);
$elaborato = $elaboratoController->readElaborato($matricola,$sessId);
$studente = $testController->getUtentebyMatricola($matricola);
$nome = $studente->getNome();
$cognome = $studente->getCognome();

$testId = $elaborato->getTestId();
$multiple = $domandaController->getAllDomandeMultipleByTest($testId);
$aperte = $domandaController->getAllDomandeAperteByTest($testId);

try {
    $corso = $controlleCdl->readCorso($corsoId);
    $nomecorso= $corso->getNome();
}
catch (ApplicationException $ex) {
    echo "<h1>ERRORE NELLA LETTURA DEL CORSO!</h1>" . $ex;
}

if (isset($_GET['salva'])){
    $fin = $elaborato->getEsitoParziale();
    foreach ($aperte as $ap){
        $apId = $ap->getId();
        $punt = $_GET['sel-'.$apId.''];
        $fin = $fin + $punt;
        $rispAp = $raController->readRispostaAperta($sessId, $matricola, $apId);
        $rispAp->setPunteggio($punt);
        $raController->updateRispostaAperta($rispAp, $sessId, $matricola, $apId);
    }
    $elaborato->setEsitoFinale($fin);
    $elaborato->setStato("Corretto");
    $elaboratoController->updateElaborato($matricola,$sessId,$elaborato);   
    header("Location: "."/docente/corso/"."$corsoId"."/sessione/"."$sessId"."/esiti/");
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
                <?php echo 'Correzione Elaborato di '.$cognome." ".$nome ?>
            </h3>
            <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="index.html">Home</a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            <a href="<?php echo "/docente/cdl/".$corso->getCdlMatricola(); ?>"> <?php echo $controlleCdl->readCdl($corso->getCdlMatricola())->getNome(); ?> </a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            <?php
                            $vaiANomeCorso="/docente/corso/".$corsoId;
                            printf("<a href=\"%s\">%s</a><i class=\"fa fa-angle-right\"></i>", $vaiANomeCorso ,$nomecorso);
                            ?>
                        </li>
                        <li>
                            <?php
                            $vaiAVisu="/docente/corso/".$corsoId."/sessione"."/".$sessId."/"."visualizzasessione";
                            printf("<a href=\"%s\">%s</a><i class=\"fa fa-angle-right\"></i>", $vaiAVisu ,"Sessione ".$sessId);
                            ?>
                        </li>
                        <li>
                            <?php
                            $vaiAEsiti="/docente/corso/".$corsoId."/sessione"."/".$sessId."/"."esiti";
                            printf("<a href=\"%s\">%s</a><i class=\"fa fa-angle-right\"></i>", $vaiAEsiti ,"Esiti");
                            ?>
                        </li>
                        <li>
                            Correggi Elaborato
                        </li>
                    </ul>
                </div>

            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <form action="" method="GET">
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
            function setRispostaApertaValue($elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaApertaId)
            {
                $raCon = new RispostaApertaController();
                $risp = $raCon->readRispostaAperta($elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaApertaId);
                return $risp->getTesto();
            }

            printf("<div class=\"portlet box blue-madison\">
                <div class=\"portlet-title\">
                    <div class=\"caption\">
                        <i class=\"fa fa-file-text-o\"></i>Domande a Risposta Multipla
                    </div>
                    <div class=\"tools\">
                        <a href=\"javascript:;\" class=\"collapse\" data-original-title=\"\" title=\"\">
                        </a>
                    </div>
                </div>
                 <div class=\"portlet-body\">");
            
                            function getRispostaMultiplaAlternativa($elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaMultiplaId){
                                $rmCon = new RispostaMultiplaController();
                                $risp = $rmCon->readRispostaMultipla($elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaMultiplaId);
                                return $risp->getAlternativaId();
                            }

            $i = 1;
            foreach ($multiple as $m) {
                $j = 1;
                $testo = $m->getTesto();
                $multId = $m->getId();
                $selectedAlt = getRispostaMultiplaAlternativa($sessId, $matricola, $multId);
                
                echo "<h3>".$testo."</h3>";
                echo '<div class="form-group form-md-checkboxes">';
                echo '<div class="md-checkbox-list">';
                $alternative = $alternativaController->getAllAlternativaByDomanda($multId);
                foreach ($alternative as $r){
                    $altId = $r->getId();
                    echo    '<div class="md-checkbox">
                                                    <input type="checkbox" id="alt-'.$altId.'" name="mul-'.$multId.'" ';
                    if ($selectedAlt == $altId) echo 'checked';
                    echo        ' onclick="javascript: updateMultipla(this.name,this.id);" class="md-check" disabled>
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
            echo ' </div></div>';
            printf("<div class=\"portlet box blue-madison\">
                <div class=\"portlet-title\">
                    <div class=\"caption\">
                        <i class=\"fa fa-file-text-o\"></i>Domande a Risposta Aperta
                    </div>
                    <div class=\"tools\">
                        <a href=\"javascript:;\" class=\"collapse\" data-original-title=\"\" title=\"\">
                        </a>
                    </div>
                </div>
                 <div class=\"portlet-body\">");
            
            function getRispostaApertaValue($elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaApertaId){
                $raCon = new RispostaApertaController();
                $risp = $raCon->readRispostaAperta($elaboratoSessioneId, $elaboratoStudenteMatricola, $domandaApertaId);
                return $risp->getTesto();
            }
            foreach ($aperte as $a) {
                $testo = $a->getTesto();
                $apId = $a->getId();
                $txt = null;
                $txt = getRispostaApertaValue($sessId, $matricola, $apId);
                echo '<h3>'.$testo.'</h3>';
                $max = $domandaController->readPunteggioMaxAlternativo($apId, $testId);
                if ($max == null){
                    $dom = $domandaController->getDomandaAperta($apId);
                    $max = $dom->getPunteggioMax();                            
                }
                echo    '  <div class="row">  <div class="col-md-9">
                                                <textarea class="form-control" disabled id="ap-'.$apId.'" rows="3" style="resize:none">'.$txt.'</textarea>
                                            </div>  <div class="col-md-1">
                            <select class="form-control" name="sel-'.$apId.'">';
                            for($x = 0; $x <= $max; $x++)
                                echo '<option>'.$x.'</option>';
                            echo '</select>
                        </div>
                    </div>';
                $i++;
            }
            echo ' </div></div>';
            ?>
            <div class="form-actions">
                <div class="row">
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-9">
                                <button type="submit" name="salva" class="btn green" data-toggle="confirmation" data-singleton="true" data-popout="true" title="Sei sicuro di voler salvare?">Salva</button>
                            </div>
                        </div>
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

<script src="/assets/admin/pages/scripts/ui-confirmations.js"></script>
<script src="/assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js" type="text/javascript"></script>

<script>
    jQuery(document).ready(function () {
        Metronic.init();
        Layout.init();
        UIConfirmations.init();
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
