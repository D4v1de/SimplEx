<?php
/**
 * La view consente al docente di visualizzare la home del corso.
 * In particolare si occupa di mostrare la lista di tutte le sessioni, tutti i
 * tests e tutti gli argomenti relativi a quel corso.
 *
 * @author Antonio Luca D'Avanzo, Fabio Esposito, Carlo Di Domenico
 * @version 1
 * @since 18/11/15 09:58
 */

//TODO qui la logica iniziale, caricamento dei controller ecc
include_once CONTROL_DIR . "SessioneController.php";
include_once CONTROL_DIR . "TestController.php";
include_once CONTROL_DIR . "ArgomentoController.php";
include_once CONTROL_DIR . "CdlController.php";

$utenteLoggato = $_SESSION['user'];

$controllerSessione = new SessioneController();
$controllerTest = new TestController();
$controllerArgomento = new ArgomentoController();
$controllerCorso = new CdlController();

$corso = null;
$identificativoCorso = $_URL[2];
$id = null;
$idcorso = null;
$argomenti = Array();
$correttezzaLogin = false;

try {
    $idsSessione = $controllerSessione->getAllSessioniByCorso($identificativoCorso);
} catch (ApplicationException $ex) {
    echo "<h1>GETALLSESSIONIBYCORSO FALLITO!</h1>" . $ex;
}

$now = date("Y-m-d H:i:s");
foreach ($idsSessione as $c) {
    $end = $c->getDataFine();
    $start = $c->getDataInizio();

    if ($c->getStato() == "Non eseguita" && ($now >= $start && $now <= $end)) { //vuol dire che è in esecuizione
        $sessioneAggiornata = new Sessione($c->getDataInizio(), $c->getDataFine(), $c->getSogliaAmmissione(), "In esecuzione", $c->getTipologia(), $identificativoCorso);
        $controllerSessione->updateSessione($c->getId(), $sessioneAggiornata);
    }
    else if ($c->getStato() == "Eseguita" && ($now >= $start && $now <= $end)) { //vuol dire che è in esecuizione
        $sessioneAggiornata = new Sessione($c->getDataInizio(), $c->getDataFine(), $c->getSogliaAmmissione(), "In esecuzione", $c->getTipologia(), $identificativoCorso);
        $controllerSessione->updateSessione($c->getId(), $sessioneAggiornata);
    }else if ($c->getStato() == "Non eseguita" && ($now > $end)) {
        $sessioneAggiornata = new Sessione($c->getDataInizio(), $c->getDataFine(), $c->getSogliaAmmissione(), "Eseguita", $c->getTipologia(), $identificativoCorso);
        $controllerSessione->updateSessione($c->getId(), $sessioneAggiornata);
    } else if ($c->getStato() == "In esecuzione" && ($now > $end)) {
        $sessioneAggiornata = new Sessione($c->getDataInizio(), $c->getDataFine(), $c->getSogliaAmmissione(), "Eseguita", $c->getTipologia(), $identificativoCorso);
        $controllerSessione->updateSessione($c->getId(), $sessioneAggiornata);
    } else
         ;
}

try {
    $corso = $controllerCorso->readCorso($_URL[2]);
}catch(ApplicationException $exception){
    echo "ERRORE IN READ CORSO " . $exception;
}

try {
    $docenteassociato = $controllerArgomento->getDocenteAssociato($corso->getId());
}catch(ApplicationException $exception){
    echo "ERRORE IN GETDOCENTEASSOCIATO" . $exception;
}


//CONTROLLO LOGIN CORRETTO

try{
    $matricolaLoggato = $utenteLoggato->getMatricola();
}catch(ApplicationException $exception){
    echo "ERRORE IN GET MATRICOLA" . $exception;
}

foreach($docenteassociato as $docente){
    if($docente->getMatricola() == $matricolaLoggato){
        $correttezzaLogin = true;
    }
}

if($correttezzaLogin == false){
    header('Location: /docente');
}

try{
    $argomenti = $controllerArgomento->getArgomenti($corso->getId());
}catch(ApplicationException $exception){
    echo "ERRORE IN READ ARGOMENTO" . $exception;
}


if(isset($_POST['IdSes'])){
    $idSes = $_POST['IdSes'];
    try {
        $controllerSessione->deleteSessione($idSes);
        header("location: "."/docente/corso/".$identificativoCorso."/successelimina");
    }
    catch(ApplicationException $ex) {
        echo "ERRORE". $ex;
    }
}



if(isset($_POST['id'])){
    $id = $_POST['id'];
    $idcorso = $corso->getId();
    $controllerArgomento->rimuoviArgomento($id, $idcorso);
    header("location: "."/docente/corso/".$identificativoCorso."/successelimina");
}




if(isset($_POST['idtest'])){
    $id = $_POST['idtest'];
    $Tests=Array();
    $Sess=Array();
    $i=0;
    $Sess=$controllerSessione->getAllSessioniByCorso($identificativoCorso); 
    foreach($Sess as $s){
        $nuoviTest=$controllerSessione->getAllTestBySessione($s->getId());
        $Tests=array_merge($Tests,$nuoviTest);
    }
    foreach($Tests as $t){
        if($t==$id){
           $i++; 
        }
    }
    if($i>0){
        
    }else{
     $controllerTest->deleteTest($id);
     $tornaACasa= "Location: "."/docente/corso/"."$identificativoCorso";
     header($tornaACasa);   
    }
    
}

$sessioniByCorso=$controllerSessione->getAllSessioniByCorso($identificativoCorso);

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
    <?php include VIEW_DIR . "design/header.php"; ?>
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/select2/select2.css">
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/bootstrap-toastr/toastr.min.css">
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

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="../">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="../cdl/<?php echo $corso->getCdlMatricola(); ?>"> <?php echo $controllerCorso->readCdl($corso->getCdlMatricola())->getNome(); ?> </a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                       <?php echo $corso->getNome(); ?>
                    </li>
                </ul>
            </div>

            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->


            <div class="row">
                <div class="col-md-12">
                    <div class="form">
                        <form action="#" class="form-horizontal form-bordered form-row-stripped">
                            <div class="form-actions">
                                <div class="col-md col-md-12">
                                    <h3><?php echo $corso->getNome(); ?></h3>
                                    <h5>Matricola: <?php echo $corso->getMatricola(); ?></h5>
                                    <h5>Tipologia: <?php echo $corso->getTipologia(); ?></h5>

                                    <?php
                                    if (count($docenteassociato) == 1) {
                                        printf('<h5>Docente: %s %s</h5>', $docenteassociato[0]->getNome(), $docenteassociato[0]->getCognome());
                                    } else if (count($docenteassociato) > 1) {
                                        foreach ($docenteassociato as $d) {
                                            printf('<h5>Docente: %s %s</h5>', $d->getNome(), $d->getCognome());
                                        }
                                    } else if (count($docenteassociato) < 1) {
                                        printf('<h5>Questo corso non ha docenti Associati!</h5>');
                                    }

                                    ?>

                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>


            <div class="row">
                <h3></h3>
            </div>


            <form action="" method="post">
            <div class="portlet box blue-madison">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-files-o"></i>Sessioni
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title="">
                        </a>
                    </div>
                    <div class="actions">
                        <a href="<?php printf("%s","/docente/corso/".$identificativoCorso."/sessione"."/"."0"."/"."creamodificasessione") ?>" class="btn btn-default btn-sm">
                            <i class="fa fa-plus"></i> Crea Sessione </a>
                    </div>
                </div>
                <div class="portlet-body">
                    <div id="tabella_sessioni_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-striped table-bordered table-hover dataTable no-footer"
                               id="tabella_sessioni" role="grid" aria-describedby="tabella_sessioni_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                                 sortAscending
                                        ">
                                    Nome
                                </th><th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                                 Email
                                        " style="width: 180px;">
                                    Data e Ora
                                </th><th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                                 Status
                                        "  >
                                    Tipologia
                                </th><th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                                 Points
                                        " >
                                    Stato
                                </th><th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                                 Points
                                        ">
                                    Mostra Esiti
                                </th><th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                                 Points
                                        " >
                                    Mostra Risposte Corrette
                                </th><th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                                 Status
                                        " >
                                    Azioni
                                </th></tr>
                            </thead>
                            <tbody>
                            <?php
                            $array = Array();
                            $array = $sessioniByCorso;
                            $now = date("Y-m-d H:i:s");
                            if ($array == null) {
                            }
                            else {

                                foreach ($array as $c) {
                                    $end = $c->getDataFine();
                                    $start = $c->getDataInizio();
                                    $vaiAModifica="/docente/corso/".$identificativoCorso."/sessione"."/".$c->getId()."/"."creamodificasessione";
                                    $vaiAVisu="/docente/corso/".$identificativoCorso."/sessione"."/".$c->getId();
                                    $vaiASesInCorso="/docente/corso/".$identificativoCorso."/sessione"."/".$c->getId()."/"."sessioneincorso";
                                    $vaiVisuEsiti= "/docente/corso/".$identificativoCorso."/sessione"."/".$c->getId()."/"."esiti/show";

                                    printf("<tr class=\"gradeX odd\" role=\"row\">");
                                    if($c->getStato()!="In esecuzione")
                                        printf("<td class=\"sorting_1\"><a class=\"btn default btn-xs green-stripe\" href=\"%s\">%s</a></td>", $vaiAVisu,  "Sessione ".$c->getId());
                                    else
                                        printf("<td class=\"sorting_1\"><a class=\"btn default btn-xs green-stripe\" href=\"%s\">%s</a></td>", $vaiASesInCorso,  "Sessione ".$c->getId());
                                    printf("<td><div class='row'><div class='col-md-offset-1'><b>Inizio:</b>%s</div></div><div class='row'><div class='col-md-offset-1'><b>  Fine:</b>  %s</div></div></td>", $c->getDataInizio(),$c->getDataFine());
                                    printf("<td>%s</td>", $c->getTipologia());
                                    printf("<td>%s</td>", $c->getStato());
                                    printf("<td>%s</td>", $controllerSessione->readMostraEsitoSessione($c->getId()));
                                    printf("<td>%s</td>", $controllerSessione->readMostraRisposteCorretteSessione($c->getId()));
                                    if($c->getStato()=="Eseguita") {
                                        printf("<td class=\"center\"><a href=\"%s\" class=\"btn btn-sm default\">Esiti</a>
                                           <a href=\"%s\" class=\"btn btn-sm blue-madison\"><i class=\"fa fa-edit\"></i></a>
                                                                 <button type='submit' name='IdSes' value='%d' disabled='' class='btn btn-sm red-intense'  data-toggle=\"confirmation\"
                                        data-singleton=\"true\" data-popout=\"true\" title=\"Sicuro?\"><i class=\"fa fa-trash-o\"></i></button>
                                           </td>", $vaiVisuEsiti, $vaiAModifica, $c->getId());
                                    }
                                    else if($c->getStato()=="In esecuzione"){
                                        printf("<td class=\"center\"><a href=\"%s\"  disabled='' class=\"btn btn-sm default\">Esiti</a>
                                           <a href=\"%s\" class=\"btn btn-sm blue-madison\"><i class=\"fa fa-edit\"></i></a>
                                                                 <button type='submit' disabled=''  name='IdSes' value='%d' class='btn btn-sm red-intense'  data-toggle=\"confirmation\"
                                        data-singleton=\"true\" data-popout=\"true\" title=\"Sicuro?\"><i class=\"fa fa-trash-o\"></i></button>
                                           </td>", $vaiVisuEsiti, $vaiAModifica, $c->getId());
                                    }
                                    else {
                                        printf("<td class=\"center\"><a href=\"%s\"  disabled='' class=\"btn btn-sm default\">Esiti</a>
                                           <a href=\"%s\" class=\"btn btn-sm blue-madison\"><i class=\"fa fa-edit\"></i></a>
                                                                 <button type='submit' name='IdSes' value='%d' class='btn btn-sm red-intense'  data-toggle=\"confirmation\"
                                        data-singleton=\"true\" data-popout=\"true\" title=\"Sicuro?\"><i class=\"fa fa-trash-o\"></i></button>
                                           </td>", $vaiVisuEsiti, $vaiAModifica, $c->getId());
                                    }
                                    printf("</tr>");
                                }
                            }
                            ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            </form>

            
            <form action="" method="post">
            <div class="portlet box blue-madison">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-file-text-o"></i>Test
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title="">
                        </a>
                    </div>
                    <?php
                    printf("<div class=\"actions\">");
                    printf("<a href=\"/docente/corso/%s/test/crea\" class=\"btn btn-default btn-sm\">", $identificativoCorso);
                    printf("<i class=\"fa fa-plus\"></i> Crea Test </a>");
                    printf("</div>");
                    ?>
                </div>
                <div class="portlet-body">
                    <div id="tabella_test_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-striped table-bordered table-hover dataTable no-footer"
                               id="tabella_test" role="grid" aria-describedby="tabella_test_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="
                                         Username
                                : activate to sort column ascending" style="width: 119px;">
                                    Nome
                                </th><th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Points
                                " style="width: 140px;">
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
                                " style="width: 100px;">
                                    Punteggio massimo
                                </th>
                                <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Status
                                " style="width: 100px;">
                                    % Inserito
                                </th>
                                <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Status
                                " style="width: 100px;">
                                    % Superato
                                </th>
                                <?php
                                    printf("<th class=\"sorting_disabled\" rowspan=\"1\" colspan=\"1\" aria-label=\"Status\" style=\"width: 14%%;\">");
                                    printf("Azioni");
                                    printf("</th>");
                                ?>
                            </tr>
                            </thead>
                            <tbody>
                                
                                 <?php
                                        $array = Array();
                                        $array = $controllerTest->getAllTestByCorso($identificativoCorso); 
                                        if($array == null){ 
                                            }
                                        else{    
                                        foreach($array as $c) {
                                        $vaiATest="/docente/corso/".$identificativoCorso."/test"."/".$c->getId()."/"."visualizzatest";
                                        printf("<tr class=\"gradeX odd\" role=\"row\">");
                                        printf("<td class=\"sorting_1\"><a class=\"btn default btn-xs green-stripe\" href=\"%s\">Test %s</a></td>", $vaiATest, $c->getId());
                                        printf("<td>%s</td>",$c->getDescrizione());
                                        printf("<td>%s</td>",$c->getNumeroMultiple());
                                        printf("<td>%s</td>",$c->getNumeroAperte());
                                        printf("<td>%s</td>",$c->getPunteggioMax());
                                        printf("<td>%s %%</td>",$c->getPercentualeScelto());
                                        printf("<td>%s %%</td>",$c->getPercentualeSuccesso());
                                        $questoTest=$c->getId();
                                        $alModificaTest="/docente/corso/".$identificativoCorso."/test/modifica/".$questoTest;
                                        printf("<td><a href=\"%s\" class=\"btn btn-sm blue-madison\"><i class=\"fa fa-edit\"></i></i></a>",$alModificaTest);
                                        printf("<button class=\"btn btn-sm red-intense\" type=\"submit\" name=\"idtest\" title=\"\" id=\"%d\" value=\"%d\" data-popout=\"true\" data-toggle=\"confirmation\" data-singleton=\"true\" data-original-title=\"Sei sicuro?\"><i class=\"fa fa-trash-o\"></i></button>", $c->getId(), $c->getId());
                                        printf("</td>");
                                        printf("</tr>");
                                        }
                                        }
                                 ?>
                            </tbody>
                        </table>
                    </div>
                    
                </div>
                    
            </div>
                </form>
            


        <form action="" method="post">
            <div class="portlet box blue-madison">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-book"></i>Argomenti
                    </div>
                    <div class="tools">
                        <a href="javascript:;" class="collapse" data-original-title="" title="">
                        </a>
                    </div>
                    <?php
                            printf("<div class=\"actions\">");
                            printf("<a href=\"/docente/corso/%s/argomento/inserisci\" class=\"btn btn-default btn-sm\">",$corso->getId());
                            printf("<i class=\"fa fa-plus\"></i> Aggiungi Argomento </a>");
                            printf("</div>");
                    ?>
                </div>
                <div class="portlet-body">
                    <div id="tabella_argomenti_wrapper" class="dataTables_wrapper no-footer">
                        <table class="table table-striped table-bordered table-hover dataTable no-footer"
                               id="tabella_argomenti" role="grid" aria-describedby="tabella_argomenti_info">
                            <thead>
                            <tr role="row">
                                <th class="sorting_asc" tabindex="0" aria-controls="sample_1" rowspan="1" colspan="1" aria-sort="ascending" aria-label="
                                         Username
                                : activate to sort column ascending" style="width: 119px;">
                                    Nome
                                </th>
                                <?php
                                        printf("<th class=\"sorting_disabled\" rowspan=\"1\" colspan=\"1\" aria-label=\"Email\" style=\"width: 14%%;\">Azioni</th>");
                                ?>
                            </tr>

                            </thead>
                            <tbody>


                            <?php

                            foreach($argomenti as $a) {
                                printf("<tr class=\"gradeX odd\" role=\"row\">");
                                printf("<td><a class=\"btn default btn-xs green-stripe\" href=\"/docente/corso/%d/argomento/domande/%d \">%s</a></td>", $a->getCorsoId() , $a->getId() , $a->getNome());
                                printf("<td>");
                                printf("<a href=\"/docente/corso/%d/argomento/modifica/%d \" class=\"btn btn-sm blue-madison\">", $a->getCorsoId(),$a->getId());
                                printf("<i class=\"fa fa-edit\"></i>");
                                printf("</a>");
                                printf("<button class=\"btn btn-sm red-intense\" type=\"submit\" name=\"id\" title='Sei sicuro?' value=\"%d\" data-popout=\"true\" data-toggle=\"confirmation\" data-singleton=\"true\"><i class=\"fa fa-trash-o\"></i></button>",$a->getId());
                                printf("</td>");
                                printf("</tr>");
                            }


                            ?>


                            </tbody>
                        </table>
                    </div>
                </div>
                </div>
            </form>




        </div>
    </div>
    <!-- END EXAMPLE TABLE PORTLET-->
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
<script src="/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<!-- BEGIN aggiunta da me -->
<script src="/assets/admin/pages/scripts/table-managed.js"></script>
<script src="/assets/global/plugins/bootstrap-confirmation/bootstrap-confirmation.min.js" type="text/javascript"></script>
<script src="/assets/admin/pages/scripts/ui-confirmations.js"></script>

<script src="/assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>
<script src="/assets/admin/pages/scripts/ui-toastr.js"></script>

<!-- END aggiunta da me -->
<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        //QuickSidebar.init(); // init quick sidebar
        //Demo.init(); // init demo features
        TableManaged2.init("tabella_sessioni","tabella_sessioni_wrapper");
        TableManaged2.init("tabella_test","tabella_test_wrapper");
        TableManaged2.init("tabella_argomenti","tabella_argomenti_wrapper");
        UIConfirmations.init();
        UIToastr.init();
        checkNotifiche();

    });
</script>

<script>
    function checkNotifiche(){
        var href = window.location.href;
        var last = href.substr(href.lastIndexOf('/') + 1);
        if(last == 'successinserimento'){
            toastr.success('Inserimento avvenuto correttamente!', 'Inserimento');
        }else if(last == 'successmodifica'){
            toastr.success('Modifica avvenuta correttamente!', 'Modifica');
        }else if(last == 'successelimina'){
            toastr.success('Eliminazione avvenuta correttamente!', 'Eliminazione');
        }
    }
</script>





<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
