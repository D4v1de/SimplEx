<?php
/**
 *La view che consente al docente di visualizzare gli esiti di una sessione
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


$idSessione="";
$idSessione= $_URL[4];
if (!is_numeric($idSessione)) {
    echo "<script type='text/javascript'>alert('errore nella url!!!');</script>";
}
$identificativoCorso ="";
$identificativoCorso = $_URL[2];
if (!is_numeric($identificativoCorso)) {
    echo "<script type='text/javascript'>alert('errore nella url!!!');</script>";
}

$numProfs=0;
$doc = $_SESSION['user'];
$docentiOe=$utenteModel->getAllDocentiByCorso($identificativoCorso);

foreach($docentiOe as $d) {
    if($doc==$d){
        $numProfs++;
    }
}
if($numProfs==0){
    header("Location: "."/docente/corso/".$corso->getId());
}
$url6="nada";
$soglia=null;
$flag=1;
$sessioneByUrl = $sessioneModel->readSessione($_URL[4]);
$dataFrom = $sessioneByUrl->getDataInizio();
$dataTo = $sessioneByUrl->getDataFine();
$sogliaMin=$sessioneByUrl->getSogliaAmmissione();
$tipoSessione = $sessioneByUrl->getTipologia();
$soglia=$sessioneByUrl->getSogliaAmmissione();

if(isset($_URL[6])) {
    $url6=$_URL[6];
    if($_URL[6]=="autoendsuccess") {
        $newSessione = new Sessione($dataFrom, $dataTo, $soglia, "Eseguita", $tipoSessione, $identificativoCorso);
        $sessioneModel->updateSessione($idSessione,$newSessione);
    }
    if($_URL[6]=="norestart") {
        $flag=0;
    }
    if($_URL[6]=="nochange") {
        $flag=0;
    }
}

try {
    $corso = $corsoModel->readCorso($identificativoCorso);
    $nomecorso= $corso->getNome();
}
catch (ApplicationException $ex) {
    echo "<h1>ERRORE NELLA LETTURA DEL CORSO!</h1>" . $ex;
}

$sessioneByUrl = $sessioneModel->readSessione($_URL[4]);
$esaminandiSessione= $utenteModel->getEsaminandiSessione($sessioneByUrl->getId());
$sogliaMin=$sessioneByUrl->getSogliaAmmissione();
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
    <title><?php echo $corso->getNome(); ?></title>
     <link rel="stylesheet" type="text/css" href="/assets/global/plugins/select2/select2.css">
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/datatables/extensions/TableTools/css/dataTables.tableTools.css">
<link rel="stylesheet" type="text/css"
          href="/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css">
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
                    Esiti Sessione
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
                            $vaiANomeCorso="/docente/corso/".$identificativoCorso;
                            printf("<a href=\"%s\">%s</a><i class=\"fa fa-angle-right\"></i>", $vaiANomeCorso ,$nomecorso);
                            ?>
                        </li>
                        <li>
                            <?php
                            $vaiAVisu="/docente/corso/".$identificativoCorso."/sessione"."/".$idSessione."/"."visualizzasessione";
                            printf("<a href=\"%s\">%s</a><i class=\"fa fa-angle-right\"></i>", $vaiAVisu ,"Sessione ".$idSessione);
                            ?>
                            </li>
                        <li>
                            Esiti
                        </li>
                    </ul>
                </div>

            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
        <form method="post" action="/docente/corso/<?php echo $identificativoCorso; ?>/sessione/<?php echo $idSessione; ?>/cambiasoglia">
            <div class="row">
            <div class="col-md-12">
                <div class="col-md-4">
                <label><h3>Soglia esiti:
                    <?php
                    if($soglia==-1)
                        ;
                    else echo $soglia;
                    //printf("<input type='search' name='soglia' class='form-control input-small input-inline' placeholder='%s' aria-controls='sample_1'/>", c);?>
                        </h3></label>
                </div>
            </div>
        </div>
            <!-- TABELLA 1 -->
            <?php
            if($flag==0 && $url6=="nochange") {
                printf("<div class='alert alert-danger'>
                    <button class=\"close\" data-close=\"alert\"></button>
                      Uno o più Tests sono stati già corretti. Impossibile modificare la sessione! </div>");
            }
            if($flag==0 && $url6=="norestart") {
                printf("<div class='alert alert-danger'>
                    <button class=\"close\" data-close=\"alert\"></button>
                      Uno o più Tests sono stati già corretti. Impossibile riprendere la sessione! </div>");
            }
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
                </div>
                <div class="portlet-body">
                    <div id="tabella_test2_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-striped table-bordered table-hover dataTable no-footer"
                                   id="tabella_test2" role="grid" aria-describedby="tabella_test2_info">
                                <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="
                                         Username
                                : activate to sort column ascending" style="width: 119px;">
                                                Nome
                                            </th><th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Email
                                " style="width: 210px;">
                                                Descrizione
                                            </th><th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Points
                                " style="width: 73px;">
                                                N° multiple
                                            </th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Status
                                " style="width: 119px;">
                                                N° aperte
                                            </th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Status
                                " style="width: 119px;">
                                                Punteggio massimo
                                            </th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Status
                                " style="width: 119px;">
                                                Inserito
                                            </th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Status
                                " style="width: 119px;">
                                                Superato
                                            </th>

                                        </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        $array = Array();
                                        $array = $testModel->getAllTestBySessione($idSessione);
                                        if ($array == null) {
                                        }
                                        else {
                                            $sessioniByCorso = $sessioneModel->getAllSessioniByCorso($identificativoCorso);
                                            foreach ($array as $c) {
                                                if ($sessioniByCorso != null) {
                                                    $scelti = $c->getPercentualeSceltoVal() + $c->getPercentualeSceltoEse();
                                                    $percSce = round(($scelti / count($sessioniByCorso) * 100));
                                                } else
                                                    $percSce = 0;
                                                    $succ = $c->getPercentualeSuccessoEse() + $c->getPercentualeSuccessoVal();
                                                    $n = $c->getNumeroSceltaValutativa() + $c->getNumeroSceltaEsercitativa();
                                                    if ($n > 0)
                                                        $percSuc = round(($succ / $n * 100));
                                                    else
                                                        $percSuc = 0;
                                                printf("<tr class=\"gradeX odd\" role=\"row\">");
                                                printf("<td class=\"sorting_1\">Test %s</td>", $c->getId());
                                                printf("<td>%s</td>", base64_decode( $c->getDescrizione()));
                                                printf("<td>%d</td>", $c->getNumeroMultiple());
                                                printf("<td>%d</td>", $c->getNumeroAperte());
                                                printf("<td>%d</td>", $c->getPunteggioMax());
                                                printf("<td>%d%%</td>", $percSce);
                                                printf("<td>%d%%</td>", $percSuc);
                                                printf("</tr>");
                                            }
                                        }
                                        ?>
                                </tbody>
                            </table>
                    </div>
                </div>
            </div>

            <!-- TABELLA 2 -->

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet box blue-madison">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-user"></i>Studenti
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title="">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div id="tabella_studenti_esiti_wrapper" class="dataTables_wrapper no-footer">
                                <div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="tabella_studenti_esiti" role="grid" aria-describedby="tabella_studenti_esiti_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="
                                         Username
                                : activate to sort column ascending" style="width: 119px;">
                                                Nome
                                            </th><th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Email
                                " style="width: 210px;">
                                                Cognome
                                            </th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Email
                                " style="width: 100px;">
                                                Matricola
                                            </th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Email
                                " style="width: 100px;">
                                                Test
                                            </th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Email
                                " style="width: 100px;">
                                                Esito
                                            </th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Email
                                " style="width: 100px;">
                                                Stato Correzione
                                            </th>
                                            <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Email
                                " style="width: 10%;">
                                                Azioni
                                            </th>
                                        </tr>
                                        
                                        </thead>
                                        <tbody>
                                        <?php
                                        $toDisable="";
                                        if ($esaminandiSessione == null) {
                                        }
                                        else {
                                            foreach ($esaminandiSessione as $c) {
                                                $ela=$elaboratoModel->readElaborato($c->getMatricola(),$idSessione);
                                                printf("<tr class=\"gradeX odd\" role=\"row\">");
                                                printf("<td class=\"sorting_1\">%s</td>", $c->getNome());
                                                printf("<td>%s</td>", $c->getCognome());
                                                printf("<td>%s</td>", $c->getMatricola());
                                                printf("<td>%s</td>", $ela->getTestId());
                                                if($ela->getStato()=="Corretto") {
                                                    if($ela->getEsitoFinale()>=$sogliaMin)
                                                      printf("<td><span class=\"label label-sm label-success\">%s</span>", $ela->getEsitoFinale());
                                                    else
                                                        printf("<td><span class=\"label label-sm label-danger\">%s</span>", $ela->getEsitoFinale());
                                                }
                                                else
                                                    printf("<td>%s</td>", $ela->getEsitoParziale());
                                                printf("<td>%s</td>", $ela->getStato());
                                                printf("<td><div class=\"btn-group-vertical btn-group-solid\"> <a href='/docente/corso/%s/sessione/%s/correggi/%s' class=\"btn btn-xs blue-madison\">
                                                    <i class=\"fa fa-pencil\"></i> Correggi
                                                </a>  <a href='/docente/corso/%s/sessione/%s/visualizza/%s' class=\"btn btn-xs default\">
                                                    Visualizza
                                                </a></div></td>",$identificativoCorso,$idSessione, $c->getMatricola(),$identificativoCorso,$idSessione, $c->getMatricola());
                                                printf("</tr>");
                                            }
                                        }
                                        ?>
                                        </tr>
                                        
                                        
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

        </form>
                    </div>

                </div>
            </div>


            <!-- END PAGE CONTENT-->


            

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
<!-- BEGIN PAGE LEVEL PLUGINS aggiunta da me-->
<script type="text/javascript" src="/assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript"
        src="/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS aggiunta da me-->

<script src="/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<script src="/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="/assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<!-- BEGIN aggiunta da me -->
<script src="/assets/admin/pages/scripts/table-managed.js"></script>
<script src="/assets/admin/pages/scripts/form-validation.js"></script>
<script type="text/javascript" src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="/assets/global/plugins/jquery-validation/js/additional-methods.min.js"></script>
<script src="/assets/global/plugins/bootbox/bootbox.min.js" type="text/javascript"></script>
<!-- END aggiunta da me -->
<script>
    jQuery(document).ready(function () {
        Metronic.init();
        Layout.init();
        TableManaged2.init("tabella_test2","tabella_test2_wrapper");
        TableManaged2.init("tabella_studenti_esiti","tabella_studenti_esiti_wrapper");
        FormValidation.init();
        setSoglia();


        var tableT = $("#tabella_test2").dataTable();
        var tableToolsT = new $.fn.dataTable.TableTools(tableT, {
            //"sSwfPath": "//cdn.datatables.net/tabletools/2.2.4/swf/copy_csv_xls_pdf.swf",
            "sSwfPath": "/assets/global/plugins/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
            "aButtons": [
                {
                    "sExtends": "xls",
                    "sButtonText": "<i class='fa fa-file-excel-o'></i> Excel"
                },
                {
                    "sExtends": "pdf",
                    "sButtonText": "<i class='fa fa-file-pdf-o'></i> PDF"
                }
            ]
        });
        $(tableToolsT.fnContainer()).insertBefore("#tabella_test2_wrapper");

        var tableS = $("#tabella_studenti_esiti").dataTable();
        var tableToolsS = new $.fn.dataTable.TableTools(tableS, {
            //"sSwfPath": "//cdn.datatables.net/tabletools/2.2.4/swf/copy_csv_xls_pdf.swf",
            "sSwfPath": "/assets/global/plugins/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf",
            "aButtons": [
                {
                    "sExtends": "xls",
                    "sButtonText": "<i class='fa fa-file-excel-o'></i> Excel"
                },
                {
                    "sExtends": "pdf",
                    "sButtonText": "<i class='fa fa-file-pdf-o'></i> PDF"
                }
            ]
        });
        $(tableToolsS.fnContainer()).insertBefore("#tabella_studenti_esiti_wrapper");
    });
</script>
<script>

    var soglia = <?= $soglia; ?>;
    if(soglia==-1) {
        bootbox.dialog({
            message: '<div class="row">  ' +
            '<div class="col-md-12"> ' +
            '<form  > ' +
            '<div class="form-group"> ' +
            '<label class="col-md-4" for="name"></label> ' +
            '<div class="col-md-4"> ' +
            '<input id="soglia" name="soglia" type="text" placeholder="Soglia minima" class="form-control input-md"> ' +
            '</div> ' +
            '</div> ' +
            '</form> </div>  </div>',
            title: "Soglia Ammissione",
            closeButton: false,
            buttons: {
                conferma: {
                    label: "Conferma",
                    className: "green",
                    callback: function () {
                        var soglia = document.getElementById('soglia').value;
                        soglia = soglia.replace(/\s+/g, '');
                        if((!isNaN(soglia) && isFinite(soglia)) && soglia!="")
                            location.href = "/docente/corso/<?php echo $identificativoCorso; ?>/sessione/<?php echo $idSessione; ?>/cambiasoglia/"+soglia;
                        else
                            location.reload();
                    }
                }
            }
        });
    }


</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
