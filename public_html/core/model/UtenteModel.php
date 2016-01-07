<?php
/**
 * Modello di gestione dell'Utente
 *
 * @author Sergio Shevchenko
 * @version 1.0
 * @since 27/11/15
 */

include_once MODEL_DIR . "Model.php";
include_once BEAN_DIR . "Utente.php";
include_once EXCEPTION_DIR . "IllegalArgumentException.php";

class UtenteModel extends Model {
    private static $SALT = "r#*1542&ztnsa7uABN83gtkw7lcSjy";
    private static $SELECT_UTENTE = "SELECT * FROM `utente` WHERE `password`='%s' LIMIT 1";
    private static $SELECT_UTENTE_MATRICOLA = "SELECT * FROM `utente` WHERE `matricola`='%s' LIMIT 1 ";
    private static $INSERT_UTENTE = "INSERT INTO `utente` (`matricola`, `username`, `password`, `tipologia`, `nome`, `cognome`, `cdl_matricola`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', %s);";
    private static $DELETE_UTENTE = "DELETE FROM `utente` WHERE `matricola` = '%s' LIMIT 1";
    private static $SELECT_ALL_UTENTI = "SELECT * FROM `utente` ORDER BY cognome";
    private static $SELECT_ALL_STUDENTI = "SELECT * FROM `utente` WHERE tipologia = 'Studente' ORDER BY cognome, nome, matricola";
    private static $UPDATE_UTENTE = "UPDATE `utente` SET `username` = '%s', `password` = '%s', `tipologia` = '%s', `nome` = '%s', `cognome` = '%s', `matricola` = '%s', `cdl_matricola`=%s  WHERE `matricola` = '%s' LIMIT 1";
    private static $GET_ALL_DOCENTI_CORSO = "SELECT u.* FROM `insegnamento` AS i, `utente` AS u WHERE i.docente_matricola = u.matricola AND i.corso_id = '%d' ORDER BY cognome, nome, matricola";
    private static $GET_ALL_STUDENTI_CDL = "SELECT u.* FROM `utente` AS u WHERE u.cdl_matricola = '%s' ORDER BY cognome, nome, matricola";
    private static $GET_ALL_STUDENTI_CORSO = "SELECT u.* FROM `utente` AS u, `frequenta` AS f WHERE f.studente_matricola = u.matricola AND f.corso_id = '%d' ORDER BY cognome, nome, matricola";
    private static $GET_ALL_STUDENTI_SESSIONE = "SELECT u.* FROM `abilitazione` AS a, `utente` AS u WHERE a.sessione_id = '%s' AND a.studente_matricola = u.matricola ORDER BY cognome, nome, matricola";
    private static $SELECT_ALL_DOCENTI = "SELECT * FROM `utente` WHERE tipologia = 'Docente' ORDER BY cognome, nome, matricola";
    private static $INSERT_FREQUENTA = "INSERT INTO `frequenta` (studente_matricola, corso_id) VALUES ('%s','%d')";
    private static $DELETE_FREQUENTA = "DELETE FROM `frequenta` WHERE studente_matricola = '%s' AND corso_id = '%d'";
    private static $INSERT_ABILITAZIONE = "INSERT INTO `abilitazione` (sessione_id, studente_matricola) VALUES ('%d', '%s')";
    private static $DELETE_ABILITAZIONE = "DELETE FROM `abilitazione` WHERE sessione_id = '%d' AND studente_matricola = '%s'";
    private static $GET_ALL_ESAMINANDI_SESSIONE = "SELECT * FROM utente WHERE tipologia = 'Studente' AND matricola IN (SELECT studente_matricola FROM elaborato WHERE sessione_id = '%d')";

    /**
     * Restituisce utente dato email e password
     * @param $email La mail dell'utente
     * @param $password La password dell'utente
     * @return Utente L'utente
     * @throws ConnectionException
     * @throws ApplicationException
     */
    public function getUtente($email, $password) {
        return $this->getUtenteByIdentity(self::createIdentity($email, $password));
    }

    /**
     * @param $identity L'identità dell'utente
     * @return Utente L'utente trovato
     * @throws ConnectionException
     * @throws ApplicationException
     */
    public function getUtenteByIdentity($identity) {
        $qr = sprintf(self::$SELECT_UTENTE, $identity);

        $res = Model::getDB()->query($qr);
        return $this->parseUtente($res);
    }

    /**
     * @param $matricola La matricola dell'utente da cercare
     * @return Utente L'utente trovato
     * @throws ConnectionException
     * @throws ApplicationException
     */

    public function getUtenteByMatricola($matricola) {
        $qr = sprintf(self::$SELECT_UTENTE_MATRICOLA, $matricola);

        $res = Model::getDB()->query($qr);
        return $this->parseUtente($res);
    }

    /**
     * Genera identità per salvare le pass ed effettuare le ricerche nel db in modo sicuro
     * @param $email La mail dell'utente
     * @param $pass La password dell'utente
     * @return string identity identità per salvare le pass ed effettuare le ricerche nel db in modo sicuro
     */

    public static function createIdentity($email, $pass) {
        return md5(md5(strtolower($email) . $pass . self::$SALT) . self::$SALT);
    }

    /**
     * @param Utente $utente L'utente da creare
     * @return Utente L'utente creato
     * @throws ApplicationException
     * @throws ConnectionException
     */

    public function createUtente($utente) {
        $ident = self::createIdentity($utente->getUsername(), $utente->getPassword());
        $utente->setPassword($ident);
        $utente->setNome(mysqli_real_escape_string(Model::getDB(), $utente->getNome()));
        $utente->setCognome(mysqli_real_escape_string(Model::getDB(), $utente->getCognome()));

        $query = sprintf(self::$INSERT_UTENTE, $utente->getMatricola(), $utente->getUsername(),
            $ident, $utente->getTipologia(), $utente->getNome(), $utente->getCognome(), ($utente->getCdlMatricola() == null) ? "NULL" : "'" . $utente->getCdlMatricola() . "'");
        if (!Model::getDB()->query($query)) {
            if (Model::getDB()->errno == 1062) {
                throw new ApplicationException(Error::$MATRICOLA_ESISTE, Model::getDB()->error, Model::getDB()->errno);
            } else
                throw new ApplicationException(Error::$INSERIMENTO_FALLITO, Model::getDB()->error, Model::getDB()->errno);
        }
        return $utente;
    }

    /**
     * Il metodo rimuove l'utente dato la matricola
     * @param $matricola La matricola dell'utente da cancellare
     * @throws ApplicationException
     * @throws ConnectionException
     */
    public function deleteUtente($matricola) {
        $qr = sprintf(self::$DELETE_UTENTE, $matricola);
        Model::getDB()->query($qr);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$CANCELLAZIONE_FALLITA);
        }
    }

    /**
     * Serializza tupla dal db in un oggetto Utente
     * @param mysqli_result $res
     * @return Utente
     * @throws ApplicationException [$UTENTE_NON_TROVATO]
     */

    private function parseUtente($res) {
        if ($obj = $res->fetch_assoc()) {
            return new Utente($obj['matricola'], $obj['username'], $obj['password'], $obj['tipologia'], $obj['nome'], $obj['cognome'], $obj['cdl_matricola']);
        } else {
            throw new ApplicationException(Error::$UTENTE_NON_TROVATO);
        }
    }

    /**
     * @return Utente[] Tutti gli utenti del db
     * @throws ConnectionException
     */

    public function getAllUtenti() {
        $res = Model::getDB()->query(self::$SELECT_ALL_UTENTI);
        $utenti = array();
        while ($obj = $res->fetch_assoc()) {
            $utenti[] = new Utente($obj['matricola'], $obj['username'], $obj['password'], $obj['tipologia'], $obj['nome'], $obj['cognome'], $obj['cdl_matricola']);
        }
        return $utenti;
    }

    /**
     * Restituisce tutti i Docenti del database
     * @return array Docenti
     * @throws ConnectionException
     */

    public function getAllDocenti() {
        $res = Model::getDB()->query(self::$SELECT_ALL_DOCENTI);
        $ret = array();
        while ($obj = $res->fetch_assoc()) {
            $ret[] = new Utente($obj['matricola'], $obj['username'], $obj['password'], $obj['tipologia'], $obj['nome'], $obj['cognome'], $obj['cdl_matricola']);
        }
        return $ret;
    }

    /**
     * Restituisce tutti gli Studenti del database
     * @return Utente[] Array di studenti
     * @throws ConnectionException
     */

    public function getAllStudenti() {
        $res = Model::getDB()->query(self::$SELECT_ALL_STUDENTI);
        $studenti = array();
        while ($obj = $res->fetch_assoc()) {
            $studenti[] = new Utente($obj['matricola'], $obj['username'], $obj['password'], $obj['tipologia'], $obj['nome'], $obj['cognome'], $obj['cdl_matricola']);
        }
        return $studenti;
    }

    /**
     * @param string $matricola
     * @param Utente $utente
     * @return bool aggiornato?
     * @throws ApplicationException
     * @throws ConnectionException
     */
    public function updateUtente($matricola, $utente) {
        $qr = sprintf(self::$UPDATE_UTENTE, $utente->getUsername(), $utente->getPassword(), $utente->getTipologia(), $utente->getNome(), $utente->getCognome(), $utente->getMatricola(), ($utente->getCdlMatricola() == null ? "NULL" : "'" . $utente->getCdlMatricola() . "'"), $matricola);
        Model::getDB()->query($qr);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$AGGIORNAMENTO_FALLITO);
        }
    }


    /**
     * Restituisce tutti i docenti che insegnano il corso
     * @param int $idCorso L'id del corso per la quale si vogliono conoscere i docenti che lo insegnano
     * @return Utente[] Tutti i docenti che insegnano il corso
     */

    public function getAllDocentiByCorso($idCorso) {
        $query = sprintf(self::$GET_ALL_DOCENTI_CORSO, $idCorso);
        $res = Model::getDB()->query($query);
        $docenti = array();
        if ($res) {
            while ($obj = $res->fetch_assoc()) {
                $docenti[] = new Utente($obj['matricola'], $obj['username'], $obj['password'], $obj['tipologia'], $obj['nome'], $obj['cognome'], $obj['cdl_matricola']);
            }
        }
        return $docenti;
    }

    /**
     * Restituisce tutti gli studenti abilitati ad una sessione
     * @param string $matricolaCdl La matricola del cdl per il quale si vogliono conoscere gli studenti iscritti
     * @return Utente[] Tutti gli studenti che sono iscritti al cdl
     */

    public function getAllStudentiByCdl($matricolaCdl) {
        $query = sprintf(self::$GET_ALL_STUDENTI_CDL, $matricolaCdl);
        $res = Model::getDB()->query($query);
        $studenti = array();
        if ($res) {
            while ($obj = $res->fetch_assoc()) {
                $studente = new Utente($obj['matricola'], $obj['username'], $obj['password'], $obj['tipologia'], $obj['nome'], $obj['cognome'], $obj['cdl_matricola']);
                $studenti[] = $studente;
            }
        }
        return $studenti;
    }

    /**
     * Restituisce tutti gli studenti iscritti ad un corso
     * @param int $idCorso L'id del corso per il quale si vogliono conoscere gli studenti iscritti
     * @return Utente[] Tutti gli studenti iscritti al corso
     */

    public function getAllStudentiByCorso($idCorso) {
        $query = sprintf(self::$GET_ALL_STUDENTI_CORSO, $idCorso);
        $res = Model::getDB()->query($query);
        $studenti = array();
        if ($res) {
            while ($obj = $res->fetch_assoc()) {
                $studente = new Utente($obj['matricola'], $obj['username'], $obj['password'], $obj['tipologia'], $obj['nome'], $obj['cognome'], $obj['cdl_matricola']);
                $studenti[] = $studente;
            }
        }
        return $studenti;
    }

    /**
     * Restituisce tutti gli studenti abilitati ad una sessione
     * @param $idSessione
     * @return Utente[] Tutti gli studenti che sono abilitati alla sessione
     * @throws ConnectionException
     */
    public function getAllStudentiSessione($idSessione) {
        $query = sprintf(self::$GET_ALL_STUDENTI_SESSIONE, $idSessione);
        $res = Model::getDB()->query($query);
        $studenti = array();
        if ($res) {
            while ($obj = $res->fetch_assoc()) {
                $studentiSessione = new Utente($obj['matricola'], $obj['username'], $obj['password'], $obj['tipologia'], $obj['nome'], $obj['cognome'], $obj['cdl_matricola']);
                $studenti[] = $studentiSessione;
            }
        }
        return $studenti;
    }

    /**
     * Iscrive uno studente ad un corso nel database
     * @param string $studenteMatricola la matricola dello studente da iscrivere
     * @param Corso idCorso L'id del corso a cui iscrivere lo studente
     * @throws ApplicationException
     */
    public function iscriviStudenteCorso($studenteMatricola, $idCorso) {
        $query = sprintf(self::$INSERT_FREQUENTA, $studenteMatricola, $idCorso);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$INSERIMENTO_FALLITO);
        }
    }

    /**
     * Disiscrive uno studente ad un corso nel database
     * @param string $studenteMatricola la matricola dello studente da disiscrivere
     * @param Corso idCorso L'id del corso a cui disiscrivere lo studente
     * @throws ApplicationException
     */
    public function disiscriviStudenteCorso($studenteMatricola, $idCorso) {
        $query = sprintf(self::$DELETE_FREQUENTA, $studenteMatricola, $idCorso);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$CANCELLAZIONE_FALLITA);
        }
    }

    /**
     * Abilita uno studente ad una sessione
     * @param Corso idSessione L'id della sessione alla quale abilitare lo studente
     * @param string $studenteMatricola la matricola dello studente da abilitare
     * @throws ApplicationException
     */
    public function abilitaStudenteSessione($idSessione, $studenteMatricola) {
        $query = sprintf(self::$INSERT_ABILITAZIONE, $idSessione, $studenteMatricola);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$INSERIMENTO_FALLITO);
        }
    }

    /**
     * Disabilita uno studente da una sessione
     * @param Corso idSessione L'id della sessione alla quale abilitare lo studente
     * @param string $studenteMatricola la matricola dello studente da abilitare
     * @throws ApplicationException
     */
    public function disabilitaStudenteSessione($idSessione, $studenteMatricola) {
        $query = sprintf(self::$DELETE_ABILITAZIONE, $idSessione, $studenteMatricola);
        Model::getDB()->query($query);
        if (Model::getDB()->affected_rows == -1) {
            throw new ApplicationException(Error::$CANCELLAZIONE_FALLITA);
        }
    }

    /**
     * Restituisce gli studenti che stanno sostenendo una sessione d'esame
     * @param $sessione_id L'id della sessione per la quale si vogliono conoscere gli esaminandi
     * @return Utente[] Gli esaminandi della sessione
     * @throws ApplicationException
     */

    public function getEsaminandiSessione($sessione_id) {
        $query = sprintf(self::$GET_ALL_ESAMINANDI_SESSIONE, $sessione_id);
        $res = Model::getDB()->query($query);
        $studenti = array();
        if ($res) {
            while ($obj = $res->fetch_assoc()) {
                $studentiSessione = new Utente($obj['matricola'], $obj['username'], $obj['password'], $obj['tipologia'], $obj['nome'], $obj['cognome'], $obj['cdl_matricola']);
                $studenti[] = $studentiSessione;
            }
        }
        return $studenti;
    }

    /**
     * Effettua il login
     * @param $email
     * @param $password
     * @param $remember bool indica se l'utente intende effettuare il logout manualmente
     * @return Utente loggato
     * @throws ApplicationException
     */
    public function login($email, $password, $remember) {
        if (!preg_match(Patterns::$EMAIL, $email)) {
            throw new ApplicationException(Error::$EMAIL_NON_VALIDA);
        }
        if (strlen($password) < Config::$MIN_PASSWORD_LEN) {
            throw new ApplicationException(Error::$PASS_CORTA);
        }

        $user = $this->getUtente($email, $password);

        $_SESSION['loggedin'] = true;
        $_SESSION['user'] = $user;

        if ($remember) {
            $this->setPermanentCookie($user->getPassword());
        }

        return $user;
    }

    /**
     * Verifica se permanent cookie esiste, se si - lo usa per ottenere l'utente
     * @return null|Utente
     */
    public function checkPermanentLogin() {
        try {
            if (!isset($_COOKIE[Config::$PERMA_COOKIE])) {
                return null;
            }
            $identity = $this->getIdentityFromPerm($_COOKIE[Config::$PERMA_COOKIE]);

            $user = $this->getUtenteByIdentity($identity);
            $_SESSION['loggedin'] = true;
            $_SESSION['user'] = $user;
            return $user;
        } catch (ApplicationException $ex) {
            return null;
        }
    }

    /**
     * Effettua il logout resettanto la sessione e i cookie
     */
    public function logOut() {
        unset($_SESSION['loggedin']);
        unset($_SESSION['user']);
        setcookie(Config::$PERMA_COOKIE, "", 0);
    }

    /**
     * Registra l'utente
     * @param $matricola string
     * @param $email string
     * @param $password string
     * @param $tipologia string
     * @param $nome string
     * @param $cognome string
     * @param $cdl int
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
        return $this->createUtente(new Utente($matricola, $email, $password, $tipologia, $nome, $cognome, $cdl));
    }

    /**
     * Setta il cookie permanente nel browser
     * @param $getPassword identity dell'utente
     */
    private function setPermanentCookie($getPassword) {
        $getPassword = $getPassword . "|" . md5(uniqid());
        setcookie(Config::$PERMA_COOKIE, StringUtils::encrypt($getPassword), time() + 365 * 24 * 60 * 60);
    }

    /**
     * Ripristina l'identità dell'utente dal cookie
     * @param $permanent
     * @return string identity
     */
    private function getIdentityFromPerm($permanent) {
        $identity = StringUtils::decrypt($permanent);

        if (!preg_match(Patterns::$MD5_SLASH, $identity)) {
            return null;
        }

        $identity = explode("|", $identity);
        return $identity[0];
    }

    /**
     * Restituisce tutti gli Utenti dato un filtro
     * @return array con tutti gli Utenti
     */
    public function getUtenti($filter = "ALL") {
        switch ($filter) {
            case "Docente":
                return $this->getAllDocenti();
            case "Studente":
                return $this->getAllStudenti();
            default:
                return $this->getAllUtenti();
        }
    }

    /**
     * Rimuove l'utenza dato la matricola
     * @param $matricola
     * @throws ApplicationException
     */
    public function eliminaUtenteByMatricola($matricola) {
        $accountModel = new UtenteModel();
        if (!is_numeric($matricola)) {
            throw new ApplicationException(Error::$MATRICOLA_INESISTENTE);
        }
        if (!preg_match(Patterns::$MATRICOLA, $matricola)) {
            throw new ApplicationException(Error::$MATRICOLA_INESISTENTE);
        }
        $accountModel->deleteUtente($matricola);
    }

    public function modificaUtente($matricola, $nome, $cognome, $cdlMatricola, $email, $pass, $tipo) {
        if (!is_numeric($matricola)) {
            throw new ApplicationException(Error::$MATRICOLA_INESISTENTE);
        }
        $utente = $this->getUtenteByMatricola($matricola);

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
        if (strlen($pass) >= Config::$MIN_PASSWORD_LEN) {
            $ident = self::createIdentity($email, $pass);
            $utente->setPassword($ident);
        }

        $this->updateUtente($matricola, $utente);
    }
}