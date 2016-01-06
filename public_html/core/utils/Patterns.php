<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 22/11/15
 * Time: 20:20
 */
class Patterns {
    public static $EMAIL = "/^[a-zA-Z0-9+&*-]+(?:\.[a-zA-Z0-9_+&*-]+)*@(?:[a-zA-Z0-9-]+\.)+[a-zA-Z]{2,7}$/";
    public static $MATRICOLA = "/^[0-9]{2,12}$/";
    public static $NAME_GENERIC = "/^[a-zA-Z0-9_ èàòù]+$/";
    public static $MD5_SLASH = "/^[a-f0-9]{32}\|[a-f0-9]{32}$/";
}