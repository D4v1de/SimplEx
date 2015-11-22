<?php
include_once MODEL_DIR . "Model.php";
include_once BEAN_DIR . "Utente.php";
include_once EXCEPTION_DIR . "UserNotFoundException.php";

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 18/11/15
 * Time: 09:34
 */
class AccountModel extends Model {
    private static $SALT = "r#*1542&ztnsa7uABN83gtkw7lcSjy";
    private static $SELECT_UTENTE = "SELECT * FROM `utente` WHERE 'password'='%s' LIMIT 1";
    private static $INSERT_UTENTE = "INSERT INTO `utente` (`matricola`, `username`, `password`, `tipologia`, `nome`, `cognome`, `cdl_matricola`) VALUES ('%s', '%s', '%s', '%s', '%s', '%s', '%s');";

    /**
     * Restituisce utente dato email e password
     * @param $email
     * @param $password
     * @return Utente
     * @throws ConnectionException
     * @throws UserNotFoundException
     */
    public function getUtente($email, $password) {
        $ident = self::createIdentity($email, $password);
        $query = sprintf(self::$SELECT_UTENTE, $ident);

        $res = Model::getDB()->query($query);
        if ($obj = $res->fetch_assoc()) {
            return new Utente($obj['username'], $obj['password'], $obj['matricola'], $obj['nome'], $obj['cognome'], $obj['tipologia']);
        } else {
            throw new UserNotFoundException("Utente non trovato");
        }
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
     * @param $matricola
     * @param $email
     * @param $password
     * @param $tipologia
     * @param $nome
     * @param $cognome
     * @param $cdl
     * @throws ConnectionException
     * @throws RuntimeException
     * @return Utente
     */
    public function register($matricola, $email, $password, $tipologia, $nome, $cognome, $cdl) {
        $ident = self::createIdentity($email, $password);
        $query = sprintf(self::$INSERT_UTENTE, $matricola, $email, $ident, $tipologia, $nome, $cognome, $cdl);
        if (!Model::getDB()->query($query)) {
            throw new RuntimeException(Model::getDB()->error, Model::getDB()->errno);
        }
        return new Utente($email, $password, $matricola, $nome, $cognome, $tipologia);
    }

}