<?php
/**
 * Created by NetBeans.
 * User: Fabio
 * Date: 18/11/15
 * Time: 09:58
 */

//TODO qui la logica iniziale, caricamento dei model ecc
include_once MODEL_DIR . "ArgomentoModel.php";
include_once MODEL_DIR . "CdLModel.php";
include_once MODEL_DIR . "DomandaModel.php";
include_once MODEL_DIR . "CorsoModel.php";
include_once MODEL_DIR . "TestModel.php";


$modelCdl = new CdLModel();
$modelArgomento = new ArgomentoModel();
$modelCorso = new CorsoModel();
$modelDomande  = new DomandaModel();
$modelTest = new TestModel();

$identificativoCorso = parseInt($_URL[2]);
function parseInt($Str) {
    return (int)$Str;   
}

try {
    $corso = $modelCorso->readCorso(parseInt($_URL[2]));
    $nomecorso= $corso->getNome();
}
catch (ApplicationException $ex) {
    echo "<h1>ERRORE NELLA LETTURA DEL CORSO!</h1>" . $ex;
}


$toCheck="";


try{
$idTest=parseInt($_URL[5]);
$ilTestDalDB=$modelTest->readTest($idTest);
} catch (ApplicationException $ex) {
        echo "<h1>ERRORE! ApplicationException->non c'è l' ID test nel path!</h1>";
        echo "<h4>" . $ex . "</h4>";
    }

$corso = $modelCorso->readCorso($_URL[2]); 
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
    <title>Modifica Test</title>
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/select2/select2.css">
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/datatables/extensions/TableTools/css/dataTables.tableTools.css">
    <?php include VIEW_DIR . "design/header.php"; ?>
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/jquery-nestable/jquery.nestable.css">

    <style type="text/css">
        div.scroll {
            height: auto;
            width: 500px;
            overflow: auto;
            padding: 8px;
        }
    </style>
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
                    Modifica Test
                </h3>
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="index.html">Home</a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                        <a href="<?php echo "/docente/cdl/".$corso->getCdlMatricola(); ?>"> <?php echo $modelCdl->readCdl($corso->getCdlMatricola())->getNome(); ?> </a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <?php
                        $vaiANomeCorso="/docente/corso/".$identificativoCorso;
                        printf("<a href=\"%s\">%s</a><i class=\"fa fa-angle-right\"></i>", $vaiANomeCorso ,$nomecorso);
                        ?>
                    </li>
                    <li>
                        Modifica Test
                    </li>

                    </ul>
                </div>

            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <form id="form_sample_1" action="/docente/modifica_TEST?idcorso=<?=$identificativoCorso ?>&idtest=<?=$_URL[5] ?>" method="post">
                
                
                <div class="alert alert-danger display-hide">
                    <button class="close" data-close="alert"></button>
                    Errore nei Dati. E' obbligatorio inserire la descrizione del test e selezionare almeno una domanda.
                </div>
                
                <?php
                    if(isset($_SESSION["flag1"]) && $_SESSION["flag1"]==1) {
                        echo "<div class=\"alert alert-danger\">
                        <button class=\"close\" data-close=\"alert\"></button>
                        Errore nei Dati. E' possibile inserire solo interi positivi.                        </div>";
                        //echo "<script type='text/javascript'>checkIt();</script>";
                        unset($_SESSION['flag1']);
                    }
                ?>

                <?php
                if(isset($_SESSION["flag2"]) && $_SESSION["flag2"]==1) {
                    //TODO (aggiungere da nmin a nmax domande) effettuare query per recuperare i valori e mostrarli nel messaggio
                    echo "<div class=\"alert alert-danger\">
                        <button class=\"close\" data-close=\"alert\"></button>
                        Errore nei Dati. Per un test RANDOM devi inserire un numero di domande valido.
                        </div>";
                    //echo "<script type='text/javascript'>checkIt();</script>";
                    unset($_SESSION['flag2']);
                }
                ?>
                
                <?php
                if(isset($_SESSION["flag3"]) && $_SESSION["flag3"]==1) {
                    //TODO (aggiungere da nmin a nmax domande) effettuare query per recuperare i valori e mostrarli nel messaggio
                    echo "<div class=\"alert alert-danger\">
                        <button class=\"close\" data-close=\"alert\"></button>
                        Errore nei Dati. Hai richiesto troppe domande per il test RANDOM.
                        </div>";
                    //echo "<script type='text/javascript'>checkIt();</script>";
                    unset($_SESSION['flag3']);
                }
                ?>
                <?php
                if(isset($_SESSION["flag4"]) && $_SESSION["flag4"]==1) {
                    //TODO (aggiungere da nmin a nmax domande) effettuare query per recuperare i valori e mostrarli nel messaggio
                    echo "<div class=\"alert alert-danger\">
                        <button class=\"close\" data-close=\"alert\"></button>
                        Errore nei Dati. E' necessario selezionare almeno una domanda dalla tabella.
                        </div>";
                    //echo "<script type='text/javascript'>checkIt();</script>";
                    unset($_SESSION['flag4']);
                }
                ?>
                <?php
                if(isset($_SESSION["flag5"]) && $_SESSION["flag5"]==1) {
                    //TODO (aggiungere da nmin a nmax domande) effettuare query per recuperare i valori e mostrarli nel messaggio
                    echo "<div class=\"alert alert-danger\">
                        <button class=\"close\" data-close=\"alert\"></button>
                        Errore nei Dati. Non è possibile utilizzare caratteri speciali nella descrizione.
                        </div>";
                    //echo "<script type='text/javascript'>checkIt();</script>";
                    unset($_SESSION['flag5']);
                }
                ?>

                <div class="form-body">
                    <div class="portlet box blue-madison">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-info-circle"></i>Informazioni
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title=""></a>
                            </div>
                        </div>

                        <div class="portlet-body">
                             <div class="form-group form-md-line-input">
                            <h4> Descrizione</h4>
                                <div class="col-md-12">
                                    <?php
                                    try{
                                        $x=$modelTest->readTest($idTest);
                                        $testo = $x->getDescrizione();
                                    }catch(ApplicationException $ex){
                                        echo "<h1>ERRORE NELLA LETTURA DELLA DESCRIZIONE TEST!</h1>" . $ex;
                                    }
                                    ?>
                                    <input class="form-control" name="descrizione" id="descrizione" value="<?php echo $testo; ?>" rows="4" style="resize:none"/>
                                    <span class="help-block"></span>
                                </div>
                             </div>
                            <br>
                            <br>
                            <br>
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4> Tipologia selezione domande</h4>
                                            <div class="col-md-10">
                                                    <div class="md-radio-inline">
                                                            <div class="md-radio">
                                                                    <input type="radio" id="man" value="man" checked="" onclick="javascript: SetContent();" name="tipologia" class="md-radiobtn">
                                                                    <label for="man">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span>
                                                                    Manuale </label>
                                                            </div>
                                                            <div class="md-radio">
                                                                    <input type="radio" id="rand" value="rand" onclick="javascript: SetContent();" name="tipologia" class="md-radiobtn">
                                                                    <label for="rand">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span>
                                                                    Random </label>
                                                            </div>
                                                    </div>
                                            </div>
                                    </div>
                                    <div class="col-md-8" id="scelte_random" style="visibility: hidden" >
                                        <div class="col-md-6">
                                            <div class="form-group form-md-line-input has-success">
                                                <div class="input-icon">
                                                    <input type="number" id="numAperte" name="numAperte" class="form-control" value="0">
                                                        <label for="numAperte">Numero domande a risposta aperta:</label>
                                                           
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-md-line-input has-success">
                                                <div class="input-icon">
                                                    <input type="number" id="numMultiple" name="numMultiple" class="form-control" value="0">
                                                         <label for="numMultiple">Numero domande a risposta multipla:</label>
                                                          
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    
                    
                    <div class="row" id="domande">
                    
                    <div class="portlet box blue-madison">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-file-text-o"></i>Domande
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title="">
                        </a>
                    </div>
                    
                </div>
                <div class="portlet-body">
                    <div id="tabella_domande_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-striped table-bordered table-hover dataTable no-footer"
                               id="tabella_domande" role="grid" aria-describedby="tabella_domande_info">
                            <thead>
                            <tr role="row">
                                <th class="table-checkbox sorting_disabled" rowspan="1" colspan="1"
                                        aria-label="">
                                        <input type="checkbox" class="group-checkable"
                                               data-set="#tabella_domande .checkboxes">
                                    </th>
                                <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Points
                                " style="width: 50px;">
                                    ID
                                </th><th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Status
                                " style="width: 150px;">
                                    Argomento
                                </th><th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Points
                                " style="width: 800px;">
                                    Testo
                                </th><th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Points
                                " style="width: 100px;">
                                                Percentuale Scelta
                                            </th><th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Points
                                " style="width: 100px;">
                                                Percentuale Corretta
                                            </th>
                                <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Status
                                " style="width: 200px;">
                                    Tipologia
                                </th>
                                <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Status
                                " style="width: 200px;">
                                    Punteggio Alternativo
                                </th>
                                
                            </tr>
                            </thead>
                            <tbody>
                            <!-- qui va il riempimento automatico -->    
                            <?php
                            $toCheck="";
                            $Argomenti = Array();
                            $Multiple = Array();
                            $Aperte = Array();
                            $Argomenti = $modelArgomento->getAllArgomentoCorso($identificativoCorso);
                            foreach($Argomenti as $a){
                                $Multiple = $modelDomande->getAllDomandaMultiplaByArgomento($a->getId());
                                $Aperte = $modelDomande->getAllDomandaApertaByArgomento($a->getId());
                                foreach($Multiple as $s){
                                    printf("<tr class=\"gradeX odd\" role=\"row\">");
                                    try{
                                    $MulTest=$modelDomande->getAllDomandeMultipleByTest($idTest);
                                    }catch(ApplicationException $ex){
                                        echo "<h1>ERRORE NELLA LETTURA DELLE DOMANDE TEST!</h1>" . $ex;
                                    }
                                    foreach($MulTest as $t){
                                        if($s->getId()==$t->getId()){
                                            $toCheck="Checked";
                                        }
                                    }
                                    printf("<td><input type=\"checkbox\" value=\"%d\" name=\"multiple[]\" %s class=\"checkboxes\"></td>", $s->getId(), $toCheck);
                                    $toCheck="";
                                    printf("<td>%s</td>",$s->getId());
                                    printf("<td>%s</td>",$a->getNome());
                                    printf("<td>%s</td>",$s->getTesto());
                                    printf("<td>%s %%</td>",$s->getPercentualeSceltaEse() + $s->getPercentualeSceltaVal());
                                    printf("<td>%s %%</td>",$s->getPercentualeRispostaCorrettaEse() + $s->getPercentualeRispostaCorrettaVal());
                                    printf("<td>Multipla</td>");
                                    printf("<td><div class=\"form-group form-md-line-input has-success\"><div class=\"input-icon\"><input type=\"number\" name=\"alternCorr-%d\" class=\"form-control\">
                                            <label for=\"alternCorr\">Corretta:</label>
                                            ", $s->getId());
                                    printf("</div><div class=\"form-group form-md-line-input has-success\"><div class=\"input-icon\"><input type=\"number\" name=\"alternErr-%d\" class=\"form-control\">
                                            <label for=\"alternErr\">Errata:</label>
                                            </div></div></td>", $s->getId());
                                    printf("</tr>");
                                }
                                foreach($Aperte as $s){
                                    printf("<tr class=\"gradeX odd\" role=\"row\">");
                                    try{
                                    $ApeTest=$modelDomande->getAllDomandeAperteByTest($idTest);
                                    }catch(ApplicationException $ex){
                                        echo "<h1>ERRORE NELLA LETTURA DELLE DOMANDE TEST!</h1>" . $ex;
                                    }
                                    foreach($ApeTest as $t){
                                        if($s->getId()==$t->getId()){
                                            $toCheck="Checked";
                                        }
                                    }
                                    printf("<td><input type=\"checkbox\" value=\"%d\" name=\"aperte[]\" %s class=\"checkboxes\"></td>", $s->getId(), $toCheck);
                                    $toCheck="";
                                    printf("<td>%s</td>",$s->getId());
                                    printf("<td>%s</td>",$a->getNome());
                                    printf("<td>%s</td>",$s->getTesto());
                                    printf("<td>%s %%</td>",$s->getPercentualeSceltaEse() + $s->getPercentualeSceltaVal());
                                    printf("<td></td>");
                                    printf("<td>Aperta</td>");
                                    printf("<td><div class=\"form-group form-md-line-input has-success\"><div class=\"input-icon\"><input type=\"number\" name=\"ApertaCorr-%d\" class=\"form-control\">
                                            <label for=name=\"ApertaCorr\">Punteggio max:</label>
                           
                                            </div></div></td>", $s->getId());
                                    printf("</tr>");
                                }
                                
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                    
                    </div>
                    
                    </div>
                    </div>
                

                    </div>
                <div class="form-actions">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-9">
                                    <button type="submit" class="btn sm green-jungle"><span class="md-click-circle md-click-animate" style="height: 94px; width: 94px; top: -23px; left: 2px;"></span>
                                    Salva
                                    </button>
                                    <?php
                                    printf("<a href=\"/docente/corso/%d\" class=\"btn sm red-intense\">Annulla</a>",$identificativoCorso);
                                      
                                    
                                    ?>
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
<script src="/assets/global/scripts/manuale_random.js" type="text/javascript"></script>
<script src="/assets/global/scripts/radioCreaTest.js" type="text/javascript"></script>
<script src="/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<!-- BEGIN PAGE LEVEL PLUGINS aggiunta da me-->
<script type="text/javascript" src="/assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS aggiunta da me-->
<script src="/assets/admin/pages/scripts/form-validation.js"></script>
<script type="text/javascript" src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
<script type="text/javascript" src="/assets/global/plugins/jquery-validation/js/additional-methods.min.js"></script>
<script src="/assets/admin/pages/scripts/ui-toastr.js"></script>
<script src="/assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>
<script src="/assets/admin/pages/scripts/ui-confirmations.js"></script>
<script src="/assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js" type="text/javascript"></script>
<!--<script src="/assets/admin/pages/scripts/ui-nestable.js"></script>
<script src="/assets/global/plugins/jquery-nestable/jquery.nestable.js"></script>
<script src="/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>-->
<!-- BEGIN aggiunta da me -->
<script src="/assets/admin/pages/scripts/table-managed.js"></script>
<script src="/assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>

<!-- END aggiunta da me -->
<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        //QuickSidebar.init(); // init quick sidebar
        //Demo.init(); // init demo features
        TableManaged.init("tabella_argomenti2","tabella_argomenti2_wrapper");
        TableManaged.init("tabella_domande","tabella_domande_wrapper");
        FormValidation.init();
        //TableManaged.init(3);
        var table = $("#tabella_domande").dataTable();
        var tableTools = new $.fn.dataTable.TableTools(table, {
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
        $(tableTools.fnContainer()).insertBefore("#tabella_domande_wrapper");
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
