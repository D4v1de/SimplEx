<?php

/**
 * Classe di supporto per la gestione delle stringhe
 *
 * @author Sergio Shevchenko
 * @version 1.0
 * @since 23/11/15
 */
class StringUtils {

    private static $IV = "3562567812345678";
    private static $ENC_PASS = "7463847812345678";

    public static function encrypt($string) {
        return openssl_encrypt($string, "aes128", self::$ENC_PASS, false, self::$IV);
    }

    public static function decrypt($string) {
        return openssl_decrypt($string, "aes128", self::$ENC_PASS, false, self::$IV);
    }

    /**
     * @param $level string Livello di accesso, ad esempio Docente
     * @param string $redirect nel caso il livello è più basso, verrà reindirizzato su questo URL
     */
    public static function checkPermission($level, $redirect = "/auth") {
        if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] == true) {
            /** @var Utente $user */
            $user = $_SESSION['user'];
            if (strtolower($user->getTipologia()) == strtolower($level) || strtolower($level) == "all") {
                return;
            }
        }
        header('Location: ' . $redirect);
        exit;
    }

    /**
     * Funzione verifica se l'ip appartiene alla maschera
     * @param $ip String es. 192.168.1.22
     * @param $maschera String es. 192.168.*.*
     * @return bool
     */
    public static function compareIP($ip, $maschera) {
        if (!preg_match("/^([\d]{1,3}|\*)\.([\d]{1,3}|\*)\.([\d]{1,3}|\*)\.([\d]{1,3}|\*)$/i", $maschera)) {
            return false;
        }
        $pies = explode("*", $maschera);
        $prefix = $pies[0];
        return substr($ip, 0, strlen($prefix)) === $prefix;
    }
}