<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 18/11/15
 * Time: 10:53
 */
include_once CONTROL_DIR . "Controller.php";
include_once BEAN_DIR . "CdL.php";
include_once MODEL_DIR . "CdLModel.php";
include_once MODEL_DIR . "AccountModel.php";
include_once EXCEPTION_DIR . "IllegalArgumentException.php";
include_once UTILS_DIR . "StringUtils.php";

class AuthController extends Controller {
    const PERMA_COOKIE = "permaCookie";

    /**
     * @return array di corsi di laurea
     */
    public function getCDL() {
        $cdlModel = new CdLModel();
        return $cdlModel->getAllCdL();
    }

    public function login($email, $password, $remember) {
        if (!preg_match(Patterns::$EMAIL, $email)) {
            throw new IllegalArgumentException("Email non valido");
        }
        if (strlen($password) < Config::$MIN_PASSWORD_LEN) {
            throw new IllegalArgumentException("Password è troppo corta");
        }
        $accModel = new AccountModel();
        $user = $accModel->getUtente($email, $password);

        $_SESSION['loggedin'] = true;
        $_SESSION['user'] = $user;

        if ($remember) {
            $this->setPermanentCookie($user->getPassword());
        }
        //todo protezione anti-bruteforce

        return $user;
    }

    /**
     * Verifica se permanent cookie esiste, se si - lo usa per ottenere l'utente
     * @return null|Utente
     */
    public function checkPermanentLogin() {
        try {
            if (!isset($_COOKIE[self::PERMA_COOKIE])) {
                return null;
            }
            $identity = $this->getIdentityFromPerm($_COOKIE[self::PERMA_COOKIE]);
            if (!preg_match(Patterns::$MD5, $identity)) {
                return null;
            }
            $accModel = new AccountModel();
            $user = $accModel->getUtenteByIdentity($identity);
            $_SESSION['loggedin'] = true;
            $_SESSION['user'] = $user;
            return $user;
        } catch (UserNotFoundException $ex) {
            return null;
        }
    }

    public function logOut() {
        $_SESSION['loggedin'] = false;
        unset($_SESSION['user']);
        setcookie(self::PERMA_COOKIE, "", 0);
    }

    /**
     * @param $matricola
     * @param $email
     * @param $password
     * @param $tipologia
     * @param $nome
     * @param $cognome
     * @param $cdl
     * @return Utente registrato nel db
     * @throws IllegalArgumentException nel caso se i parametri sono errati
     * @throws RuntimeException violati constraint nel db (utente esistente, matricola duplicata, cdl inesistente)
     *
     */
    public function register($matricola, $email, $password, $tipologia, $nome, $cognome, $cdl) {
        if (!preg_match(Patterns::$EMAIL, $email)) {
            throw new IllegalArgumentException("Email non valido");
        }
        if (!preg_match(Patterns::$MATRICOLA, $matricola)) {
            throw new IllegalArgumentException("Matricola non valida");
        }
        if (strlen($password) < Config::$MIN_PASSWORD_LEN) {
            throw new IllegalArgumentException("Password è troppo corta");
        }
        //todo bloccare tipologie diversi da studente
        if (!in_array($tipologia, Config::$TIPI_UTENTE) || $tipologia == "admin") {
            throw new IllegalArgumentException("Tipo utente errato");
        }
        if (!preg_match(Patterns::$NAME_GENERIC, $nome)) {
            throw new IllegalArgumentException("Nome assente oppure errato");
        }
        if (!preg_match(Patterns::$NAME_GENERIC, $cognome)) {
            throw new IllegalArgumentException("Cognome assente oppure errato");
        }
        if (!preg_match(Patterns::$MATRICOLA, $cdl)) {
            throw new IllegalArgumentException("Cdl sbagliato o assente");
        }
        $accModel = new AccountModel();
        return $accModel->createUtente($matricola, $email, $password, $tipologia, $nome, $cognome, $cdl);
    }

    private function setPermanentCookie($getPassword) {
        setcookie(self::PERMA_COOKIE, StringUtils::encrypt($getPassword), time() + 365 * 24 * 60 * 60);
    }

    private function getIdentityFromPerm($permanent) {
        return StringUtils::decrypt($permanent);
    }
}