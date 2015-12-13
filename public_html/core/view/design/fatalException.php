<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 13/12/15
 * Time: 19:09
 */

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
    <title>SimplEx | È partut o server</title>
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
<div class="content" style="width:500px;">
    <!-- BEGIN LOGIN FORM -->
    <div id="preloader" align="center" style="display: none">
        <img src="/assets/admin/pages/img/preloader.gif"/>
    </div>
    <div align="center">
        <img src="/assets/global/img/server-down.png"/>

        <h2 style="color:white">È partut o server</h2>
        <h5 style="color:white">(Il server è temporaneamente offline. Prova riavviare la pagina)</h5>
    </div>

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
