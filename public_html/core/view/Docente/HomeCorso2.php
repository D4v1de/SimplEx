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
include_once MODEL_DIR . "SessioneModel.php";
include_once MODEL_DIR . "TestModel.php";
include_once MODEL_DIR . "ElaboratoModel.php";
include_once MODEL_DIR . "CdLModel.php";
include_once MODEL_DIR . "ArgomentoModel.php";
include_once MODEL_DIR . "CorsoModel.php";
include_once MODEL_DIR . "UtenteModel.php";
include_once UTILS_DIR . "controlloLogin.php";


$utenteLoggato = $_SESSION['user'];

$modelSessione = new SessioneModel();
$modelTest = new TestModel();
$modelElaborato = new ElaboratoModel();
$modelArgomento = new ArgomentoModel();
$modelCorso = new CorsoModel();
$modelAccount = new UtenteModel();
$modelCdl = new CdLModel();

$corso = null;
$identificativoCorso ="";
$identificativoCorso = $_URL[2];
if (!is_numeric($identificativoCorso)) {
    echo "<script type='text/javascript'>alert('errore nella url!!!');</script>";
}
$cond = null;

if (isset($_SESSION['idcorso'])) {
    unset($_SESSION['idcorso']);
    $_SESSION['idcorso'] = $_URL[2];
} else {
    $_SESSION['idcorso'] = $_URL[2];
}

controllo();

if (isset($_URL[3]))
    $cond = $_URL[3];
else
    $cond = "vuoto";

$id = null;
$idcorso = null;
$argomenti = Array();
$correttezzaLogin = false;

try {
    $idsSessione = $modelSessione->getAllSessioniByCorso($identificativoCorso);
} catch (ApplicationException $ex) {
    echo "<h1>GETALLSESSIONIBYCORSO FALLITO!</h1>" . $ex;
}

/**
 * LEGGE IL CORSO NEL QUALE CI SI TROVA
 */
try {
    $corso = $modelCorso->readCorso($_URL[2]);
} catch (ApplicationException $exception) {
    echo "ERRORE IN READ CORSO " . $exception;
}

/**
 * RICEVE LA MATRICOLA DEL DOCENTE LOGGATO
 */
try {
    $docenteassociato = $modelAccount->getAllDocentiByCorso($corso->getId());
} catch (ApplicationException $exception) {
    echo "ERRORE IN GETDOCENTEASSOCIATO" . $exception;
}

/**
 * RICEVE I DOCENTE ASSOCIATI AL CORSO NEL QUALE CI SI TROVA
 */
try {
    $matricolaLoggato = $utenteLoggato->getMatricola();
} catch (ApplicationException $exception) {
    echo "ERRORE IN GET MATRICOLA" . $exception;
}

/**
 * CONTROLLA SE NEI DOCENTI ASSOCIATI E' PRESENTE IL DOCENTE LOGGATO
 */
foreach ($docenteassociato as $docente) {
    if ($docente->getMatricola() == $matricolaLoggato) {
        $correttezzaLogin = true;
    }
}

/**
 * CONTROLLA IL CORRETTO LOGIN DEL DOCENTE AL CORSO DA LUI INSEGNATO
 */
if ($correttezzaLogin == false) {
    header('Location: /docente');
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
        <?php include VIEW_DIR . "design/header.php"; ?>
        <link rel="stylesheet" type="text/css" href="/assets/global/plugins/select2/select2.css">
        <link rel="stylesheet" type="text/css" href="/assets/global/plugins/datatables/plugins/bootstrap/dataTables.bootstrap.css">
        <link rel="stylesheet" type="text/css" href="/assets/global/plugins/bootstrap-toastr/toastr.min.css">
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

                    <div class="page-bar">
                        <ul class="page-breadcrumb">
                            <li>
                                <i class="fa fa-home"></i>
                                <a href="/docente">Home</a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <a href="/docente/cdl/<?php echo $corso->getCdlMatricola(); ?>"> <?php echo $modelCdl->readCdl($corso->getCdlMatricola())->getNome(); ?> </a>
                                <i class="fa fa-angle-right"></i>
                            </li>
                            <li>
                                <?php echo $corso->getNome(); ?>
                            </li>
                        </ul>
                    </div>

                    <!-- END PAGE HEADER-->
                    <!-- BEGIN PAGE CONTENT-->
                    <?php
                    if(isset($_SESSION["Intruso"]) && $_SESSION["Intruso"]==1) {
                        echo "<div class=\"alert alert-danger\">
                        <button class=\"close\" data-close=\"alert\"></button>
                        Attenzione! Non ti è permesso effettuare questa operazione.                        </div>";
                        //echo "<script type='text/javascript'>checkIt();</script>";
                        unset($_SESSION['Intruso']);
                    }
                ?>


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


                    <form action="/docente/corso/<?php echo $identificativoCorso; ?>/rimuovisessione" method="post">
                        <div <?php if ($cond != "success" && $cond != "errore" && $cond != "successelimina") echo "hidden"; ?> class="portlet box blue-madison">
                            <div class="portlet-title">
                                <div class="caption">
                                    <i class="fa fa-files-o"></i>Sessioni
                                </div>
                                <div class="tools">
                                    <a href="javascript:;" class="collapse" data-original-title="" title="">
                                    </a>
                                </div>
                                <div class="actions">
                                    <a href="<?php printf("%s", "/docente/corso/" . $identificativoCorso . "/sessione" . "/" . "0" . "/" . "creamodificasessione") ?>" class="btn btn-default btn-sm">
                                        <i class="fa fa-plus"></i> Crea Sessione </a>
                                </div>
                            </div>
                            <div class="portlet-body">
                                <div class="table-responsive">
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
                                                         " style="width: 20%;">
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
                                                         " style="width: 14%;">
                                                    Azioni
                                                </th></tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if ($cond == "success" || $cond == "errore" || $cond == "successelimina") {

                                                $array = Array();
                                                $array = $idsSessione;
                                                $now = date("Y-m-d H:i:s");
                                                if ($array == null) {
                                                    
                                                } else {

                                                    foreach ($array as $c) {
                                                        $end = $c->getDataFine();
                                                        $start = $c->getDataInizio();
                                                        $vaiAModifica = "/docente/corso/" . $identificativoCorso . "/sessione" . "/" . $c->getId() . "/" . "creamodificasessione";
                                                        $vaiAVisu = "/docente/corso/" . $identificativoCorso . "/sessione" . "/" . $c->getId();
                                                        $vaiASesInCorso = "/docente/corso/" . $identificativoCorso . "/sessione" . "/" . $c->getId() . "/" . "sessioneincorso/show";
                                                        $vaiVisuEsiti = "/docente/corso/" . $identificativoCorso . "/sessione" . "/" . $c->getId() . "/" . "esiti/show";

                                                        printf("<tr class=\"gradeX odd\" role=\"row\">");
                                                        if ($c->getStato() != "In esecuzione")
                                                            printf("<td class=\"sorting_1\"><a class=\"btn default btn-xs green-stripe\" href=\"%s\">%s</a></td>", $vaiAVisu, "Sessione " . $c->getId());
                                                        else
                                                            printf("<td class=\"sorting_1\"><a class=\"btn default btn-xs green-stripe\" href=\"%s\">%s</a></td>", $vaiASesInCorso, "Sessione " . $c->getId());
                                                        printf("<td><b>Inizio:</b>%s<b>  Fine:</b> %s</td>", $c->getDataInizio(), $c->getDataFine());
                                                        printf("<td>%s</td>", $c->getTipologia());
                                                        printf("<td>%s</td>", $c->getStato());
                                                        printf("<td>%s</td>", $modelSessione->readMostraEsitoSessione($c->getId()));
                                                        printf("<td>%s</td>", $modelSessione->readMostraRisposteCorretteSessione($c->getId()));
                                                        if ($c->getStato() == "Eseguita") {
                                                            printf("<td class=\"center\"><a href=\"%s\" class=\"btn btn-icon-only default\">Esiti</a>
                                           <a title=\"Modifica\" href=\"%s\" class=\"btn btn-icon-only blue\"><i class=\"fa fa-edit\"></i></a>
                                                                 <button title=\"Elimina\" type='submit' name='IdSes' value='%d' disabled='' class=\"btn btn-icon-only red-intense\"  data-toggle=\"confirmation\"
                                        data-singleton=\"true\" data-popout=\"true\" title=\"Sicuro?\"><i class=\"fa fa-trash-o\"></i></button>
                                           </td>", $vaiVisuEsiti, $vaiAModifica, $c->getId());
                                                        } else if ($c->getStato() == "In esecuzione") {
                                                            printf("<td class=\"center\"><a href=\"%s\"  disabled='' class=\"btn btn-icon-only default\">Esiti</a>
                                           <a href=\"%s\" title=\"Modifica\" class=\"btn btn-icon-only blue\"><i class=\"fa fa-edit\"></i></a>
                                                                 <button title=\"Elimina\" type='submit' disabled=''  name='IdSes' value='%d' class=\"btn btn-icon-only red-intense\" data-toggle=\"confirmation\"
                                        data-singleton=\"true\" data-popout=\"true\" title=\"Sicuro?\"><i class=\"fa fa-trash-o\"></i></button>
                                           </td>", $vaiVisuEsiti, $vaiAModifica, $c->getId());
                                                        } else {
                                                            printf("<td class=\"center\"><a href=\"%s\"  disabled='' class=\"btn btn-icon-only default\">Esiti</a>
                                           <a href=\"%s\" title=\"Modifica\" class=\"btn btn-icon-only blue\"><i class=\"fa fa-edit\"></i></a>
                                                                 <button type='submit' title=\"Elimina\" name='IdSes' value='%d' class=\"btn btn-icon-only red-intense\"  data-toggle=\"confirmation\"
                                        data-singleton=\"true\" data-popout=\"true\" title=\"Sicuro?\"><i class=\"fa fa-trash-o\"></i></button>
                                           </td>", $vaiVisuEsiti, $vaiAModifica, $c->getId());
                                                        }
                                                        printf("</tr>");
                                                    }
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                                </div>
                            </div>
                        </div>
                    </form>

                    <form action="/docente/Elimina_Test?idcorso=<?= $identificativoCorso ?>" method="post">
                        <div <?php if ($cond != "success" && $cond != "errore" && $cond != "successelimina") echo "hidden"; ?> class="portlet box blue-madison">
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
                                <div class="table-responsive">
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
                                                printf("<th class=\"sorting_disabled\" rowspan=\"1\" colspan=\"1\" aria-label=\"Status\" style=\"width: 9%%;\">");
                                                printf("Azioni");
                                                printf("</th>");
                                                ?>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            if ($cond == "success" || $cond == "errore" || $cond == "successelimina") {

                                                $array = Array();
                                                $array = $modelTest->getAllTestByCorso($identificativoCorso);
                                                if ($array == null) {
                                                    
                                                } else {
                                                    foreach ($array as $c) {
                                                        $testId = $c->getId();
                                                        if ($idsSessione != null) {
                                                            $scelti = $c->getPercentualeSceltoVal() + $c->getPercentualeSceltoEse();
                                                            $percSce = round(($scelti / count($idsSessione) * 100), 2);
                                                        } else
                                                            $percSce = 0;
                                                        $succ = $c->getPercentualeSuccessoEse() + $c->getPercentualeSuccessoVal();
                                                        $n = $c->getNumeroSceltaValutativa() + $c->getNumeroSceltaEsercitativa();
                                                        if ($n > 0)
                                                            $percSuc = round(($succ / $n * 100), 2);
                                                        else
                                                            $percSuc = 0;

                                                        $vaiATest = "/docente/corso/" . $identificativoCorso . "/test" . "/" . $c->getId() . "/" . "visualizzatest";
                                                        printf("<tr class=\"gradeX odd\" role=\"row\">");
                                                        printf("<td class=\"sorting_1\"><a class=\"btn default btn-xs green-stripe\" href=\"%s\">Test %s</a></td>", $vaiATest, $c->getId());
                                                        printf("<td>%s</td>", $c->getDescrizione());
                                                        printf("<td>%s</td>", $c->getNumeroMultiple());
                                                        printf("<td>%s</td>", $c->getNumeroAperte());
                                                        printf("<td>%s</td>", $c->getPunteggioMax());
                                                        printf("<td>%d%%</td>", $percSce);
                                                        printf("<td>%d%%</td>", $percSuc);
                                                        $questoTest = $c->getId();
                                                        $alModificaTest = "/docente/corso/" . $identificativoCorso . "/test/modifica/" . $questoTest;
                                                        printf("<td><a href=\"%s\"  class=\"btn btn-icon-only blue\"><i class=\"fa fa-edit\"></i></i></a>", $alModificaTest);
                                                        printf("<button  class=\"btn btn-icon-only red-intense\" type=\"submit\" name=\"idtestHome\" title=\"\" id=\"%d\" value=\"%d\" data-popout=\"true\" data-toggle=\"confirmation\" data-singleton=\"true\" data-original-title=\"Sei sicuro?\"><i class=\"fa fa-trash-o\"></i></button>", $c->getId(), $c->getId());
                                                        printf("</td>");
                                                        printf("</tr>");
                                                    }
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>

                        </div>
                    </form>

                    <form action="/docente/rimuoviargomento" method="post">
                        <div <?php if ($cond != "success" && $cond != "errore" && $cond != "successelimina") echo "hidden"; ?> class="portlet box blue-madison">
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
                                printf("<a href=\"/docente/corso/%s/argomento/inserisci\" class=\"btn btn-default btn-sm\">", $corso->getId());
                                printf("<i class=\"fa fa-plus\"></i> Aggiungi Argomento </a>");
                                printf("</div>");
                                ?>
                            </div>
                            <div class="portlet-body">
                                <div class="table-responsive">
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
                                                printf("<th class=\"sorting_disabled\" rowspan=\"1\" colspan=\"1\" aria-label=\"Email\" style=\"width: 11%%;\">Azioni</th>");
                                                ?>
                                            </tr>

                                        </thead>
                                        <tbody>


                                            <?php
                                            if ($cond == "success" || $cond == "errore" || $cond == "successelimina") {

                                                $argomenti = $modelArgomento->getAllArgomentoCorso($identificativoCorso);

                                                foreach ($argomenti as $a) {
                                                    printf("<tr class=\"gradeX odd\" role=\"row\">");
                                                    printf("<td><a class=\"btn default btn-xs green-stripe\" href=\"/docente/corso/%d/argomento/domande/%d \">%s</a></td>", $a->getCorsoId(), $a->getId(), $a->getNome());
                                                    printf("<td>");
                                                    printf("<a href=\"/docente/corso/%d/argomento/modifica/%d \"  class=\"btn btn-icon-only blue\">", $a->getCorsoId(), $a->getId());
                                                    printf("<i class=\"fa fa-edit\"></i>");
                                                    printf("</a>");
                                                    printf("<button  class=\"btn btn-icon-only red-intense\"type=\"submit\" name=\"id\" title='Sei sicuro?' value=\"%d\" data-popout=\"true\" data-toggle=\"confirmation\" data-singleton=\"true\"><i class=\"fa fa-trash-o\"></i></button>", $a->getId());
                                                    printf("<input type='hidden' name='idcorso' value='%s'>", $identificativoCorso);
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
        <script src="/assets/global/plugins/datatables/extensions/TableTools/js/dataTables.tableTools.min.js"></script>
<script src="/assets/global/plugins/bootstrap-toastr/toastr.min.js"></script>
<script src="/assets/admin/pages/scripts/ui-toastr.js"></script>

<!-- END aggiunta da me -->
<?php
if ($cond == "vuoto" || $cond == "successmodifica" || $cond == "successinserimento") {
    echo "<script>
    function testSp()
    {
        look();
     }
    window.onload=testSp;
    </script>";
} else if ($cond == "success" || $cond == "errore" || $cond == "successelimina") {
    echo " <script> jQuery(document) . ready(function () {
        Metronic . init();
        Layout . init();
        TableManaged2 . init(\"tabella_sessioni\", \"tabella_sessioni_wrapper\");
        TableManaged2 . init(\"tabella_test\", \"tabella_test_wrapper\");
        TableManaged2 . init(\"tabella_argomenti\", \"tabella_argomenti_wrapper\");
        UIConfirmations . init();
        UIToastr . init();
        checkNotifiche();

        var table = $(\"#tabella_sessioni\").dataTable();
        var tableTools = new $.fn.dataTable.TableTools(table, {
            //\"sSwfPath\": \"//cdn.datatables.net/tabletools/2.2.4/swf/copy_csv_xls_pdf.swf\",
            \"sSwfPath\": \"/assets/global/plugins/datatables/extensions/TableTools/swf/copy_csv_xls_pdf.swf\",
            \"aButtons\": [
                {
                    \"sExtends\": \"xls\",
                    \"sButtonText\": \"<i class='fa fa-file-excel-o'></i> Excel\"
                },
                {
                    \"sExtends\": \"pdf\",
                    \"sButtonText\": \"<i class='fa fa-file-pdf-o'></i> PDF\"
                }
            ]
        });
        $(tableTools.fnContainer()).insertBefore(\"#tabella_sessioni_wrapper\");
    });

    </script>";
}
?>


<script>
    //controlla se c'è qualche notifica da mostrare
    function checkNotifiche() {
        var href = window.location.href;
        var last = href.substr(href.lastIndexOf('/') + 1);
        if (last == 'successinserimento') {
            toastr.success('Inserimento avvenuto correttamente!', 'Inserimento');
        } else if (last == 'successmodifica') {
            toastr.success('Modifica avvenuta correttamente!', 'Modifica');
        } else if (last == 'successelimina') {
            toastr.success('Eliminazione avvenuta correttamente!', 'Eliminazione');
        }
        else if (last == 'error') {
            toastr.success('Problema nella creazione.', 'Eliminazione');
        }
        else if (last == 'accessdenied') {
            toastr.error('Impossibile accedere.', 'Violazione');
        }
    }
</script>

<script>
    function look() {
        window.location.replace("/docente/corso/<?php echo $identificativoCorso ?>/checkdatasessione/<?php echo $cond ?>");
    }

</script>



<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
