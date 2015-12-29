<?php
/**
 * La view consente ad uno Studente di visualizzare tutti i corsi relativi ad un CdL
 * @author Federico De Rosa
 * @version 1
 * @since 23/11/15 22:58
 */

include_once MODEL_DIR . "CorsoModel.php";
$modelcorso = new CorsoModel();
include_once MODEL_DIR . "CdlModel.php";
$modelcdl = new CdLModel();

$cdl = null;
$corsi = Array();
$studente = null;
$corsistudente = Array();
$url = null;

$url = $_URL[2];
$_SESSION['idcdl'] = $url;
if (!is_numeric($url)) {
    echo "<script type='text/javascript'>alert('errore nella url!!(idcdl)');</script>";
}

$studente = $_SESSION['user'];
$_SESSION['matstudente'] = $studente->getMatricola();

try {
    $cdl = $modelcdl->readCdl($url);
} catch (ApplicationException $ex) {
    echo "<h1>INSERIRE MATRICOLA CDL NEL PATH!</h1>" . $ex;
}
try {
    $corsi = $modelcorso->getAllCorsiByCdl($cdl->getMatricola());
} catch (ApplicationException $ex) {
    echo "GETCORSICDL FALLITO!</h1>" . $ex;
}
try {
    $corsistudente = $modelcorso->getAllCorsiByStudente($studente->getMatricola());
} catch (ApplicationException $ex) {
    echo "<h1>GETCORSISTUDENTE FALLITO!</h1>" . $ex;
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
    <title>CdL <?php echo $cdl->getNome(); ?></title>
    <?php include VIEW_DIR . "design/header.php"; ?>
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/select2/select2.css">
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css">
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/datatables/extensions/TableTools/css/dataTables.tableTools.css">
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
                CdL in <?php echo $cdl->getNome(); ?>
            </h3>

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="/studente">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="/studente/cdls">CdL</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <?php echo $cdl->getNome(); ?>
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->

            <form method="post" action="/studente/iscrivi">

                <div class="portlet box blue-madison">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-university"></i>Corsi CdL <?php echo $cdl->getNome(); ?>
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse" data-original-title="" title="">
                            </a>
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="tabella_2_wrapper" class="dataTables_wrapper no-footer">
                            <table class="table table-striped table-bordered table-hover dataTable no-footer"
                                   id="tabella_2" role="grid" aria-describedby="tabella_2_info">
                                <thead>
                                <tr role="row">
                                    <th class="sorting" tabindex="0" aria-controls="sample_2" rowspan="1"
                                        colspan="1"
                                        aria-label="Status: activate to sort column ascending">
                                        Nome
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="sample_2" rowspan="1"
                                        colspan="1"
                                        aria-label="Email: activate to sort column ascending">
                                        Matricola
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="sample_2" rowspan="1"
                                        colspan="1"
                                        aria-label="Status: activate to sort column ascending">
                                        Tipologia
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="sample_2" rowspan="1"
                                        colspan="1"
                                        aria-label="Status: activate to sort column ascending">
                                        Iscrizione
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                foreach ($corsi as $c) {
                                    printf("<tr class=\"gradeX odd\" role=\"row\">");
                                    printf("<td class=\"sorting_1\"><a class=\"btn default btn-xs green-stripe\" href=\"/studente/corso/%s\">%s</a></td>", $c->getId(), $c->getNome());
                                    printf("<td class=\"sorting_1\">%s</td>", $c->getMatricola());
                                    printf("<td class=\"sorting_1\"><span class=\"label label-sm label-success\">%s</span></td>", $c->getTipologia());
                                    if (in_array($c, $corsistudente)) {
                                        printf("<td class=\"sorting_1\"><button type=\"submit\" name=\"disiscrivi\" value=\"%d\" class=\"btn red-intense\"><span class=\"md-click-circle md-click-animate\"></span>Disiscriviti</button></td>", $c->getId());
                                    } else {
                                        printf("<td class=\"sorting_1\"><button type=\"submit\" name=\"iscrivi\" value=\"%d\" class=\"btn green-jungle\"><span class=\"md-click-circle md-click-animate\"></span>Iscriviti</button></td>", $c->getId());
                                    }
                                    printf("</tr>");
                                }
                                ?>
                                </tbody>
                            </table>

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
<script src="/assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<!-- END aggiunta da me -->
<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        //QuickSidebar.init(); // init quick sidebar
        //Demo.init(); // init demo features
        TableManaged2.init("tabella_2", "tabella_2_wrapper");

        var table = $("#tabella_2").dataTable();
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
        $(tableTools.fnContainer()).insertBefore("#tabella_2_wrapper");
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
