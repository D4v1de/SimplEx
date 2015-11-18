<?php
include_once CORE_DIR . "Config.php";
include_once EXCEPTION_DIR."ConnectionException.php";

class Model {

    /** @var  mysqli */
    private static $c;

    /**
     * @return mysqli
     * @throws ConnectionException
     */
    protected static function getDB() {
        if (self::$c == NULL) {
            self::$c = new mysqli(Config::$DB_URL, Config::$DB_USER, Config::$DB_PASS);
            if (self::$c->connect_error) {
                throw new ConnectionException("Connection failed: " . self::$c->connect_error);
            }
        }
    }
}

?>
