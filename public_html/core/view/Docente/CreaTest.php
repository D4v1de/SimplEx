<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 18/11/15
 * Time: 09:58
 */

//TODO qui la logica iniziale, caricamento dei controller ecc
include_once CONTROL_DIR . "ArgomentoController.php";
include_once CONTROL_DIR . "CdlController.php";
include_once CONTROL_DIR . "DomandaController.php";
include_once CONTROL_DIR . "TestController.php";

$controllerArgomento = new ArgomentoController();
$controllerCorso = new CdlController();
$controllerDomande  = new DomandaController();
$controllerTest = new TestController();

$identificativoCorso = $_URL[2];

function parseInt($Str) {
    return (int)$Str;   
} 

if(isset($_POST['aperte']) or isset($_POST['multiple']) && isset($_POST['descrizione']) && (isset($_POST['tipologia']) && $_POST['tipologia']=='man')){
    // qui va la parte manuale 
    // LA STO RIFACENDO C***O
    $domAperte=Array(); //domande aperte selezionate
    $domAperte=$_POST['aperte']; //domande aperte selezionate
    $domMultiple=Array(); //domande multiple selezionate
    $domMultiple=$_POST['multiple']; //domande multiple selezionate
    $descrizione=$_POST['descrizione']; //descrizione testo
    $punteggio=0; 
    $cont1=0;
    $cont2=0;
    foreach($domAperte as $s){
        $cont1=$cont1+1;   //conto le domande aperte
    }
    foreach($domMultiple as $s){
        $cont2=$cont2+1;   //conto le domande multiple
    }
    $test = new Test($descrizione,0,$cont2,$cont1,0,0,$identificativoCorso);  //creo il test
    $idNuovoTest=$controllerTest->creaTest($test);   //inserisco il test nel db
    
    foreach($domAperte as $s){      //per ogni domanda aperta selezionata controllo se è stato inserito un punteggio alternativo
        $stringa=sprintf("ApertaCorr-%d", $s);
        if(!(empty($_POST[$stringa]))){  //se si associo quella domanda al test con quel valore e incremento il punteggio totale
            $z=$_POST[$stringa];
            $punteggio=$punteggio+(parseInt($z));
            $controllerDomande->associaAperTest($s,$idNuovoTest,$z);
        }else{   //altrimenti la associo con valore null(valore di default presente nel db) e incremento il punteggio totale
            $w=$controllerDomande->getDomandaAperta($s);
            $punteggio=$punteggio+($w->getPunteggioMax());
            $controllerDomande->associaAperTest($s,$idNuovoTest,NULL); 
        }
    }
        $z1=0;
        $z2=0;
    foreach($domMultiple as $s){  //per ogni domanda multipla selezionata controllo se è stato inserito un punteggio alternativo
        $stringa1=sprintf("alternCorr-%d", $s);
        if(!(empty($_POST[$stringa1]))){  //se si incremento il punteggio totale con quel punteggio alternativo
            $z1=$_POST[$stringa1];
            $punteggio=$punteggio+(parseInt($z1));
        }else{ // altrimenti incremento con il valore di default preso dal db
            $w=$controllerDomande->getDomandaMultipla($s);
            $punteggio=$punteggio+($w->getPunteggioCorretta());
            $z1=NULL; 
        }
        $stringa2=sprintf("alternErr-%d", $s);
        if(!(empty($_POST[$stringa2]))){  //controllo per il punteggio alternativo dell' errore
            $z2=$_POST[$stringa2];
        }else{
            $z2=NULL; 
        }
        $controllerDomande->associaMultTest($s, $idNuovoTest, $z1, $z2);//associo la domanda multipla al test
        
    }
         $ilTest=$controllerTest->readTest($idNuovoTest);
         $ilTest->setPunteggioMax($punteggio);
         $controllerTest->updateTest($idNuovoTest,$ilTest);//aggiorno il valore di punteggio totale del test(finora zero) con il puteggio calcolato finora
         $tornaACasa= "Location: "."/docente/corso/"."$identificativoCorso";
         header($tornaACasa);//torno alla home
 
         
        }
        
    if((isset($_POST['tipologia']) && $_POST['tipologia']=='rand') && !(empty($_POST['descrizione'])) && !(empty($_POST['numAperte'])) && !(empty($_POST['numMultiple']))){
    //qui va la parte random
    $nApe=parseInt($_POST['numAperte']);
    $nMul=parseInt($_POST['numMultiple']);
    $descr=$_POST['descrizione'];
    $punteggio=0;
    $Argomenti = Array();
    $Multiple = Array();
    $Aperte = Array();
    $Argomenti=$controllerArgomento->getArgomenti($identificativoCorso);
        $leAperte = Array();
        $leMultiple = Array();
        foreach($Argomenti as $a){// per ogni argomento del corso prendo tutte le aperte e le multiple
        $nuoveAperte = Array();
        $nuoveAperte = $controllerDomande->getAllAperte($a->getId());
        $Aperte = array_merge($Aperte,$nuoveAperte);
        $nuoveMultiple = Array();
        $nuoveMultiple = $controllerDomande->getAllMultiple($a->getId());
        $Multiple = array_merge($Multiple,$nuoveMultiple);
    }
    if($nApe>1){
    $indiciA=array_rand($Aperte,$nApe);
    
    for($i=0;$i<$nApe;$i++){
    $leAperte[$i]=$Aperte[$indiciA[$i]];
    }
    }else if($nApe==1){
      $x=rand(0,(count($Aperte)-1)); 
      $leAperte[0]=$Aperte[$x];  
    }else{
        $tornaACasa= "Location: "."/docente/corso/"."$identificativoCorso";
        header($tornaACasa); //torno alla home
    }
    if($nMul>1){
    $indiciM=array_rand($Multiple,$nMul);
    
    for($i=0;$i<$nMul;$i++){
    $leMultiple[$i]=$Multiple[$indiciM[$i]];
    }
    }else if($nMul==0){
        $x=rand(0,(count($Multiple)-1)); 
        $leMultiple[0]=$Multiple[$x];
    }else{
       $tornaACasa= "Location: "."/docente/corso/"."$identificativoCorso";
        header($tornaACasa); //torno alla home 
    }
    
    foreach($leAperte as $s){ //leAperte selezionate vengono controllate per aggiorare il punteggio totale
        $w=$controllerDomande->getDomandaAperta($s->getId());
        $punteggio=$punteggio+($w->getPunteggioMax());
    }
    foreach($leMultiple as $s) { //leMultiple selezionate vengono controllate per aggiorare il punteggio totale
        $w=$controllerDomande->getDomandaMultipla($s->getId());
        $punteggio=$punteggio+($w->getPunteggioCorretta());
    }
    $nApe=parseInt($_POST['numAperte']);//mi riprendo il numero delle aperte
    $nMul=parseInt($_POST['numMultiple']);//mi riprendo il numero di multiple
    $test = new Test($descr,$punteggio,$nMul,$nApe,0,0,$identificativoCorso);//creo il test e lo metto nel db
    $idNuovoTest=$controllerTest->creaTest($test);
    foreach($leAperte as $s){ //scansiono di nuovo le aperte per associarle al test
        $controllerDomande->associaAperTest(parseInt($s->getId()), $idNuovoTest, NULL);
    }
    foreach($leMultiple as $x) { //scansiono di nuovo le multiple per associarle al test
        $controllerDomande->associaMultTest(parseInt($x->getId()), $idNuovoTest, NULL, NULL);
    }
    
    $tornaACasa= "Location: "."/docente/corso/"."$identificativoCorso";
        header($tornaACasa); //torno alla home
    
}

$corso = $controllerCorso->readCorso($_URL[2]); 
$num = $controllerArgomento->getNumArgomenti(); 
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
                                                    <input type="text" id="numAperte" name="numAperte" class="form-control">
                                                        <label for="numAperte">Numero domande a risposta aperta:</label>
                                                            <span class="help-block">Inserire numero</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group form-md-line-input has-success">
                                                <div class="input-icon">
                                                    <input type="text" id="numMultiple" name="numMultiple" class="form-control">
                                                        <label for="numMultiple">Numero domande a risposta multipla:</label>
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
                            $Argomenti = Array();
                            $Multiple = Array();
                            $Aperte = Array();
                            $Argomenti = $controllerArgomento->getArgomenti($identificativoCorso);
                            foreach($Argomenti as $a){
                                $Multiple = $controllerDomande->getAllMultiple($a->getId());
                                $Aperte = $controllerDomande->getAllAperte($a->getId());
                                foreach($Multiple as $s){
                                    printf("<tr class=\"gradeX odd\" role=\"row\">");
                                    printf("<td><input type=\"checkbox\" value=\"%d\" name=\"multiple[]\" class=\"checkboxes\"></td>", $s->getId(),$s->getId());
                                    printf("<td>%s</td>",$s->getId());
                                    printf("<td>%s</td>",$a->getNome());
                                    printf("<td>%s</td>",$s->getTesto());
                                    printf("<td>Multipla</td>");
                                    printf("<td><div class=\"form-group form-md-line-input has-success\"><div class=\"input-icon\"><input type=\"text\" name=\"alternCorr-%d\" class=\"form-control\">
                                            <label for=\"alternCorr\">Corretta:</label>
                                            ", $s->getId());
                                    printf("</div><div class=\"form-group form-md-line-input has-success\"><div class=\"input-icon\"><input type=\"text\" name=\"alternErr-%d\" class=\"form-control\">
                                            <label for=\"alternErr\">Errata:</label>
                                            </div></div></td>", $s->getId());
                                    printf("</tr>");
                                }
                                foreach($Aperte as $s){
                                    printf("<tr class=\"gradeX odd\" role=\"row\">");
                                    printf("<td><input type=\"checkbox\" value=\"%d\" name=\"aperte[]\" class=\"checkboxes\"></td>", $s->getId(), $s->getId());
                                    printf("<td>%s</td>",$s->getId());
                                    printf("<td>%s</td>",$a->getNome());
                                    printf("<td>%s</td>",$s->getTesto());
                                    printf("<td>Aperta</td>");
                                    printf("<td><div class=\"form-group form-md-line-input has-success\"><div class=\"input-icon\"><input type=\"text\" name=\"ApertaCorr-%d\" class=\"form-control\">
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
                                    Conferma
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
        UIConfirmations.init();
        FormValidation.init();
        //TableManaged.init(3);
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
