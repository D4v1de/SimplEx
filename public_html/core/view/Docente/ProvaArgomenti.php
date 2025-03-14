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
    <title>Seleziona Domande Test</title>
    <?php include VIEW_DIR . "design/header.php"; ?>
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/jquery-nestable/jquery.nestable.css">

    <style type="text/css">
        div.scroll {
            height: 580px;
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
                Seleziona Domande:  <?php echo $corso->getNome(); ?>
            </h3>

            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->

            <div class="row">
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




            <div class="row">
                <div class="col-md-12">
                    <div class="col-md-10"></div>
                    <div class="col-md-2">
                        <a href="javascript:;" class="btn green-jungle">
                            Conferma <i class="fa fa-plus"></i>
                        </a>
                        <span class="help-block"> <br> </span>
                    </div>
                </div>
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
<script src="/assets/admin/pages/scripts/ui-nestable.js"></script>
<script src="/assets/global/plugins/jquery-nestable/jquery.nestable.js"></script>

<script src="/assets/admin/layout/scripts/quick-sidebar.js" type="text/javascript"></script>
<script src="/assets/admin/layout/scripts/demo.js" type="text/javascript"></script>

<script>


    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        //QuickSidebar.init(); // init quick sidebar
        //Demo.init(); // init demo features
        UINestable.init(<?php echo $num; ?>); //Il numero equivale al n° di tabelle presenti nella pagina

    });

</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>