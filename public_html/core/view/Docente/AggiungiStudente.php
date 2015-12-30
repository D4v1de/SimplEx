<?php

/**
 * La view consente al docente di abilitare nuovi studenti mentre
 * la sessione è in corso.
 *
 * @author Antonio Luca D'Avanzo
 * @version 1
 * @since 18/11/15 09:58
 */

include_once MODEL_DIR . "ElaboratoModel.php";
include_once MODEL_DIR . "SessioneModel.php";
include_once MODEL_DIR . "UtenteModel.php";
include_once MODEL_DIR . "CdlModel.php";
include_once MODEL_DIR . "CorsoModel.php";
include_once MODEL_DIR . "TestModel.php";
include_once BEAN_DIR . "Sessione.php";

$sessioneModel = new SessioneModel();
$utenteModel = new UtenteModel();
$testModel = new TestModel();
$corsoModel = new CorsoModel();
$cdlModel = new CdlModel();
$elaboratoModel= new ElaboratoModel();

$idSessione=$_URL[4];
$idCorso = $_URL[2];


$corso = $corsoModel->readCorso($idCorso);
$nomecorso= $corso->getNome();

$docenteassociato = Array();
$checkbox = Array();
$corso = null;
$docenti = null;
$docente = null;
$url = null;

$url = $_URL[2];
if(!is_numeric($url)) {
    echo "<script type='text/javascript'>alert('errore nella url!!!');</script>";
}

try {
    $corso = $corsoModel->readCorso($url);
}
catch (ApplicationException $ex) {
    echo "<h1>INSERIRE ID CORSO NEL PATH!</h1>".$ex;
}
$numProfs=0;
$doc = $_SESSION['user'];
$docentiOe= $utenteModel->getAllDocentiByCorso($corso->getId());
foreach($docentiOe as $d) {
    if($doc==$d){
        $numProfs++;
    }
}
if($numProfs==0){
    header("Location: "."/docente/corso/".$corso->getId());
}

if($someStudentsChange=isset($_POST['abilita'])) {
    if($someStudentsChange){
        $cbStudents= Array();
        $cbStudents = $_POST['students'];
        $allStuAbi= $utenteModel->getAllStudentiSessione($idSessione);
        foreach($allStuAbi as $s) {
            $utenteModel->disabilitaStudenteSessione($idSessione, $s->getMatricola());
        }
        foreach($cbStudents as $s) {
            $utenteModel->abilitaStudenteSessione($idSessione, $s);
        }
    }
    header("Location: "."/docente/corso/".$idCorso."/"."sessione"."/".$idSessione."/"."sessioneincorso/show");

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
    <?php include VIEW_DIR . "design/"."header.php"; ?>
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/select2/select2.css">
    <link rel="stylesheet" type="text/css" href="/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css">
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-md page-header-fixed page-quick-sidebar-over-content">
<?php include VIEW_DIR . "design/"."headMenu.php"; ?>
<div class="clearfix">
</div>
<!-- BEGIN CONTAINER -->
<div class="page-container">
    <?php include VIEW_DIR ."design/". "sideBar.php"; ?>
    <!-- BEGIN CONTENT -->
    <div class="page-content-wrapper">
        <div class="page-content">
            <!-- BEGIN PAGE HEADER-->
            <h3 class="page-title">
                Aggiungi Studenti
            </h3>

            <div class="page-bar">
                <ul class="page-breadcrumb">
                    <li>
                        <i class="fa fa-home"></i>
                        <a href="/docente">Home</a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <a href="<?php echo "/docente/cdl/".$corso->getCdlMatricola(); ?>"> <?php echo $cdlModel->readCdl($corso->getCdlMatricola())->getNome(); ?> </a>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        <?php
                        $vaiANomeCorso="/docente/corso/".$idCorso;
                        printf("<a href=\"%s\">%s</a><i class=\"fa fa-angle-right\"></i>", $vaiANomeCorso ,$nomecorso);
                        ?>
                    </li>
                    <li>
                        <?php
                            $sex = "Sessione ".$idSessione;
                            $vaiASex= "/docente/corso/".$idCorso."/"."sessione"."/".$idSessione."/"."sessioneincorso/show";
                            printf("<a href=\"%s\">%s</a>", $vaiASex, $sex);
                        ?>
                        <i class="fa fa-angle-right"></i>
                    </li>
                    <li>
                        Aggiungi Studenti
                    </li>
                </ul>
            </div>
            <!-- END PAGE HEADER-->
            <!-- BEGIN PAGE CONTENT-->

            <div class="row">
                <h3></h3>
            </div>

            <form method="post" action="">

                <div class="portlet box blue-madison">
                    <div class="portlet-title">
                        <div class="caption">
                            <i class="fa fa-university"></i>Scegli uno Studente
                        </div>
                        <div class="tools">
                            <a href="javascript:;" class="collapse" data-original-title="" title="">
                            </a>
                        </div>
                        <div class="actions">
                            <button type="submit" name="abilita" class="btn btn-default btn-sm">
                                <i class="fa fa-plus"></i> Abilita
                            </button>
                            <input type="hidden" id="elimina" name="elimina" value="elimina">
                        </div>
                    </div>
                    <div class="portlet-body">
                        <div id="tabella_4_wrapper" class="dataTables_wrapper no-footer">
                            <table class="table table-striped table-bordered table-hover dataTable no-footer"
                                   id="tabella_4" role="grid" aria-describedby="tabella_4_info">
                                <thead>
                                <tr role="row">
                                    <th class="table-checkbox sorting_disabled" rowspan="1" colspan="1"
                                        aria-label=""
                                        style="width: 24px;">
                                        <input type="checkbox" class="group-checkable"
                                               data-set="#tabella_4 .checkboxes">
                                    </th>
                                    <th class="sorting_asc" tabindex="0" aria-controls="sample_2" rowspan="1"
                                        colspan="1" aria-label="Username: activate to sort column ascending"
                                        aria-sort="ascending" style="width: 78px;">
                                        Nome
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="sample_2" rowspan="1"
                                        colspan="1"
                                        aria-label="Email: activate to sort column ascending" style="width: 137px;">
                                        Cognome
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="sample_2" rowspan="1"
                                        colspan="1"
                                        aria-label="Status: activate to sort column ascending" style="width: 36px;">
                                        Matricola
                                    </th>
                                    <th class="sorting" tabindex="0" aria-controls="sample_2" rowspan="1"
                                        colspan="1"
                                        aria-label="Status: activate to sort column ascending" style="width: 36px;">
                                        Stato
                                    </th>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $array = Array();
                                $toCheckS="";
                                $disabilita="";
                                $stato="";
                                $bgr="";
                                $array = $utenteModel->getAllStudentiByCorso($idCorso);
                                $studentsOfSessione= $utenteModel->getAllStudentiSessione($idSessione);
                                $esaminandiSessione= $utenteModel->getEsaminandiSessione($idSessione);
                                if ($array == null) {
                                    echo "l'array è null";
                                }
                                else {
                                    foreach ($array as $c) {
                                        printf("<tr class=\"gradeX odd\" role=\"row\">");
                                        foreach($studentsOfSessione as $t){
                                            if($c->getMatricola()==$t->getMatricola()) {
                                                $toCheckS = "Checked";
                                                $stato="In attesa";
                                            }
                                        }
                                        foreach($esaminandiSessione as $e){
                                            if($e->getMatricola()==$c->getMatricola()) {
                                                $disabilita = "disabled";
                                                $toCheckS = "Checked";
                                                $stato="Esame in corso";
                                            }
                                        }
                                        printf("<td><input name=\"students[]\" type=\"checkbox\" %s %s class=\"checkboxes\" value='%s'></td>",$disabilita,$toCheckS, $c->getMatricola());
                                        $toCheckS="";
                                        $disabilita="";
                                        printf("<td class=\"sorting_1\">%s</td>", $c->getNome());
                                        printf("<td>%s</td>", $c->getCognome());
                                        printf("<td>%s</td>", $c->getMatricola());
                                        if($stato=="In attesa"){
                                            $bgr="bg-red";
                                        }
                                        printf("<td><span class=\"label label-sm label-success %s\">%s</span> </td>", $bgr,$stato);
                                        $bgr="";
                                        $stato="";
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
<!-- END aggiunta da me -->
<script>
    jQuery(document).ready(function () {
        Metronic.init();
        Layout.init();
        TableManaged.init("tabella_4", "tabella_4_wrapper");
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
