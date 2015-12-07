<?php
/**
 * Created by PhpStorm.
 * User: Fabiano
 * Date: 23/11/15
 * Time: 21:59
 */

//TODO qui la logica iniziale, caricamento dei controller ecc
include_once CONTROL_DIR . "SessioneController.php";
include_once CONTROL_DIR . "TestController.php";
include_once CONTROL_DIR . "ArgomentoController.php";
include_once CONTROL_DIR . "CdlController.php";

$controllerSessione = new SessioneController();
$controllerTest = new TestController();
$controllerArgomento = new ArgomentoController();
$controllerCorso = new CdlController();

$corso = null;
$identificativoCorso = $_URL[3];
$id = null;
$idcorso = null;
$argomenti = Array();

try {
    $corso = $controllerCorso->readCorso($_URL[3]);
}catch(ApplicationException $exception){
    echo "ERRORE IN READ CORSO " . $exception;
}

try {
    $docenteassociato = $controllerArgomento->getDocenteAssociato($corso->getId());
}catch(ApplicationException $exception){
    echo "ERRORE IN GETDOCENTEASSOCIATO" . $exception;
}
try{
    $argomenti = $controllerArgomento->getArgomenti($corso->getId());
}catch(ApplicationException $exception){
    echo "ERRORE IN READ ARGOMENTO" . $exception;
}

$idsSessione = $controllerSessione->getAllSessioniByCorso($identificativoCorso);
if(isset($_POST['IdSes'])){
    $idSes = $_POST['IdSes'];
    try {
        $controllerSessione->deleteSessione($idSes);
        header("Refresh:0");
    }
    catch(ApplicationException $ex) {
        echo "CAZZO PERCHè NON FUNZIONI?".$ex;
    }
}

if(isset($_POST['id'])){
    $id = $_POST['id'];
    $idcorso = $corso->getId();
    $controllerArgomento->rimuoviArgomento($id, $idcorso);
    header("Refresh:0");
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
    <title><?php echo $corso->getNome(); ?></title>
    <?php include VIEW_DIR . "header.php"; ?>
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/select2/select2.css">
    <link rel="stylesheet" type="text/css"
          href="/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css">
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
                        <a href="<?php printf("%s","/usr/docente/corso/".$identificativoCorso."/sessione"."/"."creamodificasessione"."/"."0") ?>" class="btn btn-default btn-sm">
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
                                        " style="width: 210px;">
                                    Nome
                                </th><th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                                 Email
                                        " style="width: 210px;">
                                    Data e ora
                                </th><th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                                 Status
                                        " style="width: 20%;">
                                    Tipologia
                                </th><th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                                 Points
                                        " style="width: 73px;">
                                    Stato
                                </th><th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                                 Status
                                        " style="width: 20%;">
                                    Azioni
                                </th></tr>
                            </thead>
                            <tbody>
                            <?php
                            $array = Array();
                            $array = $idsSessione;
                            if ($array == null) {
                                echo "l'array è null";
                            }
                            else {

                                foreach ($array as $c) {
                                    $vaiAModifica="/usr/docente/corso/".$identificativoCorso."/sessione"."/"."creamodificasessione"."/".$c->getId();
                                    $vaiAVisu="/usr/docente/corso/".$identificativoCorso."/sessione"."/"."visualizzasessione"."/".$c->getId();

                                    printf("<tr class=\"gradeX odd\" role=\"row\">");

                                    printf("<td class=\"sorting_1\"><a href=\"%s\">%s</a></td>", $vaiAVisu,  "Sessione ".$c->getId());
                                    printf("<td><b>Inizio:</b>%s<b>  Fine:</b>%s</td>", $c->getDataInizio(),$c->getDataFine());
                                    printf("<td>%s</td>", $c->getTipologia());
                                    printf("<td>%s</td>", $c->getStato());
                                    printf("<td class=\"center\"><a href=\"visualizzaesitisessione\" class=\"btn btn-sm default\">Esiti</a>
                                           <a href=\"%s\" class=\"btn btn-sm blue-madison\"><i class=\"fa fa-edit\"></i></a>
                                                                 <button type='submit' name='IdSes' value='%d' class='btn btn-sm red-intense'><i class=\"fa fa-trash-o\"></i></button>
                                           </td>", $vaiAModifica, $c->getId());
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
                        <a href="test/crea" class="btn btn-default btn-sm">
                            <i class="fa fa-plus"></i> Crea Test </a>
                    </div>
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
                                <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Status
                                " style="width: 14%;">
                                    Azioni
                                </th>


                            </tr>
                            </thead>
                            <tbody>
                                
                                 <?php
                                        $array = Array();
                                        $array = $controllerTest->getAllTestByCorso($identificativoCorso); 
                                        if($array == null){ 
                                             //echo "l'array è null";
                                             printf("<h4>Nessun Test presente</h4>");
                                            }
                                        else{    
                                        foreach($array as $c) {
                                        printf("<tr class=\"gradeX odd\" role=\"row\">");
                                        printf("<td class=\"sorting_1\"><a href=\"test/%s/visualizzatest\">Test %s</a></td>", $c->getId(),$c->getId());
                                        printf("<td>%s</td>",$c->getDescrizione());
                                        printf("<td>%s</td>",$c->getNumeroMultiple());
                                        printf("<td>%s</td>",$c->getNumeroAperte());
                                        printf("<td>%s</td>",$c->getPunteggioMax());
                                        printf("<td>%s %%</td>",$c->getPercentualeScelto());
                                        printf("<td>%s %%</td>",$c->getPercentualeSuccesso());
                                        printf("<td><a href=\"test/crea\" class=\"btn btn-sm blue-madison\"><i class=\"fa fa-edit\"></i></i></a>");
                                        printf("<a href=\"javascript:;\" onclick=\"javascript: elimina(this.id);\" class=\"btn btn-sm red-intense\"><i class=\"fa fa-trash-o\"></i></i></a></td>");
                                        printf("</tr>");
                                        }
                                        }
                                 ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>


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
                    <div class="actions">
                        <a href="<?php echo $corso->getId(); ?>/argomento/inserisci" class="btn btn-default btn-sm">
                            <i class="fa fa-plus"></i> Aggiungi Argomento </a>
                    </div>
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
                                <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Email
                                " style="width: 14%;">
                                    Azioni
                                </th>
                            </tr>

                            </thead>
                            <tbody>


                            <?php

                            foreach($argomenti as $a) {
                                printf("<tr class=\"gradeX odd\" role=\"row\">");
                                printf("<td><a href=\"%d/argomento/domande/%d \">%s</a></td>", $a->getCorsoId() , $a->getId() , $a->getNome());
                                printf("<td>");
                                printf("<a href=\"%d/argomento/modifica/%d\" class=\"btn btn-sm blue-madison\">", $a->getCorsoId(),$a->getId());
                                printf("<i class=\"fa fa-edit\"></i>");
                                printf("</a>");
                                printf("<button name='id' type='submit' value='%d' class='btn btn-sm red-intense'><i class=\"fa fa-trash-o\"></i></button>", $a->getId());
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
<?php include VIEW_DIR . "footer.php"; ?>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<?php include VIEW_DIR . "js.php"; ?>

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
        //TableManaged.init(3);
    });
</script>
<script>
        var elimina = function(id){
	if (window.XMLHttpRequest) {
	  var xhr = new XMLHttpRequest();  
	  xhr.onreadystatechange =gestoreRichiesta;   
	  xhr.open("GET", "/deleteTest?id="+id, true);  
	  xhr.send(""); 
	} 
	function gestoreRichiesta() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                alert(xhr.responseText);
            }
	}
}
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
