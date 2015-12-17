<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 23/11/15
 * Time: 10:56
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
}