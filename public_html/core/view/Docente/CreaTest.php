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

$controller = new ArgomentoController();
$controllerCorso = new CdlController();
$controllerDomande  = new DomandaController();

$corso = $controllerCorso->readCorso(20); //QUI DEVE ANDARCI L'ID DEL CORSO DOVE CI TROVIAMO
$num = $controller->getNumArgomenti(); //STUB
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
    <?php include VIEW_DIR . "header.php"; ?>
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
            <form>
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
                                    <textarea class="form-control" rows="4" placeholder="Inserisci descrizione" style="resize:none"></textarea>
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
                <div class="col-md-6 scroll">

                    <?php
                    $argomenti = array();
                    $argomenti = $controller->getArgomenti($corso->getId());
                    $domandeMultiple = array();
                    $nargomento = 1;
                    $ndomanda = 1;

                    if($argomenti == null){echo "NON CI SONO ARGOMENTI";}
                    foreach($argomenti as $a) {
                        $domandeMultiple = $controller->getAllDomandaMultipla($a->getId(),$a->getCorsoId());
                        printf("<div class=\"portlet box blue-madison\">");
                        printf("<div class=\"portlet-title\">");
                        printf("<div class=\"caption\">");
                        printf("<i class=\"fa fa-comments\"></i>%s", $a->getNome());
                        printf("</div>");
                        printf("<div class=\"tools\">");
                        printf("<a href=\"javascript:;\" class=\"expand\" data-original-title=\"\" title=\"\"></a>");
                        printf("</div>");
                        printf("</div>");
                        printf("<div class=\"portlet-body collapse\">");
                        printf("<div class=\"dd\" id=\"nestable_list_%s\">",$nargomento);
                        printf("<ol class=\"dd-list\">");
                        foreach($domandeMultiple as $domanda) {
                            printf("<li class=\"dd-item\" data-id=\"%s%s\">",$nargomento,$ndomanda); //cambiare id
                            printf("<div class=\"dd-handle\">%s</div>", $domanda->getTesto()); //CAMBIARE NELLA DOMANDA
                            printf("</li>");
                            $ndomanda++;
                        }
                        printf("</ol>");
                        printf("</div>");
                        printf("</div>");
                        printf("</div>");
                        $nargomento++;

                    }
                        foreach($argomenti as $a) {
                        $domandeAperte = $controller->getAllDomandaAperta($a->getId(),$a->getCorsoId());
                        printf("<div class=\"portlet box blue-madison\">");
                        printf("<div class=\"portlet-title\">");
                        printf("<div class=\"caption\">");
                        printf("<i class=\"fa fa-comments\"></i>%s", $a->getNome());
                        printf("</div>");
                        printf("<div class=\"tools\">");
                        printf("<a href=\"javascript:;\" class=\"expand\" data-original-title=\"\" title=\"\"></a>");
                        printf("</div>");
                        printf("</div>");
                        printf("<div class=\"portlet-body collapse\">");
                        printf("<div class=\"dd\" id=\"nestable_list_%s\">",$nargomento);
                        printf("<ol class=\"dd-list\">");
                        foreach($domandeAperte as $domanda) {
                            printf("<li class=\"dd-item\" data-id=\"%s%s\">",$nargomento,$ndomanda); //cambiare id
                            printf("<div class=\"dd-handle\">%s</div>", $domanda->getTesto()); //CAMBIARE NELLA DOMANDA
                            printf("</li>");
                            $ndomanda++;
                        }
                        printf("</ol>");
                        printf("</div>");
                        printf("</div>");
                        printf("</div>");
                        $nargomento++;

                    }
                    ?>










                </div> <!--chiudi col-md-6-->

                <div class="col-md-6">
                    <div class="portlet box blue-madison" id="tabellatest">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-pencil"></i>Test
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title="">
                                </a>

                            </div>
                        </div>
                        <div class="portlet-body ">
                            <div class="dd" id="nestable_list_0">
                                <div class="dd-empty">
                                    <div>
                                        <h3>Trascina le domande qui...</h3>
                                    </div>
                                </div>
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
                                    <a href="../" class="btn sm green-jungle"><span class="md-click-circle md-click-animate" style="height: 94px; width: 94px; top: -23px; left: 2px;"></span>
                                        Conferma
                                    </a>
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
<?php include VIEW_DIR . "footer.php"; ?>
<!-- END FOOTER -->
<!-- BEGIN JAVASCRIPTS(Load javascripts at bottom, this will reduce page load time) -->
<?php include VIEW_DIR . "js.php"; ?>

<!--Script specifici per la pagina -->
<script src="/assets/global/scripts/manuale_random.js" type="text/javascript"></script>
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
        UINestable.init(<?php echo $num; ?>);
        //TableManaged.init(3);
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
