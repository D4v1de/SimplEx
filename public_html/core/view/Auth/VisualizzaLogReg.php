<?php
/**
 * Registrazione ed autenticazione
 *
 * @author Sergio Shevchenko
 * @version 1.1
 * @since 18/11/15
 */

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin']) {
    /** @var Utente $user */
    $user = $_SESSION['user'];
    switch (@$user->getTipologia()) {
        case 'Docente':
            $redirect = "/docente";
            break;
        case 'Studente':
            $redirect = "/studente";
            break;
        case 'Admin':
            $redirect = "/admin";
            break;
        default:
            $redirect = "/";
    }
    header("Location: " . $redirect);
}
include_once MODEL_DIR . "CdLModel.php";
$cdlModel = new CdLModel();
$corsi = $cdlModel->getAllCdL();
?>

<!DOCTYPE html>
<!--[if IE 8]>
<html lang="en" class="ie8 no-js"> <![endif]-->
<!--[if IE 9]>
<html lang="en" class="ie9 no-js"> <![endif]-->
<!--[if !IE]><!-->
<html lang="it">
<!--<![endif]-->
<!-- BEGIN HEAD -->
<head>
    <meta charset="utf-8"/>
    <title>Simplex | Login</title>
    <?php include VIEW_DIR . "design/header.php"; ?>

    <!-- BEGIN PAGE LEVEL STYLES -->
    <link href="/assets/global/plugins/select2/select2.css" rel="stylesheet" type="text/css"/>
    <link href="/assets/admin/pages/css/login-soft.css" rel="stylesheet" type="text/css"/>
    <!-- END PAGE LEVEL SCRIPTS -->
</head>
<!-- END HEAD -->
<!-- BEGIN BODY -->
<body class="page-md login">
<!-- BEGIN LOGO -->
<div class="logo">
    <a href="/">
        <img src="/assets/admin/layout/img/logoMedio.png" alt=""/>
    </a>
</div>
<!-- END LOGO -->
<!-- BEGIN SIDEBAR TOGGLER BUTTON -->
<div class="menu-toggler sidebar-toggler">
</div>
<!-- END SIDEBAR TOGGLER BUTTON -->
<!-- BEGIN LOGIN -->
<div class="content">
    <!-- BEGIN LOGIN FORM -->
    <div id="preloader" align="center" style="display: none">
        <img src="/assets/admin/pages/img/preloader.gif"/>
    </div>

    <form class="login-form" action="" method="post">
        <input type="hidden" name="action" value="login">

        <h3 class="form-title">Effettua il login</h3>

        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
			<span id="alert_message">
			Inserisci e-mail e password. </span>
        </div>

        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">E-mail</label>

            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="E-mail"
                       name="email"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>

            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" placeholder="Password"
                       name="password"/>
            </div>
        </div>
        <div class="form-actions">
            <label class="checkbox">
                <input type="checkbox" name="remember" value="1"/> Resta collegato </label>
            <button type="submit" class="btn blue pull-right">
                Login <i class="m-icon-swapright m-icon-white"></i>
            </button>
        </div>
        <!--        <div class="forget-password">-->
        <!--            <h4>Hai dimenticato la password?</h4>-->
        <!---->
        <!--            <p>-->
        <!--                nessun problema, clicca <a href="javascript:;" id="forget-password">-->
        <!--                    qui </a>-->
        <!--                per resettarla.-->
        <!--            </p>-->
        <!--        </div>-->
        <div class="create-account">
            <p>
                Non hai ancora l'account ?&nbsp; <a href="javascript:;" id="register-btn">
                    Registrati! </a>
            </p>
        </div>
    </form>
    <!-- END LOGIN FORM -->
    <!-- BEGIN FORGOT PASSWORD FORM -->
    <form class="forget-form" action="" method="post">
        <input type="hidden" name="action" value="reset">

        <h3>Hai dimenticato la password ?</h3>

        <p>
            Inserisci la tua email sotto per effettuare il reset.
        </p>

        <div class="form-group">
            <div class="input-icon">
                <i class="fa fa-envelope"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email"
                       name="email"/>
            </div>
        </div>
        <div class="form-actions">
            <button type="button" id="back-btn" class="btn">
                <i class="m-icon-swapleft"></i> Indietro
            </button>
            <button type="submit" class="btn blue pull-right">
                Resetta <i class="m-icon-swapright m-icon-white"></i>
            </button>
        </div>
    </form>
    <!-- END FORGOT PASSWORD FORM -->
    <!-- BEGIN REGISTRATION FORM -->
    <form class="register-form" action="" method="post">
        <input type="hidden" name="action" value="register">

        <h3>Registrazione</h3>

        <p>
            Inserisci i dati personali:
        </p>

        <div class="alert alert-danger display-hide">
            <button class="close" data-close="alert"></button>
			<span id="alert_message">
			Inserisci e-mail e password. </span>
        </div>

        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Nome</label>

            <div class="input-icon">
                <i class="fa fa-font"></i>
                <input class="form-control placeholder-no-fix" type="text" placeholder="Nome" name="name"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Cognome</label>

            <div class="input-icon">
                <i class="fa fa-header"></i>
                <input class="form-control placeholder-no-fix" type="text" placeholder="Cognome" name="surname"/>
            </div>
        </div>
        <div class="form-group">
            <!--ie8, ie9 does not support html5 placeholder, so we just show field title for that-->
            <label class="control-label visible-ie8 visible-ie9">Matricola</label>

            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix" type="text" placeholder="Matricola" name="matricola"/>
            </div>
        </div>

        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Corso di laurea</label>
            <select name="cdl_matricola" id="select2_sample4" class="select2 form-control">
                <option value=""></option>
                <?php
                /** @var CdL $corso */
                foreach ($corsi as $corso) {
                    printf("<option value='%s'>%s</option>", $corso->getMatricola(), $corso->getNome());
                }
                ?>
            </select>
        </div>
        <p>
            Dati relativi all'account:
        </p>

        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">E-mail</label>

            <div class="input-icon">
                <i class="fa fa-user"></i>
                <input class="form-control placeholder-no-fix" type="text" autocomplete="off" placeholder="Email"
                       name="email"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Password</label>

            <div class="input-icon">
                <i class="fa fa-lock"></i>
                <input class="form-control placeholder-no-fix" type="password" autocomplete="off" id="register_password"
                       placeholder="Password" name="password"/>
            </div>
        </div>
        <div class="form-group">
            <label class="control-label visible-ie8 visible-ie9">Inserisci la password di nuovo</label>

            <div class="controls">
                <div class="input-icon">
                    <i class="fa fa-check"></i>
                    <input class="form-control placeholder-no-fix" type="password" autocomplete="off"
                           placeholder="Inserisci la password di nuovo" name="rpassword"/>
                </div>
            </div>
        </div>
        <div class="form-group">
            <label>
                <input type="checkbox" name="tnc"/> Consento trattamento dei dati personali
            </label>

            <div id="register_tnc_error">
            </div>
        </div>
        <div class="form-actions">
            <button id="register-back-btn" type="button" class="btn">
                <i class="m-icon-swapleft"></i> Indietro
            </button>
            <button type="submit" id="register-submit-btn" class="btn blue pull-right">
                Conferma <i class="m-icon-swapright m-icon-white"></i>
            </button>
        </div>
    </form>
    <!-- END REGISTRATION FORM -->
</div>
<!-- END LOGIN -->
<!-- BEGIN COPYRIGHT -->
<div class="copyright">
    2015 &copy; SimplEx
</div>
<!-- END COPYRIGHT -->

<?php include VIEW_DIR . "design/js.php"; ?>
<!-- END PAGE LEVEL SCRIPTS -->

<!-- BEGIN PAGE LEVEL PLUGINS -->
<script src="/assets/global/plugins/jquery-validation/js/jquery.validate.min.js" type="text/javascript"></script>
<script src="/assets/global/plugins/backstretch/jquery.backstretch.min.js" type="text/javascript"></script>
<script type="text/javascript" src="/assets/global/plugins/select2/select2.min.js"></script>
<script src="/assets/admin/pages/scripts/login-custom.js" type="text/javascript"></script>
<!-- END PAGE LEVEL PLUGINS -->
<script>
    jQuery(document).ready(function () {
        Metronic.init(); // init metronic core components
        Layout.init(); // init current layout
        Login.init();
        // init background slide images
        $.backstretch([
                "/assets/admin/pages/media/bg/bg1.jpg",
                "/assets/admin/pages/media/bg/bg2.jpg"
            ], {
                fade: 1000,
                duration: 8000
            }
        );
    });
</script>
<!-- END JAVASCRIPTS -->
</body>
<!-- END BODY -->
</html>
