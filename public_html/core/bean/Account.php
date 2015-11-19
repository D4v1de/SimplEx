<?php

/**
 * User: Elvira
 * Date: 19/11/15
 * Time: 16:34
 */
class Account {
    protected $username;
    protected $password;
    
    /**
     * Account's constructor.
     */
    public function __construct($username, $password) {
        $this->username=$username;
        $this->password=$password;
    } 

    /**
     * @return mixed username
     */
    public function getUsername() {
        return $this->username;
    }

    /**
     * @return mixed password
     */
    public function getPassword() {
        return $this->password;
    }

    /**
     * Sets Account's username
     * @param $username
     */
    public function setUsername($username) {
        $this->username = $username;
    }
    
    /**
     * Sets Account's password
     * @param $password
     */
    public function setPassword($password) {
        $this->password = $password;
    }



}