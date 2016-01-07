<?php
/**
 * La view consente allo studente di visualizzare un test precedentemente eseguito e se possibile visualizzare risultati e correzione
 * @author Federico De Rosa
 * @version 1
 * @since 18/11/15 09:58
 */

include_once MODEL_DIR . "CdLModel.php";
include_once MODEL_DIR . "CorsoModel.php";
include_once MODEL_DIR . "UtenteModel.php";
include_once MODEL_DIR . "ElaboratoModel.php";
include_once MODEL_DIR . "SessioneModel.php";
include_once MODEL_DIR . "TestModel.php";
include_once MODEL_DIR . "DomandaModel.php";
include_once MODEL_DIR . "AlternativaModel.php";
include_once MODEL_DIR . "RispostaApertaModel.php";
include_once MODEL_DIR . "RispostaMultiplaModel.php";
$modelcdl = new CdLModel();
$modelcorso = new CorsoModel();
$modelutente = new UtenteModel();
$modelelaborato = new ElaboratoModel();
$modelsessione = new SessioneModel();
$modeltest = new TestModel();
$modeldomanda = new DomandaModel();
$modelalternativa = new AlternativaModel();
$modelrispostaaperta = new RispostaApertaModel();
$modelrispostamultipla = new RispostaMultiplaModel();

$cdl = null;
$corso = null;
$docenteassociato = Array();
$sessione = null;
$test = null;
$elaborato = null;
$studente = null;
$multiple = Array();
$aperte = Array();
$alternative = Array();
$rispostaaperta = null;
$rispostamultipla = null;
$i = 0;
$url = null;
$url2 = null;

$url = $_URL[2];
if (!is_numeric($url)) {
    echo "<script type='text/javascript'>alert('errore url!!(idcorso)');</script>";
}
$url2 = $_URL[4];
if (!is_numeric($url)) {
    echo "<script type='text/javascript'>alert('errore url!!(idelaborato)');</script>";
}

$studente = $_SESSION['user'];

try {
    $corso = $modelcorso->readCorso($url);

} catch (ApplicationException $ex) {
    echo "<h1>INSERIRE ID CORSO NEL PATH!</h1>" . $ex;
}
try {
    $cdl = $modelcdl->readCdl($corso->getCdlMatricola());

} catch (ApplicationException $ex) {
    echo "<h1>READCDL FALLITO!</h1>" . $ex;
}
try {
    $elaborato = $modelelaborato->readElaborato($studente->getMatricola(), $url2);

} catch (ApplicationException $ex) {
    echo "<h1>READELABORATO FALLITO!</h1>" . $ex;
}
try {
    $docenteassociato = $modelutente->getAllDocentiByCorso($corso->getId());

} catch (ApplicationException $ex) {
    echo "<h1>GETDOCENTIASSOCIATI FALLITO</h1>" . $ex;
}
try {
    $sessione = $modelsessione->readSessione($url2);

} catch (ApplicationException $ex) {
    echo "<h1>INSERIRE ID SESSIONE NEL PATH!</h1>" . $ex;
}
try {
    $test = $modeltest->readTest($elaborato->getTestId());

} catch (ApplicationException $ex) {
    echo "<h1>READTEST FALLITO!</h1>" . $ex;
}
try {
    $multiple = $modeldomanda->getAllDomandeMultipleByTest($test->getId());

} catch (ApplicationException $ex) {
    echo "<h1>GETALLDOMANDEMULTIPLEBYTEST FALLITO!</h1>" . $ex;
}
try {
    $aperte = $modeldomanda->getAllDomandeAperteByTest($test->getId());

} catch (ApplicationException $ex) {
    echo "<h1>GETALLDOMANDEAPERTEBYTEST FALLITO!</h1>" . $ex;
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
    <title>Visualizza Test</title>
    <?php include VIEW_DIR . "design/header.php"; ?>
    <script type="text/javascript">
        var ris = [];
    </script>
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
                Visualizza <?php echo 'Test ' . $test->getId(); ?>
            </h3>

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="/studente">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="/studente/cdls">CdL</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="/studente/cdl/<?php echo $cdl->getMatricola(); ?>"><?php echo $cdl->getNome(); ?></a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="/studente/corso/<?php echo $corso->getId(); ?>"><?php echo $corso->getNome(); ?></a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        Test <?php echo $test->getId(); ?>
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
                                <div class="col-md col-md-8">
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
                                <div class="col-md col-md-4">
                                    <h3><?php if ($modelsessione->readMostraEsitoSessione($sessione->getId()) == 'Si' && $elaborato->getStato() == 'Corretto') {
                                                    echo 'Esito Finale: ' . $elaborato->getEsitoFinale() . '/'.$test->getPunteggioMax();
                                                    }
                                                else if($modelsessione->readMostraEsitoSessione($sessione->getId()) == 'Si' && $elaborato->getStato() != 'Corretto') {
                                                    echo 'Parziale: ' . $elaborato->getEsitoParziale() . '/'.$test->getPunteggioMax();
                                                    } ?>
                                    </h3>
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
                    <!-- BEGIN EXAMPLE TABLE PORTLET-->
                    <div class="portlet box blue-madison">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-file-text-o"></i>Test
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title="">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group form-md-line-input has-success">
                                        <div class="input">
                                            <input type="text" class="form-control"
                                                   value="<?php echo $studente->getNome(); ?>" disabled>
                                            <label for="form_control_1">Nome</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-md-line-input has-success">
                                        <div class="input">
                                            <input type="text" class="form-control"
                                                   value="<?php echo $studente->getCognome(); ?>" disabled>
                                            <label for="form_control_1">Cognome</label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group form-md-line-input has-success">
                                        <div class="input">
                                            <input type="text" class="form-control"
                                                   value="<?php echo $studente->getMatricola(); ?>" disabled>
                                            <label for="form_control_1">Matricola</label>
                                            <span class="help-block">Inserire la matricola</span>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php
                            foreach ($multiple as $m) {
                                printf("<div class=\"portlet light bordered\"><div class=\"portlet-title\"><div id=\"div%s\" class=\"caption questions\"><i id=\"i%s\" class=\"fa fa-question-circle\"></i><span class=\"caption-subject bold uppercase\">%s</span></div><div class=\"tools\"><a href=\"javascript:;\" class=\"collapse\" data-original-title=\"\" title=\"\"></a></div></div>",$i ,$i , base64_decode($m->getTesto()));
                                printf("<div class=\"portlet-body\">");
                                $i++;
                                try {
                                    $alternative = $modelalternativa->getAllAlternativaByDomanda($m->getId());

                                } catch (ApplicationException $ex) {
                                    echo "<h1>GETALLALTERNATIVABYDOMANDA FALLITO!</h1>" . $ex;
                                }
                                try {
                                    $rispostamultipla = $modelrispostamultipla->readRispostaMultipla($elaborato->getSessioneId(), $studente->getMatricola(), $m->getId());

                                } catch (ApplicationException $ex) {
                                    echo "<h1>READRISPOSTAMULTIPLA FALLITO!</h1>" . $ex;
                                }

                                //correzione domanda non risposta
                                if($rispostamultipla->getAlternativaId() == 0) {
                                    printf("<script> ris.push('Carlo'); </script>");
                                }
                                foreach ($alternative as $a) {
                                    printf("<div class=\"form-group form-md-checkboxes\"><div class=\"md-checkbox-list\"><div class=\"md-checkbox\">");
                                    if ($rispostamultipla->getAlternativaId() == $a->getId()) {

                                        printf("<script> ris.push('%s'); </script>", $a->getCorretta());
                                        printf("<input type=\"checkbox\" id=\"alt-12\" name=\"mul-12\" class=\"md-check\" disabled checked>");
                                    } else {
                                        printf("<input type=\"checkbox\" id=\"alt-12\" name=\"mul-12\" class=\"md-check\" disabled>");
                                    }

                                    //mi segna una classe a tutte le corrette e una a tutte le sbagliate
                                    if($a->getCorretta() == 'Si') {
                                        printf("<label for=\"alt-12\"><span class=\"inc\"></span><span class=\"check\"></span><span class=\"box\"></span>%s</label><span class=\"esatte col-md-offset-1\"></span></div>", base64_decode($a->getTesto()));
                                    }
                                    else if($a->getCorretta() == 'No' && $rispostamultipla->getAlternativaId() == $a->getId()) {
                                        printf("<label for=\"alt-12\"><span class=\"inc\"></span><span class=\"check\"></span><span class=\"box\"></span>%s</label><span class=\"sbagliate col-md-offset-1\"></span></div>", base64_decode($a->getTesto()));
                                    }
                                    else {
                                        printf("<label for=\"alt-12\"><span class=\"inc\"></span><span class=\"check\"></span><span class=\"box\"></span>%s</label></div>", base64_decode($a->getTesto()));
                                    }
                                    printf("</div></div>");
                                }
                                printf("</div></div>");
                            }
                            foreach ($aperte as $a) {
                                try {
                                    $rispostaaperta = $modelrispostaaperta->readRispostaAperta($elaborato->getSessioneId(), $studente->getMatricola(), $a->getId());
                                } catch (ApplicationException $ex) {
                                    echo "<h1>READRISPOSTAAPERTA FALLITO!</h1>" . $ex;
                                }
                                $punteggio = $rispostaaperta->getPunteggio();
                                $componi = $modeldomanda->readPunteggioMaxAlternativo($a->getId(), $test->getId());
                                $max = $a->getPunteggioMax() == null ? $componi : $a->getPunteggioMax();
                                if($punteggio == $max) {
                                    printf("<div class=\"portlet light bordered\"><div class=\"portlet-title\"><div class=\"caption open perfetta\"><i class=\"fa fa-question-circle\"></i><span class=\"caption-subject bold uppercase\">%s</span></div><div class=\"caption punteggio col-md-offset-1\"></div><div class=\"tools\"><a href=\"javascript:;\" class=\"collapse\" data-original-title=\"\" title=\"\"></a></div></div>", base64_decode($a->getTesto()));
                                }
                                else {
                                    printf("<div class=\"portlet light bordered\"><div class=\"portlet-title\"><div class=\"caption open\"><i class=\"fa fa-question-circle\"></i><span class=\"caption-subject bold uppercase\">%s</span></div><div class=\"caption punteggio col-md-offset-1\"></div><div class=\"tools\"><a href=\"javascript:;\" class=\"collapse\" data-original-title=\"\" title=\"\"></a></div></div>", base64_decode($a->getTesto()));
                                }
                                printf("<div class=\"portlet-body\">");
                                if ($rispostaaperta->getDomandaApertaId() == $a->getId()) {
                                    printf("<textarea class=\"form-control\" id=\"ap-12\" rows=\"3\" placeholder=\"\" style=\"resize:none\" disabled>%s</textarea>", base64_decode($rispostaaperta->getTesto()));
                                }
                                printf("</div></div>");
                            }
                            ?>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <?php if($modelsessione->readMostraRisposteCorretteSessione($sessione->getId()) == 'Si' && $elaborato->getStato() != 'Non Corretto') {printf("<a href=\"#\" type=\"button\" onclick=\"correggi()\" class=\"btn green-jungle\">Correggi</a>");} ?>
                                    </div>
                                    <div class="col-md-4">
                                        <a href="/studente/corso/<?php echo $corso->getId(); ?>">
                                            <button type="button" class="btn red-intense">Esci</button>
                                        </a>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <!-- END EXAMPLE TABLE PORTLET-->
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
<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        //QuickSidebar.init(); // init quick sidebar
        //Demo.init(); // init demo features
    });
</script>
<script type="text/javascript">
    function correggi() {
        /*for(var r in ris) {
            alert(ris[r]);
        }*/
        if(document.getElementsByClassName('label label-sm risp').length == 0) {
            for(var r in ris) {
                if(ris[r] == 'Si') {
                    document.getElementById("div"+r).setAttribute('class','caption questions font-green-haze');
                    document.getElementById("i"+r).setAttribute('class','fa fa-question-circle font-green-haze');
                }
                else if(ris[r] == 'No') {
                    document.getElementById("div"+r).setAttribute('class','caption questions font-red-sunglo');
                    document.getElementById("i"+r).setAttribute('class','fa fa-question-circle font-red-sunglo');
                }
            }
            var array = document.getElementsByClassName("esatte");
            for(var i=0; i<array.length; i++) {
                var span = document.createElement("span");
                span.setAttribute("class","label label-sm label-success risp");
                span.innerHTML = "esatta";
                array[i].appendChild(span);
            }
            var array2 = document.getElementsByClassName("sbagliate");
            for(var j=0; j<array2.length; j++) {
                var span2 = document.createElement("span");
                span2.setAttribute("class","label label-sm label-danger risp");
                span2.innerHTML = "sbagliata";
                array2[j].appendChild(span2);
            }
        }

        if(document.getElementsByClassName('label label-sm label-success punt').length == 0) {
            var perfetta = document.getElementsByClassName("perfetta");
            if (perfetta.length >= 1) {
                for (var k = 0; k < perfetta.length; k++) {
                    perfetta[k].setAttribute('class', 'caption open perfetta questions font-green-haze');
                    perfetta[k].firstChild.setAttribute('class', 'fa fa-question-circle font-green-haze');
                }
            }
            var open = document.getElementsByClassName("punteggio");
            if (open.length >= 1) {
                for (var h = 0; h < open.length; h++) {
                    var span3 = document.createElement("span");
                    span3.setAttribute("class", "label label-sm label-success punt");
                    span3.innerHTML = "<?php echo 'Punteggio: ' . $punteggio . ' su ' . $max ?>";
                    open[h].appendChild(span3);
                }
            }
        }

    }
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
