<?php
/**
 * Created by PhpStorm.
 * User: fede_dr
 * Date: 13/12/15
 * Time: 15:58
 */

//TODO qui la logica iniziale, caricamento dei controller ecc
include_once CONTROL_DIR . "CdlController.php";
include_once CONTROL_DIR . "UtenteController.php";
include_once CONTROL_DIR . "ElaboratoController.php";
include_once CONTROL_DIR . "SessioneController.php";
include_once CONTROL_DIR . "TestController.php";
include_once CONTROL_DIR . "DomandaController.php";
include_once CONTROL_DIR . "AlternativaController.php";
include_once CONTROL_DIR . "RispostaApertaController.php";
include_once CONTROL_DIR . "RispostaMultiplaController.php";
$controller = new CdlController();
$controllerUtente = new UtenteController();
$controllerElaborato = new ElaboratoController();
$controllerSessione = new SessioneController();
$controllerTest = new TestController();
$controllerDomanda = new DomandaController();
$controllerAlternativa = new AlternativaController();
$controllerRispostaAperta = new RispostaApertaController();
$controllerRispostaMultipla = new RispostaMultiplaController();


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
//$corretta = null;
$rispostaaperta = null;
$rispostamultipla = null;
$i = 0;
$url = null;
$url2 = null;


$url = $_URL[2];
if (!is_numeric($url)) {
    echo "<script type='text/javascript'>alert('errore nella url!!!');</script>";
}
$url2 = $_URL[4];
if (!is_numeric($url)) {
    echo "<script type='text/javascript'>alert('errore nella url!!!');</script>";
}


//$studente = $_SESSION['user'];
$studente = $controllerUtente->getUtenteByMatricola('0512102390');


try {
    $corso = $controller->readCorso($url);
} catch (ApplicationException $ex) {
    echo "<h1>INSERIRE ID CORSO NEL PATH!</h1>" . $ex;
}
try {
    $cdl = $controller->readCdl($corso->getCdlMatricola());
} catch (ApplicationException $ex) {
    echo "<h1>READCDL FALLITO!</h1>" . $ex;
}
try {
    $elaborato = $controllerElaborato->readElaborato($studente->getMatricola(), $url2);
} catch (ApplicationException $ex) {
    echo "<h1>READELABORATO FALLITO!</h1>" . $ex;
}
try {
    $docenteassociato = $controllerUtente->getDocenteAssociato($corso->getId());
} catch (ApplicationException $ex) {
    echo "<h1>GETDOCENTIASSOCIATI FALLITO</h1>" . $ex;
}
try {
    $sessione = $controllerSessione->readSessione($url2);
} catch (ApplicationException $ex) {
    echo "<h1>INSERIRE ID SESSIONE NEL PATH!</h1>" . $ex;
}
try {
    $test = $controllerTest->readTest($elaborato->getTestId());
} catch (ApplicationException $ex) {
    echo "<h1>READTEST FALLITO!</h1>" . $ex;
}
try {
    $multiple = $controllerDomanda->getAllDomandeMultipleByTest($test->getId());
} catch (ApplicationException $ex) {
    echo "<h1>GETALLDOMANDEMULTIPLEBYTEST FALLITO!</h1>" . $ex;
}
try {
    $aperte = $controllerDomanda->getAllDomandeAperteByTest($test->getId());
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
                        <a href="/studente/corso/<?php echo $corso->getId(); ?>/test/<?php echo $sessione->getId(); ?>">Test <?php echo $test->getId(); ?></a>
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
                                    <h3>Esito <?php if ($elaborato->getStato() == 'Corretto') {
                                                    echo 'Finale: ' . $elaborato->getEsitoFinale();
                                                    } else {
                                                    echo 'Parziale: ' . $elaborato->getEsitoParziale();
                                                    } ?>/<?php echo $test->getPunteggioMax(); ?>
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

            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-red-sunglo">
                        <i class="fa fa-question-circle font-red-sunglo"></i>
                        <span class="caption-subject bold uppercase"> Question1 false</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form role="form">
                        <div class="form-body">

                        </div>
                    </form>
                </div>
            </div>
            <div class="portlet light bordered">
                <div class="portlet-title">
                    <div class="caption font-green-haze">
                        <i class="fa fa-question-circle font-green-haze"></i>
                        <span class="caption-subject bold uppercase"> Question2 true</span>
                    </div>
                </div>
                <div class="portlet-body form">
                    <form role="form">
                        <div class="form-body">

                        </div>
                    </form>
                </div>
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
                                printf("<div class=\"portlet light bordered\"><div class=\"portlet-title\"><div id=\"div%s\" class=\"caption questions\"><i id=\"i%s\" class=\"fa fa-question-circle\"></i><span class=\"caption-subject bold uppercase\">%s</span></div><div class=\"tools\"><a href=\"javascript:;\" class=\"collapse\" data-original-title=\"\" title=\"\"></a></div></div>",$i ,$i , $m->getTesto());
                                printf("<div class=\"portlet-body\">");
                                $i++;
                                try {
                                    $alternative = $controllerAlternativa->getAllAlternativaByDomanda($m->getId());
                                } catch (ApplicationException $ex) {
                                    echo "<h1>GETALLALTERNATIVABYDOMANDA FALLITO!</h1>" . $ex;
                                }
                                try {
                                    $rispostamultipla = $controllerRispostaMultipla->readRispostaMultipla($elaborato->getSessioneId(), $studente->getMatricola(), $m->getId());
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
                                        //correzione domande multiple
                                        //<script>var ris = []; ris.push({'%s': '%s'}); </script>
                                        /*try {
                                            $corretta = $controllerAlternativa->getAlternativaCorrettaByDomanda($m->getId());
                                        } catch (ApplicationException $ex) {
                                            echo "<h1>GETALLALTERNATIVABYDOMANDA FALLITO!</h1>" . $ex;
                                        }
                                        if($corretta->getId() == $a->getId()) {
                                            printf("<script> ris.push('%s'); </script>", $a->getCorretta());
                                        }*/
                                        printf("<script> ris.push('%s'); </script>", $a->getCorretta());
                                        printf("<input type=\"checkbox\" id=\"alt-12\" name=\"mul-12\" class=\"md-check\" disabled checked>");
                                    } else {
                                        printf("<input type=\"checkbox\" id=\"alt-12\" name=\"mul-12\" class=\"md-check\" disabled>");
                                    }

                                    //mi segna una classe a tutte le corrette e una a tutte le sbagliate
                                    if($a->getCorretta() == 'Si') {
                                        printf("<label for=\"alt-12\"><span class=\"inc\"></span><span class=\"check\"></span><span class=\"box\"></span>%s</label><div class=\"esatte\"></div></div>", $a->getTesto());
                                    }
                                    else {
                                        printf("<label for=\"alt-12\"><span class=\"inc\"></span><span class=\"check\"></span><span class=\"box\"></span>%s</label><div class=\"sbagliate\"></div></div>", $a->getTesto());
                                    }
                                    printf("</div></div>");
                                }
                                printf("</div></div>");
                            }
                            foreach ($aperte as $a) {
                                printf("<div class=\"portlet light bordered\"><div class=\"portlet-title\"><div class=\"caption\"><i class=\"fa fa-question-circle\"></i><span class=\"caption-subject bold uppercase\">%s (aperta)</span></div><div class=\"tools\"><a href=\"javascript:;\" class=\"collapse\" data-original-title=\"\" title=\"\"></a></div></div>", $a->getTesto());
                                printf("<div class=\"portlet-body\">");
                                try {
                                    $rispostaaperta = $controllerRispostaAperta->readRispostaAperta($elaborato->getSessioneId(), $studente->getMatricola(), $a->getId());
                                } catch (ApplicationException $ex) {
                                    echo "<h1>READRISPOSTAAPERTA FALLITO!</h1>" . $ex;
                                }
                                if ($rispostaaperta->getDomandaApertaId() == $a->getId()) {
                                    printf("<textarea class=\"form-control\" id=\"ap-12\" rows=\"3\" placeholder=\"\" style=\"resize:none\" disabled>%s</textarea>", $rispostaaperta->getTesto());
                                }
                                printf("</div></div>");
                            }
                            /*if (($multiple == null) && ($aperte == null)) {
                                printf("<h2> Il test selezionato non ha alcuna domanda associata </h2>");
                            }*/
                            ?>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <?php if($elaborato->getStato() != 'Non Corretto') {printf("<a href=\"#\" type=\"button\" onclick=\"correggi()\" class=\"btn green-jungle\">Correggi</a>");} ?>
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
        /*var questions = document.getElementsByClassName('caption questions');
        for(var q in questions) {
            if(q == 'Si') {
                q.setAttribute('class','caption questions font-green-haze');
            }
            else if(q == 'No') {
                q.setAttribute('class','caption questions font-red-sunglo');
            }
        }*/
        for(var r in ris) {
            if(ris[r] == 'Si') {
                document.getElementById("div"+r).setAttribute('class','caption questions font-green-haze');
                document.getElementById("i"+r).setAttribute('class','fa fa-question-circle font-green-haze');

                document.getElementsByClassName("esatte").innerHTML = "<span class=\"col-md-offset-1 label label-sm label-success\">giusta</span>";
                //<span class="corrette col-md-offset-1 label label-sm label-success"><!--giusto--></span>
            }
            else if(ris[r] == 'No') {
                document.getElementById("div"+r).setAttribute('class','caption questions font-red-sunglo');
                document.getElementById("i"+r).setAttribute('class','fa fa-question-circle font-red-sunglo');

                document.getElementsByClassName("sbagliate").innerHTML = "<span class=\"col-md-offset-1 label label-sm label-danger\">sbagliato</span>";
                //<span class="sbagliate col-md-offset-1 label label-sm label-danger"><!--sbagliato--></span>
            }
        }

    }
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
