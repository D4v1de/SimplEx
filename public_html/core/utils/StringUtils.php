<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 23/11/15
 * Time: 10:56
 */
class StringUtils {

    public static $IV = "3333567812345678";
    public static $ENC_PASS = "1234547812345678";

    public static function encrypt($string) {
        return openssl_encrypt($string, "aes128", self::$ENC_PASS, false, self::$IV);
    }

    public static function decrypt($string) {
        return openssl_decrypt($string, "aes128", self::$ENC_PASS, false, self::$IV);
    }
}