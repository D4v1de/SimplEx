<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 30/11/15
 * Time: 20:59
 */
include_once BEAN_DIR . "Utente.php";
include_once MODEL_DIR . "AccountModel.php";
include_once CONTROL_DIR . "Controller.php";
include_once BEAN_DIR . "CdL.php";
include_once MODEL_DIR . "CdLModel.php";
include_once EXCEPTION_DIR . "IllegalArgumentException.php";
include_once UTILS_DIR . "StringUtils.php";

class UtenteController extends Controller {

    const PERMA_COOKIE = "permaCookie";

    /**
     * @return array di corsi di laurea
     */
    public function getCDL() {
        $cdlModel = new CdLModel();
        return $cdlModel->getAllCdL();
    }

    /**
     * @param $email
     * @param $password
     * @param $remember
     * @return Utente
     * @throws ApplicationException
     */
    public function login($email, $password, $remember) {
        if (!preg_match(Patterns::$EMAIL, $email)) {
            throw new ApplicationException(Error::$EMAIL_NON_VALIDA);
        }
        if (strlen($password) < Config::$MIN_PASSWORD_LEN) {
            throw new ApplicationException(Error::$PASS_CORTA);
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

            $accModel = new AccountModel();
            $user = $accModel->getUtenteByIdentity($identity);
            $_SESSION['loggedin'] = true;
            $_SESSION['user'] = $user;
            return $user;
        } catch (ApplicationException $ex) {
            return null;
        }
    }

    public function logOut() {
        unset($_SESSION['loggedin']);
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
        if (!in_array($tipologia, Config::$TIPI_UTENTE) || $tipologia == "admin") {
            throw new IllegalArgumentException("Tipo utente errato");
        }
        if (!preg_match(Patterns::$NAME_GENERIC, $nome)) {
            throw new IllegalArgumentException("Nome assente oppure errato");
        }
        if (!preg_match(Patterns::$NAME_GENERIC, $cognome)) {
            throw new IllegalArgumentException("Cognome assente oppure errato");
        }
        if (!preg_match(Patterns::$MATRICOLA, $cdl) && $tipologia == "Studente") {
            throw new IllegalArgumentException("Cdl sbagliato o assente");
        }
        $accModel = new AccountModel();
        return $accModel->createUtente(new Utente($matricola, $email, $password, $tipologia, $nome, $cognome, $cdl));
    }

    private function setPermanentCookie($getPassword) {
        $getPassword = $getPassword . "|" . md5(uniqid());
        setcookie(self::PERMA_COOKIE, StringUtils::encrypt($getPassword), time() + 365 * 24 * 60 * 60);
    }


    private function getIdentityFromPerm($permanent) {
        $identity = StringUtils::decrypt($permanent);

        if (!preg_match(Patterns::$MD5_SLASH, $identity)) {
            return null;
        }

        $identity = explode("|", $identity);
        return $identity[0];
    }

    public function getUtenteByMatricola($matricola) {
        $accModel = new AccountModel();
        return $accModel->getUtenteByMatricola($matricola);
    }

    /**
     * Restituisce i Docenti associati a un Corso
     * @param id del Corso
     * @return array con i Docenti associati al corso specificato
     */
    public function getDocenteAssociato($corsoID) {
        $accountModel = new AccountModel();
        return $accountModel->getAllDocentiByCorso($corsoID);
    }

    /**
     * Restituisce tutti gli Utenti
     * @return array con tutti gli Utenti
     */
    public function getUtenti() {
        $accountModel = new AccountModel();
        return $accountModel->getAllUtenti();
    }

    /**
     * Restituisce tutti gli Studenti
     * @return array con tutti gli Studenti
     */
    public function getStudenti() { //da vedere
        $accountModel = new AccountModel();
        return $accountModel->getAllStudenti();
    }

    /**
     * Restituisce tutti i Docenti
     * @return array con tutti i Docenti
     */
    public function getDocenti() {
        $accountModel = new AccountModel();
        return $accountModel->getAllDocenti();
    }

    public function modificaUtente($matricola, $fieldName, $value) {
        //TODO verifiche in più
        if (!is_numeric($matricola)) {
            throw new ApplicationException(Error::$MATRICOLA_INESISTENTE);
        }
        $aModel = new AccountModel();
        $utente = $aModel->getUtenteByMatricola($matricola);

        //!!! CRAZY CODE START
        if ($fieldName == "matricola" && preg_match(Patterns::$MATRICOLA, $value)) {
            $utente->setMatricola($value);
        } else {
            throw new ApplicationException(Error::$MATRICOLA_INESISTENTE);
        }

        if ($fieldName == "username" && preg_match(Patterns::$EMAIL, $value)) {
            $utente->setUsername($value);
        } else {
            throw new ApplicationException(Error::$EMAIL_NON_VALIDA);
        }

        if ($fieldName == "nome" && preg_match(Patterns::$NAME_GENERIC, $value)) {
            $utente->setNome($value);
        } else {
            throw new ApplicationException(Error::$NOME_NON_VALIDO);
        }
        if ($fieldName == "cognome" && preg_match(Patterns::$NAME_GENERIC, $value)) {
            $utente->setCognome($value);
        } else {
            throw new ApplicationException(Error::$CONGNOME_NON_VALIDO);
        }

        if ($fieldName == "tipologia" && is_numeric($value)) {
            $utente->setCognome($value);
        } else {
            throw new ApplicationException(Error::$TIPO_UTENTE_ERRATO);
        }

        if ($fieldName == "corsi_tenuti") {
            //todo settare i corsi
        }

        $aModel->updateUtente($matricola, $utente);
    }

    /**
     * Iscrive uno studente ad un Corso
     * @param matricola dello Studente
     * @param id del Corso
     */
    public function iscrizioneStudente($matricola_studente, $id_corso) {
        $accountModel = new AccountModel();
        $accountModel->iscriviStudenteCorso($matricola_studente, $id_corso);
    }

    /**
     * Disiscrive uno studente ad un Corso
     * @param matricola dello Studente
     * @param id del Corso
     */
    public function disiscrizioneStudente($matricola_studente, $id_corso) {
        $accountModel = new AccountModel();
        $accountModel->disiscriviStudenteCorso($matricola_studente, $id_corso);
    }

    /**
     * Rimuove l'utenza dato la matricola
     * @param $matricola
     * @throws ApplicationException
     */
    public function eliminaUtenteByMatricola($matricola) {
        $accountModel = new AccountModel();
        if (!is_numeric($matricola)) {
            throw new ApplicationException(Error::$MATRICOLA_INESISTENTE);
        }
        if (!preg_match(Patterns::$MATRICOLA, $matricola)) {
            throw new ApplicationException(Error::$MATRICOLA_INESISTENTE);
        }
        $accountModel->deleteUtente($matricola);
    }

    public function modificaUtenteByType($matricola, $nome, $cognome, $cdlMatricola, $email, $pass, $tipo) {
        if (!is_numeric($matricola)) {
            throw new ApplicationException(Error::$MATRICOLA_INESISTENTE);
        }
        $aModel = new AccountModel();
        $utente = $aModel->getUtenteByMatricola($matricola);

        //!!! CRAZY CODE START
        if (preg_match(Patterns::$EMAIL, $email)) {
            $utente->setUsername($email);
        } else {
            throw new ApplicationException(Error::$EMAIL_NON_VALIDA);
        }

        if (preg_match(Patterns::$NAME_GENERIC, $nome)) {
            $utente->setNome($nome);
        } else {
            throw new ApplicationException(Error::$NOME_NON_VALIDO);
        }
        if (preg_match(Patterns::$NAME_GENERIC, $cognome)) {
            $utente->setCognome($cognome);
        } else {
            throw new ApplicationException(Error::$CONGNOME_NON_VALIDO);
        }
        if ($utente->getTipologia() == "Studente") {
            if ($cdlMatricola == null) {
                throw new ApplicationException(Error::$CDL_NON_TROVATO);
            } else {
                $utente->setCldMatricola($cdlMatricola);
            }
        } elseif ($utente->getTipologia() == "Docente") {
            $utente->setCldMatricola(null);
        }
        if (isset($pass) && strlen($pass) > 0 && strlen($pass) < Config::$MIN_PASSWORD_LEN) {
            throw new ApplicationException(Error::$PASS_CORTA);
        }
        if (strlen($pass) > Config::$MIN_PASSWORD_LEN) {
            $ident = AccountModel::createIdentity($email, $pass);
            $utente->setPassword($ident);
        }
        
        $aModel->updateUtente($matricola, $utente);
    }
}
