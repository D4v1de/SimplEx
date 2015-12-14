<?php
/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 18/11/15
 * Time: 10:07
 */
/** @var Utente $user */
$user = $_SESSION['user'];
?>

<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
    <!-- DOC: Change data-auto-speed="200" to adjust the sub menu slide up/down speed -->
    <div class="page-sidebar navbar-collapse collapse">
        <!-- BEGIN SIDEBAR MENU -->
        <!-- DOC: Apply "page-sidebar-menu-light" class right after "page-sidebar-menu" to enable light sidebar menu style(without borders) -->
        <!-- DOC: Apply "page-sidebar-menu-hover-submenu" class right after "page-sidebar-menu" to enable hoverable(hover vs accordion) sub menu mode -->
        <!-- DOC: Apply "page-sidebar-menu-closed" class right after "page-sidebar-menu" to collapse("page-sidebar-closed" class must be applied to the body element) the sidebar sub menu mode -->
        <!-- DOC: Set data-auto-scroll="false" to disable the sidebar from auto scrolling/focusing -->
        <!-- DOC: Set data-keep-expand="true" to keep the submenues expanded -->
        <!-- DOC: Set data-auto-speed="200" to adjust the sub menu slide up/down speed -->
        <ul class="page-sidebar-menu page-sidebar-menu-light " data-keep-expanded="false" data-auto-scroll="true"
            data-slide-speed="200">
            <?php if ($user->getTipologia() == "Admin") { ?>
                <!-- ADMIN -->

                <li class="<?php if ($_URL[1] == "utenti") echo "active open" ?>">
                    <a href="javascript:;">
                        <i class="icon-users"></i>
                        <span class="title">Gestione utenti</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu" style="display: none;">
                        <li>
                            <a href="/admin/utenti">
                                <i class="icon-book-open"></i>
                                Visualizza lista</a>
                        </li>
                        <li>
                            <a href="/admin/utenti/crea/studente">
                                <i class="icon-user-follow"></i>
                                Crea studente</a>
                        </li>
                        <li>
                            <a href="/admin/utenti/crea/docente">
                                <i class="icon-user-follow"></i>
                                Crea docente</a>
                        </li>
                    </ul>
                </li>

                <li class="<?php if ($_URL[1] == "cdl") echo "active open" ?>">
                    <a href="javascript:;">
                        <i class="icon-notebook"></i>
                        <span class="title">Gestione CdL</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu" style="display: none;">
                        <li>
                            <a href="/admin/cdl/view">
                                <i class="icon-book-open"></i>
                                Visualizza tutti CdL</a>
                        </li>
                        <li>
                            <a href="/admin/cdl/crea">
                                <i class="icon-plus"></i>
                                Crea CdL</a>
                        </li>
                    </ul>
                </li>

                <li class="<?php if ($_URL[1] == "corsi") echo "active open" ?>">
                    <a href="javascript:;">
                        <i class="icon-note"></i>
                        <span class="title">Gestione Corsi</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu" style="display: none;">
                        <li>
                            <a href="/admin/corsi/view">
                                <i class="icon-book-open"></i>
                                Visualizza tutti corsi</a>
                        </li>
                        <li>
                            <a href="/admin/corsi/crea">
                                <i class="icon-plus"></i>
                                Crea Corso</a>
                        </li>
                    </ul>
                </li>
                <!-- FINE ADMIN -->
            <?php } elseif ($user->getTipologia() == "Docente") { ?>
                <li class="<?php if (@$_URL[2] == "") echo "active open" ?>">
                    <a href="/docente">
                        <i class="icon-home"></i>
                        <span class="title">Home</span>
                    </a>
                </li>

                <li class="<?php if (@$_URL[2] == "cdls") echo "active open" ?>">
                    <a href="/docente/cdls">
                        <i class="icon-notebook"></i>
                        <span class="title">Tutti i Cdl</span>
                    </a>
                </li>
                <li class="<?php if ($_URL[1] == "utenti") echo "active open" ?>">
                    <a href="javascript:;">
                        <i class="icon-users"></i>
                        <span class="title">Da COMPLETARE</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu" style="display: none;">
                        <li>
                            <a href="/admin/utenti">
                                <i class="icon-book-open"></i>
                                IDEM</a>
                        </li>
                    </ul>
                </li>
            <?php } elseif ($user->getTipologia() == "Studente") { ?>
                <li class="<?php if (@$_URL[2] == "") echo "active open" ?>">
                    <a href="/studente">
                        <i class="icon-home"></i>
                        <span class="title">Home</span>
                    </a>
                </li>

                <li class="<?php if (@$_URL[2] == "cdls") echo "active open" ?>">
                    <a href="/studente/cdls">
                        <i class="icon-notebook"></i>
                        <span class="title">Tutti i Cdl</span>
                    </a>
                </li>

                <li class="<?php if ($_URL[1] == "utenti") echo "active open" ?>">
                    <a href="javascript:;">
                        <i class="icon-users"></i>
                        <span class="title">Da COMPLETARE</span>
                        <span class="arrow"></span>
                    </a>
                    <ul class="sub-menu" style="display: none;">
                        <li>
                            <a href="/admin/utenti">
                                <i class="icon-book-open"></i>
                                IDEM</a>
                        </li>
                    </ul>
                </li>
            <?php } else {
                die("Situazione impossibile ... esco");
            }
            ?>
        </ul>
        <!-- END SIDEBAR MENU -->
    </div>
</div>
<!-- END SIDEBAR -->

