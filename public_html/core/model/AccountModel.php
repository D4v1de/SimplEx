<?php
include_once MODEL_DIR . "Model.php";
include_once BEAN_DIR . "Utente.php";

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 18/11/15
 * Time: 09:34
 */
class AccountModel extends Model {
    private static $SALT = "r#*1542&ztnsa7uABN83gtkw7lcSjy";
    private static $SELECT_UTENTE = "SELECT * FROM `utente` WHERE `password`='%s' LIMIT 1";
    private static $SELECT_UTENTE_MATRICOLA = "SELECT * FROM `utente` WHERE `matricola`='%s' LIMIT 1";
    private static $INSERT_UTENTE = "INSERT INTO `utente` (`matricola`, `username`, `password`, `tipologia`, `nome`, `cognome`, `cdl_matricola`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s');";
    private static $DELETE_UTENTE = "DELETE FROM `utente` WHERE `matricola` = '%s' LIMIT 1";
    private static $SELECT_ALL_UTENTI = "SELECT * FROM `utente`";
    private static $UPDATE_UTENTE = "UPDATE `utente` SET `username` = '%s', `password` = '%s', `tipologia` = '%s', `nome` = '%s', `cognome` = '%s', `matricola` = '%s' WHERE `matricola` = '%s' LIMIT 1";

    // Aggiunti da Elvira
    private static $GET_ALL_DOCENTI_CORSO = "SELECT u.* FROM `insegnamento` as i, `utente` as u WHERE `i.docente_matricola` = `u.matricola` AND `i.corso_id` = '%d'";
    private static $GET_ALL_STUDENTI_CDL = "SELECT u.* FROM `utente` as u WHERE `u.cdl_matricola` = '%s'";
    private static $GET_ALL_STUDENTI_CORSO = "SELECT u.* FROM `utente` as u, `frequenta` as f WHERE f.studente_matricola = u.matricola AND f.corso_id = '%d'";
    private static $GET_ALL_STUDENTI_SESSIONE = "SELECT u.* FROM `abilitazione` as a, `utente` as u WHERE `a.sessione_id` = '%s' AND `a.studente_matricola` = `u.matricola`";

    // Aggiunto da Federico
    private static $SELECT_ALL_DOCENTI = "SELECT * FROM `utente` WHERE `tipologia` = 'Docente'";

    /**
     * Restituisce utente dato email e password
     * @param $email
     * @param $password
     * @return Utente
     * @throws ConnectionException
     * @throws ApplicationException
     */
    public function getUtente($email, $password) {
        return $this->getUtenteByIdentity(self::createIdentity($email, $password));
    }

    /**
     * @param $identity
     * @return Utente
     * @throws ConnectionException
     * @throws ApplicationException
     */
    public function getUtenteByIdentity($identity) {
        $qr = sprintf(self::$SELECT_UTENTE, $identity);

        $res = Model::getDB()->query($qr);
        return $this->parseUtente($res);
    }

    /**
     * @param $matricola
     * @return Utente
     * @throws ConnectionException
     * @throws ApplicationException
     */

    public function getUtenteByMatricola($matricola) {
        $qr = sprintf(self::$SELECT_UTENTE_MATRICOLA, $matricola);

        $res = Model::getDB()->query($qr);
        return $this->parseUtente($res);
    }

    /**
     * Genera identità per salvare le pass ed effettuare le ricerce nel db in modo sicuro
     * @param $email
     * @param $pass
     * @return string identity
     */

    private static function createIdentity($email, $pass) {
        return md5(md5(strtolower($email) . $pass . self::$SALT) . self::$SALT);
    }

    /**
     * @param Utente $utente
     * @return Utente
     * @throws ApplicationException [$INSERIMENTO_FALLITO]
     * @throws ConnectionException
     */

    public function createUtente($utente) {
        $ident = self::createIdentity($utente->getUsername(), $utente->getPassword());
        $utente->setPassword($ident);
        $utente->setNome(mysqli_real_escape_string(Model::getDB(), $utente->getNome()));
        $utente->setCognome(mysqli_real_escape_string(Model::getDB(), $utente->getCognome()));

        $query = sprintf(self::$INSERT_UTENTE, $utente->getMatricola(), $utente->getUsername(),
            $ident, $utente->getTipologia(), $utente->getNome(), $utente->getCognome(), $utente->getCdlMatricola());
        if (!Model::getDB()->query($query)) {
            throw new ApplicationException(Error::$INSERIMENTO_FALLITO, Model::getDB()->error, Model::getDB()->errno);
        }
        return $utente;
    }

    /**
     * Il metodo rimuove l'utente dato la matricola
     * @param $matricola
     * @return bool Cancellato oppure no
     * @throws ConnectionException
     */

    public function removeUtente($matricola) {
        $qr = sprintf(self::$DELETE_UTENTE, $matricola);
        Model::getDB()->query($qr);

        return (Model::getDB()->affected_rows == 1);
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
     * @return array Utente
     * @throws ConnectionException
     */

    public function getAllUtenti() {
        $res = Model::getDB()->query(self::$SELECT_ALL_UTENTI);
        $ret = array();
        while ($obj = $res->fetch_assoc()) {
            $ret[] = new Utente($obj['matricola'], $obj['username'], $obj['password'], $obj['tipologia'], $obj['nome'], $obj['cognome'], $obj['cdl_matricola']);
        }
        return $ret;
    }

    /**
     * Aggiunta da federico
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
     * @param string $matricola
     * @param Utente $utente
     * @return bool aggiornato?
     * @throws ConnectionException
     *
     */

    public function updateUtente($matricola, $utente) {
        $qr = sprintf(self::$UPDATE_UTENTE, $utente->getUsername(), $utente->getPassword(), $utente->getTipologia(), $utente->getNome(), $utente->getCognome(), $utente->getMatricola(), $matricola);

        Model::getDB()->query($qr);
        return (Model::getDB()->affected_rows == 1);
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
        if($res){
            while ($obj = $res->fetch_assoc()) {
                $docenti[] = Utente($obj['matricola'], $obj['username'], $obj['password'], $obj['tipologia'], $obj['nome'], $obj['cognome'], $obj['cdl_matricola']);
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
        while($obj = $res->fetch_assoc()) {
            $studenti[] = new Utente($obj['matricola'], $obj['username'], $obj['password'], $obj['tipologia'], $obj['nome'], $obj['cognome'], $obj['cdl_matricola']);
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
     * @param int $id L'id della sessione per la quale si vogliono conoscere gli studenti abilitati
     * @return Utente[] Tutti gli studenti che sono abilitati alla sessione
     */
    public function getAllStudentiSessione($id) {
        $query = sprintf(self::$GET_ALL_STUDENTI_SESSIONE, $id);
        $res = Model::getDB()->query($query);
        $studenti = array();
        if ($res) {
            while ($obj = $res->fetch_assoc()) {
                $studentiSessione = Utente($obj['matricola'], $obj['username'], $obj['password'], $obj['tipologia'], $obj['nome'], $obj['cognome'], $obj['cdl_matricola']);
                $studenti[] = $studentiSessione;
            }
        }
        return $studenti;
    }
}