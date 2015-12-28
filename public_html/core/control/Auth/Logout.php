<?php
/**
 * Logout
 *
 * @author Sergio Shevchenko
 * @version 1.1
 * @since 29/11/15
 */
if (!isset($_SESSION['loggedin']) && !isset($_COOKIE[Config::$PERMA_COOKIE])) {
    header('Location: /');
}
logOut();
header('Location: /');

function logOut() {
    unset($_SESSION['loggedin']);
    unset($_SESSION['user']);
    setcookie(Config::$PERMA_COOKIE, "", 0);
}
