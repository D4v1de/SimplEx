<?php
/**
 * Gestione Login
 *
 * @author Sergio Shevchenko
 * @version 1.1
 * @since 25/11/15
 */

include_once MODEL_DIR . "UtenteModel.php";
include_once UTILS_DIR . "StringUtils.php";

try {
    Logger::info("Richiesta login [" . $_POST['email'] . " " . $_POST['password'] . " " . @$_POST['remember'] . "]");
    $user = login($_POST['email'], $_POST['password'], (@$_POST['remember'] == "1" ? true : false));
    Logger::info("Login effettuato " . $user->getUsername());
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
    echo json_encode(array('status' => true, 'redirect' => $redirect));
} catch (ApplicationException $ex) {
    Logger::warning("Errore nel login " . $ex);
    echo json_encode(array('status' => false, 'error' => $ex->getMessage()));
}

/**
 * @param $email
 * @param $password
 * @param $remember
 * @return Utente
 * @throws ApplicationException
 */
function login($email, $password, $remember) {
    if (!preg_match(Patterns::$EMAIL, $email)) {
        throw new ApplicationException(Error::$EMAIL_NON_VALIDA);
    }
    if (strlen($password) < Config::$MIN_PASSWORD_LEN) {
        throw new ApplicationException(Error::$PASS_CORTA);
    }
    $accModel = new UtenteModel();
    $user = $accModel->getUtente($email, $password);

    $_SESSION['loggedin'] = true;
    $_SESSION['user'] = $user;

    if ($remember) {
        $this->setPermanentCookie($user->getPassword());
    }

    return $user;
}

function setPermanentCookie($getPassword) {
    $getPassword = $getPassword . "|" . md5(uniqid());
    setcookie(Config::$PERMA_COOKIE, StringUtils::encrypt($getPassword), time() + 365 * 24 * 60 * 60);
}