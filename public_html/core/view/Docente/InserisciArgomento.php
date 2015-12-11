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
$controller = new ArgomentoController();
$controllerCorso = new CdlController();
$corsoid = $_URL[3];

try{
    $corso = $controllerCorso->readCorso($corsoid);
}catch(ApplicationException $exception){
    echo "ERRORE IN READ CORSO" . $exception;
}

if(isset($_POST['nome'])){
    $nome = $_POST['nome'];

        $argomento = new Argomento($corsoid, $nome);
        $controller->creaArgomento($argomento);
        header('location:../../' . $corsoid);

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
        <title>Metronic | Page Layouts - Blank Page</title>
        <?php include VIEW_DIR . "design/header.php"; ?>
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
                    <h3 class="page-title">
                        Inserisci un nuovo argomento
                    </h3>
                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <a href="../../../">Home</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <a href="../../../cdl/<?php echo $corso->getCdlMatricola(); ?>"> <?php echo $controllerCorso->readCdl($corso->getCdlMatricola())->getNome(); ?> </a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <a href="../../<?php echo $corso->getId(); ?>"><?php echo $corso->getNome(); ?></a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                Nuovo Argomento
                            </li>
                        </ul>
                    </div>
                    <!-- END PAGE HEADER-->
                    <!-- BEGIN PAGE CONTENT-->
                    <div class="portlet box blue-madison">
                        <div class="portlet-title">
                            <div class="caption">
                                <i class="fa fa-globe"></i>Inserisci Argomento
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
                            <form id="form_sample_1" action="" onsubmit="impostaNotifica()" method="POST" class="form-horizontal form-bordered">
                                <div class="form-body">
                                    <div class="form-group form-md-line-input has-success" style="height: 90px">
                                        <label class="control-label col-md-3">Inserisci Titolo</label>
                                        <div class="col-md-6">
                                            <input type="text" placeholder="" class="form-control" name="nome">
                                            <span class="help-block"></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-actions">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-9">
                                                    <input type="submit" class="btn sm green-jungle"><span class="md-click-circle md-click-animate" style="height: 94px; width: 94px; top: -23px; left: 2px;"></span>
                                                    </input>
                                                    <a href="../../<?php echo $corsoid ?>" class="btn sm red-intense">
                                                        Annulla
                                                    </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>


                            <!-- END FORM-->
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
        <script src="/assets/admin/pages/scripts/form-validation.js"></script>
        <script type="text/javascript" src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js"></script>
        <script type="text/javascript" src="/assets/global/plugins/jquery-validation/js/additional-methods.min.js"></script>

        <script src="/assets/admin/pages/scripts/ui-confirmations.js"></script>

        <script src="/assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>
        <script src="/assets/admin/pages/scripts/ui-toastr.js"></script>


        <script>
            jQuery(document).ready(function () {
                Metronic.init(); // init metronic core components
                Layout.init(); // init current layout
                //QuickSidebar.init(); // init quick sidebar
                //Demo.init(); // init demo features
                FormValidation.init();
                UIConfirmations.init();
                UIToastr.init();

            });
        </script>

        <script>
            function impostaNotifica(){
                sessionStorage.setItem('notInsArgomento', 'si');
            }
        </script>
        <!-- END JAVASCRIPTS -->
    </body>
    <!-- END BODY -->
</html>
