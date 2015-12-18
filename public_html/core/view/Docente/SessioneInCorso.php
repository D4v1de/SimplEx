<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 18/11/15
 * Time: 09:58
 */

//TODO qui la logica iniziale, caricamento dei controller ecc
include_once CONTROL_DIR . "SessioneController.php";
include_once CONTROL_DIR . "CdlController.php";
include_once CONTROL_DIR . "ElaboratoController.php";
$controller = new SessioneController();
$controlleCdl = new CdlController();
$controllerEla= new ElaboratoController();


$diLuca=0;
$idSessione=$_URL[4];
$identificativoCorso = $_URL[2];
$corso = $controlleCdl->readCorso($identificativoCorso);
$nomecorso= $corso->getNome();

try {
    $sessioneByUrl = $controller->readSessione($idSessione);
    $dataFrom = $sessioneByUrl->getDataInizio();
    $dataTo = $sessioneByUrl->getDataFine();
    $tipoSessione = $sessioneByUrl->getTipologia();

} catch (ApplicationException $ex) {
    echo "<h1>errore! ApplicationException->errore manca id sessione nel path!</h1>";
    echo "<h4>" . $ex . "</h4>";
}


if(isset( $_POST['datato']) && isset( $_POST['termina'] )) {
    $dataNow=date('Y/m/d/ h:i:s ', time());
    $dataTo=$dataNow;
    $newSessione = new Sessione($dataFrom, $dataNow, 18, "Eseguita", $tipoSessione, $identificativoCorso);
    $controller->updateSessione($idSessione,$newSessione);
    $vaiVisuEsiti= "Location: "."/docente/corso/".$identificativoCorso."/sessione"."/".$idSessione."/"."esiti/show";
    header($vaiVisuEsiti);

}
else if(isset( $_POST['datato'])) {
    $dataFineNow=$_POST['datato'];
    $newSessione = new Sessione($dataFrom, $dataFineNow, 18, "In Esecuzione", $tipoSessione, $identificativoCorso);
    $controller->updateSessione($idSessione,$newSessione);
}

if(isset( $_POST['addStu'])) {
    $vaiAddStu= "Location: "."/docente/corso/".$identificativoCorso."/sessione"."/".$idSessione."/"."sessioneincorso/aggiungistudente";
    header($vaiAddStu);
}

if(isset( $_POST['annullaEsame'])) {
    $matricola=$_POST['annullaEsame'];
    $elaborato=$controllerEla->readElaborato($matricola,$idSessione);
    $nuovoElaborato= new Elaborato($matricola,$elaborato->getSessioneId(),"0","0",$elaborato->getTestId(), "Corretto");
    $controllerEla->updateElaborato($matricola,$idSessione,$nuovoElaborato);
    header("Refresh:0");
}

if(isset( $_POST['aggiorna'])) {
    header("Refresh:0");
}
$sessioneByUrl = $controller->readSessione($idSessione);
$dataTo = $sessioneByUrl->getDataFine();
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
    <link rel="stylesheet" type="text/css"
          href="/assets/global/plugins/bootstrap-datetimepicker/css/bootstrap-datetimepicker.min.css">

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
                <div id="demo"></div>
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
                            $vaiANomeCorso="/docente/corso/".$identificativoCorso;
                            printf("<a href=\"%s\">%s</a><i class=\"fa fa-angle-right\"></i>", $vaiANomeCorso ,$nomecorso);
                            ?>
                        </li>
                        <li>
                            <?php echo "Sessione ".$idSessione ?>
                        </li>

                    </ul>
                </div>

            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->

            <!-- TABELLA 1 -->

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet box blue-madison">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-globe"></i>Test
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title="">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body">
                            <div id="sample_1_wrapper" class="dataTables_wrapper no-footer">
                                <div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="sample_1" role="grid" aria-describedby="sample_1_info">
                                        <thead>
                                        <tr role="row">
                                            <th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="
                                         Username
                                : activate to sort column ascending" style="width: 119px;">
                                                Nome
                                            </th><th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Email
                                " style="width: 210px;">
                                                Data creazione
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
                                        $array = $controller->getAllTestBySessione($idSessione);
                                        if ($array == null) {
                                        }
                                        else {
                                            foreach ($array as $c) {
                                                printf("<tr class=\"gradeX odd\" role=\"row\">");
                                                printf("<td class=\"sorting_1\">Test %s</td>", $c->getId());
                                                printf("<td>%s</td>", $c->getDescrizione());
                                                printf("<td>%d</td>", $c->getNumeroMultiple());
                                                printf("<td>%d</td>", $c->getNumeroAperte());
                                                printf("<td>%d</td>", $c->getPunteggioMax());
                                                printf("<td>%d</td>", $c->getPercentualeScelto());
                                                printf("<td>%d</td>", $c->getPercentualeSuccesso());
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
    </div>


            <!-- TABELLA 2 -->
            <form method="post" action="" name="myForm">

            <div class="row">
                <div class="col-md-12">
                    <div class="portlet box blue-madison">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-globe"></i>Studenti
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title="">
                                </a>
                            </div>
                        </div>
                            <div class="portlet-body " >
                              <div id="sample_1_wrapper" class="dataTables_wrapper no-footer">
                        <div class="row">
                                <div class="col-md-12">
                                    <button type="submit"  name="addStu" href="javascript:;" class="btn sm green-jungle"><i class="fa fa-plus"></i><span class="md-click-circle md-click-animate" style="height: 94px; width: 94px; top: -23px; left: 2px;"></span>
                                        Aggiungi Studente</button>

                                        <a title="Aggiungi alla lista seguente gli Studenti che hanno appena cominciato il test!" name="aggiorna" href="<?php
                                        $vaiASesInCorso="/docente/corso/".$identificativoCorso."/sessione"."/".$idSessione."/"."sessioneincorso";
                                        printf("%s",$vaiASesInCorso);  ?>"
                                           class="btn sm green-jungle"><i class="fa fa-refresh" ></i><span class="md-click-circle md-click-animate" style="height: 94px; width: 94px; top: -23px; left: 2px;"></span>
                                            Aggiorna
                                        </a>
                                </div>
                        </div>
                                <div class="table-scrollable">
                                    <table class="table table-striped table-bordered table-hover dataTable no-footer" id="sample_1" role="grid" aria-describedby="sample_1_info">
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
                                " style="width: 15%;">
                                                Azioni
                                            </th>
                                        </tr>
                                        
                                        </thead>
                                        <tbody>
                                        <?php
                                        $esaminandiSessione = Array();
                                        $toDisable="";
                                        $esaminandiSessione= $controller->getEsaminandiSessione($idSessione);
                                        if ($esaminandiSessione == null) {
                                        }
                                        else {
                                            foreach ($esaminandiSessione as $c) {
                                                $ela=$controllerEla->readElaborato($c->getMatricola(),$idSessione);
                                                printf("<tr class=\"gradeX odd\" role=\"row\">");
                                                printf("<td class=\"sorting_1\">%s</td>", $c->getNome());
                                                printf("<td>%s</td>", $c->getCognome());
                                                printf("<td>%s</td>", $c->getMatricola());
                                                if($ela->getStato()=="Corretto" && $ela->getEsitoParziale()==0 && $ela->getEsitoFinale()==0) {
                                                    $toDisable="Disabled";
                                                }
                                                printf("<td><button type='submit' %s name='annullaEsame' data-toggle=\"confirmation\"
                                        data-singleton=\"true\" data-popout=\"true\" title=\"Sicuro?\" value='%s' href=\"javascript:;\" class=\"btn btn-sm red-intense\">Annulla Esame</button></td>", $toDisable, $c->getMatricola());
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
            </div>



            <div class="row">

                    <div class="col-md-12">
                        <div class="col-md-2">
                            <label class="control-label"><h4>Termine Sessione:</h4></label>
                        </div>
                        <div class="col-md-3">
                            <div class="input-group date form_datetime">
                                <input name="datato" id="termine" type="text" value='<?php printf("%s", $dataTo) ?>'  size="16" class="form-control"/>
                                        <span class="input-group-btn">
                                            <button class="btn default date-set" type="button"><i
                                                    class="fa fa-calendar"></i></button>
                                        </span>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <button type="submit" href="javascript:;" class="btn btn-md blue-madison"><span class="md-click-circle md-click-animate" style="height: 94px; width: 94px; top: -23px; left: 2px;"></span>
                                Modifica Termine
                                <i class="fa fa-edit"></i></button>
                        </div>
                        <div class="col-md-2" >
                        </div>
                        <div class="col-md-1" >
                         <button type="submit"  id="bottoneT" name="termina" value="<?php printf("%s", $dataTo) ?>" class="btn sm red-intense" data-toggle="confirmation"
                                data-singleton="true" data-popout="true" title="Sicuro?"><span class="md-click-circle md-click-animate" style="height: 94px; width: 94px; top: -23px; left: 2px;"></span>
                             TERMINA ORA
                         </button>
                            </div>
                    </div>
                </div>



            </form>


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
<script src="/assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js" type="text/javascript"></script>
<script src="/assets/admin/pages/scripts/ui-confirmations.js"></script>
<script type="text/javascript" src="/assets/global/plugins/bootstrap-datetimepicker/js/bootstrap-datetimepicker.min.js"></script>
<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        //QuickSidebar.init(); // init quick sidebar
        //Demo.init(); // init demo features
        UIConfirmations.init();
    });
</script>
        <script>
            //SCRIPT PER AVVIARE DATETIMEPICKER
            $(".form_datetime").datetimepicker({format: 'yyyy-mm-dd hh:ii:ss'});
        </script>

        <script>
            function loadDoc() {

                var datTo = document.getElementById('bottoneT').value;
                var xhttp = new XMLHttpRequest();
                xhttp.onreadystatechange = function() {
                    if (xhttp.readyState == 4 && xhttp.status == 200) {
                        var boT = new Date(datTo);
                        var timeFromServer = new Date(xhttp.responseText);
                        if(boT>=timeFromServer)
                            document.getElementById("demo").innerHTML = "Sessione in Corso" ;
                        else {
                            var var1='/docente/corso/';
                            var var2=<?php echo "$identificativoCorso" ?>;
                            var var3='/sessione/';
                            var var4=<?php echo "$idSessione" ?>;
                            var var5='/esiti/autoendsuccess';
                            var res1 = var1.concat(var2);
                            var res2 = res1.concat(var3);
                            var res3 = res2.concat(var4);
                            var res4 = res3.concat(var5);
                            document.getElementById("demo").innerHTML = "Sessione Terminata";
                            alert('La sessione è terminata! Sarai indirizzato alla pagina deli Esiti.');
                            window.location.replace(res4);
                        }
                    }
                };
                xhttp.open("GET", "/docente/corso/18/gestoredata", true);
                xhttp.send();
            }
            setInterval(loadDoc, 1000);
        </script>

<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
