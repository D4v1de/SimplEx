<?php

/**
 * Created by PhpStorm.
 * User: sergio
 * Date: 18/11/15
 * Time: 10:53
 */
include_once CONTROL_DIR . "Controller.php";
include_once BEAN_DIR . "CdL.php";
include_once MODEL_DIR . "CdLModel.php";
include_once MODEL_DIR . "AccountModel.php";

class AuthController extends Controller {
    /**
     * @return array di corsi di laurea
     */
    public function getCDL() {
        $cdlModel = new CdLModel();
        //TODO qualche logica in più

        return $cdlModel->getAllCdL();
    }

    public function login($username, $password) {
        //TODO eventuali verifiche sulla correttezza
        $accModel = new AccountModel();
        $user = $accModel->doLogin($username, $password);
        $_SESSION['loggedin'] = true;
        $_SESSION['user'] = $user;

        return $user;
    }
}