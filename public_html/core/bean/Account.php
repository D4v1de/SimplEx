<?php

/**
 * User: Elvira
 * Date: 20/11/15
 * Time: 16:30
 */
class Account {
    protected $username;
    protected $password;
    
    /**
     * Costruttore di Account
     */
    public function __construct($username, $password) {
        $this->username=$username;
        $this->password=$password;
    } 

    /**
     * @return la username dell'account
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * @return la password dell'account
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Setta la username dell'account
     * @param $username username dell'account
     */
    public function setUsername($username) {
        $this->username = $username;
    }
    
    /**
     * Setta la password dell'account
     * @param $password la password dell'account
     */
    public function setPassword($password) {
        $this->password = $password;
    }
}