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

class AuthController extends Controller {
    /**
     * @return array di corsi di laurea
     */
    public function getCDL() {
        $cdlModel = new CdLModel();
        //TODO qualche logica in più

        return $cdlModel->getAllCdL();
    }

    public function login($username, $password, $remember) {
        $accModel = new AccountModel();
        $user = $accModel->getUtente($username, $password);
        die();
        $_SESSION['loggedin'] = true;
        $_SESSION['user'] = $user;

        return $user;
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
        if (!in_array($tipologia, Config::$TIPI_UTENTE) || $tipologia == "admin") {
            throw new IllegalArgumentException("Password è troppo corta");
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
        return $accModel->register($matricola, $email, $password, $tipologia, $nome, $cognome, $cdl);
    }
}