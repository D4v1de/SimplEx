<?php

/**
 * La view consente al docente di visualizzare uno specifico elaborato.
 *
 * @author Antonio Luca D'Avanzo
 * @version 1
 * @since 18/11/15 09:58
 */


include_once MODEL_DIR . "ElaboratoModel.php";
include_once MODEL_DIR . "SessioneModel.php";
include_once MODEL_DIR . "AlternativaModel.php";
include_once MODEL_DIR . "RispostaApertaModel.php";
include_once MODEL_DIR . "RispostaMultiplaModel.php";
include_once MODEL_DIR . "DomandaModel.php";
include_once MODEL_DIR . "UtenteModel.php";
include_once MODEL_DIR . "CdLModel.php";
include_once MODEL_DIR . "CorsoModel.php";
include_once MODEL_DIR . "TestModel.php";
include_once BEAN_DIR . "Sessione.php";

$sessioneModel = new SessioneModel();
$utenteModel = new UtenteModel();
$testModel = new TestModel();
$corsoModel = new CorsoModel();
$cdlModel = new CdLModel();
$elaboratoModel= new ElaboratoModel();
$modelDomanda = new DomandaModel();
$modelAlternativa = new AlternativaModel();
$modelRispostaAperta = new RispostaApertaModel();
$modelRispostaMultipla = new RispostaMultiplaModel();

$cdl = null;
$corso = null;
$docenteassociato = Array();
$sessione = null;
$test = null;
$elaborato = null;
$studente = null;
$max=null;
$dom=null;
$multiple = Array();
$aperte = Array();
$alternative = Array();
$rispostaaperta = null;
$rispostamultipla = null;
$i = 0;
$url = null;
$url2 = null;
$matricola="";
$matricola = $_URL[6];
if (!is_numeric($matricola)) {
    echo "<script type='text/javascript'>alert('errore nella url!!!');</script>";
}
$studente=$utenteModel->getUtenteByMatricola($matricola);

$url = $_URL[2];
if (!is_numeric($url)) {
    echo "<script type='text/javascript'>alert('errore nella url!!!');</script>";
}
$url2 = $_URL[4];
if (!is_numeric($url)) {
    echo "<script type='text/javascript'>alert('errore nella url!!!');</script>";
}



try {
    $corso = $corsoModel->readCorso($url);
} catch (ApplicationException $ex) {
    echo "<h1>INSERIRE ID CORSO NEL PATH!</h1>" . $ex;
}
$numProfs=0;
$doc = $_SESSION['user'];
$docentiOe=$utenteModel->getAllDocentiByCorso($url);
foreach($docentiOe as $d) {
    if($doc==$d){
        $numProfs++;
    }
}
if($numProfs==0){
    header("Location: "."/docente/corso/".$corso->getId());
}

try {
    $cdl = $cdlModel->readCdl($corso->getCdlMatricola());
} catch (ApplicationException $ex) {
    echo "<h1>READCDL FALLITO!</h1>" . $ex;
}
try {
    $elaborato = $elaboratoModel->readElaborato($studente->getMatricola(), $url2);
} catch (ApplicationException $ex) {
    echo "<h1>READELABORATO FALLITO!</h1>" . $ex;
}
try {
    $docenteassociato = $utenteModel->getAllDocentiByCorso($corso->getId());
} catch (ApplicationException $ex) {
    echo "<h1>GETDOCENTIASSOCIATI FALLITO</h1>" . $ex;
}
try {
    $sessione = $sessioneModel->readSessione($url2);
} catch (ApplicationException $ex) {
    echo "<h1>INSERIRE ID SESSIONE NEL PATH!</h1>" . $ex;
}
try {
    $test = $testModel->readTest($elaborato->getTestId());
} catch (ApplicationException $ex) {
    echo "<h1>READTEST FALLITO!</h1>" . $ex;
}
try {
    $multiple = $modelDomanda->getAllDomandeMultipleByTest($test->getId());
} catch (ApplicationException $ex) {
    echo "<h1>GETALLDOMANDEMULTIPLEBYTEST FALLITO!</h1>" . $ex;
}
try {
    $aperte = $modelDomanda->getAllDomandeAperteByTest($test->getId());
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
    <title>Visualizza Elaborato</title>
    <?php include VIEW_DIR . "design/header.php"; ?>
    <script type="text/javascript">
        var ris = [];
    </script>
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-md page-header-fixed page-quick-sidebar-over-content" onload="correggi()">
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
                <?php echo 'Elaborato di '.$studente->getCognome()." ".$studente->getNome();echo ', Test ' . $test->getId(); ?>
            </h3>

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="/docente">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="<?php echo "/docente/cdl/".$corso->getCdlMatricola(); ?>"> <?php echo $cdlModel->readCdl($corso->getCdlMatricola())->getNome(); ?> </a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <?php
                        $vaiANomeCorso="/docente/corso/".$corso->getId();
                        printf("<a href=\"%s\">%s</a><i class=\"fa fa-angle-right\"></i>", $vaiANomeCorso ,$corso->getNome());
                        ?>
                    </li>
                    <li>
                        <?php
                        $vaiAVisu="/docente/corso/".$corso->getId()."/sessione"."/".$sessione->getId()."/"."visualizzasessione";
                        printf("<a href=\"%s\">%s</a><i class=\"fa fa-angle-right\"></i>", $vaiAVisu ,"Sessione ".$sessione->getId());
                        ?>
                    </li>
                    <li>
                        <?php
                        $vaiAEsiti="/docente/corso/".$corso->getId()."/sessione"."/".$sessione->getId()."/"."esiti/show";
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
                                    $alternative = $modelAlternativa->getAllAlternativaByDomanda($m->getId());
                                } catch (ApplicationException $ex) {
                                    echo "<h1>GETALLALTERNATIVABYDOMANDA FALLITO!</h1>" . $ex;
                                }
                                try {
                                    $rispostamultipla = $modelRispostaMultipla->readRispostaMultipla($elaborato->getSessioneId(), $studente->getMatricola(), $m->getId());
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
                                        printf("<input type=\"checkbox\" id=\"alt-12\" class=\"md-check\" disabled checked>");
                                    } else {
                                        printf("<input type=\"checkbox\" id=\"alt-12\" class=\"md-check\" disabled>");
                                    }

                                    //mi segna una classe a tutte le corrette e una a tutte le sbagliate
                                    if($a->getCorretta() == 'Si') {
                                        printf("<label for=\"alt-12\"><span class=\"inc\"></span><span class=\"check\"></span><span class=\"box\"></span>%s</label><span class=\"esatte col-md-offset-3\"></span></div>", $a->getTesto());
                                    }
                                    else if($a->getCorretta() == 'No' && $rispostamultipla->getAlternativaId() == $a->getId()) {
                                        printf("<label for=\"alt-12\"><span class=\"inc\"></span><span class=\"check\"></span><span class=\"box\"></span>%s</label><span class=\"sbagliate col-md-offset-3\"></span></div>", $a->getTesto());
                                    }
                                    else {
                                        printf("<label for=\"alt-12\"><span class=\"inc\"></span><span class=\"check\"></span><span class=\"box\"></span>%s</label></div>", $a->getTesto());
                                    }
                                    printf("</div></div>");
                                }
                                printf("</div></div>");
                            }
                            foreach ($aperte as $a) {

                                echo "<form method='get' action=''>";

                                $max = $modelDomanda->readPunteggioMaxAlternativo($a->getId(), $test->getId());
                                if ($max == null){
                                    $dom = $modelDomanda->getDomandaAperta($a->getId());
                                    $max = $dom->getPunteggioMax();
                                }
                                printf("<div class=\"portlet light bordered\"><div class=\"portlet-title\"><div class=\"caption\"><i class=\"fa fa-question-circle\"></i><span class=\"caption-subject bold uppercase\">%s (aperta)</span></div><div class=\"tools\"><a href=\"javascript:;\" class=\"collapse\" data-original-title=\"\" title=\"\"></a></div></div>", $a->getTesto());
                                printf("<div class=\"portlet-body\">");
                                try {
                                    $rispostaaperta = $modelRispostaAperta->readRispostaAperta($elaborato->getSessioneId(), $studente->getMatricola(), $a->getId());
                                } catch (ApplicationException $ex) {
                                    echo "<h1>READRISPOSTAAPERTA FALLITO!</h1>" . $ex;
                                }
                                if ($rispostaaperta->getDomandaApertaId() == $a->getId()) {
                                    printf("<div class=\"row\"> <div class=\"col-md-12\"><textarea class=\"form-control\" id=\"ap-12\" rows=\"3\" placeholder=\"\" style=\"resize:none\" disabled>%s</textarea> </div>", $rispostaaperta->getTesto());
                                }
                                printf("</div></div></div>");


                            }
                            ?>
                            <?php echo "</form>"; ?>

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
        for(var r in ris) {
            if(ris[r] == 'Si') {
                document.getElementById("div"+r).setAttribute('class','caption questions font-green-haze');
                document.getElementById("i"+r).setAttribute('class','fa fa-question-circle font-green-haze');

                //document.getElementsByClassName("esatte").innerHTML = "<span class=\"col-md-offset-1 label label-sm label-success\">giusta</span>";
                //<span class="corrette col-md-offset-1 label label-sm label-success"><!--giusto--></span>

            }
            else if(ris[r] == 'No') {
                document.getElementById("div"+r).setAttribute('class','caption questions font-red-sunglo');
                document.getElementById("i"+r).setAttribute('class','fa fa-question-circle font-red-sunglo');

                //document.getElementsByClassName("sbagliate").innerHTML = "<span class=\"col-md-offset-1 label label-sm label-danger\">sbagliato</span>";
                //<span class="sbagliate col-md-offset-1 label label-sm label-danger"><!--sbagliato--></span>

            }
        }
        var array = document.getElementsByClassName("esatte");
        for(var i=0; i<array.length; i++) {
            var span = document.createElement("span");
            span.setAttribute("class","label label-sm label-success");
            span.innerHTML = "esatta";
            array[i].appendChild(span);
        }
        var array2 = document.getElementsByClassName("sbagliate");
        for(var j=0; j<array2.length; j++) {
            var span2 = document.createElement("span");
            span2.setAttribute("class","label label-sm label-danger");
            span2.innerHTML = "sbagliata";
            array2[j].appendChild(span2);
        }
    }
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>