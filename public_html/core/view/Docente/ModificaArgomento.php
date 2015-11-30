<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 18/11/15
 * Time: 09:58
 */
//TODO qui la logica iniziale, caricamento dei controller ecc
include_once CONTROL_DIR . "ArgomentoController.php";
include_once CONTROL_DIR . "DomandaController.php";
include_once CONTROL_DIR . "AlternativaController.php";

$controller = new ArgomentoController();
$controllerDomande = new DomandaController();
$controllerRisposte = new AlternativaController();
$corso = $controller->readCorso(21); //qui dentro andrà $_URL[1];
$argomento = $controller->readArgomento(10,21); //qui dentro andrà $_URL[?];

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
        <?php include VIEW_DIR . "header.php"; ?>
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
                        Modifica argomento
                    </h3>
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <a href="index.html">Home</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <a href="#"><?php echo $corso->getNome(); ?></a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <a href="#">Modifica Argomento</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                        </ul>
                    </div>
                    <!-- END PAGE HEADER-->
                    <!-- BEGIN PAGE CONTENT-->
                    <div class="portlet box grey-cascade">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-globe"></i>Modifica Argomento
                            </div>
                            <div class="tools">
                                <a href="javascript:;" class="collapse" data-original-title="" title="">
                                </a>
                                <a href="#portlet-config" data-toggle="modal" class="config" data-original-title="" title="">
                                </a>
                                <a href="javascript:;" class="reload" data-original-title="" title="">
                                </a>
                                <a href="javascript:;" class="remove" data-original-title="" title="">
                                </a>
                            </div>
                        </div>
                        <div class="portlet-body form">
                            <!-- BEGIN FORM-->
                            <form action="<?php echo $_SERVER['PHP_SELF']?>" class="form-horizontal form-bordered">
                                <div class="form-body">
                                    <div class="form-group form-md-line-input has-success" style="height: 100px">
                                        <label class="control-label col-md-3">Inserisci Titolo</label>
                                        <div class="col-md-6">
                                            <input type="text" name="nomeargomento" value="<?php echo $argomento->getNome(); ?>" class="form-control">
                                            <span class="help-block">
                                                Inserisci il titolo del nuovo argomento </span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <input type="submit" href="javascript:;" class="btn sm green-jungle"><span class="md-click-circle md-click-animate" style="height: 94px; width: 94px; top: -23px; left: 2px;"></span>
                                                    </input>
                                                    <a href="javascript:;" class="btn sm red-intense">
                                                        Annulla
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>

                            <?php
                            if(isset($_POST['nomeargomento'])){
                                $nome = $_POST['nomeargomento'];
                                $argomento->setNome($nome);
                                $controller->modificaArgomento($argomento->getId(),$argomento->getCorsoId(), $argomento);
                            }
                            ?>


                            <!-- END FORM-->
                        </div>
                    </div>

                    <div class="row">
                        <!--TOP menu -->
                        <div class="col-md-offset-3 col-md-3">
                            <a href="inseriscidomandaaperta" class="btn sm green-jungle">
                                <i class="fa fa-plus"></i> Nuova Domanda Aperta
                            </a>
                        </div>
                        <div class="col-md-3">
                            <a href="inseriscidomandamultipla" class="btn sm green-jungle">
                                <i class="fa fa-plus"></i> Nuova Domanda Multipla
                            </a>
                        </div>
                    </div>
                    <br>
                    <!--INIZIO TABELLA DOMANDA1-->

                    <?php
                    $domandeArgomento = $controllerDomande->getAllMultiple(10,21); //Questo dev'essere automatico

                    foreach($domandeArgomento as $d) {
                        $risposte = $controllerRisposte->getAllAlternativa($d->getId(), $d->getArgomentoId(),$d->getArgomentoCorsoId());

                        printf("<div class=\"portlet box blue-madison\">");
                        printf("<div class=\"portlet-title\">");
                        printf("<div class=\"caption\">");
                        printf("<i class=\"fa fa-book\"></i>%s", $d->getTesto());
                        printf("</div>");
                        printf("<div class=\"tools\">");
                        printf("<a href=\"javascript:;\" class=\"collapse\" data-original-title=\"\" title=\"\"></a>");
                        printf("</div>");
                        printf("<div class=\"actions\">");
                        printf("<a href=\"javascript:;\" class=\"btn btn-default btn-sm\"><i class=\"fa fa-edit\"></i> Modifica </a>");
                        printf("<a href=\"javascript:;\" class=\"btn btn-default btn-sm\"><i class=\"fa fa-remove\"></i> Rimuovi </a>");
                        printf("</div>");
                        printf("</div>");
                        printf("<div class=\"portlet-body\">");
                        printf("<div id=\"tabella_domanda1_wrapper\" class=\"dataTables_wrapper no-footer\">");
                        printf("<table class=\"table table-striped table-bordered table-hover dataTable no-footer\"id=\"tabella_domanda1\" role=\"grid\" aria-describedby=\"tabella_domanda1_info\">");
                        printf("<tbody>");
                        foreach($risposte as $r) {
                            printf("<tr class=\"gradeX odd\" role=\"row\">");
                            printf("<td width='30'>");
                            printf("<input type=\"checkbox\" disabled=\"\" checked=\"\">");
                            printf("</td>");
                            printf("<td>%s</td>", $r->getTesto());
                            printf("</tr>");
                        }
                        printf("</tbody>");
                        printf("</table>");
                        printf("</div>");
                        printf("</div>");
                        printf("</div>");
                    }

                    ?>

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
        <script>
            jQuery(document).ready(function () {
                Metronic.init(); // init metronic core components
                Layout.init(); // init current layout
                //QuickSidebar.init(); // init quick sidebar
                //Demo.init(); // init demo features
            });
        </script>
        <!-- END JAVASCRIPTS -->
    </body>
    <!-- END BODY -->
</html>
