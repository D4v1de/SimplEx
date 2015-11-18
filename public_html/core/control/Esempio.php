<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 18/11/15
 * Time: 10:19
 */
include_once CONTROL_DIR . "Controller.php";

class Esempio extends Controller {
    /**
     * Faccio qualcosa qui
     * @return string data
     */
    public function getDateTime() {
        return date("H:i:s d/m/Y");
    }
}