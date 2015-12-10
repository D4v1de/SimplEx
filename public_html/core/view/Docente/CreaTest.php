<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 18/11/15
 * Time: 09:58
 */

//TODO qui la logica iniziale, caricamento dei controller ecc
include_once CONTROL_DIR . "Esempio.php";
$controller = new Esempio();
include_once CONTROL_DIR . "ArgomentoController.php";
include_once CONTROL_DIR . "CdlController.php";
include_once CONTROL_DIR . "DomandaController.php";
include_once CONTROL_DIR . "TestController.php";

$controllerArgomento = new ArgomentoController();
$controllerCorso = new CdlController();
$controllerDomande  = new DomandaController();
$controllerTest = new TestController();

$identificativoCorso = $_URL[3];

if(isset($_POST['aperte']) or isset($_POST['multiple']) && isset($_POST['descrizione']) && isset($_POST['punteggio']) && isset($_POST['man'])){
    $domAperte=Array();
    $domAperte=$_POST['aperte'];
    $domMultiple=Array();
    $domMultiple=$_POST['multiple'];
    $descrizione=$_POST['descrizione'];
    $punteggio=$_POST['punteggio'];
    $cont1=0;
    $cont2=0;
    if($domAperte==null){          
            }
    else{
        foreach($domAperte as $s) {
                $cont1=$cont1+1;
              }
    }
    if($domMultiple==null){          
            }
    else{
        foreach($domMultiple as $s) {
                $cont2=$cont2+1;
              }
    }
    
    $test = new Test($descrizione,$punteggio,$cont2,$cont1,0,0,$identificativoCorso);
        $idNuovoTest=$controllerTest->creaTest($test);
        foreach($domAperte as $s) {
               $controllerDomande->associaAperTest($s, $idNuovoTest, 5);
              }
        foreach($domMultiple as $s) {
               $controllerDomande->associaMultTest($s, $idNuovoTest, 3, -1);
              }      
        $tornaACasa= "Location: "."/usr/docente/corso/"."$identificativoCorso";
            header($tornaACasa);
}

$corso = $controllerCorso->readCorso($_URL[3]); //QUI DEVE ANDARCI L'ID DEL CORSO DOVE CI TROVIAMO
$num = $controllerArgomento->getNumArgomenti(); //STUB
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
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/select2/select2.css">
    <link rel="stylesheet" type="text/css"
          href="/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css">
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
                    Crea Test
                </h3>
                <div class="page-bar">
                    <ul class="page-breadcrumb">
                        <li>
                            <i class="fa fa-home"></i>
                            <a href="index.html">Home</a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            <a href="#">Nome Corso</a>
                            <i class="fa fa-angle-right"></i>
                        </li>
                        <li>
                            <a href="#">Crea Test</a>
                        </li>

                    </ul>
                </div>

            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->
            <form action="" method="post">
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
                            <h4> Descrizione</h4>
                                <div class="col-md-12">
                                    <textarea class="form-control" name="descrizione" id="descrizione" rows="4" placeholder="Inserisci descrizione" style="resize:none"></textarea>
                                </div>
                                <div class="row">
                                   <div class="col-md-4">
                                    <h4>Punteggio massimo Test:</h4>
                                    <input type="text" id="punteggio" name="punteggio" class="form-control">
                                    <span class="help-block">Inserire numero</span>
                                   </div>           
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <h4> Tipologia selezione domande</h4>
                                            <div class="col-md-10">
                                                    <div class="md-radio-inline">
                                                            <div class="md-radio">
                                                                    <input type="radio" id="man" checked="" onclick="javascript: SetContent();" name="tipologia" class="md-radiobtn">
                                                                    <label for="man">
                                                                    <span></span>
                                                                    <span class="check"></span>
                                                                    <span class="box"></span>
                                                                    Manuale </label>
                                                            </div>
                                                            <div class="md-radio">
                                                                    <input type="radio" id="rand" onclick="javascript: SetContent();" name="tipologia" class="md-radiobtn">
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
                                                    <input type="text" id="numAperte" class="form-control">
                                                        <label for="form_control_1">Numero domande a risposta aperta:</label>
                                                            <span class="help-block">Inserire numero</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-md-line-input has-success">
                                                <div class="input-icon">
                                                    <input type="text" id="numMultiple" class="form-control">
                                                        <label for="form_control_1">Numero domande a risposta multipla:</label>
                                                            <span class="help-block">Inserire numero</span>
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
                                <th class="table-checkbox sorting_disabled" rowspan="1" colspan="1" aria-label="
                                                        " style="width: 24px;">
                                <input type="checkbox" class="group-checkable" data-set="#tabella_studenti .checkboxes">
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
                                </th>
                                <th class="sorting_disabled" rowspan="1" colspan="1" aria-label="
                                         Status
                                " style="width: 200px;">
                                    Tipologia
                                </th>
                                
                            </tr>
                            </thead>
                            <tbody>
                            <!-- qui va il riempimento automatico -->    
                            <?php
                            $Argomenti = Array();
                            $Multiple = Array();
                            $Aperte = Array();
                            $Argomenti = $controllerArgomento->getArgomenti($identificativoCorso);
                            foreach($Argomenti as $a){
                                $Multiple = $controllerDomande->getAllMultiple($a->getId());
                                $Aperte = $controllerDomande->getAllAperte($a->getId());
                                foreach($Multiple as $m){
                                    printf("<tr class=\"gradeX odd\" role=\"row\">");
                                    printf("<td><input type=\"checkbox\" value=\"%d\" name=\"multiple[]\" class=\"checkboxes\"></td>", $m->getId(), $m->getId());
                                    printf("<td>%s</td>",$m->getId());
                                    printf("<td>%s</td>",$a->getNome());
                                    printf("<td>%s</td>",$m->getTesto());
                                    printf("<td>Multipla</td>");
                                    printf("</tr>");
                                }
                                foreach($Aperte as $x){
                                    printf("<tr class=\"gradeX odd\" role=\"row\">");
                                    printf("<td><input type=\"checkbox\" value=\"%d\" name=\"aperte[]\" class=\"checkboxes\"></td>", $x->getId(), $x->getId());
                                    printf("<td>%s</td>",$x->getId());
                                    printf("<td>%s</td>",$a->getNome());
                                    printf("<td>%s</td>",$x->getTesto());
                                    printf("<td>Aperta</td>");
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
                                    Conferma
                                    </button>
                                    <a href="../" class="btn sm red-intense">
                                        Annulla
                                    </a>
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
<script src="/assets/global/scripts/creazioneTest.js" type="text/javascript"></script>
<script src="/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<!-- BEGIN PAGE LEVEL PLUGINS aggiunta da me-->
<script type="text/javascript" src="/assets/global/plugins/select2/select2.min.js"></script>
<script type="text/javascript" src="/assets/global/plugins/datatables/media/js/jquery.dataTables.min.js"></script>
<script type="text/javascript"
        src="/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.js"></script>
<!-- END PAGE LEVEL PLUGINS aggiunta da me-->
<script src="/assets/admin/pages/scripts/ui-nestable.js"></script>
<script src="/assets/global/plugins/jquery-nestable/jquery.nestable.js"></script>
<script src="/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>
<script src="/assets/global/scripts/metronic.js" type="text/javascript"></script>
<script src="/assets/admin/layout/scripts/layout.js" type="text/javascript"></script>
<!-- BEGIN aggiunta da me -->
<script src="/assets/admin/pages/scripts/table-managed.js"></script>
<!-- END aggiunta da me -->
<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        //QuickSidebar.init(); // init quick sidebar
        //Demo.init(); // init demo features
        TableManaged.init("tabella_argomenti2","tabella_argomenti2_wrapper");
        TableManaged.init("tabella_domande","tabella_domande_wrapper");
        UINestable.init(<?php echo $num; ?>);
        //TableManaged.init(3);
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
